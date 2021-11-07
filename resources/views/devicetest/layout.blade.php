<!DOCTYPE html>
<html>
<head>
<title>Computer Gurus Device Test Report</title>
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
        .wrapper {
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
</head>
<body style="margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    Computer Gurus Device Test..
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
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                        
                        @yield('sendbutton')
                       
                        @yield('logo')
                    </td>
                </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 15px;" class="padding-copy">

                                    Device Test Report
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
        <td bgcolor="#ffffff" align="center" style="padding: 15px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
                                <td align="left" style="padding: 20px 0 0 0; font-size: 12px; line-height: 20px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                 
                                <b>Device: </b> {{$order->make->make}}:{{$order->model}} <br>
                                <b>Serial No: </b>{{$order->serial_no}} <br>
                                <b>Customer: </b> {{$order->customer->first_name}} {{$order->customer->last_name}}<br>
                                <b>Test Date: </b> {{$order->test_date}} <br>
                                <b>Order No: </b> {{$order->id}} <br>
                                <b>Tested By: </b> {{$order->tested_by}} <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 15px;" class="padding">
            <table border="1" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="responsive-table">
                
                @include('devicetest.resultrow',['test' => 'Startup','result' => $order->test_startup,'comments' => $order->test_startup_comm])
                @include('devicetest.resultrow',['test' => 'Sound','result' => $order->test_sound,'comments' => $order->test_sound_comm])
                @include('devicetest.resultrow',['test' => 'Headphone','result' => $order->test_headphone,'comments' => $order->test_headphone_comm])
                @include('devicetest.resultrow',['test' => 'Microphone','result' => $order->test_microphone,'comments' => $order->test_microphone_comm])
                @include('devicetest.resultrow',['test' => 'Earphone','result' => $order->test_earphone,'comments' => $order->test_earphone_comm])
                @include('devicetest.resultrow',['test' => 'Camera','result' => $order->test_camera,'comments' => $order->test_camera_comm])
                @include('devicetest.resultrow',['test' => 'Wireless','result' => $order->test_wifi,'comments' => $order->test_wifi_comm])
                @include('devicetest.resultrow',['test' => 'Ethernet Port','result' => $order->test_ethernet,'comments' => $order->test_ethernet_comm])
                @include('devicetest.resultrow',['test' => 'Keyboard','result' => $order->test_keyboard,'comments' => $order->test_keyboard_comm])
                @include('devicetest.resultrow',['test' => 'Trackpad/Mouse','result' => $order->test_trackpad,'comments' => $order->test_trackpad_comm])
                @include('devicetest.resultrow',['test' => 'Display/Touch Screen','result' => $order->test_display,'comments' => $order->test_display_comm])
                @include('devicetest.resultrow',['test' => 'Homebutton','result' => $order->test_homebutton,'comments' => $order->test_homebutton_comm])
                @include('devicetest.resultrow',['test' => 'Cooling Fan/Temprature','result' => $order->test_fan,'comments' => $order->test_fan_comm])
                @include('devicetest.resultrow',['test' => 'Battery','result' => $order->test_battery,'comments' => $order->test_battery_comm])
                @include('devicetest.resultrow',['test' => 'Charging Port','result' => $order->test_chport,'comments' => $order->test_chport_comm])
                @include('devicetest.resultrow',['test' => 'Shutdown','result' => $order->test_shutdown,'comments' => $order->test_shutdown_comm])
                @include('devicetest.resultrow',['test' => 'Others','result' => $order->test_others,'comments' => $order->test_others_comm])
                
            </table>
        </td>
    </tr>
    
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 20px 0px; ">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 600px;" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 11px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666; border-top: 1px dashed #aaaaaa;">
                        {{$settings->company_name}}, {{$settings->address1}}, 
                        @if($settings->address2 != NULL) {{$settings->address2}}, @endif 
                        {{$settings->town}}, {{$settings->postcode}} 
                        <br>
                        Phone : {{$settings->phone}} @if($settings->web != NULL)| <a href="http://{{$settings->web}}">{{$settings->web}}</a> @endif
                        
                         @if($settings->reg_no != NULL) | Reg No: {{$settings->reg_no}} @endif  @if($settings->vat_no != " ") | VAT No: {{$settings->vat_no}} @endif 
                        <br>
                        
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
</table>

</body>
</html>
