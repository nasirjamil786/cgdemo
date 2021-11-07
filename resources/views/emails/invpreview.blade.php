@extends('emails.invlayout')

@section('sendbutton')

@include('partials.success')

<div>
    <div>
	   <a href="{{url('invemail/'.$order->id)}}" class="button">Email to Customers</a>
      <a href="{{url('invpdf/'.$order->id)}}" class="button">Download</a>
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
    <img alt="Logo" src="{{url('images/logo.png')}}" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
</a>

@endsection
