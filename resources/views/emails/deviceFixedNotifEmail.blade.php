@extends('emails.deviceFixedNotifLayout')

@section('logo')
  <a href="https://computergurus.co.uk" target="_blank">
       <center><img src="<?php echo $message->embed('images/logo.png');  ?>" alt="" width="220" height="90"></center>
   </a>
@endsection