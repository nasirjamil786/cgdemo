<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quote;
use App\Qline;
use App\Customer;
use App\User;
use App\Setting;
use App\Myfunctions\Myfunctions;
use Auth;
use Redirect;
use Mail;
use DB;
use Session;
use DateTime;
use Carbon\Carbon;
use App\Device;
use App\Make;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    	$keyword = $request->keyword;
    	$status  = $request->status;


        if($status == 'on') {  //show all status

            if($keyword != NULL){  //All quotes including rejected matching the search criteria

                $quotes = DB::table('quotes')
                        ->join('customers','quotes.customer_id','=','customers.id')
                        ->join('users','quotes.updated_by','=','users.id')
                        ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS usrname')
                        ->where('quotes.id','LIKE','%'.$keyword.'%')
                        ->orWhere('customers.first_name','LIKE','%'.$keyword.'%')
                        ->orWhere('customers.last_name','LIKE','%'.$keyword.'%')
                        ->orWhere('customers.postcode','LIKE','%'.$keyword.'%')
                        ->orderby('quotes.id','desc')
                        ->paginate(400);

            } else {  //All quotes including rejected and inactive 

                $quotes = DB::table('quotes')
                        ->join('customers','quotes.customer_id','=','customers.id')
                        ->join('users','quotes.updated_by','=','users.id')
                        ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS usrname')
                        ->orderby('quotes.id','desc')
                        ->paginate(400);

            }

        } else {   //only show which are active 
            if($keyword != NULL){  //

                $quotes = DB::table('quotes')
                        ->join('customers','quotes.customer_id','=','customers.id')
                        ->join('users','quotes.updated_by','=','users.id')
                        ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS usrname')
                        ->where('quotes.id','LIKE','%'.$keyword.'%')
                        //->where('quotes.quote_status','!=','rejected')  //exclude rejected */
                        //->where('quotes.quote_status','!=','ordered')  //exclude ordered */
                        ->orWhere('customers.first_name','LIKE','%'.$keyword.'%')
                        ->orWhere('customers.last_name','LIKE','%'.$keyword.'%')
                        ->orWhere('customers.postcode','LIKE','%'.$keyword.'%')
                        ->orderby('quotes.id','desc')
                        ->paginate(400);

            } else {  //All quotes no condition excluding rejected 

                $quotes = DB::table('quotes')
                        ->join('customers','quotes.customer_id','=','customers.id')
                        ->join('users','quotes.updated_by','=','users.id')
                        ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS usrname')
                        ->where('quotes.quote_status','!=','rejected')  //exclude rejected 
                        ->where('quotes.quote_status','!=','ordered')  //exclude ordered
                        ->where('quotes.quote_status','!=','inactive')  //exclude inactive
                        ->orderby('quotes.id','desc')
                        ->paginate(400);
            }
           
        }



/*

    	if($keyword != null){
    		$quotes = DB::table('quotes')
                            ->join('customers','quotes.customer_id','=','customers.id')
                            ->join('users','quotes.updated_by','=','users.id')
                            ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.name')
                            ->where('quotes.id','LIKE','%'.$keyword.'%')
                            ->orWhere('quotes.quote_status','=',$status)
                            ->orWhere('quotes.quote_status','=',null)
                            ->orWhere('customers.first_name','LIKE','%'.$keyword.'%')
                            ->orWhere('customers.last_name','LIKE','%'.$keyword.'%')
                            ->orWhere('customers.postcode','LIKE','%'.$keyword.'%')
                            ->orderby('id','desc')
                            ->paginate(300);
    	} else{

    		$quotes = DB::table('quotes')
                            ->join('customers','quotes.customer_id','=','customers.id')
                            ->join('users','quotes.updated_by','=','users.id')
                            ->select('quotes.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.name')
                            ->where('quote_status','!=','rejected')
                            ->where('quotes.id','LIKE','%'.$keyword.'%')
                            ->orWhere('quotes.quote_status','=',$status)
                            ->orWhere('quotes.quote_status','=',null)
                            ->orderby('id','desc')
                            ->paginate(300);
         }      


*/
        $settings = Setting::find(1);
    	return view('quote.quotes',compact('quotes','settings'));

    }

    public function create($custid,$from)
    {
    	$cust = Customer::findorfail($custid);

    	//store this customer id into session to retrieve later on
    	//$request->session()->put('custid', $cust->custid);
        
        //$quote = new Quote;

        //$quote->customer_id = $custid;
        //$quote->save();

        //return redirect('quote/'.$quote->id.'/edit');
    

        return view('quote.quoteCreate',compact('cust','from'));

    }

    public function goBack($custid,$from){

    
        if($from == 1){
            $first_name = session('first_name');
            $last_name  = session('last_name');
            $postcode = session('postcode');
            $phone = session('phone');
            $email = session('email');
            $town = session('town');
            $address1 = session('address1');
            $custno = session('custno');

            $customers = Customer::where('id',$custid)->paginate(50);
            return view('customer.custSearch',compact('customers','first_name','last_name','postcode','phone','custno','email','town','address1'));
        }

        if($from == 2){
            $customer = Customer::findorfail($custid);
            return view('customer.customerDetail',compact('customer'));
        }


    }

    public function store(Request $request,$custid){


    	//validation
    	$this->validate($request,[
    		'valid_date' => 'required',
    		'quote_title' => 'required',
    		'work_detail' => 'required',
    	]);

    	//$request->flash();

        $settings = Setting::findorfail(1);

        $myfuncs = New Myfunctions;
        $valid_date = $myfuncs->usDate($request->valid_date);

        $cust = Customer::findorfail($custid);

        $quote = new Quote;
        $quote->customer_id = $cust->id;
        $quote->quote_date = Carbon::now();
        $quote->valid_date = $valid_date;
        $quote->quote_status = "current";
        $quote->notes = '';
        $quote->quote_title = $request->quote_title;
        $quote->work_detail = $request->work_detail;
        $quote->vat_rate = $settings->vat_rate;
        $quote->updated_by = auth::user()->id;
        $quote->save();


        $quote = Quote::findorfail($quote->id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();

        
        return view('quote.quoteDetail',compact('cust','quote','qlines'));

    }

    public function edit($id){

    	$quote = Quote::findorfail($id);
        $cust = Customer::findorfail($quote->customer_id);

        return view('quote.quoteEdit',compact('quote','cust'));

    }

    public function update(Request $request,$id){
        //validation
        $this->validate($request,[
            'valid_date' => 'required',
            'quote_title' => 'required',
            'work_detail' => 'required',
            'quote_status' => 'required'
        ]);

        
        $myfuncs = New Myfunctions;
        $valid_date = $myfuncs->usDate($request->valid_date);

        $quote = Quote::findorfail($id);

        $quote->valid_date = $valid_date;
        $quote->quote_status = $request->quote_status;
        $quote->notes = $request->notes;
        $quote->quote_title = $request->quote_title;
        $quote->work_detail = $request->work_detail;
        $quote->updated_by = auth::user()->id;
        $quote->save();


        $quote = Quote::findorfail($id);
        $cust = Customer::findorfail($quote->customer_id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();

        return view('quote.quoteDetail',compact('cust','quote','qlines'));

        
    }

    public function editDetail($id){
        
        $quote = Quote::findorfail($id);
        $cust = Customer::findorfail($quote->customer_id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();
        
        return view('quote.quoteDetail',compact('cust','quote','qlines'));

    }

    public function print($quoteid){

        $quote = Quote::findorfail($quoteid);
        $settings = Setting::findorfail(1);
        $user = Auth::user();
        $qlines = Qline::where('quote_id','=',$quote->id)->get();
        $payurl = '#';
        return view('quote.print',compact('quote','settings','qlines','payurl','user'));

    }
    
    public function emailPreview($quoteid){
        
        $quote = Quote::findorfail($quoteid);
        $settings = Setting::findorfail(1);
        $user = Auth::user();
        $qlines = Qline::where('quote_id','=',$quote->id)->get();
        $myfuncs = New Myfunctions;
    
        $payurl = ($settings->payment_button == 1) ? $myfuncs->payUrl($quote->id,'quote') : '#';

        return view('quote.emailpreview',compact('quote','settings','qlines','payurl','user'));

    }

    public function email($id){

        $quote = Quote::with('customer')->where('id',$id)->first();
        $qlines = Qline::where('quote_id','=',$id)->get();
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        $myfuncs = New Myfunctions;
        $payurl = $myfuncs->payUrl($quote->id,'quote');

        Mail::send('quote.email', ['quote' => $quote,'settings' => $settings,'qlines' => $qlines,'payurl' => $payurl], function ($m) use ($user,$quote) {
           
           $m->from($user->email, $user->name);
           $m->to($quote->customer->email, $quote->customer->first_name.' '.$quote->customer->last_name)->subject('Computer Gurus Quote# '.$quote->id);
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Quote to Customer');
           if ($quote->customer->ccemail != null) {
               $m->cc($quote->customer->ccemail);
           }
        });

        $quote->quote_status = "emailed";
        $quote->email_sent = Carbon::now();
        $quote->save();

        Session::flash('status','Quote emailed to customer successfully!');
        return redirect::back();

    }

    public function deleteConfirm($quoteid){

        $quote = Quote::findorfail($quoteid);

        return view('quote.deleteconfirm',compact('quote'));
    }

/*
    public function delete(Request $request,$quoteid){
           
        $this->validate($request,[
            'confirm_delete' => 'required',
        ]);

        $quote = Quote::findorfail($quoteid);

        $quote->delete();

        return redirect('quote');
        
    } */

    public function delete($quoteid){
           
        $quote = Quote::findorfail($quoteid);
        $quote->delete();

        return redirect('quote');
        
    }

    public function convertToOrder($quoteid){

        $quote = Quote::findorfail($quoteid);
        //$cust = Customer::findorfail($custid);
        $engineers = User::all();
        $devices = Device::orderby('device_type')->get();
        $makes = Make::all();

         return view('order.orderfromquote',compact('quote','engineers','devices','makes'));

    }

    public function copy($quoteid){

        $quote = Quote::findorfail($quoteid);
        
        $customers = Customer::where('status','=','active')
                     ->orderBy('first_name')
                     ->orderBy('last_name')
                     ->get();
        return view('quote.quoteCopy',compact('quote','customers'));

    }

    public function savecopy(Request $request,$quoteid){

        
            $this->validate($request,[

                'custid' => 'required',
            ]);

        $customer = Customer::findorfail($request->custid);

        //Find the quote which needs to be copied
        $qt = Quote::findorfail($quoteid);
        //Also find all the quote lines associated with this quote to be copied 
        $ql = Qline::where('quote_id','=',$qt->id)->get();

        
        //Now create a new quote with new ID automatically created 
        $quote = new Quote;
        $quote->customer_id = $customer->id;
        $quote->quote_date = Carbon::now();
        $quote->valid_date = Carbon::now();
        $quote->quote_status = "current";
        $quote->notes = '';
        $quote->quote_title = $qt->quote_title;
        $quote->work_detail = $qt->work_detail;
        $quote->quote_total = $qt->quote_total; //copy quote total 
        $quote->updated_by = auth::user()->id;
        $quote->save();

        //Now loop through the quote lines and make a copy of new lines 

        foreach ($ql as $qtl) {
           //create new quote line 
           $qline = new Qline();
           $qline->quote_id = $quote->id; //make sure quote ID for the new quote 
           $qline->item_no = $qtl->item_no;
           $qline->item_detail = $qtl->item_detail;
           $qline->item_image = $qtl->item_image;
           $qline->spec1 = $qtl->spec1;
           $qline->spec2 = $qtl->spec2;
           $qline->spec3 = $qtl->spec3;
           $qline->spec4 = $qtl->spec4;
           $qline->spec5 = $qtl->spec5;
           $qline->quantity = $qtl->quantity;
           $qline->price = $qtl->value;
           $qline->cost = $qtl->cost;
           $qline->cost_vat_exempt = $qtl->cost_vat_exempt;
           $qline->cost_vat = $qtl->cost_vat;
           $qline->commission = $qtl->commission;
           $qline->value = $qtl->value;
           $qline->vat_rate = $qtl->vat_rate;
           $qline->vat = $qtl->vat;
           $qline->item_notes = $qtl->item_notes;
           $qline->item_type = $qtl->item_type;
           //Save the quote line 
           $qline->save();
        }
        
        //Now return the copied quote to the user 

        return redirect('quote/'.$quote->id.'/editdetail')->with('status','Quote copied successfully!');

    }
    
}
