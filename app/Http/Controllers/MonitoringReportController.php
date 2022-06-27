<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MonitoringReportController extends Controller
{
    /**
     * Make weekly sensors average temperature report
     * @return Application|Factory|View
     */
    public function getWeeklyReport()
    {
        $getWeeklyData = Temperature::weeklyData();
        $weeklyData = $this->makeArray($getWeeklyData);
        return view('weeklyReport', compact('weeklyData'));
    }

    /**
     * Make a weekly report on the average temperature of the failed sensors
     * @return Application|Factory|View
     */
    public function getFailedWeeklyReport()
    {
        $getWeeklyData = Temperature::weeklyData(1);
        $weeklyData = $this->makeArray($getWeeklyData);
        return view('failedSensorsReport', compact('weeklyData'));
    }

    /**
     * Make multidimensional array
     * @param $dataObj
     * @return array
     */
    public function makeArray($dataObj): array
    {
        $weeklyData = [];
        foreach ($dataObj as $data){
            $weekdays[] = array(
                'hour' => $data->hour,
                'avg'  => $data->avgValue,
            );
            $weeklyData[$data->face][$data->date] = $weekdays;
        }
        return $weeklyData;
    }
}
