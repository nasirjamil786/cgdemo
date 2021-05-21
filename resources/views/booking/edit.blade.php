@extends('layouts.app')

@section('title')
    <title>Edit Booking</title>
@endsection

@section('content')

<form method="post" action="{{url('booking/'.$booking->id)}}">

<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Booking</div>
                <div class="panel-body">
                @include('partials.error')
                    <div class="col-md-6">
                
                        <div class="form-group">
                             
                            <div class="input-group date">
                                <input type="text" class="form-control" name="booking_date" value="{{ $booking->booking_date }}" id="booking_date" placeholder="Booking Date">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                             
                            <select class="form-control" name="booking_time" >
                                <option value="">Booking Time</option>
                                <option value="08:00" @if($booking->booking_time == '08:00') selected @endif>08:00</option>
                                <option value="08:30" @if($booking->booking_time == '08:30') selected @endif>08:30</option>
                                <option value="09:00" @if($booking->booking_time == '09:00') selected @endif>09:00</option>
                                <option value="09:30" @if($booking->booking_time == '09:30') selected @endif>09:30</option>
                                <option value="10:00" @if($booking->booking_time == '10:00') selected @endif>10:00</option>
                                <option value="10:30" @if($booking->booking_time == '10:30') selected @endif>10:30</option>
                                <option value="11:00" @if($booking->booking_time == '11:00') selected @endif>11:00</option>
                                <option value="11:30" @if($booking->booking_time == '11:30') selected @endif>11:30</option>
                                <option value="12:00" @if($booking->booking_time == '12:00') selected @endif>12:00</option>
                                <option value="12:30" @if($booking->booking_time == '12:30') selected @endif>12:30</option>
                                <option value="13:00" @if($booking->booking_time == '13:00') selected @endif>13:00</option>
                                <option value="13:30" @if($booking->booking_time == '13:30') selected @endif>13:30</option>
                                <option value="14:00" @if($booking->booking_time == '14:00') selected @endif>14:00</option>
                                <option value="14:30" @if($booking->booking_time == '14:30') selected @endif>14:30</option>
                                <option value="15:00" @if($booking->booking_time == '15:00') selected @endif>15:00</option>
                                <option value="15:30" @if($booking->booking_time == '15:30') selected @endif>15:30</option>
                                <option value="16:00" @if($booking->booking_time == '16:00') selected @endif>16:00</option>
                                <option value="16:30" @if($booking->booking_time == '16:30') selected @endif>16:30</option>
                                <option value="17:00" @if($booking->booking_time == '17:00') selected @endif>17:00</option>
                                <option value="17:30" @if($booking->booking_time == '17:30') selected @endif>17:30</option>
                                <option value="18:00" @if($booking->booking_time == '18:00') selected @endif>18:00</option>
                                <option value="18:30" @if($booking->booking_time == '18:30') selected @endif>18:30</option>
                                <option value="19:00" @if($booking->booking_time == '19:00') selected @endif>19:00</option>
                                <option value="19:30" @if($booking->booking_time == '19:30') selected @endif>19:30</option>
                                <option value="20:00" @if($booking->booking_time == '20:00') selected @endif>20:00</option>
                                <option value="20:30" @if($booking->booking_time == '20:30') selected @endif>20:30</option>
                                <option value="21:00" @if($booking->booking_time == '21:00') selected @endif>21:00</option>
                                <option value="21:30" @if($booking->booking_time == '21:30') selected @endif>21:30</option>
                                <option value="22:00" @if($booking->booking_time == '22:00') selected @endif>22:00</option>
                           </select>
                        </div>

                        <div class="form-group">
                             
                            <select class="form-control" name="location" >
                                <option value="">Location/Actions</option>
                                <option vlaue="In Office" @if($booking->location == "In Office") selected @endif>In Office</option>
                                <option value="On Site" @if($booking->location == "On Site") selected @endif>On Site</option>
                                <option value="Call Customer" @if($booking->location == "Call Customer") selected @endif>Call Customer</option>
                                <option value="Customer Will Call" @if($booking->location == "Customer Will Call") selected @endif>Customer Will Call</option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                             
                            <input type="text" class="form-control" value="{{$booking->name}}"  name="name" placeholder="Customer Name">
                        </div>
                        <div class="form-group">
                             
                            <input type="text" class="form-control" value="{{$booking->phone}}" name="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                             
                            <input type="text" class="form-control" value="{{$booking->notes}}" name="notes" placeholder="Job Detail">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                             
                            <input type="text" class="form-control" value="{{$booking->address}}" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                             
                            <input type="text" class="form-control" value="{{$booking->town}}" name="town" placeholder="Town">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control" value="{{$booking->postcode}}" name="postcode" placeholder="Postcode">
                        </div>
                        <div class="form-group">
                            
                            <input type="email" class="form-control" value="{{$booking->email}}" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                          
                            <select class="form-control" name="assigned_to" >
                                 
                                @foreach($users as $u)
                                    <option value="{{$u->id}}" @if($booking->assigned_to == $u->id ) selected @endif >{{$u->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <select class="form-control" name="status" >
                                <option value="">Status</option>
                                <option value="Booked" @if($booking->status == 'Booked') selected @endif>Booked</option>
                                <option value="Complete" @if($booking->status == 'Complete') selected @endif>Complete</option>
                                <option value="Followup" @if($booking->status == 'Followup') selected @endif>Followup</option>
                                <option value="Cancelled" @if($booking->status == 'Cancelled') selected @endif>Cancelled</option>
                                <option value="No Response" @if($booking->status == 'No Response') selected @endif>No Response</option>
                                <option value="Not Turnup" @if($booking->status == 'Did Not Turnup') selected @endif>Not Turnup</option>
                                <option value="Rescheduled" @if($booking->status == 'Rescheduled') selected @endif>Rescheduled</option>
                                <option value="Call to Confirm" @if($booking->status == 'Call to Confirm') selected @endif>Call to Confirm</option>
                                <option value="Waiting for Confirmation" @if($booking->status == 'Waiting for Confirmation') selected @endif>Waiting for Confirmation</option>
                            </select>
                        </div>

                    </div>
                        
                </div>
                <div class="panel-footer">

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ URL::previous()}}" class="btn btn-primary">Cancel</a>
                            
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

</form>

@endsection