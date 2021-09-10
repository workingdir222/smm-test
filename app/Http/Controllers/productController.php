<?php

namespace App\Http\Controllers;

use App\Models\smm_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = smm_product::orderBy('date', 'DESC')->get();
        $response = [
            'message' => 'List data product',
            'data' => $users
        ];

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ["required"],
            'sku' => ['required'],
            'harga_pokok' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'berat' => ['required', 'numeric'],
            'lokasi' => ['required']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            $users = smm_product::create($request->all());
            $response = [
                'message' => 'User create',
                'data' => $users
            ];

            return $response;

        } catch (QueryException $e) {
            $errorMsg = $e->errorInfo;

            return $errorMsg;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
