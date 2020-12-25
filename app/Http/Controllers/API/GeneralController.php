<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Cities;
use App\Districts;
use App\Villages;
use App\Transactions;
use App\Transactions_detail;
use App\User;
use Validator;
use Hash;
use Session;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class GeneralController
{

    use AuthenticatesUsers;
    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function actionLogin(
        Request $request
    ){

        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
 
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
 
        Auth::attempt($data);
 
        if (Auth::check()) {
            return response()->json([
                'data'  => [],
                'response_code' => 200,
                'message' => 'Login berhasil'
            ], 200);
 
        } else { // false
            return response()->json([
                'data'  => [],
                'response_code' => 500,
                'message' => 'Silahkan coba lagi'
            ], 500);
        }
    }

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function actionRegister(
        Request $request,
        User $model
    ){
        $row['updated_by'] = 0;
        $row['updated_at'] = \Carbon\Carbon::now();
        $row['created_by']    = 0;
        $row['created_at']    = \Carbon\Carbon::now();
        $row['password']      = bcrypt($request['password']);
        $row['name']        = $request['name'];
        $row['username']        = strtolower(str_replace(" ", "", $request['name']));
        $row['email']       = $request['email'];
        $row['phone']       = $request['phone'];
        $row['city_id']             = explode("-", $request['location'])[0];
        $row['province_id']         = explode("-", $request['location'])[1];
        $row['address']         = $request['address'];
        $row['role_id']         = \GlobalHelper::labelRole('customers');

        $data = $model->create($row);

        return response()->json([
            'data'  => $data,
            'response_code' => 200,
            'message' => 'Pendaftaran Berhasil'
        ], 200);
    }

    public function goLogout (Request $request) {
        //logout user
        Auth::logout();
        // auth()->logout();

        // redirect to homepage
        return redirect('/');
    }

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
        $dataShipping = explode("|", $request['courier_service']);
        $model->create([
            'transaction_code' =>$codeTrans,
            'customers' => 0,
            'total_paid' => $request['totalPrice'],
            'total_discount' => 0,
            'buyer_name' => $request['name'],
            'buyer_email' => $request['email'],
            'buyer_phone' => $request['phone'],
            'buyer_city' => explode("-", $request['location'])[0],
            'buyer_districts' => $request['district'],
            'buyer_villages' => $request['villages'],
            'address' => $request['address'],
            'note' => empty($request['notes'])?'-':$request['notes'],
            'payment_id' => $request['payment'],
            'status' => 0,
            'weight' => $request['weight'],
            'created_by' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => 0,
            'updated_at' => \Carbon\Carbon::now(),
            'courier' => $request['courier'],
            'courier_service' => $dataShipping[1],
            'shipping_fee' =>$dataShipping[0],
            'unique_fee' =>!empty($request['unique_fee'])?$request['unique_fee']:0
        ]);

        foreach ($request['dataProduct'] as $key => $value) {
            $model_detail->create([
                'transaction_code' => $codeTrans,
                'product_id' => $value['idProduct'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'note' => empty($value['note'])?'-':$value['note'],
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

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function cekOngkir(
        Request $request
    ){
        $originData = explode(",", $request['origin']);
        $originUsed = $originData[0];

        return response()->json([
            'data'  => \RajaOngkir::cekOngkir(
                $request['courier'],
                $request['origin'],
                $request['destination'],
                $request['weight']
            ),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }

}
