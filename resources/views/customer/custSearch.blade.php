@extends('layouts.app')

@section('title')
    <title>Customer Search</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @include('partials.error')
                        <form class="form" method="POST" action="{{url('custsearchresult')}}">
                            {!! csrf_field() !!}

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$first_name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$last_name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Post code</label>
                                    <input type="text" class="form-control" name="postcode" value="{{$postcode}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">Address1</label>
                                    <input type="text" class="form-control" name="address1" value="{{$address1}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Town</label>
                                    <input type="text" class="form-control" name="town" value="{{$town}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$phone}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$email}}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Cust#</label>
                                    <input type="text" class="form-control" name="custno" value="{{$custno}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{url('customer/question')}}" class="btn btn-primary">New Customer</a>
                            
                        </form>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Quote</th> 
                                    <th>Address</th>
                                    <th>Postcode</th>
                                    <th>Town</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Cust No</th>
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
                                            @if($cust->status == 'Inactive')
                                               <small style="color: red">INACTIVE <br> {{$cust->notes}}</small>
                                            @else
                                               <a href="{{url('order/'.$cust->id.'/neworder')}}" class="btn-sm btn-primary">Order</a>
                                            @endif
                                       </td>
                                       <td>
                                            @if($cust->status == 'Active')
                                             <a href="{{url('quote/'.$cust->id.'/1/create')}}" class="btn-sm btn-primary">Quote</a>
                                            @endif
                                       </td>
                                        <td>{{$cust->address1}}</td>
                                        <td>{{$cust->postcode}}</td>
                                        <td>{{$cust->town}}</td>
                                        <td>{{$cust->phone}}</td>
                                        <td>{{$cust->email}}</td>
                                        <td>{{$cust->company}}</td>
                                        <td>{{$cust->id}}</td>
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