@extends('quote.layout')

@section('buttons')

    <div class="alert alert-success" role="alert">
         <h2> {!! session('status') !!}</h2>
    </div>

    <!-- send email buttons -->
    <div>
        <div>
           <a href="{{url('quote/'.$quote->id.'/email')}}" class="button">Email to Customers</a>
           <a href="{{url('quote/'.$quote->id.'/editdetail')}}" class="button">Go Back</a>
        </div>
         <div class="divclear"></div>
        <div style="float: left;">To:{{$quote->customer->email}}
             @if($quote->customer->ccemail != null) 
                CC: {{$quote->customer->ccemail}}
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

@section('qlines')
@foreach($qlines As $ql)

                <tr>
                    <td>
                        <!-- THREE COLUMNS -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td valign="top" style="padding: 0; border-bottom: 1px dashed #eaeaea " class="mobile-wrapper" >
                                    <!-- IMAGE COLUMN -->
                                    @if($ql->item_image != null)
                                    <table cellpadding="0" cellspacing="0" border="0" width="33%" style="width: 17%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">
                                                            
                                                              <img alt="item_image" src="{{url('qline/'.$ql->id.'/getimage/')}}"  width="250" style="display: block;">
                                                            
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif

                                    <!-- DESCRIPTION COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 77%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">

                                                            {{$ql->item_detail}}
                                                            <ul>
                                                              @if($ql->spec1 != null)
                                                                <li>{{$ql->spec1}}</li>
                                                              @endif
                                                              @if($ql->spec2 != null)
                                                                <li>{{$ql->spec2}}</li>
                                                              @endif
                                                              @if($ql->spec3 != null)
                                                                <li>{{$ql->spec3}}</li>
                                                              @endif
                                                              @if($ql->spec4 != null)
                                                                <li>{{$ql->spec4}}</li>
                                                              @endif
                                                              @if($ql->spec5 != null)
                                                                <li>{{$ql->spec5}}</li>
                                                              @endif

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- PRICE COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 17%;" align="right">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">£{{$ql->value}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endforeach    
@endsection