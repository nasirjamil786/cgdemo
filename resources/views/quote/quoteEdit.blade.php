@extends('layouts.app')

@section('title')
    <title>Edit Quote Headings</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{url('quote/'.$quote->id.'/editdetail')}}" class="btn btn-primary pull-right">Back</a>
                        <h4><small>Edit Quote {{$quote->id}} </small> For<a href="{{url('customer/'.$cust->id)}}">                       {{$cust->first_name}} {{$cust->last_name}} </a> 

                         </h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('quote/'.$quote->id.'/update')}}">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="valid_date">Valid Until Date </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="valid_date" value="{{ $quote->valid_date}}" id="valid_date" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quote_title">Quote Title</label>
                                    <input type="text" class="form-control" name="quote_title" value="{{ $quote->quote_title }}" required>
                                </div>

                                <div class="form-group">
                                    <label >Work Detail</label>
                                    <textarea class="form-control" name="work_detail" id="work_detail">{{$quote->work_detail}}</textarea> 
                                   
                                </div>

                                <div class="form-group">
                                    <label for="quote_status">Quote Status</label>
                                    <select class="form-control" name="quote_status" id="quote_status" required>
                                        <option value="current" @if($quote->quote_status == 'current') selected @endif >current </option>
                                        <option value="emailed" @if($quote->quote_status == 'emailed') selected @endif >emailed  </option>
                                        <option value="ordered" @if($quote->quote_status == 'ordered') selected @endif >ordered  </option>
                                        <option value="rejected" @if($quote->quote_status == 'rejected') selected @endif >rejected  </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Reject Reason</label>
                                    <input type="text" class="form-control"  name="notes" value="{{$quote->notes}}">
                                </div>
                                
                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>  <!-- end of form -->
                    </div>
                    <div class="panel-footer">

                    </div>
                    
                </div>  <!-- end of panel -->


            </div>
        </div>
    </div>
@endsection
