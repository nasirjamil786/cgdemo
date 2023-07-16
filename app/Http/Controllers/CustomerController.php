<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Setting;
use App\Customer;
use App\User;
Use Auth;
use Mail;
use DB;
use App\Myfunctions\Myfunctions;

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

        if(trim($request->keyword) != NULL){

            $customers = Customer::where('first_name','LIKE','%'.trim($request->keyword).'%')->

                                    orwhere(DB::raw("CONCAT(first_name,' ',last_name)"), 'LIKE', '%' . trim($request->keyword) . '%')->

                                    orWhere('last_name','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('address1','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('address2','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('town','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('postcode','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('phone','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('mobile','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('id','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('email','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('ccemail','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('recommended_by','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('recommended_name','LIKE','%'.trim($request->keyword).'%')->
                                    orWhere('notes','LIKE','%'.trim($request->keyword).'%')
                                    ->paginate(200); 

        }else $customers = App\Customer::orderBy('id','desc')->paginate(200);

        //store the keyword in to session which will then be used in function ExportSearchResult()

        $request->session()->put('keyword',$request->keyword);


        return view('customer.customers',compact('customers'));
    }

    //Display search view first time 

    public function search1($id){
        //clear all the data in the session
        //session()->flush();
        //define all the variable 
        $first_name = $last_name = $postcode = $phone = $custno = $email = $town = $address1 = '';
        //find a null value of customer 
        $customers = Customer::where('id',$id)->paginate(200); 
        //return view 
        return view('customer.custSearch',compact('customers','first_name','last_name','postcode','phone','custno','email','town','address1'));
    }

    //Display Search view

    public function searchBack(Request $request,$id)
    {

        $first_name = $request->session()->pull('first_name');
        $last_name  = $request->session()->pull('last_name');
        $postcode = $request->session()->pull('postcode');
        $phone = $request->session()->pull('phone');
        $email = $request->session()->pull('email');
        $town = $request->session()->pull('town');
        $address1 = $request->session()->pull('address1');
        $custno = request->session()->pull('custno');

        $customers = Customer::where('id',$id)->paginate(200); 

        return view('customer.custSearch',compact('customers','first_name','last_name','postcode','phone','custno','email','town','address1'));

    }

    public function goBack(){



dd('here');
            $first_name = session('first_name');
            $last_name  = session('last_name');
            $postcode = session('postcode');
            $phone = session('phone');
            $email = session('email');
            $town = session('town');
            $address1 = session('address1');
            $custno = session('custno');

            $customers = Customer::where('id',$custno)->paginate(50);

            return view('customer.custSearch',compact('customers','first_name','last_name','postcode','phone','custno','email','town','address1'));
    }

    public function searchResult(Request $request)
    {

            $rules = array(
                'first_name' => 'required_without_all:last_name,postcode,phone,custno,email,town,address1',
                'last_name' => 'required_without_all:first_name,postcode,phone,custno,email,town,address1',
                'postcode' => 'required_without_all:first_name,last_name,phone,custno,email,town,address1',
                'phone' => 'required_without_all:first_name,last_name,postcode,custno,email,town,address1',
                'custno' => 'required_without_all:first_name,last_name,postcode,phone,email,town,address1',
                'email' => 'required_without_all:first_name,last_name,postcode,phone,custno,town,address1',
                'town' => 'required_without_all:first_name,last_name,postcode,phone,email,custno,address1',
                'address1' => 'required_without_all:first_name,last_name,postcode,phone,custno,email,town',
            );

            $validator = Validator::make($request->all(), $rules,["At least one field must be entered"])->validate();

            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $postcode = $request->postcode;
            $phone = $request->phone;
            $custno = $request->custno;
            $email = $request->email;
            $town = $request->town;
            $address1 = $request->address1;

        //store all the values to session

        session(['first_name' => $first_name],
            ['last_name' => $last_name],
            ['postcode' => $postcode],
            ['phone' => $phone],
            ['custno' => $custno],
            ['email' => $email],
            ['town' => $town],
            ['address1' => $address1]);

        //if atleast one input parameter is set then performed search

        if($first_name <> NULL || 
            $last_name <> NULL || 
            $postcode <> NULL || 
            $phone <> NULL || 
            $custno <> Null || 
            $email <> NULL || 
            $town <> NULL || 
            $address1 <> NULL) {

                $customers = Customer::when($first_name,function($query, $first_name) {
                                                           $query->where('first_name', $first_name);
                                                         })->
                                       when($last_name, function ($query, $last_name) {
                                                            $query->where('last_name', $last_name);
                                                         })->
                                       when($postcode, function ($query, $postcode) {
                                                            $query->where('postcode', $postcode);
                                                         })->
                                       when($address1, function ($query, $address1) {
                                                            $query->where('address1', $address1);
                                                         })->
                                       when($town, function ($query, $town) {
                                                            $query->where('town', $town);
                                                         })->
                                       when($phone, function ($query, $phone) {
                                                            $query->where('phone', $phone);
                                                         })->
                                       when($custno, function ($query, $custno) {
                                                            $query->where('id', $custno);
                                                         })->
                                       when($email, function ($query, $email) {
                                                            $query->where('email', $email);
                                                         })->
                                        paginate(100);
            return view('customer.custSearch',compact('customers','first_name','last_name','postcode','phone','custno','email','town','address1'));
        } 

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
            'phone'   => 'required|digits:11',

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

        return redirect('custsearch1/'.$customer->id)->with('status','New customer was adedd and welcome email was sent successfully!');

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
            'phone'   => 'required|digits:11',
            'recommended_by' => 'required',
        ]);

        $customer = Customer::findorfail($id);

        $myfuncs = New Myfunctions;
        $review_date = $myfuncs->usDate($request->reviewed);


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
        $customer->reviewed = $review_date;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        //$request->session()->flash('status', 'Customer details was saved successfully!');
        //return view('messages');

        //return redirect('customer.show')->with('success','Customer updated successfully!');

        return redirect()->route('customer.show', ['id' => $customer->id])->with('status','Customer updated successfully!');

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

    public function exportBusinessCustomers()
    {
          $pathToFile = 'BusCustomersOnly.csv';
          $name = "BusCustomersOnly.csv.csv";
          $headers = array('content-type' => 'text/csv',);

          $file_handle = fOpen($pathToFile,'w+');
          fputcsv($file_handle,['CUSTNUM','BUSNAME','FNAME','LNAME','EMAIL','ADD1','ADD2','TOWN','PCODE','NLETTER']);

          //$customers = Customer::all();
          $customers = Customer::where('company','!=',null)
                                 ->where('company','!=','')
                                 ->orderBy('id','desc')
                                 ->get();

          foreach ($customers as $c) {
              
            fputcsv($file_handle, [
                $c->id,
                $c->company,
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

    public function ExportSearchResult (Request $request)
    {

        $keyword = $request->session()->get('keyword','all');

        $pathToFile = 'CustomerSearchResult.csv';
        $name = "CustomerSearchResult.csv";
        $headers = array('content-type' => 'text/csv',);

        $file_handle = fOpen($pathToFile,'w+');
        fputcsv($file_handle,['ID','FNAME','LNAME','EMAIL','ADD1','ADD2','TOWN','POSTCODE','Area']);

        //Query for search result


        $results = Customer::where('first_name','LIKE','%'.$keyword.'%')->
                                    orWhere('last_name','LIKE','%'.$keyword.'%')->
                                    orWhere('address1','LIKE','%'.$keyword.'%')->
                                    orWhere('address2','LIKE','%'.$keyword.'%')->
                                    orWhere('town','LIKE','%'.$keyword.'%')->
                                    orWhere('postcode','LIKE','%'.$keyword.'%')->
                                    orWhere('phone','LIKE','%'.$keyword.'%')->
                                    orWhere('mobile','LIKE','%'.$keyword.'%')->
                                    orWhere('id','LIKE','%'.$keyword.'%')->
                                    orWhere('email','LIKE','%'.$keyword.'%')->
                                    orWhere('ccemail','LIKE','%'.$keyword.'%')->
                                    orWhere('recommended_by','LIKE','%'.$keyword.'%')->
                                    orWhere('recommended_name','LIKE','%'.$keyword.'%')->
                                    orWhere('notes','LIKE','%'.$keyword.'%')
                                    ->get(); 



        foreach ($results as $r) {
          
            fputcsv($file_handle, [
                $r->id,
                $r->first_name,
                $r->last_name,
                $r->email,
                $r->address1,
                $r->address2,
                $r->town,
                $r->postcode,
                $r->voter,
            ]);
        }

        fclose($file_handle);

        return response()->download($pathToFile, $name, $headers);

    }
    
}
