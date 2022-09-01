<!DOCTYPE html>
<html>
<head>
<title>Computer Gurus's Booking Confirmation</title>
<!--

    An email present from your friends at Litmus (@litmusapp)

    Email is surprisingly hard. While this has been thoroughly tested, your mileage may vary.
    It's highly recommended that you test using a service like Litmus (http://litmus.com) and your own devices.

    Enjoy!
 -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<style type="text/css">
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        float: left;
        border: 1px solid green; 
    }
    .divclear {
        clear : left;
    }

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        .wrapper2 {
          width: 100% !important;
            max-width: 100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo img {
          margin: 0 auto !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }

        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }

        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }

        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        .padding-copy {
             padding: 10px 5% 10px 5% !important;
          text-align: left;
        }

        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }

        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }

    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }

</style>


<!-- Signature box styling -->
    @include('partials.signatureStyle')
<!-- Signature box styling end -->



</head>
<body  onload="printit()" style="margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    Computer Gurus Booking Confirmation...
</div>

<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>

        <td bgcolor="#ffffff" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper2">
                <tr>
                    <!-- Logo -->
                    <td align="center" valign="top" style="padding: 10px 0 ;" class="logo">
                        
                        <!--  Buttons Section in case of preview -->
                        @yield('buttons')

                        <!-- logo -->
                        

                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                            <tr>

                                <td>
                                    @yield('logo')
                                </td>

                                <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;padding-top: 10px">
                                    <!-- {{$settings->company_name}}, --> {{$settings->address1}}, 
                                    @if($settings->address2 != NULL) {{$settings->address2}}, @endif 
                                    {{$settings->town}}, {{$settings->postcode}} 
                                    <br>
                                        T: {{$settings->phone}} 
                                        @if($settings->web != NULL)| <a href="http://{{$settings->web}}">{{$settings->web}}</a> @endif
                                        <!-- @if($settings->reg_no != NULL) | Reg No: {{$settings->reg_no}} @endif  --> 
                                        @if($settings->vat_no != " ") | VAT No: {{$settings->vat_no}} @endif 
                                    <br>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

             
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 4px;" class="padding-copy">BOOKING CONFIRMATION
                    </td>
                </tr>
                <tr>
                    <td align="center" style="font-size: 20px;font-family: Helvetica, Arial, sans-serif; color: red; padding-top: 1px;" class="padding-copy">
                        @if($order->location == 0) Drop In @endif
                        @if($order->location == 1) Home/Office Visit @endif
                        @if($order->location == 2) Remote Support @endif
                    </td>
                </tr>
                
            </table>
            

            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
                                <td align="left" style="padding: 10px 0 0 0; font-size: 14px; line-height: 20px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                 
                                <b>For:</b>  <br>

                                @if($order->customer->company != NULL) {{$order->customer->company}} <br> @endif
                                {{$order->customer->first_name}} {{$order->customer->last_name}}<br>
                                @if($order->location == 1)
                                    {{$order->customer->address1}}<br> 
                                    @if($order->customer->address2 != NULL) {{$order->customer->address2}} <br>@endif
                                 @endif
                                {{$order->customer->town}} 

                                @if($order->location == 1)
                                    , {{$order->customer->postcode}}
                                @endif

                                

                                </td>
                                <td align="right" style="padding: 10px 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy" >
                                 
                                <b>Booking# </b> {{$order->id}} <br>
                                <b>Booking Date</b> {{$order->booking_date}} <br>
                                <b>Booking Time</b> {{$order->booking_time}} <br>
                                
                                 @if($order->location == 1)
                                   <br>
                                   {{$order->customer->phone}} 
                                   @if($order->customer->mobile != NULL) / {{$order->customer->mobile}}@endif
                                 @endif
                                 

                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
                                <td align="left" style="padding: 10px 0 0 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666; border-top: 1px dashed #aaaaaa" class="padding-copy">
                                 
                                <b>Device Detail:</b> 
                                 <!-- Device Type -->
                                 @if($order->device->device_type != 'Other') Type: <b> {{$order->device->device_type}}</b> @endif
                                 <!-- Make -->
                                 @if($order->make->make != 'Other') Make: <b>{{$order->make->make}} </b> @endif
                                 <!-- Model -->
                                 @if($order->model != NULL) Model: <b> {{$order->model}} </b> @endif
                                 <!-- Serial Number or Service Tag -->
                                 @if($order->serial_no != NULL) Serial No: <b> {{$order->serial_no}} </b> @endif
                                 <!-- Operating System -->
                                 @if($order->operating_system != NULL) OS : <b> {{$order->operating_system}} </b> @endif
                                 <!-- Data backup required or not -->
                                 @if($order->data_backup != NULL) Backup: <b>{{$order->data_backup}}</b> @endif 
                                 <!-- Colour -->
                                 @if($order->colour != NULL) Charger Present: <b> {{$order->colour}} </b>  @endif
                                 <!-- Condition -->
                                 @if($order->condition != NULL) Condition: <b> {{$order->condition}}</b>@endif

                                </td>
                                
                            </tr>

                            <tr>
                                <td align="left" style="padding: 10px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666; border-top: 1px dashed #aaaaaa;border-bottom: 1px dashed #aaaaaa" class="padding-copy">
                                 
                                <b>Work Detail:</b> 
                                {{$order->order_notes}}
                                  

                                </td>
                                
                            </tr>


                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>

    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 5px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="left" style="padding: 0 0 5px 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #333333; font-style: italic;border-bottom: 1px dashed #aaaaaa;" class="padding-copy">

                                                
                                                @if($order->location == 2)
                                                    @include('partials.termsRemote')
                                                @else
                                                    @include('partials.terms')
                                                @endif
                                            </td>
                                             
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 5px 0 5px 0; font-size: 14px; line-height: 10px; font-family: Helvetica, Arial, sans-serif; color: #7ca230; font-style: italic;border-bottom: 1px dashed #aaaaaa;" class="padding-copy">
                                                <!-- customer signature box-->
                                                
                                                @yield('signature')

                                            </td>
                                             
                                        </tr>

                                         
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    

    {{-- 

    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 20px 0px;">
            <!--[if (gte mso 9)|(IE)]>  -->
            <!-- <table align="center" border="0" cellspacing="0" cellpadding="0" width="500"> -->
            <!-- <tr>  -->
            <!-- <td align="center" valign="top" width="500"> -->
            <!-- <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                        {{$settings->company_name}}, {{$settings->address1}}, 
                        @if($settings->address2 != NULL) {{$settings->address2}}, @endif 
                        {{$settings->town}}, {{$settings->postcode}} 
                        <br>
                        Phone : {{$settings->phone}} @if($settings->web != NULL)| <a href="http://{{$settings->web}}">{{$settings->web}}</a> @endif
                        
                         @if($settings->reg_no != NULL) | Reg No: {{$settings->reg_no}} @endif  @if($settings->vat_no != " ") | VAT No: {{$settings->vat_no}} @endif 
                        <br>
                        
                        <!--
                        <a href="http://litmus.com" target="_blank" style="color: #666666; text-decoration: none;">Unsubscribe</a>
                        <span style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href="http://litmus.com" target="_blank" style="color: #666666; text-decoration: none;">View this email in your browser</a>
                        -->
                    </td>
                    <!-- <tr> <td> @yield('printbutton')</td></tr>  -->
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>

     --}}
</table>

<script type="text/javascript">
    function terms(val){
        let termsElement = document.getElementById("terms");
        if(val == 2){
            let h4 = document.createElement("h4");
            h4.textContent  = "Remote Support Terms & Conditions";
            termsElement.appendChild(h4);
        }
    }
</script>

@yield('script')
    
@yield('printscript')

</body>


</html>
