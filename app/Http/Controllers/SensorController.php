<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorRequest;
use App\Models\Sensor;
use Illuminate\Http\Request;


class SensorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param SensorRequest $request
     */
    public function index(SensorRequest $request)
    {
        $getSensors = Sensor::where('face', '=', $request->face)->get();

        dd($getSensors);
    }

    /**
     *
     */
    public function findFaultySensor()
    {

    }
}
