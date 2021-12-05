<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myfunctions\Myfunctions;
use App\Http\Requests;
use App\Order;
use App\Orline;
use Auth;
use Redirect;
use DB;
use App\Supplier;

class OrlineController extends Controller
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
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $supp_ref = $request->supp_ref;



        if($supp_ref != NULL){
            $orlines = DB::table('orders')
                        ->join('users','orders.worked_by','=','users.id')
                        ->join('customers','orders.customer_id','=','customers.id')
                        ->join('orlines','orlines.order_id','=','orders.id')
                        ->select('users.first_name as user_first_name','customers.*','orlines.*','orders.*')
                        ->where('orlines.item_notes','!=','advance')
                        ->where('orlines.supp_ref','LIKE','%'.$supp_ref.'%')
                        ->orWhere('orlines.supp_name','LIKE','%'.$supp_ref.'%')
                        ->orWhere('orders.private_notes','LIKE','%'.$supp_ref.'%')
                        ->orderBy('orders.id','desc')
                        ->get();
        }
        else {

            $orlines = DB::table('orders')
                        ->join('users','orders.worked_by','=','users.id')
                        ->join('customers','orders.customer_id','=','customers.id')
                        ->join('orlines','orlines.order_id','=','orders.id')
                        ->select('users.first_name as user_first_name','customers.*','orlines.*','orders.*')
                        ->where('orlines.item_notes','!=','advance')
                        ->orderBy('orders.id','desc')
                        ->get();
        }


        return view('orlines.list',compact('orlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {

        return view('orlines.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orderid)
    {


        $this->validate($request,[

            'item_notes' => 'required',
            'item_detail' => 'required',
            'value' => 'required'
        ]);

        $order = Order::findorfail($orderid);
        $supp_id = $request->supp_id;

        if($supp_id != 0){
            $supplier = Supplier::findorfail($supp_id);
        }

        $orline = New Orline;

        $orline->order_id = $orderid;
        $orline->item_notes = $request->item_notes;
        $orline->item_detail = $request->item_detail;
        $orline->quantity = 1;
        $orline->price = $request->value;
        $orline->cost = $request->cost;
        $orline->value = $request->value;
        $orline->commission = $request->commission;
        $orline->supp_id = $request->supp_id;
        $orline->supp_name = ($supp_id != 0) ? $supplier->name : '';
        $orline->supp_ref = $request->supp_ref;
        $orline->updated_by = Auth::user()->id;

        $orline->save();

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($orderid);

        return redirect('order/'.$orderid.'/edit/0')->with('status','Order details was saved successfully!');

    }

    public function update(Request $request, $lineid)
    {
        $this->validate($request,[

            'item_notes' => 'required',
            'item_detail' => 'required',
            'value' => 'required'
        ]);

        $orline = Orline::findorfail($lineid);
        $supp_id = $request->supp_id;

        if($supp_id != 0){
            $supplier = Supplier::findorfail($supp_id);
        }

        $orderid = $orline->order_id;

        $orline->item_notes = $request->item_notes;
        $orline->item_detail = $request->item_detail;
        $orline->price = $request->value;
        $orline->value = $request->value;
        $orline->cost = $request->cost;
        $orline->commission = $request->commission;
        $orline->supp_id = $request->supp_id;
        $orline->supp_name = ($supp_id != 0) ? $supplier->name : '';
        $orline->supp_ref = $request->supp_ref;
        $orline->updated_by = Auth::user()->id;

        $orline->save();

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($orderid);

        return redirect('order/'.$orderid.'/edit/0')->with('status','Order line was saved successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        $orline = Orline::findorfail($id);

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($orline->order_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $orline = Orline::findorfail($id);
        $order_id = $orline->order_id;

        $orline->delete();

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($order_id);


        return redirect('order/'.$order_id.'/edit/0');
    }
}
