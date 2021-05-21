<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;
use App\Customer;
use App\User;
Use Auth;
use Mail;
class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function importCustomers(){


        $settings = Setting::findOrFail(1);

        if (($handle = fopen("customers.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $customer = New Customer;

                $customer->old_ref = $data[0];
                $customer->first_name = $data[1];
                $customer->last_name  = $data[2];
                $customer->phone      = $data[3];
                $customer->mobile     = $data[4];
                $customer->email      = $data[5];
                $customer->ccemail    = $data[6];
                $customer->address1   = $data[7];
                $customer->address2   = $data[8];
                $customer->town       = $data[9];
                $customer->postcode   = $data[10];
                $customer->cust_title = $data[11];
                $customer->company    = $data[12];
                $customer->recommended_by = $data[13];
                $customer->recommended_name = $data[14];

                $customer->country   = $settings->country;
                $customer->newsletter = 'on';
                $customer->status = "Active";
                $customer->user_id = Auth::user()->id;
                $customer->updated_by = Auth::user()->id;
                $customer->send_email = 1;
                $customer->save();
            }
            fclose($handle);
        }


        $customers = Customer::all();
        return view('customer.customers',compact('customers'));

    }



    public function index(Request $request)
    {

        if($request->keyword != NULL){
            $customers = Customer::where('first_name','LIKE','%'.$request->keyword.'%')->
                                    orWhere('last_name','LIKE','%'.$request->keyword.'%')->
                                    orWhere('address1','LIKE','%'.$request->keyword.'%')->
                                    orWhere('address2','LIKE','%'.$request->keyword.'%')->
                                    orWhere('town','LIKE','%'.$request->keyword.'%')->
                                    orWhere('postcode','LIKE','%'.$request->keyword.'%')->
                                    orWhere('phone','LIKE','%'.$request->keyword.'%')->
                                    orWhere('id','LIKE','%'.$request->keyword.'%')->
                                    orWhere('email','LIKE','%'.$request->keyword.'%')->
                                    orWhere('ccemail','LIKE','%'.$request->keyword.'%')->paginate(200);


        }else $customers = App\Customer::orderBy('id','desc')->paginate(200);


        return view('customer.customers',compact('customers'));
    }

    public function create()
    {
        return view('customer.customerCreate');
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'cust_title' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'address1'   => 'required',
            'town'       => 'required',
            'postcode'   => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',

            'recommended_by' => 'required',
        ]);

        $settings = Setting::findOrFail(1);
        $customer = New Customer;

        $customer->cust_title = $request->cust_title;
        $customer->first_name = $request->first_name;
        $customer->last_name  = $request->last_name;
        $customer->company    = $request->company;
        $customer->address1   = $request->address1;
        $customer->address2   = $request->address2;
        $customer->town       = $request->town;
        $customer->postcode   = $request->postcode;
        $customer->country    = $settings->country;
        $customer->email      = $request->email;
        $customer->phone      = $request->phone;
        $customer->mobile     = $request->mobile;
        $customer->recommended_by = $request->recommended_by;
        $customer->recommended_name = $request->recommended_name;
        $customer->newsletter = $request->newsletter;
        $customer->notes = $request->notes;
        $customer->status = "Active";
        $customer->user_id = Auth::user()->id;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        //Send a welcome email to customer
        //Mail:: is a Fascad and send is a function
        //send can take three parameter (view,array of data to use in view, closure function
        //we can add 'use' as an annoymouse function to pass parameters inside enclosue function
        //which are outside of its scope.

        $user = Auth::user();
        
        Mail::send('emails.custWelcome', ['customer' => $customer], function ($m) use ($user,$customer) {
            $m->from($user->email, $user->name);
            $m->to($customer->email, $customer->first_name.' '.$customer->last_name)->subject('Welcome to Computer Gurus!');
            if ($user->bcc != NULL)
               $m->bcc($user->bcc, $user->name);
        });
        // end


        return redirect('customer')->with('status','New customer was adedd and welcome email was sent successfully!');
        //return redirect::back()->with('status','Order details was saved successfully!');

    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        
        return view('customer.customerDetail',compact('customer'));
    }
    
    
    public function edit($id){

        
        $cust = Customer::findorfail($id);
        
        return view('customer.customerEdit',compact('cust'));
        
        
    }
    
    public function update(Request $request,$id){

        $this->validate($request,[
            'cust_title' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'address1'   => 'required',
            'town'       => 'required',
            'postcode'   => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'recommended_by' => 'required',
        ]);

        $customer = Customer::findorfail($id);


        $customer->cust_title = $request->cust_title;
        $customer->first_name = $request->first_name;
        $customer->last_name  = $request->last_name;
        $customer->company    = $request->company;
        $customer->address1   = $request->address1;
        $customer->address2   = $request->address2;
        $customer->town       = $request->town;
        $customer->county       = $request->county;
        $customer->postcode   = $request->postcode;
        $customer->country    = $request->country;
        $customer->email      = $request->email;
        $customer->ccemail      = $request->ccemail;
        $customer->phone      = $request->phone;
        $customer->mobile     = $request->mobile;
        $customer->newsletter = $request->newsletter;
        $customer->recommended_by = $request->recommended_by;
        $customer->recommended_name = $request->recommended_name;
        $customer->discount      = $request->discount;
        $customer->status = $request->status;
        $customer->subscription_status = $request->subscription_status ;
        $customer->old_ref = $request->old_ref;
        $customer->notes = $request->notes;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        $request->session()->flash('status', 'Customer details was saved successfully!');
        return view('messages');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteconfirm($id)
    {
        $cust = Customer::findorfail($id);

        return view('customer.customerDeleteConfirm',compact('cust'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cust = Customer::findorfail($id);

        $cust->delete();

        return redirect('customer');
    }

    public function custReports()
    {

        return view('customer.reports');
    }

    public function exportcustnewsletteronly()
        {

          $pathToFile = 'CustomersNewsletterOnly.csv';
          $name = "CustomersNewsletterOnly.csv";
          $headers = array('content-type' => 'text/csv',);

          $file_handle = fOpen($pathToFile,'w+');
          fputcsv($file_handle,['CUSTNUM','FNAME','LNAME','EMAIL']);

          //$customers = Customer::all();
          $customers = Customer::where('newsletter','=','on')
                                 ->orderBy('id','desc')
                                 ->get();

          foreach ($customers as $c) {
              
            fputcsv($file_handle, [
                $c->id,
                $c->first_name,
                $c->last_name,
                $c->email,
                //$c->address1,
                //$c->address2,
                //$c->town,
                //$c->postcode,
                //$c->newsletter,
            ]);
          }

          fclose($file_handle);

          return response()->download($pathToFile, $name, $headers);

        }


    public function exportCustomers()
    {

      $pathToFile = 'CustomersAll.csv';
      $name = "CustomersAll.csv";
      $headers = array('content-type' => 'text/csv',);

      $file_handle = fOpen($pathToFile,'w+');
      fputcsv($file_handle,['NUM','FNAME','LNAME','EMAIL','ADD1','ADD2','TOWN','POSTCODE','NEWSLETTER']);

      $customers = Customer::orderBy('id','desc')->get();
       

      foreach ($customers as $c) {
          
        fputcsv($file_handle, [
            $c->id,
            $c->first_name,
            $c->last_name,
            $c->email,
            $c->address1,
            $c->address2,
            $c->town,
            $c->postcode,
            $c->newsletter,
        ]);
      }

      fclose($file_handle);

      return response()->download($pathToFile, $name, $headers);

    }


    public function exportconstituents()
    {

      $pathToFile = 'constituents.csv';
      $name = "constituents.csv";
      $headers = array('content-type' => 'text/csv',);

      $file_handle = fOpen($pathToFile,'w+');
      fputcsv($file_handle,['ID','FNAME','LNAME','EMAIL','ADD1','ADD2','TOWN','POSTCODE','Area']);

      $constituents = Customer::where('voter','<>','')->get();

      foreach ($constituents as $c) {
          
        fputcsv($file_handle, [
            $c->id,
            $c->first_name,
            $c->last_name,
            $c->email,
            $c->address1,
            $c->address2,
            $c->town,
            $c->postcode,
            $c->voter,

        ]);
      }

      fclose($file_handle);

      return response()->download($pathToFile, $name, $headers);
    }
    
}
