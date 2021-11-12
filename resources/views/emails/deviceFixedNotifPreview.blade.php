@extends('emails.deviceFixedNotifLayout')

@section('sendbutton')

   @include('partials.success')

   <div>
       <div>
   	   <a href="{{url('/order/'.$order->id.'/deviceFixedNotifEmail')}}" class="button">Email to Customer</a>
         
   	   <a href="{{url('order/'.$order->id.'/edit/1')}}" class="button">Go Back</a>
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
       <center><img src="{{url('images/logo.png')}}" alt="" height="90" width="220"></center>
   </a>
@endsection
