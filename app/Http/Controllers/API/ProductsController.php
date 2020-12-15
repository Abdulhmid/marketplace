<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Products;

class ProductsController
{

    /**
     * Display a login manual account kit.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataProducts(
        Products $products,
        Request $request
    )
    {
        return response()->json([
            'data'  => $products->latest()->get(),
            'response_code' => 200,
            'message' => 'Success'
        ], 200);
    }
}
