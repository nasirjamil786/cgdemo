<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Permission;
use Auth;
class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::All();
        return view('permission.permissions',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('permission.permissionCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required|unique:permissions'

        ]);

        $permission = new Permission;

        $permission->name = $request->name;
        $permission->label = $request->label;

        $permission->updated_by = Auth::user()->id;

        $permission->save();

        return Redirect::to('permissions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.permissionEdit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'name' => 'required'

        ]);

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->updated_by = Auth::user()->id;
        $permission->save();

        return Redirect::to('permissions');

    }

    public function delete($id)
    {
        $permission = Permission::find($id);

        return view('permission.permissionDeleteConfirm',compact('permission'));
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if($permission->roles->count() > 0){

            return Redirect::back()->withErrors(['Can not delete this permission because an active role exists for this permission']);
        }

        $permission->delete();

        return Redirect::to('permissions');
    }
}
