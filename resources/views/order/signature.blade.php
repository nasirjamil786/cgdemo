@extends('order.layout')

@section('logo')
   <a href="https://computergurus.co.uk" target="_blank">
        <img alt="Logo" src="{{url('images/logo.png')}}" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
    </a>
@endsection

<!--
@section('signaturestyle')
     <style type="text/css">
        .wrapper {
          position: relative;
          width: 400px;
          height: 200px;
          -moz-user-select: none;
          -webkit-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        .signature-pad {
          position: relative;
          left: 0;
          top: 0;
          width:400px;
          height:200px;
          border: 2px solid black;
        }
    </style> 
@endsection
-->

@section('signature')
	
    <form method="POST" action="{{url('signature/'.$order->id)}}" onsubmit="return submitForm();">
        {!! csrf_field() !!}

        <!-- Signature Pad -->

	     @include('partials.signatureBox')

      <br>

	    <!-- Accept button -->
	    <div class="form-group">
	        <button type="submit" class="button btn btn-primary">Save</button>
	    </div>
    </form>

    <div>
       <button id="clear">Clear Signature</button>
    </div> 

@endsection

@section('script')
  @include('partials.signatureScript')
@endsection


