@extends('layouts.app')

@section('title')
    <title>New Order</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>
                        <h4><small>New Order for</small> {{$cust->first_name}} {{$cust->last_name}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('order/'.$cust->id.'/store')}}" onsubmit="return submitForm();">
                            {!! csrf_field() !!}
                             <!-- Left panel -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="booking_date">Booking Date </label> 
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="booking_date" value="{{ $today}}" id="booking_date" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="booking_time">Booking Time</label>
                                    <select class="form-control" name="booking_time" required>
                                        <option value=""></option>
                                        <option value="08:00" >08:00</option>
                                        <option value="08:30" >08:30</option>
                                        <option value="09:00" >09:00</option>
                                        <option value="09:30" >09:30</option>
                                        <option value="10:00" >10:00</option>
                                        <option value="10:30" >10:30</option>
                                        <option value="11:00" >11:00</option>
                                        <option value="11:30" >11:30</option>
                                        <option value="12:00" >12:00</option>
                                        <option value="12:30" >12:30</option>
                                        <option value="13:00" >13:00</option>
                                        <option value="13:30" >13:30</option>
                                        <option value="14:00" >14:00</option>
                                        <option value="14:30" >14:30</option>
                                        <option value="15:00" >15:00</option>
                                        <option value="15:30" >15:30</option>
                                        <option value="16:00" >16:00</option>
                                        <option value="16:30" >16:30</option>
                                        <option value="17:00" >17:00</option>
                                        <option value="17:30" >17:30</option>
                                        <option value="18:00" >18:00</option>
                                        <option value="18:30" >18:30</option>
                                        <option value="19:00" >19:00</option>
                                        <option value="19:30" >19:30</option>
                                        <option value="20:00" >20:00</option>
                                        <option value="20:30" >20:30</option>
                                        <option value="21:00" >21:00</option>
                                        <option value="21:30" >21:30</option>
                                        <option value="22:00" >22:00</option>
                                   </select>
                                </div>
                                <div class="checkbox">
                                   <label>
                                      <input type="checkbox" name="add_event" id="add_event" value="1">Add to Calendar
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="location">Work Location</label>
                                    <select class="form-control" name="location" required onchange="terms(this.value)">
                                        <option value=""></option>
                                        <option value="0">Drop In </option>
                                        <option value="1" >Home/Office Visit</option>
                                        <option value="2" >Remote Support Call</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="device_id">Device Type</label>
                                    <select class="form-control" name="device_id" required>

                                        <option value="0"></option>
                                        @foreach($devices as $device)
                                            <option value="{{$device->id}}">{{$device->device_type}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="make_id">Make</label>
                                    <select class="form-control" name="make_id" required>

                                        <option value="0"></option>
                                        @foreach($makes as $make)
                                            <option value="{{$make->id}}">{{$make->make}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" name="model" value="{{ old('model') }}" required>
                                </div>

                           </div>
                            <!-- right panel -->
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="serial_no">Serial No</label>
                                    <input type="text" class="form-control" name="serial_no" value="{{ old('serial_no') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" value="{{ old('password') }}"required >
                                </div>
                                <div class="form-group">
                                    <label for="data_backup">Data Backup Required?</label>
                                    <select class="form-control" name="data_backup" required>
                                        <option value=""></option>
                                        <option value="Not Required">Not Required</option>
                                        <option value="Required">Required</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="colour">Charger Present</label>
                                    <select class="form-control" name="colour" required >
                                        <option value=""></option>
                                        <option value="No">No</option>
                                        <option value="Yes" >Yes</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="order_notes">Problem Detail</label>
                                    <!-- <textarea class="form-control" name-="order_notes" rows="8"  required>{{ old('order_notes') }}</textarea> -->
                                    <input type="text" class="form-control" name="order_notes" value="{{ old('order_notes') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="worked_by">Assign Engineer</label>

                                        <select class="form-control" name="worked_by" required>
                                          <option value=""></option>
                                           @foreach($engineers AS $eng)
                                             <option value="{{$eng->id}}" @if($eng->id == $loginid) SELECTED @endif >{{$eng->first_name}} {{$eng->last_name}}</option>
                                           @endforeach   
                                        </select>

                                </div>

                            </div>

                            <!-- Terms & Conditions -->

                            
                            <div class="clearfix"></div>

                            <hr class="my-4">

                            <div id="terms">


                                @include('partials.terms')

                            </div>

                            <!-- Signature Pad -->

                            @include('partials.signatureBox')

                            <!-- Accept button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                            <div class="checkbox">
                               <label>
                                 <input type="checkbox" name="ignore_signature" id="ignore_signature">Take Signature Later On
                                </label>
                            </div>

                        </form>
                        <div>
                           <button id="clear">Clear Signature</button>
                        </div> 
                    </div>
                    <div class="panel-footer">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    @include('partials.signatureScript')

@endsection
