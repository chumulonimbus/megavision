<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    public function getWeeklySales($salesPersonId, $startDate, $endDate)
    {
        $result = $this->selectSum('order_amount')
            ->where('salesperson_id', $salesPersonId)
            ->where('order_date >=', $startDate)
            ->where('order_date <=', $endDate)
            ->first();
        
        return $result ? (float) $result['order_amount'] : 0;
    }

    public function getWeeklyOrdersCount($salesPersonId, $startDate, $endDate)
    {
        return $this->where('salesperson_id', $salesPersonId)
            ->where('order_date >=', $startDate)
            ->where('order_date <=', $endDate)
            ->countAllResults();
    }

    public function getRecentOrderHistory($salesPersonId, $limit = 10)
    {
        return $this->select('client_name, order_item, order_amount, order_date')
            ->where('salesperson_id', $salesPersonId)
            ->orderBy('order_date', 'DESC')
            ->findAll($limit);
    }
}
