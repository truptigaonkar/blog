<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\admin\permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $permissions = permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:permissions',
            'for'  => 'required'
            ]);
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->for = $request->for;
        $permission->save();
        return redirect(route('permission.index'))->with('message','Added Permission Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = permission::find($id);
        return view('admin.permission.edit', compact('permission'));
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
        $this->validate($request,[
            'name' => 'required|max:50',
            'for' => 'required'
        ]);
        //return 'validation has passed';
        $permission = permission::find($id);
        $permission->name = $request->name;
        $permission->for = $request->for;
        $permission->save();
        return redirect(route('permission.index'))->with('message','Edited Permission Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissions = permission::find($id);
        $permissions->delete();
        return redirect(route('permission.index'))->with('message','Deleted Permission Succussfully');
    }
}
