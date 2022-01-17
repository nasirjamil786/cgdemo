@extends('order.layout')
@section('buttons')

    <div class="alert " role="alert">
         <h2> {!! session('status') !!}</h2>
    </div>

    <!-- send email buttons -->
    <div>
        <div>
           <a href="{{url('order/'.$order->id.'/print')}}" class="button">Print</a>
           <a href="{{url('order/'.$order->id.'/email')}}" class="button">Email to Customers</a>

           <a href="{{url('order/'.$order->id.'/edit/0')}}" class="button">Go Back</a>
        </div>
         <div class="divclear"></div>
        <div style="float: left;">To:{{$order->customer->email}}
             @if($order->customer->ccemail != null) 
                CC: {{$order->customer->ccemail}}
             @endif
        </div>
        <div class="divclear"></div>
        <hr>
    </div>
@endsection

@section('logo')
   <a href="https://computergurus.co.uk" target="_blank">
        <img alt="Logo" src="{{url('images/logo.png')}}" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
    </a>
@endsection

@section('signature')


    {{-- @if($order->signature != NULL) --}}
    {{--  <img alt="sign" src="{{url('/signatures/'.$order->id.'.png')}}" width="220" height="40" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 12px;" border="0"> --}}
    {{-- @endif --}}

    @if($order->signature != NULL)

        Customers Signature <br>

        <img alt="sign" src="{{url('/order/'.$order->id.'/getSignature')}}" width="220" height="40" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 12px;" border="0">
    @endif

@endsection