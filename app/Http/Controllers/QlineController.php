<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quote;
use App\Qline;
use App\Customer;
use App\User;
use Auth;
use App\Myfunctions\Myfunctions;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QlineController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($quoteid){

       $quote = Quote::findorfail($quoteid);

       return view('qline.create',compact('quote'));

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
       $qline->commission = $request->commission;
       $qline->value = $request->value;
       $qline->vat_rate = 0.0;
       $qline->vat = 0.0;
       $qline->item_notes = $request->item_notes;
       $qline->item_type = $request->item_type;

       $qline->save();
    
       
       //update quote total
       $myfunctions = New Myfunctions;
       $myfunctions->updateQuoteTotals($quote->id);

       $quote = Quote::findorfail($quoteid);
       $cust = Customer::findorfail($quote->customer_id);
       $qlines = Qline::where('quote_id','=',$quote->id)->get();


        return view('quote.quoteDetail',compact('cust','quote','qlines'));

    }

    public function edit($qlineid){

    	$qline = Qline::findorfail($qlineid);

    	return view('qline.edit',compact('qline'));

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
       $qline->commission = $request->commission;
       $qline->value = $request->value;
       $qline->vat_rate = 0.0;
       $qline->vat = 0.0;
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

        return view('quote.quoteDetail',compact('cust','quote','qlines'));

    }

    public function delete($qlineid){
    	$qline = Qline::findorFail($qlineid);
    	$quoteid = $qline->quote_id;

    	$qline->delete();
        
        //update quote total
    	$myfunctions = New Myfunctions;
        $myfunctions->updateQuoteTotals($quoteid);

    	$quote = Quote::findorfail($quoteid);
        $cust = Customer::findorfail($quote->customer_id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();

        return view('quote.quoteDetail',compact('cust','quote','qlines'));

    }

    public function image($qlineid){

    	$qline = Qline::findorfail($qlineid);
    	return view('qline.image',compact('qline'));


    }

    public function imageUpload(Request $request,$qlineid){

       //validation
    	$this->validate($request,[
    		'item_image' => 'required',
    	]);

        $file = $request->file('item_image');
        $name = $file->getClientOriginalName();

        Storage::put($name,File::get($file));

        $path = Storage::url($name);

        $qline = Qline::findorfail($qlineid);
        $qline->item_image = $path;
        $qline->save();

        $qline = Qline::findorfail($qlineid);

        return view('qline.image',compact('qline'));

    }

    public function removeImage($qlineid){
      $qline = Qline::findorfail($qlineid);

      $qline->item_image = '';

      $qline->save();

      $qline = Qline::findorfail($qlineid);
      return view('qline.image',compact('qline'));
 

    }
}
