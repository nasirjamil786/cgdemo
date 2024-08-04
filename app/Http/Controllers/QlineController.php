<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quote;
use App\Qline;
use App\Customer;
use App\User;
use App\Supplier;
use App\Setting;
use App\Image;  //This is a model class
use Auth;
use Images;     //This is an alliase of service provider 
use App\Myfunctions\Myfunctions;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class QlineController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($quoteid){
        
       $settings = Setting::findorfail(1);
       $vatRate = $settings->vat_rate;
       $quote = Quote::findorfail($quoteid);
       $suppliers = Supplier::all();

       return view('qline.create',compact('quote','suppliers','vatRate','settings'));

    }

    public function store(Request $request,$quoteid){

       //validation
    	$this->validate($request,[
    		'item_detail' => 'required',
        'item_type' => 'required',
    		'quantity' => 'required',
    		'value' => 'required',
    	]);


       $quote = Quote::findorfail($quoteid);
       $supp_id = $request->supp_id;
       $settings = Setting::findorfail(1);

       if($supp_id != 0){
            $supplier = Supplier::findorfail($supp_id);
       }

       $qline = new Qline();
       $qline->quote_id = $quote->id;
       $qline->item_no = 1;
       $qline->item_detail = $request->item_detail;
       $qline->item_image = '';
       $qline->spec1 = $request->spec1;
       $qline->spec2 = $request->spec2;
       $qline->spec3 = $request->spec3;
       $qline->spec4 = $request->spec4;
       $qline->spec5 = $request->spec5;
       $qline->quantity = $request->quantity;
       $qline->price = $request->value;
       $qline->cost = $request->cost;
       $qline->cost_vat_exempt = $request->cost_vat_exempt;
       $qline->cost_vat = $request->cost_vat_exempt == 1 ? 0 : ($request->cost * $settings->vat_rate / 100);
       $qline->commission = $request->commission;
       $qline->value = $request->value;
       $qline->vat_rate = $settings->vat_rate;
       $qline->vat = ($request->value * $settings->vat_rate / 100);
       $qline->total_withvat = $request->value + ($request->value * $settings->vat_rate / 100);
       $qline->item_notes = $request->item_notes;
       $qline->item_type = $request->item_type;
       $qline->supp_id = $request->supp_id;
       $qline->supp_name = ($supp_id != 0) ? $supplier->name : ''; 
       $qline->supp_ref = $request->supp_ref;
        
       $qline->save();

       //update quote total
       $myfunctions = New Myfunctions;
       $myfunctions->updateQuoteTotals($quote->id);

       $quote = Quote::findorfail($quoteid);
       $cust = Customer::findorfail($quote->customer_id);
       $qlines = Qline::where('quote_id','=',$quote->id)->get();


        return view('quote.quoteDetail',compact('cust','quote','qlines','settings'));

    }

    public function edit($qlineid){

    	$qline = Qline::findorfail($qlineid);
        $suppliers = Supplier::all();
        $settings = Setting::findorfail(1);


    	return view('qline.edit',compact('qline','suppliers','settings'));

    }

    public function update(Request $request,$qlineid){

    	//validation
    	$this->validate($request,[
    		'item_detail' => 'required',
            'item_type' => 'required',
    		'quantity' => 'required',
    		'value' => 'required',
    	]);


       $qline = Qline::findorfail($qlineid);
       $supp_id = $request->supp_id;
       $settings = Setting::findorfail(1);

       if($supp_id != 0){
            $supplier = Supplier::findorfail($supp_id);
       }

       $qline->item_no = 1;
       $qline->item_detail = $request->item_detail;
       $qline->spec1 = $request->spec1;
       $qline->spec2 = $request->spec2;
       $qline->spec3 = $request->spec3;
       $qline->spec4 = $request->spec4;
       $qline->spec5 = $request->spec5;
       $qline->quantity = $request->quantity;
       $qline->price = $request->value;
       $qline->cost = $request->cost;
       $qline->cost_vat_exempt = $request->cost_vat_exempt;
       $qline->cost_vat = $request->cost_vat_exempt == 1 ? 0 : ($request->cost * $settings->vat_rate / 100);
       $qline->commission = $request->commission;
       $qline->supp_id = $request->supp_id;
       $qline->supp_name = ($supp_id != 0) ? $supplier->name : '';
       $qline->supp_ref = $request->supp_ref;
       $qline->value = $request->value;
       $qline->vat_rate = $settings->vat_rate;
       $qline->vat = ($request->value * $settings->vat_rate / 100);
       $qline->total_withvat = $request->value + ($request->value * $settings->vat_rate / 100);
       $qline->item_notes = $request->item_notes;
       $qline->item_type = $request->item_type;
       $qline->updated_by = Auth::user()->id;

       $qline->save();
       
       //update quote total
       $myfunctions = New Myfunctions;
       $myfunctions->updateQuoteTotals($qline->quote_id);

       $quote = Quote::findorfail($qline->quote_id);
       $cust = Customer::findorfail($quote->customer_id);
       $qlines = Qline::where('quote_id','=',$quote->id)->get();

        return view('quote.quoteDetail',compact('cust','quote','qlines','settings'));

    }

    public function delete($qlineid){
    	$qline = Qline::findorFail($qlineid);
    	$quoteid = $qline->quote_id;
        $settings = Setting::findorfail(1);

    	$qline->delete();
        
        //update quote total
    	$myfunctions = New Myfunctions;
        $myfunctions->updateQuoteTotals($quoteid);

    	$quote = Quote::findorfail($quoteid);
        $cust = Customer::findorfail($quote->customer_id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();

        return view('quote.quoteDetail',compact('cust','quote','qlines','settings'));

    }

    public function image($qlineid){

    	$qline = Qline::findorfail($qlineid);

    	return view('qline.image',compact('qline'));

    }

    public function imageUpload(Request $request,$qlineid){

       //validation
    	$this->validate($request,[
    		'item_image' => 'required|image|max:2048',
    	]);

        /*New code to store imag ein the database */

        $file = $request->file('item_image');

        $img = Images::make($file);

        Response::make($img->encode('jpeg'));

        // create new row in the iMages table

        //$imgRow = New Image();

        //$imgRow->image = $img;

        //$imgRow->save();

        //store qline 
        $qline = Qline::findorfail($qlineid);
        $qline->item_image = $img;
        $qline->save();
        $qline = Qline::findorfail($qlineid);
        return view('qline.image',compact('qline'));

        /* New code end here   */

/* This is old code 
        $file = $request->file('item_image');
        $name = $file->getClientOriginalName();

        Storage::put($name,File::get($file));

        $path = Storage::url($name);

        $qline = Qline::findorfail($qlineid);
        $qline->item_image = $path;
        $qline->save();

        $qline = Qline::findorfail($qlineid);

        return view('qline.image',compact('qline'));
old code end here  */

    }

    public function removeImage($qlineid){
      $qline = Qline::findorfail($qlineid);

      $qline->item_image = '';

      $qline->save();

      $qline = Qline::findorfail($qlineid);
      return view('qline.image',compact('qline'));
 

    }

    public function getImage($qlineid)
    {
        $qline = Qline::findorfail($qlineid);

        $img_file = Images::make($qline->item_image);
        $response = Response::make($img_file->encode('jpeg'));
        $response->header('Content-Type','image/jpeg');

        return $response;
    }
}
