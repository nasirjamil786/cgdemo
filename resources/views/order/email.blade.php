@extends('order.layout')

@section('logo')
    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                        
        <a href="https://computergurus.co.uk" target="_blank">
            <img alt="Logo" src="<?php echo $message->embed('images/logo.png');  ?>" width="220" height="90" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0"> 
        </a>
    </td>
  
@endsection
@section('signature')

    @if($order->signature != NULL)
        <img alt="sign" src="<?php echo $message->embedData($order->signature,'sig');  ?>" width="220" height="80" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 12px;" border="0"> 
    @endif


@endsection