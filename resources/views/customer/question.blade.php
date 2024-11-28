@extends('layouts.app')

@section('title')
    <title>Question About Customer</title>
@endsection

@section('content')
     <div class="container">
        <p>Required Home Visit?</p>
         <a href="{{url('customer/create')}}" class="btn btn-primary btn-lg" role="button">Yes</a>
         <a href="{{url('customer/createnoaddress')}}" class="btn btn-primary btn-lg" role="button">No</a>
     </div>
@endsection