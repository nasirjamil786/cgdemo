@extends('layouts.app')

@section('title')
    <title>Order Lines</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order Lines 
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order#</th>
                                    <th>Order Date</th>
                                    <th>Customer</th> 
                                    <th>Worked By</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Comm</th>
                                    <th>Profit</th>
                                    <th>Supplier</th>
                                </tr>
                                @foreach($orlines AS $o)
                                    <tr>
                                        <td> <a href="{{url('order/'.$o->order_id.'/edit/1')}}"> {{$o->order_id}} </a>   </td>
                                        <td> {{DateTime::createFromFormat('Y-m-d H:i:s',$o->created_at)->format('d.m.Y') }}</td>

                                        {{-- <td> {{DateTime::createFromFormat('Y-m-d H:i:s',$o->booking_date)->format('d.m.Y') }}</td> --}}

                                        <td> {{$o->first_name}} {{$o->last_name}} </td>
                                        <td> {{$o->user_first_name}}</td> 
                                        <td>{{$o->item_detail}}</td>
                                        <td>{{$o->item_notes}}</td>
                                        <td>{{$o->cost}}</td>
                                        <td>{{$o->value}}</td>
                                        <td>{{$o->commission}}</td>
                                        <td>{{$o->value - $o->cost - $o->commission}}</td>
                                        <td>{{$o->supp_name}} {{$o->supp_ref}}</td>
                                        
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