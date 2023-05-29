<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')


    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/datepicker/css/bootstrap-datepicker3.css')}}">

    <!-- Signature box styling -->
        @include('partials.signatureStyle')
    <!-- Signature box styling end -->
     

    {{--  <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse  navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    GAPP
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>

                    <!--
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" area-expanded="false" >Customers <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('customer/create')}}">New Customer</a></li>
                            <li><a href="{{url('customer')}}">Find Customer</a></li>
                        </ul>
                    </li>
                    -->
                    <li><a href="{{url('custsearch1/0')}}">Customers</a></li>
                    <li><a href="{{url('suppliers')}}">Suppliers</a></li>
                    <li><a href="{{ url('booking') }}">Bookings</a></li>
                    <li><a href="{{ url('order') }}">Orders</a></li>
                    <li><a href="{{ url('quote') }}">Quotes</a></li>

                    <li><a href="{{ url('invoices') }}">Invoice</a></li>
                    <li><a href="{{ url('orlinesSearch') }}">Order Enquiry</a></li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        {{--  <li><a href="{{ url('/register') }}">Register</a></li> --}}
                    @else
                        {{-- only Admin can do that --}}
                        @can('update-settings') <!-- update-settings is a permission name if it exist -->
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" area-expanded="false" >Reports <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/custreports')}}">Customers</a></li>
                                    <!-- <li><a href="{{url('/ordreport')}}">Orders</a></li> -->
                                    <li><a href="{{url('/commissionreport')}}">Financial Report</a></li>
                                    <li><a href="{{url('/vatreport')}}">VAT Report</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" area-expanded="false" >Settings <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/settings')}}">Settings</a></li>
                                    <li><a href="{{url('/user')}}">Users</a></li>
                                    <li><a href="{{url('/roles')}}">Roles</a></li>
                                    <li><a href="{{url('/permissions')}}">Permissions</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('customer')}}">Customers</a></li>
                        @endcan
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->first_name}} {{Auth::user()->last_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>


                                    <form role="form" name="signoutform" method="POST" action="{{ url('/logout') }}" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                             <!-- <a type="submit"><i class="fa fa-btn fa-sign-out"></i>Logout</a> -->
                                             <button type="submit" >Logout</button>
                                    
                                    </form>


                                    <!-- <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a> -->

                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->

    {{-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> --}}
     
     {{--  <script src="{{ elixir('js/app.js') }}"></script>  --}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="{{url('/js/bootstrap.min.js')}}"></script> 
    <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>

    <script>
        $(function(){
            $('.input-group.date').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                todayHighlight: true
            });
        });

        function pleaseWait(){
            document.getElementById('wait').style.display = '';
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            window.setTimeout(function() {
                $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove(); 
                });
            }, 5000);
 
        });
    </script>

    @yield('script')


</body>
</html>
