<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting;
use Auth;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    /**
     * Show the application settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var
         * Find the first record of settings and
         * display to user
         * $settings */

        //Always find settings with id = 1
        $settings = App\Setting::find(1);

        //if not available then create new settings record and assign id = 1
        if($settings == null){
            $settings = New Setting;
            $settings->id = 1;
            $settings->save();
        }

        return view('settings',compact('settings'));
    }

    public function update(Request $request,$id)
    {
        //Validate and update

        $this->validate($request, [
            'company_name' => 'required',
            'address1' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'vat_rate' => 'numeric',
            'currency' => 'required',
            'currency_symbol' => 'required',
        ]);

        //After Validation passed now save in to database

        $settings = App\Setting::find($id);

        $settings->company_name = $request->company_name;
        $settings->reg_no = $request->reg_no;
        $settings->vat_no = $request->vat_no;
        $settings->vat_rate = $request->vat_rate;
        $settings->address1 = $request->address1;
        $settings->address2 = $request->address2;
        $settings->town = $request->town;
        $settings->postcode = $request->postcode;
        $settings->country = "UNITED KINGDOM";
        $settings->phone = $request->phone;
        $settings->mobile = $request->mobile;
        $settings->email = $request->email;
        $settings->web = $request->web;
        $settings->logo_file = $request->logo_file;
        $settings->currency = $request->currency;
        $settings->currency_symbol = $request->currency_symbol;

        $settings->updated_by = Auth::user()->id;
        
        $settings->save();

        $request->session()->flash('status', 'Company Settings was saved successfully!');

        return view('messages');

    }
}
