<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Cities;
use App\Districts;
use App\Villages;
use App\Transactions;

class GeneralController
{

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataGeneral(
        Cities $model,
        Request $request
    )
    {
        if ($request['type']=='cities') {
            return response()->json([
                'data'  => \GlobalHelper::cities($request['province']),
                'response_code' => 200,
                'message' => 'Success'
            ], 200);
        }

        if ($request['type']=='districts') {
            return response()->json([
                'data'  => \GlobalHelper::districs($request['cities']),
                'response_code' => 200,
                'message' => 'Success'
            ], 200);
        }

        if ($request['type']=='villages') {
            return response()->json([
                'data'  => \GlobalHelper::villages($request['district']),
                'response_code' => 200,
                'message' => 'Success'
            ], 200);
        }

    }

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy(
        Transactions $model,
        Request $request
    )
    {
        return response()->json([
            'data'  => $request->all(),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

}
