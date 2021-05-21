@extends('layouts.app')

@section('title')
    <title>Commission Report</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order Lines from {{$order_date_from}} to {{$order_date_to}}
                        <div class="table-responsive">
                            
                        
                            <table class="table">
                                <tr>
                                    <th>Type</th>
                                    <th>Cost</th>
                                    <th>Commission</th>
                                    <th>Charge</th>
                                    <th>Profit</th>
                                </tr>
                                <tr>
                                    <td>Parts</td>
                                    <td>{{$parts_cost}}</td>
                                    <td>{{$parts_commission}}</td>
                                    <td>{{$parts_charge}}</td>
                                    <td>{{$parts_profit}}</td>
                                </tr>
                                <tr>
                                    <td>Services</td>
                                    <td>{{$services_cost}}</td>
                                    <td>{{$services_commission}}</td>
                                    <td>{{$services_charge}}</td>
                                    <td>{{$services_profit}}</td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b>{{$parts_cost + $services_cost}}</b></td>
                                    <td><b>{{$parts_commission + $services_commission}}</b></td>
                                    <td><b>{{$parts_charge + $services_charge}}</b></td>
                                    <td><b>{{$parts_profit + $services_profit}}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{url('orderreportexport/'.$order_date_from.'/'.$order_date_to)}}" >Download</a>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Booking Date</th>
                                    <th>Job Date</th>
                                    <th>Customer</th> 
                                    <th>Worked By</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Comm</th>
                                    <th>Profit</th>
                                </tr>
                                @foreach($xyz AS $o)
                                    <tr>
                                        <td> <a href="{{url('order/'.$o->order_id.'/edit/1')}}"> {{$o->order_id}} </a>   </td>
                                        <td> {{DateTime::createFromFormat('Y-m-d H:i:s',$o->created_at)->format('d.m.Y') }}</td>

                                        <td> {{DateTime::createFromFormat('Y-m-d H:i:s',$o->booking_date)->format('d.m.Y') }}</td>

                                        <td> {{$o->first_name}} {{$o->last_name}} </td>
                                        <td> {{$o->user_first_name}}</td> 
                                        <td>{{$o->item_detail}}</td>
                                        <td>{{$o->item_notes}}</td>
                                        <td>{{$o->cost}}</td>
                                        <td>{{$o->value}}</td>
                                        <td>{{$o->commission}}</td>
                                        <td>{{$o->value - $o->cost - $o->commission}}</td>
                                        
                                    </tr>
                                @endforeach
                                
                            </table>
                        </div>


                    </div>

                    <div class="panel-footer">
                        
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection