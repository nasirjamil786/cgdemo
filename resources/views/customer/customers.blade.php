@extends('layouts.app')

@section('title')
    <title>Customers</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <form class="form-inline" method="GET" action="{{url('customer')}}">
                            {!! csrf_field() !!}
                            
                            <div class="form-group">
                                <input type="search" class="form-control" name="keyword" size="40">
                            </div>
                            <button type="submit"   class="btn btn-primary">Search</button> or
                            <a href="{{url('customer/create')}}" class="btn btn-primary">New Customer</a>
                        </form>
                    </div>
                    <div class="panel-body">
                        @include('partials.success')
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Quote</th> 
                                    <th>Address</th>
                                    <th>Postcode</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Cust No</th>
                                    <th>News</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($customers AS $cust)
                                    <tr>
                                        <td>
                                            <a href="{{url('customer/'.$cust->id)}}"> {{$cust->first_name}} {{$cust->last_name}} </a> <br>
                                            @if($cust->discount != 0)
                                             <small style="color: red">{{$cust->discount}}% Discount</small>
                                            @endif
                                            
                                        </td>
                                        <td>
                                           <a href="{{url('order/'.$cust->id.'/neworder')}}" class="btn-sm btn-primary">Order</a>
                                       </td>
                                       <td>
                                           <a href="{{url('quote/'.$cust->id.'/create')}}" class="btn-sm btn-primary">Quote</a>
                                       </td>
                                        <td>{{$cust->address1}}</td>
                                        <td>{{$cust->postcode}}</td>
                                        <td>{{$cust->phone}}</td>
                                        <td>{{$cust->email}}</td>
                                        <td>{{$cust->id}}</td>
                                        <td>{{$cust->newsletter}}</td>
                                        <td><a href="{{url('customer/'.$cust->id.'/edit')}}" class="btn-sm btn-primary">Edit </a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>


                    </div>

                    <div class="panel-footer">
                        {!! $customers->links() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection