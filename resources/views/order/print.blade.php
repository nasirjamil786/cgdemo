@extends('order.layout')

@section('logo')
   <a href="https://computergurus.co.uk" target="_blank">
        <img alt="Logo" src="{{url('images/logo.png')}}" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
    </a>
@endsection

@section('signature')
    @if($order->signature != NULL)
    <img alt="sign" src="{{url('/order/'.$order->id.'/getSignature')}}" width="220" height="50" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 12px;" border="0">
    @endif
@endsection


@section('printscript')
  <script type="text/javascript">
  	 function printit() {
  	 	window.print();
  	 }
  </script>

@endsection