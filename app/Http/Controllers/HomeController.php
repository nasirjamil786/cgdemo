<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Booking;
use App\Order;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bookings = Booking::orderBy('booking_date','asc')
                            ->orderBy('booking_time','asc')
                            ->where('status','=',NULL)
                            ->orWhere(function($query)
                            {
                                $query->where('status','<>','Complete')
                                      ->where('status','<>','Cancelled')
                                      ->where('status','<>','Not Turnup')
                                      ->where('status','<>','Not Response');

                            })
                            ->get();

        $orders = DB::table('orders')
                            ->join('customers','orders.customer_id','=','customers.id')
                            ->join('users','orders.worked_by','=','users.id')
                            ->select('orders.*','customers.first_name','customers.last_name','customers.address1','customers.phone','customers.town','customers.postcode','users.name')
                            ->where(function($query)
                            {
                                $query->where('order_status','<>','Closed')
                                      ->where('order_status','<>','Cancelled');

                            })
                             
                            ->orderby('id','desc')
                            ->get();
                             
        return view('home',compact('bookings','orders'));
    }
}
