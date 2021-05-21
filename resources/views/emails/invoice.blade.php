@extends('emails.invlayout')

@section('sendbutton')
  <div></div>
@endsection

@section('logo')

<a href="https://computergurus.co.uk" target="_blank">
   <img alt="Logo" src="<?php echo $message->embed('images/logo.png');  ?>" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
</a>

@endsection