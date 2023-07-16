@extends('layouts.app')

@section('title')
    <title>Customer Detail</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a href="{{ URL::previous() }}" class="btn btn-primary">Back to List</a>
                        @if($customer->status == 'Active')
                            <a href="{{url('order/'.$customer->id.'/neworder')}}" class="btn btn-primary">New Order</a>
                            <a href="{{url('quote/'.$customer->id.'/2/create')}}" class="btn btn-primary">New Quote</a>
                        @endif
                        @if($customer->status == 'Active' || Auth::user()->hasRole('Admin'))
                          <a href="{{url('customer/'.$customer->id.'/edit')}}" class="btn btn-primary">Edit </a>
                        @endif
                    </div>

                    <div class="panel-body">

                        @include('partials.error')
                        @include('partials.success')
                        
                        <div class="col-md-6">

                            <ul class="list-unstyled">
                                <li>{{$customer->cust_title}} {{$customer->first_name}} {{$customer->last_name}}</li>
                                <li>{{$customer->company}}</li>
                                <li>{{$customer->address1}}</li>
                                <li>{{$customer->address2}}</li>
                                <li>

                                    @if($customer->area != null)
                                        {{$customer->area}}
                                    @endif
                                    {{$customer->town}}

                                </li>
                                <li>
                                    @if($customer->county != Null)
                                        {{$customer->county}}
                                    @endif
                                </li>

                                <li>{{$customer->postcode}}</li>
                                <li> {{$customer->email}}</li>
                                <li>@if($customer->ccemail != NULL)
                                        {{$customer->ccemail}}
                                    @endif
                                </li>
                                <li>{{$customer->phone}}</li>
                                <li>{{$customer->mobile}}</li>
                                <li>{{$customer->notes}}</li>
                            </ul>







                        </div>

                        <div class="col-md-6">
                            <h5>Id <small>{{$customer->id}}</small></h5>
                            <h5>Recommended By <small>{{$customer->recommended_by}}</small></h5>
                            <h5>Recommended Name <small>{{$customer->recommended_name}}</small></h5>
                            <h5>Cust Type <small>{{$customer->cust_type}}</small></h5>
                            <h5>Outstanding Balance <small>{{$customer->outstand_balance}}</small></h5>
                            <h5>Account Total <small>{{$customer->account_total}}</small></h5>
                            <h5>Discount<small>{{$customer->discount}}</small></h5>
                            <h5>Status <small>{{$customer->status}}</small></h5>
                            <h5>Newsletter <small>{{$customer->newsletter}}</small></h5>
                            <h5>Notes <small>{{$customer->notes}}</small></h5>
                            <h5>old_ref <small>{{$customer->old_ref}}</small></h5>
                            <h5>User_id <small>{{$customer->user_id}}</small></h5>
                            <h5>craeted_at <small>{{$customer->created_at}}</small></h5>
                            <h5>updated_at <small>{{$customer->updated_at}}</small></h5>
                            <h5>Updated_by <small>{{$customer->updated_by}}</small></h5>
                            <h5>Reviewed <small>{{$customer->reviewed}}</small></h5>
                            {{$customer->country}} <br>
                        </div>

                        <!--<a href="{{url('customer/'.$customer->id.'/deleteconfirm')}}">Delete</a> -->




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
