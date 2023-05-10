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
                        Orders from {{$order_date_from}} to {{$order_date_to}}
                        <div class="table-responsive">
                            
                            <table class="table">
                                <tr>
                                    <th>Total Before VAT</th>
                                    <th>VAT</th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <td>{{$total_beforevat}}</td>
                                    <td>{{$vat}}</td>
                                    <td>{{$total}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{url('vatreportexport/'.$order_date_from.'/'.$order_date_to)}}" >Download</a>
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
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Total Before VAT</th>
                                    <th>VAT Rate</th>
                                    <th>VAT</th>
                                    <th>TOTAL</th>
                                </tr>
                                @foreach($xyz AS $o)
                                    <tr>
                                        <td> <a href="{{url('order/'.$o->id.'/edit/1')}}"> {{$o->id}} </a>   </td>
                                        <td> {{DateTime::createFromFormat('Y-m-d H:i:s',$o->created_at)->format('d.m.Y') }}</td>

                                        <td>{{$o->first_name}} {{$o->last_name}}</td>
                                        
                                        <td>{{$o->total_beforevat}}</td>
                                        <td> {{$o->vat_rate}}</td>
                                        <td>{{$o->vat}}</td>
                                        <td>{{$o->order_total}}</td>
                                        
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