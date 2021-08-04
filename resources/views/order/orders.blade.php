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

                                           <a href="{{url('customer')}}" class="btn btn-primary">New Order</a>
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

                    <div class="panel-body">

                        <div class="table-responsive">

                            <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Customer</th>
                                    <th>Job Date</th>
                                    <th>Location</th>
                                    <th>Engineer</th>
                                    <th>Total</th>

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
                                            @if($order->order_status == 'Invoiced') 
                                                <span class="label label-danger" > {{$order->order_status}} {{DateTime::createFromFormat('Y-m-d H:i:s',$order->complete_date)->format('d/m/Y')}}</span>
                                              @elseif ($order->order_status == 'Waiting for Parts')
                                                   <span class="label label-info" > {{$order->order_status}} </span>
                                                 @elseif($order->order_status == 'Parts Required')
                                                      <span class="label label-info" > {{$order->order_status}} </span>
                                                    @elseif($order->order_status == 'Payment Receipt Sent')
                                                        <span class="label label-success" > {{$order->order_status}} </span>
                                                        @elseif($order->order_status == 'emailed')
                                                            <span class="label label-primary" > {{$order->order_status}} </span>
                                                            @elseif($order->order_status == 'Booked')
                                                                <span class="label label-primary" > {{$order->order_status}} </span>
                                                                @elseif($order->order_status == 'Courtsey Call Required')
                                                                    <span class="label label-warning" > {{$order->order_status}} </span>
                                                                    @elseif($order->order_status == 'Call To Arrange Collection')
                                                                        <span class="label label-warning" > {{$order->order_status}} </span>
                                                                        @else
                                                                            <span class="label label-default"></span>{{$order->order_status}}
                                            @endif
                                            <br><small>{{$order->email}}</small>
                                          
                                        </td>
                                        
                                        
                                        <td>

                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('l')}} 
                                            <small>
                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$order->booking_date)->format('j M Y')}}

                                            {{DateTime::createFromFormat('H:i:s',$order->booking_time)->format('H:i')}}
                                            </small> 
                                            <br>
                                            <small>{{$order->model}}: {{$order->serial_no}}</small>

                                        </td>
                                        <td>

                                            @if($order->location == "1")
                                               {{$order->address1}} <br> <small>{{$order->town}}, {{$order->postcode}}</small>
                                            @else
                                                {{'In Office'}}
                                            @endif

                                        </td>
                                    
                                        
                                        <td>{{$order->user_first_name}}</td>
                                        <td>£{{$order->order_total}}</td>

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
