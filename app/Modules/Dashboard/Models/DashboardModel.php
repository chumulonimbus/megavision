<?php
namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'orders';

    private function _getFilteredBuilder($filters)
    {
        $builder = $this->builder();
        $builder->select('orders.*, salespersons.sp_name, salespersons.sp_office');
        $builder->join('salespersons', 'salespersons.id = orders.salesperson_id');

        if(!empty($filters['start_date']) && !empty($filters['end_date'])){
            $builder->where('orders.order_date >=', $filters['start_date']);
            $builder->where('orders.order_date <=', $filters['end_date']);
        }

        if(!empty($filters['search'])){
            foreach($filters['search'] as $column => $keyword){
                if(!empty($keyword)){
                    if($column === 'order_date'){
                        $builder->groupStart();
                        $builder->like('orders.order_date', $keyword);
                        $builder->orWhere("DATE_FORMAT(oders.order_date, '%d %M %Y') LIKE", "%".$keyword."%");
                        $builder->orWhere("DATE_FORMAT(oders.order_date, '%d %b %Y') LIKE", "%".$keyword."%");
                        $builder->groupEnd();
                    } else {
                        $builder->like($column, $keyword);
                    }
                }
            }
        }

        return $builder;
    }

    public function getFilteredData($filters, $sort, $limit, $offset)
    {
        $data = $this->_getFilteredBuilder($filters);

        if(!empty($sort['column']) && !empty($sort['direction'])){
            $data->orderBy($sort['column'], $sort['direction']);
        } else {
            $data->orderBy('order_date', 'DESC');
        }

        return $data->limit($limit, $offset)->get()->getResultArray();
    }

    public function countData($filters)
    {
        $countData = $this->_getFilteredBuilder($filters);
        return $countData->countAllResults();
    }

    public function reportBySales($year = null)
    {
        return $this->select('salespersons.sp_name, SUM(order_amount) as total, MONTH(order_date) as bulan_num')
            ->join('salespersons', 'salespersons.id = salesperson_id')
            ->where('YEAR(order_date)', $year)
            ->groupBy('salespersons.id, salespersons.sp_name, MONTH(order_date)')
            ->orderBy('salespersons.id', 'ASC')
            ->orderBy('bulan_num', 'ASC')
            ->get()
            ->getResultArray();
    }
}