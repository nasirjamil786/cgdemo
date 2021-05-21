@extends('layouts.app')

@section('title')
    <title>Show|Delete Booking</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Booking Detail</div>

                <div class="panel-body">
                    <form method="post" action="{{url('booking/'.$booking->id)}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <ul>
                            <li><h4><small>ID</small> {{$booking->id}}</h4></li>
                            <li><h4><small>Booking Date</small> {{$booking->booking_date}}</h4></li>
                            <li><h4><small>Booking Time</small> {{$booking->booking_time}}</h4></li>
                            <li><h4><small>Location</small> {{$booking->location}}</h4></li>
                            <li><h4><small>Name</small> {{$booking->name}}</h4></li>
                            <li><h4><small>Phone</small> {{$booking->phone}}</h4></li>
                            <li><h4><small>Address</small> {{$booking->address}}</h4></li>
                            <li><h4><small>Town</small> {{$booking->town}}</h4></li>
                            <li><h4><small>Postcode</small> {{$booking->postcode}}</h4></li>
                            <li><h4><small>Email</small> {{$booking->email}}</h4></li>
                            <li><h4><small>Notes</small> {{$booking->notes}}</h4></li>
                            <li><h4><small>Status</small> {{$booking->status}}</h4></li>
                            <li><h4><small>Assigned Engineer</small> {{$booking->engineer->name}}</h4></li>
                            <li><h4><small>Booked By</small> {{$booking->bookedby->name}}</h4></li>
                          
                      
                         
                        </ul>

                        <button type="submit" class="btn btn-primary">Delete</button>
                        <a href="{{ URL::previous()}}" class="btn btn-primary">Cancel</a>
                        




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
