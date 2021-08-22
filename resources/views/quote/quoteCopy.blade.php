@extends('layouts.app')

@section('title')
    <title>Copy Quote</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Back</a>  
                        <h4>Creating Copy of Quote# {{$quote->id}} <small>for customer {{$quote->customer->first_name}} {{$quote->customer->last_name}}</small></h4>
                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('quote/'.$quote->id.'/savecopy')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <h4>If this quote is for a different customer please select below</h4>
                                <label class="col-md-2 control-label"  >Select Customer</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="custid" id="custid">
                                        <option value="{{$quote->customer_id}}">{{$quote->customer->first_name}} {{$quote->customer->last_name}}</option>
                                        @foreach($customers AS $c)
                                           <option value="{{$c->id}}">{{$c->first_name}} {{$c->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                                <div class="col-md-4">
                                    
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection