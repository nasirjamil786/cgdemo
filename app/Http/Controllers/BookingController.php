<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Booking;
use App\User;
use App\Customer;
use App\Myfunctions\Myfunctions;
use Auth;
use Redirect;
use Mail;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class BookingController extends Controller
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
    public function index()
    {
        
        $bookings = Booking::orderBy('booking_date','asc')
                            ->orderBy('booking_time','asc')
                            ->where('status','=',NULL)
                            ->orWhere('status','=','Followup')
                            ->orWhere('status','=','Rescheduled')
                            ->orWhere('status','=','Call to Confirm')
                            ->orWhere('status','=','Booked')->paginate(20);

        $checked_state = NULL;

        return view('booking.index',compact('bookings','checked_state'));

    }

    public function allbookings(Request $request)
    {

        $checked_state = $request->checkbox_all;

        if($checked_state == 'on'){
        
                $bookings = Booking::orderBy('booking_date','asc')
                            ->orderBy('booking_time','asc')->paginate(20);
        } else {

                $bookings = Booking::orderBy('booking_date','asc')
                            ->orderBy('booking_time','asc')
                            ->where('status','=',NULL)
                            ->orWhere('status','=','Followup')
                            ->orWhere('status','=','Rescheduled')
                            ->orWhere('status','=','Booked')->paginate(20);
        }
          
        return view('booking.index',compact('bookings','checked_state'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $customers = Customer::orderBy('first_name')->orderBy('last_name')->get();


        return view('booking.create',compact('users','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->flash();

        $this->validate($request,[

            'booking_date' => 'required',
            'booking_time' => 'required',
            'name'  => 'required',
            'phone'   => 'required',
            'email' => 'email'
        ]);


        $myfuncs = New Myfunctions;
        $booking_date = $myfuncs->usDate($request->booking_date); //This will convert 12/01/2020 to 2020-01-12
        $assigned_to = $request->assigned_to;

        $booking = New Booking;


        $booking->booking_date = $booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->location = $request->location;
        $booking->name = $request->name;
        $booking->address = $request->address;
        $booking->town = $request->town;
        $booking->postcode = $request->postcode;
        $booking->phone = $request->phone;
        $booking->email = $request->email;
        $booking->assigned_to = $request->assigned_to;
        $booking->booked_by = Auth::user()->id;
        $booking->updated_by = Auth::user()->id;
        $booking->status = "Booked";
        $booking->notes = $request->notes;

        $booking->save();

        //send email to assigned to person 

        $engineer = User::findorFail($assigned_to);
        $user = Auth::user();

        //dd($engineer);
        
       


        Mail::send('emails.engBookingNotification', ['booking' => $booking,'bdate' => $booking_date], function ($m) use ($user,$settings,$booking,$engineer) {
           $m->from($settings->email, $settings->name);
           $m->to($engineer->email, $engineer->name)->subject('New Repair Booking#'.$booking->id.' for '.$booking->name);
        });



        //Make a Google Calendar Event
        // Onsite Bookings are created in a 2 hours slots 
        //to achieve that first we have to create a Carbon instance from date and time 
        //Then add 2 hours into it 
        //The date formate comes from online form is in this format 12/01/2020 , we have to convert it 
        //into 2020-01-12 using $myfuncs->usDate 
        //then join the date and time which is 10:30 format from onlie form 
        //then parse it to make a Carbon instant 

        


        //$startDateTime = Carbon::parse($booking_date.' '.$request->booking_time); //This will be a Carbon instant



        $event = new Event;
        $event->name = $booking->name.'|'.$booking->id;
        $event->startDateTime =  Carbon::parse($booking_date.' '.$request->booking_time,'Europe/London');
        $event->endDateTime = Carbon::parse($booking_date.' '.$request->booking_time,'Europe/london')->addHour(2);
        $event = $event->save();

        $booking->event_id = $event->id;
        $booking->save();

        //return list 

         
        return redirect('booking')->with('status','New booking was adedd and an email to engineer was sent successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findorfail($id);

        return view('booking.show',compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $booking = Booking::findorfail($id);
        $users = User::all();

        return view('booking.edit',compact('booking','users'));

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
     
        $this->validate($request,[

            'booking_date' => 'required',
            'booking_time' => 'required',
            'name'  => 'required',
            'phone'   => 'required',
            'email' => 'email',
            'status' => 'required'
        ]);


        $myfuncs = New Myfunctions;
        $booking_date = $myfuncs->usDate($request->booking_date);
        $assigned_to = $request->assigned_to;

        $booking = Booking::findorfail($id);


        $booking->booking_date = $booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->location = $request->location;
        $booking->name = $request->name;
        $booking->address = $request->address;
        $booking->town = $request->town;
        $booking->postcode = $request->postcode;
        $booking->phone = $request->phone;
        $booking->email = $request->email;
        $booking->assigned_to = $request->assigned_to;
        $booking->updated_by = Auth::user()->id;
        $booking->status = $request->status;
        $booking->notes = $request->notes;

        $booking->save();

        if($booking->event_id != Null){

            $event = Event::find($booking->event_id);

            $event->name = $booking->name.'|'.$booking->id.'Update';
            $event->startDateTime =  Carbon::parse($booking_date.' '.$request->booking_time,'Europe/London');
            $event->endDateTime = Carbon::parse($booking_date.' '.$request->booking_time,'Europe/London')->addHour(2);
            $event->location = $booking->address.','.$booking->town.','.$booking->postcode;
            $event = $event->save();

        }
        

        //send email to assigned to person 

        //$user = User::findorFail($assigned_to);
        
        //Mail::send('emails.engPreBookingAlert', ['booking' => $booking], function ($m) use ($user,$booking) {
        //   $m->from($user->email, $user->name);
        //   $m->to($user->email, $user->name)->subject('Amendment of Pre Repair Booking for '.$booking->name);
        //});


        return redirect('booking');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findorfail($id);

        if($booking->event_id != Null){

           $event = Event::find($booking->event_id);
            
           $event->delete();

        }

        $booking->delete();

        return redirect('booking');


    }
}
