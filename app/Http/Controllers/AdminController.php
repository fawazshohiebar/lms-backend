<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $admin = Admin::all();
        $adminData = $admin->map(function ($admins) {
            return [
                'id' => $admins->id,
                'Role' => $admins->Role,
                'Email' => $admins->Email, 
                'Password' => $admins->Password, 
                'Full_name' => $admins->Full_name, 
            ];
        });
        return $admin;
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
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $admin = new Admin();
        $admin->Role=$request->input('Role');
        $admin->Email=$request->input('Email');
        $admin->Password=$request->input('Password');
        $admin->Full_name=$request->input('Full_name');
        $admin->save();
        return response()->json(['message' => 'admin$admin created successfully'], 201);
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin,$id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'admin not found'], 404);
        }
        $admin->Role = $request->has('Role')? $request->input('Role'):$admin->Role;
        $admin->Email = $request->has('Email')?$request->input('Email'):$admin->Email;
        $admin->Password = $request->has('Password')?$request->input('Password'):$admin->Password;
        $admin->Full_name = $request->has('Full_name')?$request->input('Full_name'):$admin->Full_name;
        $admin->save();
        return response()->json(['message' => 'admin updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $request,$id)
    {
        
            $ana = Admin::find($id);
            $ana->delete();
            return "the id have been deleted ";
        
    }
    
    /**
     
     *
     * @param  str  $Role
     * @return \Illuminate\Http\Response
     */
    public function search($searchterm)
    {
        
        return  Admin::where('Role','like','%'.$searchterm.'%')->get();
    }
}
