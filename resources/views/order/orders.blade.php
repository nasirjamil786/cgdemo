@extends('layouts.app')

@section('title')
    <title>Orders</title>
@endsection

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form class="form-inline" method="GET" action="{{url('/order')}}">
                            {!! csrf_field() !!}
                             <div class="container"> 
                                <div class="form-row">
                                        <div class="form-group col-md-4">
                                           <input class="form-control" name="order_search" size="20"   placeholder="Enter order no or customer name">
                                           <button type="submit" class="btn btn-primary">Find</button>
                                           <a href="{{url('custsearch1/0')}}" class="btn btn-primary">New Order</a>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="checkbox">
                                               <label>
                                                 <input type="checkbox"  name="checked_state" id="checked_state" @if($checked_state == 'on') checked @endif> Show All 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="sort_by">Sort By</label>
                                            <select class="form-control" name="sort_by" required onchange="this.form.submit()">
                                                    <option value="date" @if($sortby == 'date') selected @endif >Work Date   </option>
                                                    <option value="orderno"  @if($sortby == 'orderno') selected @endif >Order No    </option>
                                            </select>
                                        </div>
                                </div> <!-- Row -->
                                <div class="clearfix"></div>
                            </div>  <!-- container -->
                         </form>
                    </div>
                </div>
                <!-- A new Order Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                Order# <br>
                                1098
                                </div>
                                <div class="col-md-6">
                                2 of 3 (wider)
                                </div>
                                <div class="col-md-3">
                                3 of 3
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                                This is body 
                    </div>
                </div>





                <!-- end  of new order panel -->


                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Customer</th>
                                    <th>Job Date</th>
                                    <th>Location</th>
                                    <!-- <th>Engineer</th> -->
                                    <th>Order Total</th>
                                </tr>

                                @foreach($orders AS $order)
                                    <tr>
                                        <td>
                                            <a href="{{url('order/'.$order->id.'/edit/1')}}"> {{$order->id}} </a>
                                        </td>
                                        <td>
                                            <a href="{{url('customer/'.$order->customer_id)}}"> {{$order->first_name}} {{$order->last_name}} </a>
                                            @if($order->discount_percent != 0)
                                                <br> <small style="color: red">{{$order->discount_percent}}% Discount</small>
                                            @endif
                                            <br>

                                            @switch($order->order_status)
                                                @case('Invoiced')
                                                    <span class="label label-danger" > {{$order->order_status}} @if($order->inv_emailed != NULL) {{DateTime::createFromFormat('Y-m-d H:i:s',$order->inv_emailed)->format('d/m/Y')}} @endif</span>
                                                @break
                                                @case('Waiting for Parts')
                                                    <span class="label label-info" > {{$order->order_status}} </span>
                                                @break
                                                @case('Parts Required')
                                                    <span class="label label-info" > {{$order->order_status}} </span>
                                                @break
                                                @case('Payment Receipt Sent')
                                                    <span class="label label-success" > {{$order->order_status}} </span>
                                                @break
                                                @case('emailed')
                                                    <span class="label label-primary" > {{$order->order_status}} </span>
                                                @break
                                                @case('Booked')
                                                    <span class="label label-primary" > {{$order->order_status}} </span>
                                                @break
                                                @case('Courtsey Call Required')
                                                    <span class="label label-warning" > {{$order->order_status}} </span>
                                                @break
                                                @case('Call to Arrange Collection')
                                                    <span class="label label-warning" > {{$order->order_status}} </span>
                                                @break
                                                @default
                                                    <span class="label label-default" > {{$order->order_status}} </span>

                                            @endswitch
                                            <br><small>{{$order->email}}</small>
                                            <br><small> @if($order->phone != NULL) {{$order->phone}} @endif @if($order->mobile != NULL ) /{{$order->mobile}} @endif </small>
                                        </td>
                                        <td>
                                            @if(DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('Y-m-d') == $today) <span style="color:red; "> <b>Today</b></span><br> @endif
                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('l')}} 
                                            <small>
                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('j M Y')}}

                                            {{DateTime::createFromFormat('H:i:s',$order->booking_time)->format('H:i')}}
                                            </small> 
                                            <br>
                                            <small>{{$order->device_type}} {{$order->make}} {{$order->model}} {{$order->serial_no}}</small>
                                            <br>
                                            --------------------------------------------
                                            <br>
                                            <small>{{$order->order_notes}}</small>
                                        </td>
                                        <td>
                                            @if($order->location == "1")
                                               {{$order->address1}} <br> <small>{{$order->town}}, {{$order->postcode}}</small>
                                            @else
                                                {{'In Office'}}
                                            @endif
                                        </td>
                                       <!-- <td>{{$order->user_first_name}}</td>  -->
                                       
                                        <td>  {{-- £{{$order->order_total}}  --}}

                                            @if($order->payment == 0)
                                                @if($order->order_total != NULL && $order->order_total != 0.00)
                                                    <span style="color:red;">
                                                        £{{$order->order_total}}
                                                    </span>
                                                @endif

                                              @elseif(($order->order_total - $order->payment) != 0 )
                                                   £{{$order->order_total}}
                                                  <br><span style="color:red;"> £{{$order->order_total - $order->payment}}</span>
                                               @else

                                                  <span style="color:green;"> £{{$order->order_total}}</span>
                                               
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! $orders->appends(['checked_state' => $checked_state])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
