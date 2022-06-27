<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorRequest;
use App\Models\Sensor;
use App\Models\Temperature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class SensorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param SensorRequest $request
     * @return JsonResponse
     */
    public function store(SensorRequest $request)
    {
        $sensor = Sensor::where('number', $request->id)->firstOrFail();

        $sensorData = array(
            'temperature' => $request->temperature,
            'created_at'  => gmdate("Y-m-d H:i:s", $request->timestamp),
            'sensor_id'   => $sensor->id
        );

        if($this->checkSensor($request)){
            $sensorData['faulty'] = 1;
        }

        Temperature::create($sensorData);
        return response()->json("Successfully added!", 200);
    }

    /**
     * Check the faulty sensor
     * @param $sensor
     * @return bool
     */
    public function checkSensor($sensor)
    {
        $sensorsAvgVal = Temperature::getTemperaturesByFace($sensor->face);
        $sensorTemp = $sensor->temperature;

        if(!is_null($sensorsAvgVal)){
            $temperatureDiff = $sensorsAvgVal > $sensorTemp ? $sensorsAvgVal - $sensorTemp : $sensorTemp - $sensorsAvgVal;
            $percentageDiff = ($temperatureDiff / $sensorsAvgVal) * 100;

            if($percentageDiff > 20){
                Log::channel('faultySensor')->info('Sensor deviated by '.round($percentageDiff, 2).'%', [
                    'ID' => $sensor->id,
                    'Temperature' => $sensor->temperature
                ]);
                return true;
            }
        }
        return false;
    }
}
