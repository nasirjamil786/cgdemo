@extends('layouts.app')

@section('title')
    <title>Create Device Test</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Back</a>  <h4>Enter Test Result </h4>

                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('/devicetest/'.$order->id.'/update')}}">
                            {!! csrf_field() !!}
                            
                            
                            
                        
                            <div class="form-group">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection