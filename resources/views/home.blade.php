@extends('layouts.app')

@section('title')
    <title>GAPP|Home</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h4><a href="{{url('booking')}}">Appointments</a></h4>
                </div>

                <div class="panel-body">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Engineer</th>
                        </tr>
                        @foreach($bookings as $b)
                       <tr>
                           <td><a href="{{url('booking/'.$b->id)}}">{{$b->name}}</a> </td>
                           <td>{{DateTime::createFromFormat('j/m/Y',$b->booking_date)->format('D j M Y')}}</td>
                           <td>{{$b->booking_time}}</td>
                           <td>{{$b->location}}</td>
                           <td>{{$b->phone}}</td>

                           <td>

                           @if($b->status == 'Booked' || $b->status == 'Rescheduled' || $b->status == 'Complete'
                           || $b->status == 'Followup' || $b->status == 'Call to Confirm')

                                @if($b->status == 'Booked') <span class="label label-danger" >{{$b->status}}</span>@endif
                                @if($b->status == 'Call to Confirm') <span class="label label-danger" >{{$b->status}}</span>@endif
                                @if($b->status == "Rescheduled") <span class="label label-warning">{{$b->status}}</span>@endif
                                @if($b->status == "Complete") <span class="label label-success">{{$b->status}}</span>@endif
                                @if($b->status == "Followup") <span class="label label-info">{{$b->status}}</span>@endif

                           @else
                               <span class="label label-default">{{$b->status}}</span>

                           @endif

                           </td>
                           <td>{{$b->engineer->name}}</td>
                            
                           <td><a href="{{url('booking/'.$b->id.'/edit')}}">Change</a>|<a href="{{url('booking/'.$b->id)}}">Delete</a></td>
                       </tr>

                    @endforeach
                    </table>

                </div>
                 
                </div>
            </div> <!-- end of panel-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> <a href="{{url('order')}}">Orders</a> </h4>
                </div>

                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Customer</th>
                                    <th>Booking Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Engineer</th>
                                </tr>

                                @foreach($orders AS $order)
                                    <tr>
                                        <td><a href="{{url('order/'.$order->id.'/edit')}}"> {{$order->id}} </a></td>
                                        <td><a href="{{url('customer/'.$order->customer_id)}}"> {{$order->first_name}} {{$order->last_name}} </a></td>

                                        <td>


                                        {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('l')}} <br>
                                        <small>
                                        {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('j M Y')}}

                                        {{DateTime::createFromFormat('H:i:s',$order->booking_time)->format('H:i')}}
                                        </small>

                                        </td>
                                        <td>

                                            @if($order->location == "1")
                                               {{$order->address1}} <br> <small>{{$order->town}}, {{$order->postcode}}</small>
                                            @else
                                                {{'In Office'}}
                                            @endif

                                        </td>
                                        <td>
                                           @if($order->order_status == 'Invoiced')
                                              <span class="label label-danger" > {{$order->order_status}} </span>
                                              @else {{$order->order_status}}

                                            @endif
                                              <br>
                                            @if(($order->order_status == 'Collection Scheduled' || $order->order_status == 'Visit Scheduled') && $order->collection_date != NULL)
                                            
                                            <small>
                                              {{DateTime::createFromFormat('Y-m-d H:i:s',$order->collection_date)->format('l')}}
                                        
                                              {{DateTime::createFromFormat('Y-m-d H:i:s',$order->collection_date)->format('j M Y')}}

                                               {{DateTime::createFromFormat('H:i:s',$order->collection_time)->format('H:i')}}
                                            </small>
                                             @endif

                                        </td>
                                        <td>{{$order->name}}</td>

                                    </tr>
                                @endforeach


                            </table>
                </div>
                 
                </div>
            </div> <!-- end of panel-->
        </div>
    </div>
</div>
@endsection
