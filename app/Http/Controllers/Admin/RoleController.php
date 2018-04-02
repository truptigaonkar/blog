<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\role;
use Illuminate\Http\Request;
use App\Model\admin\permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = permission::all();
        return view('admin.role.create', compact('permissions'));
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
            'name' => 'required|max:50|unique:roles'
        ]);
        $role = new role;
        $role->name = $request->name;
        $role->save();
        // Many to many relation between Roles and Permissions
        $role->permissions()->sync($request->permission);
        return redirect (route('role.index'))->with('message','Roles Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = role::find($id);
        $permissions = permission::all();
        return view('admin.role.edit',compact('role','permissions'));
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
            'name' => 'required|max:50'
        ]);
        $role = role::find($id);
        $role->name = $request->name;
        $role->save();
        // Many to many relation between Roles and Permissions
        $role->permissions()->sync($request->permission);
        return redirect (route('role.index'))->with('message','Roles Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = role::find($id);
        $roles->permissions()->detach();
        $roles->delete();
        return redirect (route('role.index'))->with('message','Role Deleted Successfully');
    }
}
