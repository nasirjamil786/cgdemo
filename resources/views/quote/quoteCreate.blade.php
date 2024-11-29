@extends('layouts.app')

@section('title')
    <title>New Quote</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{ url('quote/'.$cust->id.'/'.$from.'/back')}}" class="btn btn-primary pull-right">Back</a>
                        <h4><small>New Quote for </small> {{$cust->first_name}} {{$cust->last_name}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('quote/'.$cust->id.'/store')}}">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="valid_date">Valid Until Date </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="valid_date" value="{{ old('valid_date') }}" id="valid_date" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quote_title">Quote Title</label>
                                    <input type="text" class="form-control" name="quote_title" value="{{ old('quote_title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label >Work Detail</label>
                                    <textarea class="form-control" name="work_detail" rows=8 id="work_detail">{{ old('work_detail') }}</textarea> 
                                   
                                </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Next</button>
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
