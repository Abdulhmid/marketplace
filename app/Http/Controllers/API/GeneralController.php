<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Cities;
use App\Districts;
use App\Villages;
use App\Transactions;
use App\Transactions_detail;

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
        Transactions_detail $model_detail,
        Request $request
    )
    {
        $codeTrans = \GlobalHelper::generateCode();
        $model->create([
            'transaction_code' =>$codeTrans,
            'customers' => 0,
            'total_paid' => $request['totalPrice'],
            'total_discount' => $request['customerId'],
            'buyer_email' => $request['email'],
            'buyer_phone' => $request['phone'],
            'buyer_city' => $request['city'],
            'buyer_districts' => $request['district'],
            'buyer_villages' => $request['villages'],
            'address' => $request['address'],
            'note' => $request['notes'],
            'payment_id' => $request['payment'],
            'status' => 0,
            'created_by' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => 0,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        foreach ($request['dataProduct'] as $key => $value) {
            $model_detail->create([
                'transaction_code' => $codeTrans,
                'product_id' => $value['idProduct'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'note' => $value['note'],
                'created_by' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_by' => 0,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        return response()->json([
            'data'  => $codeTrans,
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm(
        Transactions $model,
        Transactions_detail $model_detail,
        Request $request
    )
    {
        if ($files = $request->file('image')) {
            $destinationPath = 'public/imagesProof/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $dataProof['image_proof'] = "public/imagesProof/"."$profileImage";
        }
        $dataProof['status'] = 1;

        $row = $model->where('transaction_code', $request['code'])
            ->update($dataProof);

        return response()->json([
            'data'  => $row,
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

}
