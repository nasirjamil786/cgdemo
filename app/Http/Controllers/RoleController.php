<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Role;
use App\Permission;
use Auth;
use Redirect;
class RoleController extends Controller
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
        $roles = Role::with('permissions')->get();
        return view('role.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $permissions = Permission::All();
        return view('role.roleCreate',compact('permissions'));
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

            'name' => 'required|unique:roles'

        ]);

        $permissionsChecked = $request->permissions_checked;
        $role = new Role;
        $role->name = $request->name;
        $role->label = $request->label;
        $role->updated_by = Auth::user()->id;
        $role->save();

        //This is an array of checked permission ids e.g [1,3,5] etc

        if($permissionsChecked != null){
            foreach($permissionsChecked as $per) {
                $perm = Permission::find($per);
                $role->givePermissionTo($perm);
            }
        }


        return Redirect::to('roles');
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
        $role = Role::find($id);
        $permissions = Permission::All();
        return view('role.roleEdit',compact('role','permissions'));
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

        $role = Role::find($id);
        $role->name = $request->name;
        $role->label = $request->label;
        $role->updated_by = Auth::user()->id.'|'.Auth::user()->name;
        $role->save();

        //This is an array of checked permission ids e.g [1,3,5] etc
        $permissionsChecked = $request->permissions_checked;
        if($permissionsChecked != null) {
            $role->updatePermissions($permissionsChecked);
        }
        else{
            $role->permissions()->detach();
        }

        return Redirect::to('roles');
    }

    public function delete($id)
    {
        $role = Role::with('permissions')->find($id);
        
        return view('role.roleDeleteConfirm',compact('role'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if($role->users->count() > 0){

            return Redirect::back()->withErrors(['Can not delete this role as an active user exisit for this role']);
        }

        $role->delete();

        return Redirect::to('roles');

    }
}
