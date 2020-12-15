<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Sliders;

class SlidersController
{

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataSliders(
        Sliders $model,
        Request $request
    )
    {
        return response()->json([
            'data'  => $model->latest()->get(),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }
}
