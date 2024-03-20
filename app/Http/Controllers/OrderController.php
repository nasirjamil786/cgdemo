<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\Quote;
use App\Qline;
use App\Orline;
use App\Customer;
use App\Supplier;
use App\User;
use App\Device;
use App\Make;
use App\Setting;
use App\Myfunctions\Myfunctions;
use Auth;
use Redirect;
use Mail;
use DB;
use Session;
use DateTime;
use Carbon\Carbon;
use App\Payment;
use Spatie\GoogleCalendar\Event;
use PDF;
use Illuminate\Support\Facades\Response;
use Images;
use Talal\LabelPrinter\Printer;
use Talal\LabelPrinter\Mode\Template;
use Talal\LabelPrinter\Command;
use Talal\LabelPrinter\Mode\Escp; 

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function confirmCompleteDate($id,$p)
    {

        $order = Order::with('customer')->where('id',$id)->first();

        return view('order.orderCompleteDate',compact('order','p'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->order_search;
        $checked_state = $request->checked_state;
        $exclude = ($request->checked_state == 'on')? false : true;
        $sortby  = $request->sort_by;
        
        if( $search != NULL){

            if($sortby == 'orderno'){

                $orders = DB::table('orders')
                                ->join('customers','orders.customer_id','=','customers.id')
                                ->join('devices','orders.device_id','=','devices.id')
                                ->join('makes','orders.make_id','=','makes.id')
                                ->join('users','orders.worked_by','=','users.id')
                                ->select('orders.*','customers.first_name','customers.last_name','customers.email','customers.ccemail','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name as user_first_name','customers.phone','customers.mobile','device_type','make')
                                ->WhereExists(function($query) use($search){ 

                                        $query->select(DB::raw(1))
                                              ->from('orlines')
                                              ->whereColumn('orders.id','=','orlines.order_id')
                                              ->where('orlines.supp_ref','LIKE','%'.$search.'%');

                                    })
                                ->orwhere('orders.id','LIKE','%'.$search.'%')
                                ->orwhere('orders.serial_no','LIKE','%'.$search.'%')
                                ->orwhere('orders.private_notes','LIKE','%'.$search.'%')
                                ->orWhere('customers.first_name','LIKE','%'.$search.'%')
                                ->orWhere('customers.last_name','LIKE','%'.$search.'%')
                                ->orWhere('customers.postcode','LIKE','%'.$search.'%')
                                ->orWhere('customers.recommended_by','LIKE','%'.$search.'%')
                                ->orWhere('customers.recommended_name','LIKE','%'.$search.'%')
                                ->orderby('id','desc')
                                ->paginate(500);
            } else {

                $orders = DB::table('orders')
                                ->join('customers','orders.customer_id','=','customers.id')
                                ->join('devices','orders.device_id','=','devices.id')
                                ->join('makes','orders.make_id','=','makes.id')
                                ->join('users','orders.worked_by','=','users.id')
                                ->select('orders.*','customers.first_name','customers.last_name','customers.address1','customers.email','customers.ccemail','customers.phone','customers.town','customers.postcode','users.first_name as user_first_name','customers.phone','customers.mobile','device_type','make')
                                
                                ->WhereExists(function($query) use($search){ 

                                        $query->select(DB::raw(1))
                                              ->from('orlines')
                                              ->whereColumn('orders.id','=','orlines.order_id')
                                              ->where('orlines.supp_ref','LIKE','%'.$search.'%');

                                    })
                                ->orWhere('orders.id','LIKE','%'.$search.'%')
                                ->orwhere('orders.serial_no','LIKE','%'.$search.'%')
                                ->orwhere('orders.private_notes','LIKE','%'.$search.'%')
                                ->orWhere('customers.first_name','LIKE','%'.$search.'%')
                                ->orWhere('customers.last_name','LIKE','%'.$search.'%')
                                ->orWhere('customers.postcode','LIKE','%'.$search.'%')
                                ->orWhere('customers.recommended_by','LIKE','%'.$search.'%')
                                ->orWhere('customers.recommended_name','LIKE','%'.$search.'%')
                                ->orderby('booking_date','desc')
                                ->paginate(500);

            }
            
        }else { 

           if ($checked_state == 'on') { 


                if ($sortby == 'orderno') {

                    $orders = DB::table('orders')
                            ->join('customers','orders.customer_id','=','customers.id')
                            ->join('devices','orders.device_id','=','devices.id')
                            ->join('makes','orders.make_id','=','makes.id')
                            ->join('users','orders.worked_by','=','users.id')
                            ->select('orders.*','customers.first_name','customers.last_name','customers.email','customers.ccemail','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS user_first_name','customers.phone','customers.mobile','device_type','make')
                            ->orderby('id','desc')
                            ->paginate(500);
                    
                } else {

                    $orders = DB::table('orders')
                            ->join('customers','orders.customer_id','=','customers.id')
                            ->join('devices','orders.device_id','=','devices.id')
                            ->join('makes','orders.make_id','=','makes.id')
                            ->join('users','orders.worked_by','=','users.id')
                            ->select('orders.*','customers.first_name','customers.last_name','customers.email','customers.ccemail','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS user_first_name','customers.phone','customers.mobile','device_type','make')
                            ->orderby('booking_date','desc')
                            ->paginate(500);
                }

            }
            else {

                if ($sortby == 'orderno') {
                    
            
                        $orders = DB::table('orders')
                            ->join('customers','orders.customer_id','=','customers.id')
                            ->join('devices','orders.device_id','=','devices.id')
                            ->join('makes','orders.make_id','=','makes.id')
                            ->join('users','orders.worked_by','=','users.id')
                            ->select('orders.*','customers.first_name','customers.last_name','customers.address1','customers.email','customers.ccemail','customers.phone','customers.town','customers.postcode','users.first_name AS user_first_name','customers.phone','customers.mobile','device_type','make')
                            /*->when($exclude,function($query,$exclude_closed){return $query->where('order_status','!=','Closed');})*/
                            ->where('order_status','!=','Closed')
                            ->orderby('id','desc')
                            ->paginate(500);
                } else {

                        $orders = DB::table('orders')
                            ->join('customers','orders.customer_id','=','customers.id')
                            ->join('devices','orders.device_id','=','devices.id')
                            ->join('makes','orders.make_id','=','makes.id')
                            ->join('users','orders.worked_by','=','users.id')
                            ->select('orders.*','customers.first_name','customers.last_name','customers.email','customers.ccemail','customers.address1','customers.phone','customers.town','customers.postcode','users.first_name AS user_first_name','customers.phone','customers.mobile','device_type','make')
                            /*->when($exclude,function($query,$exclude_closed){return $query->where('order_status','!=','Closed');})*/
                            ->where('order_status','!=','Closed')
                            ->orderby('booking_date','desc')
                            ->paginate(500);


                        }

            }
         }

         $today = Carbon::now()->toDateString();
             
        return view('order.orders',compact('orders','checked_state','sortby','today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }
    public function neworder($custid)
    {

        $cust = Customer::findorfail($custid);
        $engineers = User::all();
        $devices = Device::orderby('device_type')->get();
        $makes = Make::orderby('make')->get();
        
        return view('order.orderCreate',compact('cust','engineers','devices','makes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$custid)
    {

        $this->validate($request,[

            'booking_date' => 'required',
            'booking_time' => 'required',
            'location'  => 'required',
            'device_id'   => 'required',
            'make_id'       => 'required', 
            'model'   => 'required',
            'colour'  => 'required',
            'serial_no'   => 'required',
            'password'   => 'required',
            'data_backup'   => 'required',
            'order_notes' => 'required',
            //'signature' => 'required',
        ]);

    
        //double check here in case javaScript validation faild 
        if($request->ignore_signature != 'on' && ($request->signature == NULL || $request->signature == '' || 
           strpos($request->signature , 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAHFklEQVR4X') === 0)){

            return "Signature required!";
        }

        $myfuncs = New Myfunctions;
        $booking_date = $myfuncs->usDate($request->booking_date);

        $settings = Setting::findorfail(1);

        $cust = Customer::findorfail($custid);

        $order = New Order;

        $order->booking_date = $booking_date;
        $order->complete_date = $booking_date;
        $order->booking_time = $request->booking_time;
        $order->location = $request->location;
        $order->device_id = $request->device_id;
        $order->make_id =  $request->make_id;
        $order->model = $request->model;
        $order->colour = $request->colour;
        $order->serial_no = $request->serial_no;
        $order->password = $request->password;
        $order->data_backup = $request->data_backup;
        $order->order_notes = $request->order_notes;
        $order->private_notes = $request->private_notes;
        $order->taken_by = Auth::user()->id;
        $order->updated_by = Auth::user()->id;
        $order->worked_by = $request->worked_by;
        $order->order_status = "Booked";
        $order->customer_id = $cust->id;
        $order->discount_percent = $cust->discount;
        $order->vat_rate = $settings->vat_rate;
        $order->send_email = 1;
        $order->add_event = ($request->add_event) ? 1 : 0;
        $order->save();

        //If Customer one off discount applied then clear that in customer 
        if($cust->discount != 0){
            $cust->discount = 0;
            $cust->save();
        }

        $order->order_ref = $order->id;
        $order->save();

        //Now save the customer signature in /storage/app/signatures flder with order no
        // example /Users/Nasir/code/gapp/storage/signatures/12345.png 
        // Then store the full path of signature file into orders.signature field 
        // so that we can retrieve it later for prinitng etc
        if($request->ignore_signature != 'on') {


            //New code
            $signature = $request->signature;  //store input signature from javascript pad
            $image_parts = explode(";base64,", $signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);  //This is an image

            //now save this image into order.signature as BLOB 
            $img = Images::make($image_base64);
            Response::make($img->encode('png'));

            $order->signature = $img;
            $order->save();
            //end of new code 


            //$signatureFile = $myfuncs->storeSignature($order->id,$request->signature);
            //$order->signature = $signatureFile;
            //$order->save();

        }
        /*

        //send an email to customer

        $user = Auth::user();
        Mail::send('emails.bookingCustConfirmation', ['customer' => $cust], function ($m) use ($user,$cust) {
            $m->from($user->email, $user->name);
            $m->to($cust->email, $cust->first_name.' '.$cust->last_name)->subject('Booking Confirmation with Computer Gurus');
        });

        //send an email to assigned engineer

        $eng = User::findorfail($order->worked_by) ;
        Mail::send('emails.bookingEngNotification', ['order' => $order,'engineer' => $eng], function ($m) use ($user,$eng,$order) {
            $m->from($user->email, $user->name);
            $m->to($eng->email, $eng->name)->subject('New Booking Confirmation No '.$order->id);
        });

        */

        //If the order is onsite or add event checkbox is checked then create an event in Google Calendar
        if($order->location == 1 || $order->add_event == 1) {
            //Create new event 
            $event = new Event;
            //Assign values including Name, date , time and location
            $event->name = $order->customer->first_name.' '.$order->customer->last_name.'|Order#'.$order->id;

            $event->startDateTime =  Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London');
            $event->endDateTime = Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London')->addHour(2);

            //$event->location = $order->customer->address1.','.$order->customer->postcode;
            $event->location = ($order->location == 1) ? $order->customer->address1.','.$order->customer->postcode : 'Comming into the Office';
            $event = $event->save();

            $order->event_id = $event->id;
            $order->save();

            //send email to Engineer to remind about appointment 
            
        }

        //return redirect('order');

        return redirect()->route('emailPreview', ['orderid' => $order->id]);

    }

    // Convert a quote into order 

    public function createOrderFromQuote (Request $request, $quoteid){

        $this->validate($request,[

            'booking_date' => 'required',
            'booking_time' => 'required',
            'location'  => 'required',
            'device_id'   => 'required',
            'make_id'        => 'required',
            'model'   => 'required',
            'password'   => 'required',
            'data_backup'   => 'required',
            'order_notes' => 'required',
            'colour' => 'required',
        ]);

        //convert the input booking date in to a database store format 
        $myfuncs = New Myfunctions;
        $booking_date = $myfuncs->usDate($request->booking_date);
        //Find quote 
        $quote = Quote::findorfail($quoteid);
        //Find customer from quote 
        $cust = Customer::findorfail($quote->customer_id);
        //Find first settings for VAT rate etc 
        $settings = Setting::findorfail(1);  
        //Create New order 
        $order = New Order;
        //store data from the input form 
        $order->quote_id = $quote->id;
        $order->booking_date = $booking_date;
        $order->complete_date = $booking_date;
        $order->booking_time = $request->booking_time;
        $order->location = $request->location;
        $order->device_id = $request->device_id;
        $order->make_id =   $request->make_id;
        $order->model = $request->model;
        $order->colour = $request->colour;
        $order->password = $request->password;
        $order->data_backup = $request->data_backup;
        $order->order_notes = $request->order_notes;
        $order->private_notes = $request->private_notes;
        $order->taken_by = Auth::user()->id;
        $order->updated_by = Auth::user()->id;
        $order->worked_by = $request->worked_by;
        $order->order_status = "Booked";
        $order->customer_id = $cust->id;
        $order->discount_percent = $cust->discount;
        $order->vat_rate = $settings->vat_rate;
        $order->send_email = 1;
        $order->add_event = ($request->add_event) ? 1 : 0;
        $order->save();
        
        $order->order_ref = $order->id;

        //update cross refrence of orde rno to quote as well

        $quote->order_id = $order->id;
        $quote->quote_status = "ordered";
        $quote->save();

        //If Customer one off discount applied then clear that in customer 
        if($cust->discount != 0){
            $cust->discount = 0;
            $cust->save();
        }

        //Now create order lines from quote lines 
        $qlines = Qline::where('quote_id',$quote->id)->get();

        foreach ($qlines as $ql) {
             
            $orline = New Orline;  //Create new order-line

            $orline->order_id = $order->id;
            $orline->item_notes = $ql->item_type;  //parts or labour
            $orline->item_detail = $ql->item_detail;
            $orline->quantity = $ql->quantity;
            $orline->price = $ql->price;
            $orline->cost = $ql->cost;
            $orline->cost_vat_exempt = $ql->cost_vat_exempt;
            $orline->cost_vat = $ql->cost_vat;
            $orline->value = $ql->value;
            $orline->vat_rate = $ql->vat_rate;
            $orline->vat = $ql->vat;
            $orline->total_withvat = $ql->total_withvat;
            $orline->commission = $ql->commission;
            $orline->supp_id = $ql->supp_id;
            $orline->supp_name = $ql->supp_name;
            $orline->supp_ref = $ql->supp_ref;
            $orline->updated_by = Auth::user()->id;

            $orline->save();
        }

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($order->id);


        //If the order is onsite then create an event in Google Calendar
        if($order->location == 1 || $order->add_event == 1) {
            //Create new event 
            $event = new Event;
            //Assign values including Name, date , time and location
            $event->name = $order->customer->first_name.' '.$order->customer->last_name.'|Order#'.$order->id;
            $event->startDateTime =  Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London');
            $event->endDateTime = Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London')->addHour(2);
            //$event->location = $order->customer->address1.','.$order->customer->postcode;
            $event->location = ($order->location == 1) ? $order->customer->address1.','.$order->customer->postcode : 'Comming into the Office';
            $event = $event->save();

            $order->event_id = $event->id;
            $order->save();
        }

        //Redirect to named router defined in route file
        //which willshow the edit order screen 
        //return redirect()->route('orderedit', ['order' => $order->id]);
        return redirect('order/'.$order->id.'/edit/1');
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
    public function edit($id,$from)
    {

        $order = Order::with('customer')->where('orders.id',$id)->first();
        $orlines = Orline::where('order_id',$id)->get();
        $payments = Payment::where('order_id',$id)->get();
        $devices = Device::all();
        $makes = Make::all();
        $engineers = User::all();
        $suppliers = Supplier::all();
        
        $services = 0;
        foreach ($orlines as $ol) {
            if ($ol->item_notes == 'labour') {
                $services = $services + $ol->line_value;
            }
        }
        
        $from = $from;
        return view('order.orderEdit',compact('order','orlines','payments','devices','makes','engineers','suppliers','services','from'));
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
        
        $this->validate($request, [

            'order_status' => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'location'  => 'required',
            'order_notes' => 'required',
            'device_id'   => 'required',
            'make_id'       => 'required',
            'model'   => 'required',
            /*'serial_no'   => 'required',*/
            'password'   => 'required',
            'data_backup'   => 'required',
            'worked_by' => 'required'
        ]);

        $order = Order::findorfail($id);
        
        $myfuncs = New Myfunctions;
        $booking_date = $myfuncs->usDate($request->booking_date);
        $settings = Setting::findorfail(1);

        $complete_date = Null;
        $collection_date = Null;
        $followup_date = Null;
        $payment_date = Null;

        if($request->complete_date != Null)
           $complete_date = $myfuncs->usDate($request->complete_date);

        if($request->collection_date != null)
           $collection_date = $myfuncs->usDate($request->collection_date);
        if($request->followup_date != null)
           $followup_date = $myfuncs->usDate($request->followup_date);

        if($request->payment_date != null)
            $payment_date = $myfuncs->usDate($request->payment_date);

        $order->order_status = $request->order_status;
        $order->booking_date = $booking_date;
        $order->booking_time = $request->booking_time;
        $order->location = $request->location;
        $order->complete_date = $booking_date;
        $order->collection_date = $collection_date;
        $order->collection_time = $request->collection_time;
        $order->followup_date = $followup_date;
        $order->followup_time = $request->followup_time;
        $order->order_notes = $request->order_notes;
        $order->private_notes = $request->private_notes;
        $order->recommendations = $request->recommendations;
        $order->device_id = $request->device_id;
        $order->make_id = $request->make_id;
        $order->model = $request->model;
        $order->serial_no = $request->serial_no;
        $order->operating_system = $request->operating_system;
        $order->condition = $request->condition;
        $order->colour = $request->colour;
        $order->data_backup = $request->data_backup;
        $order->username = $request->username;
        $order->password = $request->password;
        $order->discount_percent = $request->discount_percent;
        $order->vat_rate = $settings->vat_rate;
        $order->vat_exempt = $request->vat_exempt;
        $order->worked_by = $request->worked_by;
        $order->updated_by = Auth::user()->id;
        $order->add_event = ($request->add_event) ? 1 : 0;

        // store device testing result 

        $order->test_startup = ($request->test_startup == 'NA') ? NULL : $request->test_startup ;
        $order->test_startup_comm = $request->test_startup_comm;
        $order->test_sound = ($request->test_sound == 'NA') ? NULL : $request->test_sound ;
        $order->test_sound_comm = $request->test_sound_comm;
        $order->test_camera = ($request->test_camera == 'NA') ? NULL : $request->test_camera ;
        $order->test_camera_comm = $request->test_camera_comm;
        $order->test_wifi = ($request->test_wifi == 'NA') ? NULL : $request->test_wifi ;
        $order->test_wifi_comm = $request->test_wifi_comm;
        $order->test_ethernet = ($request->test_ethernet == 'NA') ? NULL : $request->test_ethernet ;
        $order->test_ethernet_comm = $request->test_ethernet_comm;
        $order->test_keyboard = ($request->test_keyboard == 'NA') ? NULL : $request->test_keyboard ;
        $order->test_keyboard_comm = $request->test_keyboard_comm;
        $order->test_trackpad = ($request->test_trackpad == 'NA') ? NULL : $request->test_trackpad ;
        $order->test_trackpad_comm = $request->test_trackpad_comm;
        $order->test_headphone = ($request->test_headphone == 'NA') ? NULL : $request->test_headphone ;
        $order->test_headphone_comm = $request->test_headphone_comm;
        $order->test_display = ($request->test_display == 'NA') ? NULL : $request->test_display ;
        $order->test_display_comm = $request->test_display_comm;
        $order->test_homebutton = ($request->test_homebutton == 'NA') ? NULL : $request->test_homebutton ;
        $order->test_homebutton_comm = $request->test_homebutton_comm;
        $order->test_microphone = ($request->test_microphone == 'NA') ? NULL : $request->test_microphone ;
        $order->test_microphone_comm = $request->test_microphone_comm;
        $order->test_fan = ($request->test_fan == 'NA') ? NULL : $request->test_fan ;
        $order->test_fan_comm = $request->test_fan_comm;
        $order->test_battery = ($request->test_battery == 'NA') ? NULL : $request->test_battery ;
        $order->test_battery_comm = $request->test_battery_comm;
        $order->test_chport = ($request->test_chport == 'NA') ? NULL : $request->test_chport ;
        $order->test_chport_comm = $request->test_chport_comm;
        $order->test_shutdown = ($request->test_shutdown == 'NA') ? NULL : $request->test_shutdown ;
        $order->test_shutdown_comm = $request->test_shutdown_comm;
        $order->test_earphone = ($request->test_earphone == 'NA') ? NULL : $request->test_earphone ;
        $order->test_earphone_comm = $request->test_earphone_comm;
        $order->test_others = ($request->test_others == 'NA') ? NULL : $request->test_others ;
        $order->test_others_comm = $request->test_others_comm;
        $order->test_date = Carbon::now();
        $order->tested_by = Auth::user()->first_name.' '.Auth::user()->last_name;

        $order->save();

        $myfunctions = New Myfunctions;
        $myfunctions->updateOrderTotals($id);


        //If the order is onsite then create an event in Google Calendar
        if($order->location == 1 || $order->add_event == 1) {

            //check if the calendar event already exist 
            if($order->event_id != NULL){

                //find that event in the Google calendar
                $event = Event::find($order->event_id);

                //Now check if there is no event or event is cancelled then create a new event
                if($event == NULL || $event->status == 'cancelled' ){

                    $event = new Event();
                }
            }
            else {

                $event = New Event();
            }

            //At this stage event will be available so assign values including Name, date , time and location
            $event->name = $order->customer->first_name.' '.$order->customer->last_name.'|Order#'.$order->id;

            $event->startDateTime =  Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London');
            $event->endDateTime = Carbon::parse($booking_date.' '.$order->booking_time,'Europe/London')->addHour(2);

            $event->location = ($order->location == 1) ? $order->customer->address1.','.$order->customer->postcode : 'Comming into the Office';
            $event = $event->save();

            $order->event_id = $event->id;
            $order->save();
        } else 
            {
                if($order->event_id != NULL)
                {
                    try { 

                       $event =  Event::find($order->event_id); 

                    } catch (\Google_Service_Exception $e) { 

                       echo $e->getErrors()[0]['reason']; //notFound
                    }

                    //If the event is available and status is not cancelled then delete
                    if($event != NULL && $event->status != 'cancelled'){
                        $event->delete();
                    }
                    
                    //In all cases assign order->event_id to NULL
                    $order->event_id = NULL;
                    $order->save();

                }
            }

        //return redirect::back()->with('status','Order details was saved successfully!');

            return redirect('order/'.$order->id.'/edit/0')->with('status','Order details was saved successfully!');

    }

    public function updateCompleteDate(Request $request,$id,$p)
    {

        $this->validate($request,[

            'complete_date' => 'required',
             
        ]);

        $order = Order::findorfail($id);
        $myfuncs = New Myfunctions;
        $complete_date = $myfuncs->usDate($request->complete_date);
        
        $order->complete_date = $complete_date;
        $order->save();

        //return view('order.orderCompleteDateConfirm',compact('order'));

        //return redirect('invpreview/'.$order->id));

        //return redirect()->route('invpreview/', ['id' => $order->id]);

        if($p == 1)
            return redirect('invprint/'.$order->id);
        else
           return redirect('invpreview/'.$order->id);

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

    //Email Invoice

    public function invPreview($id,$reminder){

        $order = Order::findorfail($id);
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        //$inv_date = New DateTime();
        $inv_date = $order->complete_date;
        //$inv_date = $inv_date->format('j M Y');
        $settings = Setting::findorfail(1);
        $user = Auth::user();

        return view('emails.invpreview',compact('order','orlines','payments','inv_date','settings','reminder','user'));

    }

    //Print Preview an Email without buttons 

    public function invPrint($id,$reminder){

        $order = Order::findorfail($id);
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        //$inv_date = New DateTime();
        $inv_date = $order->complete_date;
        //$inv_date = $inv_date->format('j M Y');
        $settings = Setting::findorfail(1);
        
        return view('emails.invprint',compact('order','orlines','payments','inv_date','settings','reminder'));
    }
    public function invEmail($id,$reminder){

        $order = Order::with('customer')->where('id',$id)->first();
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        $user = Auth::user();
        //$inv_date = New DateTime();
        $inv_date = $order->complete_date;
        //$inv_date = $inv_date->format('j M Y');
        $settings = Setting::findorfail(1);

        $remindLabel = ($reminder > 0) ? '[Reminder]':'';

        Mail::send('emails.invoice', ['order' => $order,'inv_date' => $inv_date,'settings' => $settings,'orlines' => $orlines,'payments' => $payments,'reminder' => $reminder,'user' => $user], function ($m) use ($user,$order,$remindLabel) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name);
           $m->subject($remindLabel.'Computer Gurus Invoice #'.$order->id);
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Invoice to Customer');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $order->order_status = "Invoiced";
        $order->inv_emailed = Carbon::now();
        $order->save();

        Session::flash('status','Invoice emailed to customer successfully!');
        return redirect::back();

    }

    //Download invoice as pdf 

    public function invPdf($id){

        $order = Order::findorfail($id);
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        $inv_date = $order->complete_date;
        $settings = Setting::findorfail(1);

        $pdf = PDF::loadView('emails.pdftest',compact('order','orlines','payments','inv_date','settings'));

        //return $pdf->download('pdf_file.pdf');
        return $pdf->stream('pdf_file.pdf');
    }

    //Email Payment Receipt

    public function recPreview($id){

        $order = Order::findorfail($id);
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        $inv_date =  $order->payment_date;
        $settings = Setting::findorfail(1);

        return view('emails.recpreview',compact('order','orlines','payments','inv_date','settings'));

    }

     //Print Payment Receipt

    public function recPrint($id){

        $order = Order::findorfail($id);
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        $inv_date =  $order->payment_date;
        $settings = Setting::findorfail(1);

        return view('emails.recprint',compact('order','orlines','payments','inv_date','settings'));

    }

    public function recEmail($id){

        $order = Order::with('customer')->where('id',$id)->first();
        $user = Auth::user();
        $orlines = Orline::where('order_id','=',$id)->get();
        $payments = Payment::where('order_id','=',$id)->get();
        $inv_date =  $order->payment_date;
        $settings = Setting::findorfail(1);

        Mail::send('emails.receipt', ['order' => $order,'orlines' => $orlines,'payments' => $payments,'inv_date' => $inv_date,'settings' => $settings], function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Computer Gurus Payment Receipt# '.$order->id);
           if ($user->bcc != null)
              $m->bcc($user->bcc, $name = 'Receipt to Customer');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $order->order_status = "Payment Receipt Sent";
        $order->save();

        Session::flash('status','Receipt emailed to customer successfully!');
        return redirect::back();

    }
    // Prinitng and Print Preview and Email etc 
    //Print
    public function print($orderid){

        $order = Order::findorfail($orderid);
        $settings = Setting::findorfail(1);
        $user = Auth::user();
        $olines = Orline::where('order_id','=',$order->id)->get();

        return view('order.print',compact('order','settings','olines','user'));

    }

    // Signature later on , if order is placed while client is not present,
    // for example taking order over phone and visit home later on
    // then take signature when you see client 

    public function signature($orderid){

        //display a print copy of the booking confirmation to take signature

        $order = Order::findorfail($orderid);
        $settings = Setting::findorfail(1);
        $user = Auth::user();
        $olines = Orline::where('order_id','=',$order->id)->get();

        return view('order.signature',compact('order','settings','olines','user'));

    }

    public function storeSignature(Request $request,$orderid){

        $this->validate($request,[
            'signature' => 'required',
        ]);

         //double check here in case javaScript validation faild 
        if(($request->signature == NULL || $request->signature == '' || 
           strpos($request->signature , 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAHFklEQVR4X') === 0)){
            return "Signature required!";
        }

        //New code
            $signature = $request->signature;  //store input signature from javascript pad
            $image_parts = explode(";base64,", $signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);  //This is an image

            //now save this image into order.signature as BLOB 
            $img = Images::make($image_base64);
            Response::make($img->encode('png'));

            $order = Order::findorfail($orderid);
            $order->signature = $img;
            $order->save();
        //end of new code 

        //$order = Order::findorfail($orderid);
        //$myfuncs = New Myfunctions;
        //$signatureFile = $myfuncs->storeSignature($order->id,$request->signature);
        //$order->signature = $signatureFile;
        //$order->save();


        return redirect()->route('emailPreview', ['orderid' => $order->id]);
    }

    public function getSignature($orderid)
    {
        $order = Order::findorfail($orderid);
        $img_file = Images::make($order->signature);
        $response = Response::make($img_file->encode('png'));
        $response->header('Content-Type','image/png');

        return $response;
    }

    public function emailPreview($orderid){

        $order = Order::findorfail($orderid);
        $settings = Setting::findorfail(1);
        $user = Auth::user();
        $olines = Orline::where('order_id','=',$order->id)->get();

        return view('order.emailpreview',compact('order','settings','olines','user'));

    }


    public function email($id){

        $order = Order::with('customer')->where('id',$id)->first();
        $olines = Orline::where('order_id','=',$id)->get();
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        Mail::send('order.email', ['order' => $order,'settings' => $settings,'olines' => $olines], 


            function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Computer Gurus Booking# '.$order->id);
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Booking Confirmation');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $order->order_status = "emailed";
        $order->email_sent = Carbon::now();
        $order->save();

        Session::flash('status','Booking emailed to customer successfully!');
        return redirect::back();

    }
    // Printng Finished here -----------------

    //Reports Funtions

    public function OrderReport(){

        return view('order.orderreport');
    }



    public function OrderReportSummary(Request $request){
        $myfuncs = New Myfunctions;
        $booking_date_from = $myfuncs->usDate($request->booking_date_from);
        $booking_date_to = $myfuncs->usDate($request->booking_date_to);

        $orders = DB::table('orders')
                      ->join('orlines','orlines.order_id','=','orders.id')
                      ->where('orders.booking_date','>=',$booking_date_from)
                      ->where('orders.booking_date','<=',$booking_date_to)
                      ->where('orlines.item_notes','!=','advance')
                      ->get();

        $total_income = 0;
        $total_parts = 0;
        $total_labour = 0;
        $total_cost = 0;
        $total_commission = 0;

        foreach ($orders as $ord) {

             $total_income = $total_income + $ord->value;
             $total_cost = $total_cost + $ord->cost;
             $total_commission = $total_commission + $ord->commission;

             if($ord->item_notes == "parts"){
                $total_parts = $total_parts + $ord->value;
             }
             else{
                $total_labour = $total_labour + $ord->value;
             }

        }

        return view('order.orderreportsummary',compact('orders','total_income','total_cost','total_parts','total_labour','booking_date_from','booking_date_to','total_commission'));
    }


    public function OrderReportExport($booking_date_from,$booking_date_to){
         
    
        /*
        $myfuncs = New Myfunctions;
        $booking_date_from = $myfuncs->usDate($booking_date_from);
        $booking_date_to = $myfuncs->usDate($booking_date_to);*/

        $pathToFile = 'Orders.csv';
        $name = "Orders.csv";
        $headers = array('content-type' => 'text/csv',);
        $file_handle = fOpen($pathToFile,'w+');
        fputcsv($file_handle,['Order#','Order Date','Customer','Item','Cost','Cost VAT','Sales',
        'Sales VAT','Diff VAT']);

        $orders = DB::table('orders')
                    ->join('users','orders.worked_by','=','users.id')
                    ->join('customers','orders.customer_id','=','customers.id')
                    ->join('orlines','orlines.order_id','=','orders.id')
                    ->select('users.first_name as user_first_name','customers.*','orlines.*','orlines.cost_vat AS linecostvat','orlines.vat as linesalevat','orders.*')
                    ->where('orders.created_at','>=',$booking_date_from)
                    ->where('orders.created_at','<=',$booking_date_to)
                    ->where('orlines.item_notes','!=','advance')
                    ->orderBy('orders.id','desc')
                    ->get();

          foreach ($orders as $o) {
              
            fputcsv($file_handle, [
                $o->order_id,
                DateTime::createFromFormat('Y-m-d H:i:s',$o->booking_date)->format('d.m.Y'),
                $o->first_name.' '.$o->last_name,
                $o->item_detail,
                $o->cost,
                $o->linecostvat,
                $o->value,
                $o->linesalevat,
                $o->linesalevat - $o->linecostvat
                //$o->item_notes,
                //$o->order_status,
                //$o->user_first_name,
                //$o->commission
            ]);
          }

          fclose($file_handle);

          return response()->download($pathToFile, $name, $headers);

    }

    

    //Convert Quote To Order 
    public function ConvertQuoteToOrder ($id) {

        $quote = Quote::findorfail($id);
        $cust = Customer::findorfail($quote->customer_id);
        $qlines = Qline::where('quote_id','=',$quote->id)->get();


         dd("I am in ConvertQuoteToOrder function in Order controller qote id ".$id );
    }

    //Commission Report dislay date range 
    public function CommissionReport() {

      return view('commission.reportdaterange');

    }

    
    
    //This will display list of all order lines between the date range
    //also display the profit chart 
    public function CommissionReportExtract(Request $request){

        $myfuncs = New Myfunctions;
        $order_date_from = $myfuncs->usDate($request->order_date_from);
        $order_date_to = $myfuncs->usDate($request->order_date_to);
        $order_date_to = $order_date_to.' 23:59:59';

       $xyz = DB::table('orders')
                    ->join('users','orders.worked_by','=','users.id')
                    ->join('customers','orders.customer_id','=','customers.id')
                    ->join('orlines','orlines.order_id','=','orders.id')
                    ->select('users.first_name as user_first_name','customers.*','orlines.*','orlines.cost_vat AS linecostvat','orlines.vat as linesalevat','orders.*')
                    ->where('orders.created_at','>=',$order_date_from)
                    ->where('orders.created_at','<=',$order_date_to)
                    ->where('orlines.item_notes','!=','advance')
                    ->orderBy('orders.id','desc')
                    ->get();

        $parts_cost = 0;
        $parts_commission = 0;
        $parts_charge = 0;
        $parts_profit = 0;

        $services_cost = 0;
        $services_commission = 0;
        $services_charge = 0;
        $services_profit = 0;

        $total_cost = 0;
        $total_costvat = 0;
        $total_sale = 0;
        $total_salevat = 0;
        $total_vatdiff = 0;
        $total_profit = 0;

        foreach ($xyz as $orl) {
            
            if ($orl->item_notes == 'parts') {
                $parts_cost = $parts_cost + $orl->cost;
                $parts_commission = $parts_commission + $orl->commission;
                $parts_charge = $parts_charge + $orl->value;
            } else {
                $services_cost = $services_cost + $orl->cost;
                $services_commission = $services_commission + $orl->commission;
                $services_charge = $services_charge + $orl->value;
            }

            $total_cost = $total_cost + $orl->cost;
            $total_costvat = $total_costvat + $orl->linecostvat;
            $total_sale = $total_sale + $orl->value;
            $total_salevat = $total_salevat + $orl->linesalevat;
            $total_vatdiff = $total_vatdiff + ($orl->linesalevat - $orl->linecostvat);
            $total_profit = $total_profit + ($orl->value - $orl->cost);

        }

        $parts_profit = $parts_charge - $parts_cost - $parts_commission;
        $services_profit = $services_charge - $services_cost - $services_commission;

        
        return view('commission.report',compact('xyz','order_date_from',
                   'order_date_to','parts_cost','parts_commission','parts_charge',
                 'parts_profit','services_cost','services_commission',
                 'services_charge','services_profit','total_cost','total_costvat',
                 'total_sale','total_salevat','total_vatdiff','total_profit'));

    } // end of public function CommissionReportExtract


    //VAT Report dislay date range 
    public function VATReport() {

        return view('vat.vatdaterange');
 
    }
   //This will display VAT report 
    public function VATReportExtract(Request $request){

        $myfuncs = New Myfunctions;
        $order_date_from = $myfuncs->usDate($request->order_date_from);
        $order_date_to = $myfuncs->usDate($request->order_date_to);
        $order_date_to = $order_date_to.' 23:59:59';

       $xyz = DB::table('orders')
                    ->join('customers','orders.customer_id','=','customers.id')
                    ->select('orders.*','customers.first_name','customers.last_name')
                    ->where('orders.created_at','>=',$order_date_from)
                    ->where('orders.created_at','<=',$order_date_to)
                    ->where('orders.total_beforevat','!=','NULL')
                    ->where('orders.total_beforevat','!=',0)
                    ->where('orders.vat','!=',0)
                    ->orderBy('orders.id','desc')
                    ->get();

        $total_beforevat = 0;
        $vat = 0;
        $cost_vat = 0;
        $cost_total = 0;
        $total = 0;
         
        foreach ($xyz as $or) {
            
            $total_beforevat = $total_beforevat + $or->total_beforevat;
            $vat = $vat + $or->vat;
            $cost_vat = $cost_vat + $or->cost_vat;
            $total = $total + $or->order_total;
            $cost_total = $cost_total + $or->cost_total;

        }

        return view('vat.vat',compact('xyz','order_date_from','order_date_to','total_beforevat','vat','cost_vat','cost_total','total'));

    } // end of public function VATReportExtract

    public function VATReportExport($order_date_from,$order_date_to){
        
        $pathToFile = 'vat.csv';
        $name = "vat.csv";
        $headers = array('content-type' => 'text/csv',);
        $file_handle = fOpen($pathToFile,'w+');
        fputcsv($file_handle,['ORDERNO','BOOKINGDATE','CUSTOMER','COST','COST VAT','SALE','SALE VAT','SALE TOTAL']);

        $xyz = DB::table('orders')
                    ->join('customers','orders.customer_id','=','customers.id')
                    ->select('orders.*','customers.first_name','customers.last_name')
                    ->where('orders.created_at','>=',$order_date_from)
                    ->where('orders.created_at','<=',$order_date_to)
                    ->where('orders.total_beforevat','!=','NULL')
                    ->where('orders.total_beforevat','!=',0)
                    ->where('orders.vat','!=',0)
                    ->orderBy('orders.id','desc')
                    ->get();

          foreach ($xyz as $o) {
              
            fputcsv($file_handle, [
                $o->id,
                DateTime::createFromFormat('Y-m-d H:i:s',$o->created_at)->format('d.m.Y'),
                $o->first_name.' '.$o->last_name,
                $o->cost_total, //COST
                $o->cost_vat,   //VAT on COST
                $o->total_beforevat, //Sale 
                $o->vat,  //vat on sale
                $o->order_total  // sale invoice total
            ]);
          }

          fclose($file_handle);

          return response()->download($pathToFile, $name, $headers);

    }



    // Device Testing Functions 

    public function testView($id){

        $order = Order::findorfail($id);

        return view('devicetest.view',compact('order'));
    }

    public function testCreate($id) {

        $order = Order::findorfail($id);

        return view('devicetest.create',compact('order'));
    }

    public function testUpdate(Request $request,$id){

        $order = Order::findorfail($id);
        $user = Auth::user();

        $order->test_startup = $request->test_startup;
        $order->test_startup_comm = $request->test_startup_comm;
        $order->test_sound = $request->test_sound;
        $order->test_sound_comm = $request->test_sound_comm;
        $order->test_camera = $request->test_camera;
        $order->test_camera_comm = $request->test_camera_comm ;
        $order->test_wifi = $request->test_wifi;
        $order->test_wifi_comm = $request->test_wifi_comm;
        $order->test_ethernet = $request->test_ethernet;
        $order->test_ethernet_comm = $request->test_ethernet_comm;
        $order->test_keyboard = $request->test_keyboard;
        $order->test_keyboard_comm = $request->test_keyboard_comm;
        $order->test_trackpad = $request->test_trackpad;
        $order->test_trackpad_comm = $request->test_trackpad_comm;
        $order->test_headphone = $request->test_headphone;
        $order->test_headphone_comm = $request->test_headphone_comm;
        $order->test_display = $request->test_display;
        $order->test_display_comm = $request->test_display_comm;
        $order->test_homebutton = $request->test_homebutton;
        $order->test_homebutton_comm = $request->test_homebutton_comm;
        $order->test_microphone = $request->test_microphone;
        $order->test_microphone_comm = $request->test_microphone_comm;
        $order->test_fan = $request->test_fan;
        $order->test_fan_comm = $request->test_fan_comm;
        $order->test_battery = $request->test_battery;
        $order->test_battery_comm = $request->test_battery_comm;
        $order->test_chport = $request->test_chport;
        $order->test_chport_comm = $request->test_chport_comm;
        $order->test_shutdown = $request->test_shutdown;
        $order->test_shutdown_comm = $request->test_shutdown_comm;
        $torder->test_date = Carbon::now();
        $order->tested_by = $user->first_name. ' '. $user->last_name;

        $order->save();

        return view('devicetest.preview',compact('order'));
    }

    public function testPreview($id){

        $order = Order::findorfail($id);
        $settings = Setting::findorfail(1);

        return view('devicetest.preview',compact('order','settings'));

    }

     public function testPrint($id){

        $order = Order::findorfail($id);
        $settings = Setting::findorfail(1);

        return view('devicetest.print',compact('order','settings'));

    }

    public function testEmail($id){

        $order = Order::with('customer')->where('id',$id)->first();
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        Mail::send('devicetest.email', ['order' => $order,'settings' => $settings], function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Computer Gurus Device Test Report#'.$order->id);
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Device Test Report');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });
        $order->test_emailed = Carbon::now();
        $order->save();

        Session::flash('status','Result emailed to customer successfully!');
        return redirect::back();
    }

    public function DeviceFixedNotifPreview($id){

        $order = Order::findorfail($id);
        $settings = Setting::findorfail(1);

        return view('emails.deviceFixedNotifPreview',compact('order','settings'));

    }

    public function DeviceFixedNotifEmail($id){

        $order = Order::with('customer')->where('id',$id)->first();
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        Mail::send('emails.deviceFixedNotifEmail', ['order' => $order,'settings' => $settings,], function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Your device has been fixed order# '.$order->id);
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Device Fixed Notification');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $order->fixednotif_emailed = Carbon::now();
        $order->save();

        Session::flash('status','Notification emailed to customer successfully!');
        return redirect::back();

    }

    //Review Request Emails 

    public function ReviewRequestPreview($id) {

        $order = Order::findorfail($id);
        $settings = Setting::findorfail(1);

        return view('emails.reviewrequestpreview',compact('order','settings'));
    }

    public function ReviewRequestEmail($id){

        $order = Order::with('customer')->where('id',$id)->first();

    
        $customer = Customer::findorfail($order->customer_id);
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        Mail::send('emails.reviewrequestemail', ['order' => $order,'settings' => $settings,], function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Please Write a Review');
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Review Request');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $customer->revreqsent = Carbon::now();
        $customer->save();

        Session::flash('status','Notification emailed to customer successfully!');
        return redirect::back();

    }

    // Parts Ordered Email
    public function PartsOrderedEmailPreview($id) {

        $order = Order::findorfail($id);
        $settings = Setting::findorfail(1);

        return view('emails.partsorderedpreview',compact('order','settings'));
    }

    public function PartsOrderedEmail($id){

        $order = Order::with('customer')->where('id',$id)->first();

        $customer = Customer::findorfail($order->customer_id);
        $user = Auth::user();
        $settings = Setting::findorfail(1);

        Mail::send('emails.partsorderedemail', ['order' => $order,'settings' => $settings,], function ($m) use ($user,$order) {
           
           $m->from($user->email, $user->name);
           $m->to($order->customer->email, $order->customer->first_name.' '.$order->customer->last_name)->subject('Parts Ordred');
           if ($user->bcc != null)
               $m->bcc($user->bcc, $name = 'Parts Ordered');
           if ($order->customer->ccemail != null) {
               $m->cc($order->customer->ccemail);
           }
        });

        $customer->revreqsent = Carbon::now();
        $customer->save();

        Session::flash('status','Notification emailed to customer successfully!');
        return redirect::back();

    }

    //oneoff
    public function OneOffCompleteDate() {


        $orders = Order::where('id','<>',0)->get();

        $myfuncs = New Myfunctions;
        //$booking_date = $myfuncs->usDate($request->booking_date);

        foreach ($orders as $ord) {
            
            $o = Order::findorfail($ord->id);

            $o->complete_date = $myfuncs->usDate($o->booking_date);

            $o->save();
        }


    }

    //Print Labels 

    public function PrintLabel($order_no){

        $order = Order::findorfail($order_no);
        
        /*$stream = stream_socket_client('tcp://31.48.81.30:9100', $errorNumber, $errorString);*/
        /*$stream = stream_socket_client('tcp://81.143.205.231:9100', $errorNumber, $errorString);*/

        $stream = stream_socket_client(env('STATIC_IP'), $errorNumber, $errorString);

        $printer = new Printer(new Escp($stream));
        $font = new Command\Font('brussels', Command\Font::TYPE_OUTLINE);

        $printer->addCommand(new Command\CharStyle(Command\CharStyle::NORMAL));
        $printer->addCommand($font);
        $printer->addCommand(new Command\CharSize(46, $font));
        $printer->addCommand(new Command\Align(Command\Align::LEFT));

        /*$printer->addCommand(new Command\Text("Computer Gurus Ltd\r"));
        $printer->addCommand(new Command\Text("computergurus.co.uk\r"));
        $printer->addCommand(new Command\Text("T: 01892 529999\r")); */
        $printer->addCommand(new Command\Text($order->customer->first_name.' '.$order->customer->last_name."\r"));
        $printer->addCommand(new Command\Text("Order#:".$order->id."\n"));
        $printer->addCommand(new Command\Text("Ord Date:".date('d/m/Y H:i',strtotime($order->created_at))."\r"));
        $printer->addCommand(new Command\Text("support: 01892 529999\r"));
        $printer->addCommand(new Command\Text("computergurus.co.uk"));

        $printer->addCommand(new Command\Cut(Command\Cut::FULL));
        $printer->printLabel();

        fclose($stream);

        return back()->with('sess_mess', 'Your label has been printed');
    }

}
