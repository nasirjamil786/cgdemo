<?php

namespace App\Http\Controllers;
use App;
use Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Role;
use App\User;
use Redirect;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = App\User::with('roles')->get();

        return view('user.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::All();

        return view('user.userCreate',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'user_title' => 'required',
            'address1' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'user_status' => 'required',
            'role' => 'required',
        ]);

        $user = New User;
        $settings = App\Setting::findOrFail(1);
        $role = Role::findOrFail($request->role);

        $user->user_title = $request->user_title;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->town = $request->town;
        $user->county = $request->county;
        $user->postcode = $request->postcode;
        $user->country = $settings->country;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->tax_no = $request->tax_no;
        $user->user_status = $request->user_status;
        $user->notes = $request->notes;
        $user->email = $request->email;
        $user->cc = $request->cc;
        $user->bcc = $request->bcc;
        $user->can_settings = $request->can_settings;
        $user->can_reports = $request->can_reports;
        $user->can_closeOrder = $request->can_closeOrder;
        $user->password = bcrypt($request->password);
        $user->password_hint = $request->password_hint;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $user->assignRole($role);

        return Redirect::to('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = App\User::find($id);

        return view('user.userDetail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::All();

        return view('user.userEdit',compact('user','roles'));
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
        // Form validation
        $this->validate($request, [
            'user_title' => 'required',
            'address1' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'first_name' => 'required',
            'last_name' => 'required',
            'user_status' => 'required',
            'role' => 'required',
        ]);

        $user = App\User::find($id);
        $settings = App\Setting::find(1);
        $role = Role::findOrFail($request->role);

        $user->user_title = $request->user_title;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->town = $request->town;
        $user->county = $request->county;
        $user->postcode = $request->postcode;
        $user->country = $settings->country;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->tax_no = $request->tax_no;
        $user->user_status = $request->user_status;
        $user->notes = $request->notes;
        $user->commission = $request->commission;
        $user->email = $request->email;
        $user->cc = $request->cc;
        $user->bcc = $request->bcc;
        $user->can_settings = $request->can_settings;
        $user->can_reports = $request->can_reports;
        $user->can_closeOrder = $request->can_closeOrder;
        $user->password_hint = $request->password_hint;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $user->updateRole(array($role->id));
        return Redirect::to('user');

    }


    public function changePassword($id)
    {

        $user = App\User::find($id);

        return view('user.password',compact('user'));


    }

    public function updatePassword(Request $request, $id)
    {

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',

        ]);

        $user = App\user::find($id);
        $user->password = bcrypt($request->password);
        $user->password_hint = $request->password;
        $user->save();

        $request->session()->flash('status', 'Password  successfuly!');
        return view('messages');

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



    public function sendEmailReminder(Request $request)
    {
        $user = User::findOrFail(1);
        $customer = $user;

        Mail::send('emails.custWelcome', ['customer' => $customer], function ($m) use ($user) {
            $m->from('farah@computergurus.co.uk', 'Farah Nasir');

            $m->to($user->email, $user->name)->subject('Test Message from Nasirs GAPP');
        });


        $request->session()->flash('status', 'An email was sent successfully!');
        return view('messages');
        

    }

    
}
