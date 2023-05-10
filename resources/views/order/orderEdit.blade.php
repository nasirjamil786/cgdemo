@extends('layouts.app')

@section('title')
    <title>Order Edit</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @php
                    echo Session::has('sess_mess') ? '<div class="alert alert-success">' . Session::get('sess_mess') . '</div>' : '';
                @endphp
            <form role="form" name="updateorder" method="POST" action="{{url('/order/'.$order->id)}}">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($order->signature == NULL {{-- && $order->quote_id == 0 --}} )
                            <div class="signaturealert" role="alert">
                                  <h4>Customer's signature required - please press the button to get signature</h4>
                                  <a href="{{url('signature/'.$order->id)}}" class="btn btn-danger">Get Signature</a>
                           </div>
                        @endif
                        <h4>  
                            <small>Order No</small> {{$order->id}}  <small> for </small>
                           <a href="{{url('customer/'.$order->customer->id)}}">{{$order->customer->first_name}} {{$order->customer->last_name}} </a> <small>@if($order->customer->phone != NULL) {{$order->customer->phone}} @endif @if($order->customer->mobile != NULL ) /{{$order->customer->mobile}} @endif</small>
                           <span class="label label-info">{{$order->order_status}} @if($order->order_status == 'Invoiced' && $order->inv_emailed != NULL) <small> {{DateTime::createFromFormat('Y-m-d H:i:s',$order->inv_emailed)->format('d/m/Y')}} </small>@endif</span>
                           @if($order->fixednotif_emailed != NULL)
                                <small>Collection Notification Sent on {{DateTime::createFromFormat('Y-m-d H:i:s',$order->fixednotif_emailed)->format('d/m/Y')}} </small>
                           @endif
                           @if ($order->quote_id != NULL) 
                                <span> <small> Quote Ref: {{$order->quote_id}} </small> </span> 
                           @endif
                        </h4>
                        @if(!in_array($order->order_status,['Closed','Cancelled']) || Auth::user()->hasRole('Admin'))
                           <button type="submit" class="btn btn-primary"  >Save</button>
                        @endif
                        <a href="{{url('/order/'.$order->id.'/emailpreview')}}" class="btn btn-primary">Print/Email</a>
                        
                        <a href="{{url('/order/'.$order->id.'/deviceFixedNotifPreview')}}" class="btn btn-primary">
                            @if($order->fixednotif_emailed == NULL) 
                                Send Fixed Notification 
                            @else 
                                Remind Fixed Notification
                            @endif 
                        </a>
                        @if($order->order_status == 'Invoiced' && $order->inv_emailed != NULL) 
                            <a href="{{url('invpreview/'.$order->id.'/1')}}" class="btn btn-primary">Send Invoice Reminder</a>
                        @endif

                        <a href="{{url('printlabel/'.$order->id)}}" class="btn btn-primary" target="_self">Print Label</a>

                        <a href="{{ url('order') }}" class="btn btn-primary">Back</a>
                        
                    </div>

                    <div class="panel-body">

                        @include('partials.error')
                        @include('partials.success')

                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#booking">Booking</a></li>
                                <li><a data-toggle="tab" href="#device">Device</a></li>
                                <li><a data-toggle="tab" href="#devicetest">Device Test</a></li>
                                <li><a data-toggle="tab" href="#parts">Parts/Services</a></li>
                                <li><a data-toggle="tab" href="#payment">Payment</a></li>
                            </ul>

                            <div class="tab-content">

                                <!--Booking Tab --> 

                                <div id="booking" class="tab-pane fade in active">

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="order_status">Order Status</label>
                                            <select class="form-control" name="order_status" required>
                                                @include('partials.orderstatuslist')
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="booking_date">Job Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="booking_date" value="{{ $order->booking_date }}" id="booking_date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="booking_time">Job Time</label>
                                            <select class="form-control" name="booking_time" required>
                                                @include('partials.timelist')
                                            </select>
                                        </div>
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" name="add_event" id="add_event" value="1" {{ $order->add_event == 1 ? 'checked' : '' }}>Add to Calendar
                                          </label>
                                        </div>
                                        <div class="form-group">
                                            <label form="location">Job Location</label>
                                            <select class="form-control" name="location" required>
                                                <option value="0" @if($order->location == 0) selected @endif>Drop In</option>
                                                <option value="1" @if($order->location == 1) selected @endif>Home/Office Visit</option>
                                                <option value="2" @if($order->location == 2) selected @endif>Remote Support Call</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="created_at">Booked at</label>
                                            <input type="text" class="form-control" name="created_at" value="{{$order->created_at}}">
                                            
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="booking_date">Booking Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="booking_date" value="{{$order->booking_date}}" id="booking_date" required>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div> -->


                                        <!-- <div class="form-group">
                                            <label for="collection_date">Collection/Onsite Visit Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="collection_date" value="{{ $order->collection_date }}" id="collection_date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="collection_time">Collection/Onsite Visit Time</label>
                                            <select class="form-control" name="collection_time" >
                                                @include('partials.collectiontimelist')
                                            </select>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="worked_by">Engineer</label>
                                            <select class="form-control" name="worked_by" required>
                                                @foreach($engineers as $eng)
                                                   <option value="{{$eng->id}}" @if($order->worked_by == $eng->id) selected @endif>{{$eng->first_name}} </option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_notes">Work Detail(<span style="color: red">This will be printed on Booking Form</span>)</label>
                                            <textarea class="form-control" name="order_notes" rows="10" >{{$order->order_notes}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="recommendations">Notes for Customer(<span style="color: red">This will be printed on Invoice/Receipt</span>)</label>
                                            <textarea class="form-control" name="recommendations" rows="5">{{$order->recommendations}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="private_notes">Private Notes (Not for customer)</label>
                                            <textarea class="form-control" name="private_notes" rows="10" >{{$order->private_notes}}</textarea>
                                        </div>
                                    </div>
                                    @if(!in_array($order->order_status,['Closed','Cancelled']) || Auth::user()->hasRole('Admin'))
                                    <button type="submit" class="btn btn-primary"  >Save</button>
                                    @endif
                                    <a href="{{url('/order/'.$order->id.'/emailpreview')}}" class="btn btn-primary">Print/Email</a>
                                </div>

                                {{-- Device --}}
                                <div id="device" class="tab-pane fade">

                                    <div class="col-md-6">

                                        <label for="device_id">Device Type</label>
                                        <select class="form-control" name="device_id" required>

                                            @foreach($devices as $device)
                                                <option value="{{$device->id}}" @if($order->device_id == $device->id) selected @endif>{{$device->device_type}}</option>
                                                @endforeach

                                        </select>

                                        <div class="form-group">
                                            <label for="make_id">Make</label>
                                            <select class="form-control" name="make_id" required>


                                                @foreach($makes as $make)
                                                    <option value="{{$make->id}}" @if($order->make_id == $make->id) selected @endif>{{$make->make}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" class="form-control" name="model" value="{{$order->model}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="serial_no">Serial No</label>
                                            <input type="text" class="form-control" name="serial_no" value="{{$order->serial_no}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="operating_system">Operating System</label>
                                            <input type="text" class="form-control" name="operating_system" value="{{$order->operating_system}}" >
                                        </div>
                                    </div>
                                     <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="condition">Condition</label>
                                            <input type="text" class="form-control" name="condition" value="{{$order->condition}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="colour">Charger Present</label>
                                            <select class="form-control" name="colour" required >
                                                <option value="" @if($order->colour == NULL) selected @endif ></option>
                                                <option value="No" @if($order->colour == 'No') selected @endif>No</option>
                                                <option value="Yes" @if($order->colour == 'Yes') selected @endif>Yes</option>
                                            </select>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="colour">Colour</label>
                                            <input type="text" class="form-control" name="colour" value="{{$order->colour}}" >
                                        </div> -->
                                        <div class="form-group">
                                            <label for="data_backup">Databackup</label>
                                            <input type="text" class="form-control" name="data_backup" value="{{$order->data_backup}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{$order->username}}" >
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" value="{{$order->password}}" >
                                        </div>

                                     </div>
                                     @if(!in_array($order->order_status,['Closed','Cancelled']) || Auth::user()->hasRole('Admin'))
                                     <button type="submit" class="btn btn-primary"  >Save</button>
                                     @endif
                                     <a href="{{url('/order/'.$order->id.'/emailpreview')}}" class="btn btn-primary">Print/Email</a>

                                </div>

                                <!-- Device test -->


                                <div id="devicetest" class="tab-pane fade">
                                        <hr/>
                                        <!-- startup test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Startup</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_startup" value="NA" @if($order->test_startup == NULL) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_startup" value="Pass" @if($order->test_startup == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_startup" value="Fail" @if($order->test_startup == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_startup_comm" value="{{$order->test_startup_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        

                                        <!-- Sound test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label> Sound</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_sound" value="NA" @if($order->test_sound   == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_sound" value="Pass" @if($order->test_sound == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_sound" value="Fail" @if($order->test_sound == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_sound_comm" value="{{$order->test_sound_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- Headphone test -->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Headphone</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_headphone" value="NA" @if($order->test_headphone  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_headphone" value="Pass" @if($order->test_headphone == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_headphone" value="Fail" @if($order->test_headphone == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_headphone_comm" value="{{$order->test_headphone_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        <!-- microphone test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Microphone</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_microphone" value="NA" @if($order->test_microphone  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_microphone" value="Pass" @if($order->test_microphone == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_microphone" value="Fail" @if($order->test_microphone == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_microphone_comm" value="{{$order->test_microphone_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- earphone test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Earphone</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_earphone" value="NA" @if($order->test_earphone  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_earphone" value="Pass" @if($order->test_earphone == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_earphone" value="Fail" @if($order->test_earphone == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_earphone_comm" value="{{$order->test_earphone_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- camera test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Camera</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_camera" value="NA" @if($order->test_camera  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_camera" value="Pass" @if($order->test_camera == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_camera" value="Fail" @if($order->test_camera == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_camera_comm" value="{{$order->test_camera_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        
                                        <!-- wifi test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Wireless</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_wifi" value="NA" @if($order->test_wifi  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_wifi" value="Pass" @if($order->test_wifi == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_wifi" value="Fail" @if($order->test_wifi == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_wifi_comm" value="{{$order->test_wifi_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- ethernet test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Ethernet Port</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_ethernet" value="NA" @if($order->test_ethernet  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_ethernet" value="Pass" @if($order->test_ethernet == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_ethernet" value="Fail" @if($order->test_ethernet == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_ethernet_comm" value="{{$order->test_ethernet_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- keyboard test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>keyboard</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_keyboard" value="NA" @if($order->test_keyboard  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_keyboard" value="Pass" @if($order->test_keyboard == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_keyboard" value="Fail" @if($order->test_keyboard == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_keyboard_comm" value="{{$order->test_keyboard_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- trackpad test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Trackpad/Mouse</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_trackpad" value="NA" @if($order->test_trackpad  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_trackpad" value="Pass" @if($order->test_trackpad == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_trackpad" value="Fail" @if($order->test_trackpad == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_trackpad_comm" value="{{$order->test_trackpad_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- display test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Display</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_display" value="NA" @if($order->test_display  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_display" value="Pass" @if($order->test_display == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_display" value="Fail" @if($order->test_display == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_display_comm" value="{{$order->test_display_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- homebutton test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Homebutton</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_homebutton" value="NA" @if($order->test_homebutton  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_homebutton" value="Pass" @if($order->test_homebutton == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_homebutton" value="Fail" @if($order->test_homebutton == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_homebutton_comm" value="{{$order->test_homebutton_comm}}" >
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- fan test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Cooling Fan</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_fan" value="NA" @if($order->test_fan  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_fan" value="Pass" @if($order->test_fan == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_fan" value="Fail" @if($order->test_fan == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_fan_comm" value="{{$order->test_fan_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- battery test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Battery</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_battery" value="NA" @if($order->test_battery  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_battery" value="Pass" @if($order->test_battery == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_battery" value="Fail" @if($order->test_battery == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_battery_comm" value="{{$order->test_battery_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- chport test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Charging Port</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_chport" value="NA" @if($order->test_chport  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_chport" value="Pass" @if($order->test_chport == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_chport" value="Fail" @if($order->test_chport == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_chport_comm" value="{{$order->test_chport_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- shutdown test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Shutdown</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_shutdown" value="NA" @if($order->test_shutdown  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_shutdown" value="Pass" @if($order->test_shutdown == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_shutdown" value="Fail" @if($order->test_shutdown == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_shutdown_comm" value="{{$order->test_shutdown_comm}}" >
                                                </label>
                                            </div>
                                        </div>

                                        <!-- others test-->
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label>Others</label> 
                                            </div>
                                            <div class="col-md-3">
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_others" value="NA" @if($order->test_others  == NULL ) checked @endif >N/A
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_others" value="Pass" @if($order->test_others == 'Pass') checked @endif>Pass
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" name="test_others" value="Fail" @if($order->test_others == 'Fail') checked @endif>Fail
                                                </label>
                                            </div>
                                            <div class="col-md-7"> 
                                                <label class="radio-inline">
                                                    Comments <input type="text"  style="width: 400px"  name="test_others_comm" value="{{$order->test_others_comm}}" >
                                                </label>
                                            </div>

                                        </div>
                                             
                                        <p style="color: red;">Important: Please don't forget to press save button before printing</p>
                                        @if(!in_array($order->order_status,['Closed','Cancelled']) || Auth::user()->hasRole('Admin'))
                                        <button type="submit" class="btn btn-primary"  >Save</button>
                                        @endif
                                        <a href="{{url('devicetest/'.$order->id.'/preview')}}" class="btn btn-primary">Print/Email This Test</a>
                                             
                                </div>


                                <!-- Parts -->

                                <div id="parts" class="tab-pane fade">

                                @if(!in_array($order->order_status,['Closed','Cancelled']) || Auth::user()->hasRole('Admin'))   
                                    @if($order->inv_emailed == NULL || Auth::user()->hasRole('Admin'))
                                    <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#myModal"  data-backdrop="static"      >
                                        Add Line
                                    </button>
                                    @endif
                                @endif
                                    <table class="table">

                                        <tr>
                                            <th></th>
                                            <th>Parts/Services</th>
                                            <th>Price</th>
                                            
                                            <th>Type</th>
                                            <th>Supp</th>
                                            {{-- <th>Cost</th> --}}
                                            {{-- <th>Comm</th> --}}

                                        </tr>
                                        @foreach($orlines AS $ol)
                                            <tr>
                                                <td>
                                                    @if($order->inv_emailed == NULL || Auth::user()->hasRole('Admin'))
                                                        <a href="{{url('orline/'.$ol->id.'/delete')}}">Delete|</a>
                                                        <a href="#" data-toggle="modal" data-target="#amendModal" data-id="{{$ol->id}}" data-item_notes="{{$ol->item_notes}}" data-item_detail="{{$ol->item_detail}}" data-value="{{$ol->value}}" data-cost="{{$ol->cost}}" data-commission="{{$ol->commission}}" data-supp_id="{{$ol->supp_id}}" data-supp_ref="{{$ol->supp_ref}}">Edit</a> 
                                                    @else
                                                        <small style="color: red"> INVOICED <br> 
                                                        {{DateTime::createFromFormat('Y-m-d H:i:s',$order->inv_emailed)->format('d/m/Y')}}</small> 
                                                    @endif

                                                </td>
                                                <td>{{$ol->item_detail}}</td>
                                                <td>{{$ol->value}}</td>
                                                
                                                <td>{{$ol->item_notes}}</td>
                                                <td>{{$ol->supp_name}} {{$ol->supp_ref}}</td>
                                                {{-- <td><small>{{$ol->cost}}</small></td> --}}
                                                {{-- <td><small>{{$ol->commission}}</small></td> --}}
                                            </tr>
                                            
                                        @endforeach
                                    </table>

                                    <hr>
                                        <div class="col-md-8">

                                        </div>
                                        <div class="col-md-4">
                                            <table class="table">
                                                <tr>
                                                    <td>Line Total without VAT</td>
                                                    <td>{{$order->line_total}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="discount_percent">Services Discount% </label>
                                                            <select class="form-control" name="discount_percent" id="discount_percent">
                                                                <option value="0" @if($order->discount_percent == "0") selected @endif>0</option>
                                                                <option value="5" @if($order->discount_percent == '5') selected @endif>5</option>
                                                                <option value="10"@if($order->discount_percent == '10') selected @endif>10</option>
                                                                <option value="15"@if($order->discount_percent == '15') selected @endif>15</option>
                                                                <option value="20"@if($order->discount_percent == '20') selected @endif>20</option>
                                                                <option value="25"@if($order->discount_percent == '25') selected @endif>25</option>
                                                                <option value="30"@if($order->discount_percent == '30') selected @endif>30</option>
                                                                <option value="35"@if($order->discount_percent == '35') selected @endif>35</option>
                                                                <option value="40"@if($order->discount_percent == '40') selected @endif>40</option>
                                                                <option value="45"@if($order->discount_percent == '45') selected @endif>45</option>
                                                                <option value="50"@if($order->discount_percent == '50') selected @endif>50</option>
                                                                <option value="50"@if($order->discount_percent == '50') selected @endif>60</option>
                                                                <option value="50"@if($order->discount_percent == '50') selected @endif>70</option>
                                                                <option value="50"@if($order->discount_percent == '50') selected @endif>80</option>
                                                                <option value="50"@if($order->discount_percent == '50') selected @endif>100</option>
                                                            </select>
                                                        </div></td>
                                                    <td>{{$order->discount}}</td>
                                                </tr>
                                                @if($order->vat != 0)
                                                  <tr>
                                                    <td>Total before VAT</td>
                                                    <td>{{$order->total_beforevat}}</td>
                                                   </tr>
                                                   <tr>
                                                     <td>VAT @ {{$order->vat_rate}}%</td>
                                                     <td>{{$order->vat}}</td>
                                                   </tr>
                                                  @endif
                                                <tr>
                                                    <td><h4>Order Total</h4></td>
                                                    <td><h4>{{$order->order_total}}</h4></td>
                                                </tr>
                                                <tr> 
                                                    <td>
                                                       @if($order->complete_date <> NULL)
                                                         <a href="{{url('invprint/'.$order->id.'/0')}}" class="btn btn-primary"
                                                          @if($order->order_total == 0) disabled @endif>Print Invoice</a>
                                                       @endif

                                                       @if($order->complete_date == NULL)
                                                         <a href="{{url('/order/'.$order->id.'/1/confirmCompleteDate')}}" class="btn btn-primary"
                                                         @if($order->order_total == 0) disabled @endif>Print Invoice</a>
                                                       @endif
                                                    </td>
                                                    <td>
                                                       @if($order->complete_date <> NULL)
                                                         <a href="{{url('invpreview/'.$order->id.'/0')}}" class="btn btn-primary"
                                                          @if($order->order_total == 0) disabled @endif>Email Invoice</a>
                                                       @endif

                                                       @if($order->complete_date == NULL)
                                                         <a href="{{url('/order/'.$order->id.'/2/confirmCompleteDate')}}" class="btn btn-primary"
                                                         @if($order->order_total == 0) disabled @endif>Email Invoice</a>
                                                       @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                </div>

                                <!-- Payments -->

                    
                                <div id="payment" class="tab-pane fade">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 style="color: red">Balance Due £{{$order->order_total - $order->payment}}</h4>

                                            <!--
                                             @if($order->payment != 0)  
                                                <a href="{{url('recpreview/'.$order->id)}}" class="btn btn-primary">Email/Print Receipt</a>
                                             @endif
                                             -->

                                            <!--This button will open a Modal dialogue with form to enter payments -->
                                            <!--Model is defined below the page -->
                                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal" data-backdrop="static">
                                                        New Payment
                                             </button>


                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Method</th>
                                                        <th>Ref</th>
                                                        <th>Detail</th>
                                                        <th>Action</th>
                                                         
                                                    </tr>
                                                    @foreach($payments AS $pay)
                                                        <tr>
                                                            <td>{{$pay->amount}}</td>
                                                            <td>{{$pay->payment_date}}</td>
                                                            <td>{{$pay->payment_method}}</td>
                                                            <td>{{$pay->payment_ref}}</td>
                                                            <td>{{$pay->detail}}</td>
                                                            <td>
                                                                @if(Auth::user()->hasRole('Admin'))
                                                                <a href="{{url('payment/'.$pay->id.'/delete')}}">Delete</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    @if($order->payment != 0)  
                                        <a href="{{url('recpreview/'.$order->id)}}" class="btn btn-primary">Email/Print Receipt</a>
                                    @endif

                                </div>
                            </div> {{-- Tab Content --}}

                    </div>  <!--end of panel body-->
                    <div class="panel-footer">
                    </div>
                </div> <!--end of panel -->

            </form>

                 {{-- Modal To add lines  --}}

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Order Line</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form   role="form" name="addline" method="POST" action="{{url('orline/'.$order->id)}}">

                                            {!! csrf_field() !!}

                                            <div class="form-group">
                                                <label for="item_notes">Item type</label>
                                                <select class="form-control" name="item_notes" id="item_notes" required>
                                                    <option value=""></option>
                                                    <option value="labour">Labour</option>
                                                    <option value="parts">Parts</option>
                                                    <option value="advance">Advance</option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="item_detail" class="control-label">Item Detail</label>
                                                <input type="text" class="form-control" name="item_detail"   id="item_detail" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="value" class="control-label">Price</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="value" id="value" placeholder="£0.00" required>
                                            </div>

                                            


                                            <div class="form-group">
                                                <label for="cost" class="control-label">Cost</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="cost" id="cost" placeholder="£0.00" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cost" class="control-label">Cost VAT</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="cost_vat" id="cost_vat" placeholder="£0.00" required>
                                            </div>

                                            
                                             <div class="form-group">
                                                <label for="commission" class="control-label">Commission</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="commission" id="commission" placeholder="£0.00" required>
                                            </div>
                                            
                                            <div class="form-group">
                                               <label for="supp_id">Supplier</label>
                                               <select class="form-control" name="supp_id">
                                                    <option value="0">Select....</option>
                                                    @foreach($suppliers as $supp)
                                                        <option value="{{$supp->id}}">{{$supp->name}}
                                                        </option>
                                                    @endforeach
                                               </select>
                                        
                                            </div>
                                            <div class="form-group">
                                                <label for="supp_ref" class="control-label">Supplier Reference</label>
                                                <input type="text" class="form-control" name="supp_ref"   id="supp_ref">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>

                                        </form>

                                    </div>

                                    {{--
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                        <button type="button" class="btn btn-primary" @if($order->order_status == 'Paid') disabled @endif>Save changes</button>

                                    </div>
                                    --}}
                                </div>
                            </div>
                        </div>

                        {{-- End of Order line Modal--}}
                        {{-- start of line change modal --}}
                                       <!-- Modal -->
                                        <div class="modal fade" id="amendModal" tabindex="-1" role="dialog" aria-labelledby="amendModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Amend Order Line</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form   role="form" name="amendline" id="formamendline" method="POST" action="">

                                                            {!! csrf_field() !!}

                                                            <div class="form-group">
                                                                <label for="item_notes">Item type</label>
                                                                <select class="form-control" name="item_notes" id="item_notes" required>
                                                                    <option value=""></option>
                                                                    <option value="labour" >Labour</option>
                                                                    <option value="parts" >Parts</option>
                                                                    <option value="advance">Advance</option>
                                                                </select>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="item_detail" class="control-label">Item Detail</label>
                                                                <input type="text" class="form-control" name="item_detail"  id="item_detail"  value="" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="value" class="control-label">Price</label>
                                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="value" id="value"  value="" placeholder="£0.00" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cost" class="control-label">Cost</label>
                                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="cost" id="cost" value=""placeholder="£0.00" required>
                                                            </div>

                                                            
                                                             <div class="form-group">
                                                                <label for="commission" class="control-label">Commission</label>
                                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="commission" id="commission" value="" placeholder="£0.00" required>
                                                            </div>
                                                            

                                                            <div class="form-group">
                                                                <label for="supp_id">Supplier</label>
                                                                <select class="form-control" name="supp_id" id="supp_id">
                                                                    <option value="0">Select....</option>
                                                                    @foreach($suppliers as $supp)
                                                                        <option  value="{{$supp->id}}"> {{$supp->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="supp_ref" class="control-label">Supplier Reference</label>
                                                                <input type="text" class="form-control" name="supp_ref"  id="supp_ref">
                                                                </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </form>

                                                    </div>

                                                    {{--
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                        <button type="button" class="btn btn-primary" @if($order->order_status == 'Paid') disabled @endif>Save changes</button>

                                                    </div>
                                                    --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end of line change modal --}}

                        

                        <!-- Payment Modal code start here -->
                        <!-- Modal -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <!-- Payment form will go here  make whole modal as a form -->
                                <form   role="form" name="addpayment" method="POST" action="{{url('payment/'.$order->id)}}">

                                            {!! csrf_field() !!}

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Enter Payment Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                            <!-- Payment Amount -->
                                            <div class="form-group">
                                                <label for="amount">Balance Due on Order £{{$order->order_total - $order->payment}}</label>
                                                <input type="number" step="0.01"    class="form-control" name="amount" value="{{}}" required>
                                            </div>

                                            <!-- Payment Date -->
                                            <div class="form-group">
                                                <label for="payment_date">Payment Date </label>
                                                <div class="input-group date">
                                                   <input type="text" class="form-control" name="payment_date" value="" id="payment_date" required="">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <!-- Payment Method -->
                                            <div class="form-group">
                                                <label for="payment_method">Method</label>
                                                <select class="form-control" name="payment_method" id="payment_method" required>
                                                    <option value=""></option>
                                                    <option value="Cash" >Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Bank Transfer" >Bank Transfer</option>
                                                    <option value="Card Payment">Card Payment</option>
                                                    <option value="Paypal">Paypal</option>
                                                </select>
                                            </div>
                                            <!-- Payment Reference -->
                                            <div class="form-group">
                                                <label for="payment_ref">Payment Reference(card last 4 digits/cheque no/bank name etc)</label>
                                                <input type="text" class="form-control" name="payment_ref" value="" placeholder="Cheque detail">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                </form>

                            </div>
                          </div>
                        </div>

                        <!-- End of Payment model -->
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = ({!! $from !!} == 1) ? '#booking':localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>

    <script type="text/javascript">
        $('#amendModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var item_notes = button.data('item_notes')
            var item_detail = button.data('item_detail')
            var value = button.data('value')
            var cost = button.data('cost')
            var commission = button.data('commission')
            var supp_ref = button.data('supp_ref')
            var supp_id = button.data('supp_id')


                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
                //modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body #formamendline').attr('action','/orline/' + id + '/update')
                modal.find('.modal-body #item_detail').val(item_detail)
                modal.find('.modal-body #item_notes').val(item_notes)
                modal.find('.modal-body #value').val(value)
                modal.find('.modal-body #cost').val(cost)
                modal.find('.modal-body #commission').val(commission)
                modal.find('.modal-body #supp_ref').val(supp_ref)
                modal.find('.modal-body #supp_id').val(supp_id)
        })
    </script>


@endsection
