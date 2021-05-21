@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Message</div>

                    <div class="panel-body">


                            @if(Session::has('status'))
                                <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
                            @endif


                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-primary" href="{{ URL::previous()}}" role="button">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection