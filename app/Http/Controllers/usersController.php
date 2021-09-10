<?php

namespace App\Http\Controllers;

use App\Models\smm_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = smm_users::orderBy('date', 'DESC')->get();
        $response = [
            'message' => 'List data users',
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
            'nik' => ['required', 'numeric'],
            'departemen' => ['required'],
            'phone' => ['required', 'numeric'],
            'gender' => ['required', 'in:pria,wanita']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            $users = smm_users::create($request->all());
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
