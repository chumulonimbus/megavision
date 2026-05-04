<?php
namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Models\DashboardModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard - Megavision'
        ];
        return view('Modules\Dashboard\Views\dashboard', $data);
    }

    public function fetchData()
    {
        if(!$this->request->isAJAX()){
            return redirect()->to('/dashboard');
        }

        $dashboardModel = new DashboardModel();

        $payloadData = $this->request->getJSON(true);

        $filters = [
            'start_date' => $payloadData['start_date'],
            'end_date' => $payloadData['end_date'],
            'search' => $payloadData['search'],
        ];

        $sort = [
            'column' => $payloadData['sort_column'] ?? 'order_date',
            'direction' => $payloadData['sort_direction'] ?? 'DESC'
        ];

        $page = $payloadData['page'] ?? 1;
        $perPage = $payloadData['per_page'] ?? 10;
        $offset = ($page - 1) * $perPage;

        $data = $dashboardModel->getFilteredData($filters, $sort, $perPage, $offset);

        $totalRows = $dashboardModel->countData($filters);
        $totalPages = ceil($totalRows / $perPage);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $data,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_rows' => $totalRows
            ]
        ]);
    }
    
    public function getReportBySales()
    {
        if(!$this->request->isAJAX()){
            return redirect()->to('/dashboard');
        }

        $dashboardModel = new DashboardModel;
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Oct', 'Nov', 'Dec'];

        $reports = $dashboardModel->reportBySales(2023);
        $result = [];
        foreach($reports as $data){
            $name = $data["sp_name"];
            if(!isset($result[$name])){
                $result[$name] = [
                    "sales"     => $name,
                    "history"   => []
                ];
            }

            $result[$name]["history"][] = [
                "total" => $data["total"],
                "month" => $month[(int)$data["bulan_num"]]
            ];
        };
        return $this->response->setJSON([
            'status'    => 'success',
            'data'      => array_values($result)
        ]);
    }
}