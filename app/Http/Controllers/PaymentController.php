<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Payment;
use Auth;
use Redirect;
use App\Myfunctions\Myfunctions;
use App\Customer;
use App\Order;
use Carbon\carbon;

class PaymentController extends Controller
{
    // Middle ware 
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function store (Request $request,$orderid){

		$this->validate($request,[
			'payment_date' => 'required',
			'amount' => 'required',
			'payment_method' => 'required'
		]);
        

        $myfuncs = New Myfunctions;
        $payment_date = $myfuncs->usDate($request->payment_date);

		$order = Order::findorFail($orderid);
		$payment = New Payment;

		$payment->customer_id = $order->customer_id;
		$payment->cust_name = $order->customer->first_name." ".$order->customer->last_name;
        $payment->order_id = $order->id;
        $payment->quote_id = $order->quote_id;
        $payment->payment_date = $payment_date;
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->payment_ref = $request->payment_ref;
        $payment->payment_type = ($request->amount < 0) ? 'refund' : 'payment';
        $payment->currency = 'GBP';
        $payment->exch_rate = 1;
        $payment->updated_by = Auth::user()->id;

        $payment->save();


        $order->payment_date = $payment->payment_date;  //last payment date no need to store in order but just incase 
        $order->payment_method = $payment->payment_method; // last payment method 
        $order->payment = $order->payment + $payment->amount;
        $order->payment_ref = $payment->payment_ref; //last payment reference just in case 

        $order->save();

        //Redirect to named router defined in route file
        //which will show the edit order screen 
        //return redirect()->route('orderedit', ['order' => $order->id]);

        return redirect('order/'.$order->id.'/edit/0')->with('status','Order details was saved successfully!');

    }

    public function delete ($id){

        //Find payment with the payment id 
        $pay = Payment::findorFail($id);
        //find related order of that payment
        $ord = Order::findorFail($pay->order_id);
        //update the order payment , as we are deleting this payment therefore we will minus it if we delete the credit note then it will add
        $ord->payment = $ord->payment - $pay->amount;
        //save order 
        $ord->save();
        //delete payment record 
        $pay->delete();
         
         //redirect to order update screen
        return redirect('order/'.$ord->id.'/edit/0')->with('status','Order details was updated successfully!');


    }
}
