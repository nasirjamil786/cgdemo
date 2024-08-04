@extends('layouts.app')

@section('title')
    <title>Quotes</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    <form class="form-inline" method="get" action="{{url('/quote')}}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <input class="form-control" name="keyword" size="40"   placeholder="Enter quote no or customer name">
                        <button type="submit" class="btn btn-primary">Find</button>
                        <a href="{{url('custsearch1/0')}}" class="btn btn-primary">New Quote</a>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"  name="status" id="status" > Show All 
                          </label>
                        </div>
                    </div>
                        
                    </form>


                    </div>

                    <div class="panel-body">

                        <div class="table-responsive">

                            <table class="table">
                                <tr>
                                    <th>Quote#</th>
                                    <th>Customer</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                                @foreach($quotes AS $quote)
                                    
                                    <tr>
                                        <td><a href="{{url('quote/'.$quote->id.'/editdetail')}}"> {{$quote->id}} </a></td>
                                        <td>

                                            <a href="{{url('customer/'.$quote->customer_id)}}"> {{$quote->first_name}} {{$quote->last_name}}</a>
                                            <br> <small style="color: red">{{$settings->currency_symbol}}{{$quote->quote_total}}</small>

                                        </td>

                                        <td>{{$quote->quote_title}} </td>
                                        
                                         
                                        <td>
                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$quote->quote_date)->format('l')}} <br>
                                            <small>
                                            {{DateTime::createFromFormat('Y-m-d H:i:s',$quote->quote_date)->format('j M Y')}}
                                            </small> 
                                        </td>
                                        
                                        <td> 
                                            @switch($quote->quote_status)
                                                @case('current')
                                                    <span style="color: red">{{$quote->quote_status}}</span>
                                                @break
                                                @case('emailed')
                                                    <span style="color: blue">{{$quote->quote_status}}</span>
                                                    <small>
                                                      {{DateTime::createFromFormat('Y-m-d H:i:s',$quote->email_sent)->format('j M Y')}}
                                                    </small>
                                                @break
                                                @case('ordered')
                                                    <span style="color: green">{{$quote->quote_status}}</span>
                                                    <small>{{$quote->order_id}}</small>
                                                @break
                                                @default
                                                    <span style="color: grey">{{$quote->quote_status}}</span>
                                                

                                            @endswitch

                                        </td>
                                        
                                        <td> 
                                            {{-- @if($quote->quote_status == 'current') --}}
                                            {{-- <a href="{{url('quote/'.$quote->id.'/deleteconfirm')}}">Delete</a>  --}}

                                              <a href="{{url('quote/'.$quote->id.'/delete')}}">Delete</a>
                                              @if($quote->email_sent != NULL)
                                                <a href="{{url('quote/'.$quote->id.'/1/emailpreview')}}">|Reminder</a>
                                              @endif

                                            {{-- @endif --}}
                                        </td>
                                    
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
