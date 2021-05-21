@extends('layouts.app')

@section('title')
    <title>Customer|Reports</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Customer Reports</div>

                <div class="panel-body">
                     
                     <a href="{{url('exportcustnewsletteronly')}}">Download Customers Who Signed up for Newsletter</a>
                     <br>
                     <a href="{{url('exportcustomers')}}">Download All Customers</a>
                     <br>
                     <a href="{{url('exportconstituents')}}">Download Customers in Southborough and St John's Wards</a>

                     

                </div>
            </div>
        </div>
    </div>
</div>
@endsection