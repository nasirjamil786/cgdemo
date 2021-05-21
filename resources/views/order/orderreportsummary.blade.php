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
                        <b>Order Report Summary <a href="{{url('orderreportexport/'.$booking_date_from.'/'.$booking_date_to)}}" >Download Full Report</a></b>
                    </div>

                    <div class="panel-body">

                       <ul>
                            <li><h4><small>Total Income</small> {{$total_income}}</h4></li>
                            <li><h4><small>Total Parts</small> {{$total_parts}}</h4></li>
                            <li><h4><small>Total Cost</small> {{$total_cost}}</h4></li>
                            <li><h4><small>Total Labour</small> {{$total_labour}}</h4></li>
                            <li><h4><small>Total Commission</small> {{$total_commission}}</h4></li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Date</th>
                                    <th>Customer</th> 
                                    <th>Work</th>
                                    <th>Worked By</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Commission</th>
                                </tr>
                                @foreach($orders AS $ord)
                                    <tr>
                                        <td> {{$ord->order_id}}</td>
                                        <td> {{$ord->booking_date}}</td>
                                        <td>  </td>
                                        <td></td>
                                        <td></td> 
                                        <td>{{$ord->item_detail}}</td>
                                        <td>{{$ord->item_notes}}</td>
                                        <td>{{$ord->cost}}</td>
                                        <td>{{$ord->value}}</td>
                                        <td>{{$ord->commission}}</td>
                                        
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
