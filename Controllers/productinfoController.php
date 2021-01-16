<?php

namespace App\Http\Controllers;

use App\Models\productinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// use App\Http\Controllers\Validator;
class productinfoController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=productinfo::all();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productCode' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productdescription' => 'required',
            'manufacturer' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->messages()],400);
        }
    
        // Retrieve errors message bag
        // $errors = $validator->errors();


        productinfo::create([
            'productCode'=>$request['productCode'],
            'productName'=>$request['productName'],
            'productPrice'=>$request['productPrice'],
            'productdescription'=>$request['productdescription'],
            'manufacturer'=>$request['manufacturer']
        ]);

        return response()->json(['message'=>'Success'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function show($productinfo)
    {
        $products = DB::table('productinfo')
        ->select('productinfo.*')
        ->where('productinfo.productCode','=',$productinfo)
        ->get();
       
        return $products;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$productinfo)
    {
        // validate data that will be updated
        $validator = Validator::make($request->all(), [
            'productCode' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productdescription' => 'required',
            'manufacturer' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            // break point 
            return response()->json(['message'=>$validator->messages()],400);
        }
        //update all columns of product info table
        $editedproduct= DB::update('update productinfo set 
                                    productinfo.productCode=:pc
                                    ,
                                    productinfo.productName=:pn
                                    ,
                                    productinfo.productPrice=:pp
                                    ,
                                    productinfo.productdescription=:pd
                                    ,
                                    productinfo.manufacturer=:m
                                    where productCode=:productinfo',
                                        ['productinfo' =>$productinfo,
                                        'pc' =>$request['productCode'],
                                        'pn' =>$request['productName'],
                                        'pp' =>$request['productPrice'],
                                        'pd' =>$request['productdescription'],
                                        'm' =>$request['manufacturer']]);
 
      return response()->json(['message'=>'Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($productinfo)
    {
        DB::table('productinfo')
             ->where('productinfo.productCode','=',$productinfo)
             ->delete();
        return response()->json(['message'=>'Success'],200);
    }
}
