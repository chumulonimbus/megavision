<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\V1\ReportModel;

class ReportController extends BaseController
{
    use ResponseTrait;
    public function reports()
    {
        $reportModel = new ReportModel();

        $salesPersonId = $this->request->user_id ?? null;

        if(!$salesPersonId){
            return $this->failUnauthorized('Akses ditolak. Token yang digunakan tidak valid');
        }

        // $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        // $endOfWeek   = date('Y-m-d', strtotime('sunday this week'));
        $startOfWeek = '2023-06-01';
        $endOfWeek = '2023-06-07';
        
        $weeklySales = $reportModel->getWeeklySales($salesPersonId, $startOfWeek, $endOfWeek);
        $weeklyOrdersCount = $reportModel->getWeeklyOrdersCount($salesPersonId, $startOfWeek, $endOfWeek);
        $orderHistory = $reportModel->getRecentOrderHistory($salesPersonId, 10);

        return $this->respond([
            'status'    => 'success',
            'data'      => [
                'current_week'  => [
                    'total_amount'  => $weeklySales,
                    'total_orders'  => $weeklyOrdersCount,
                    'start_date'    => $startOfWeek,
                    'end_date'      => $endOfWeek
                ],
                'order_history' => $orderHistory
            ]
        ]);


    }
}
