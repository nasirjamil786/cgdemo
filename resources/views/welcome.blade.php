@extends('layouts.appnomenue')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><img src="{{ url('/images/logo.png') }}" alt="logo" height="" width="200" ></div>

                <div class="panel-body">
                    <h3>Computer Gurus Management Application (GAPP CRM)</h3>
                    <a href="{{ url('/login') }}" class="btn btn-primary">Login </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
