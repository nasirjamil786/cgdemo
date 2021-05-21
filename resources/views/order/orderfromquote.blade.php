@extends('layouts.app')

@section('title')
    <title>New Order From Quote</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>
                        <h4><small>New Order for</small> {{$quote->customer->first_name}} {{$quote->customer->last_name}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('order/'.$quote->id.'/createfromquote')}}">
                            {!! csrf_field() !!}
                             <!-- Lafet panel -->
                            <!-- <div class="col-md-6"> -->
                                <div class="for-row">
                                    <div class="form-group col-md-4">
                                        <label for="quoteno">Quote#</label>
                                        <input type="text" class="form-control" name="quoteno" value="{{ $quote->id }}" required readonly>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="booking_date">Booking Date </label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="booking_date" value="{{ old('booking_date') }}" id="booking_date" required>
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="booking_time">Booking Time</label>
                                        <select class="form-control" name="booking_time" required>
                                            <option value=""></option>
                                            <option value="08:00" @if(old('booking_time') == '08:00') selected @endif >08:00</option>
                                            <option value="08:30" @if(old('booking_time') == '08:30') selected @endif   >08:30</option>
                                            <option value="09:00" @if(old('booking_time') == '09:00') selected @endif   >09:00</option>
                                            <option value="09:30" @if(old('booking_time') == '09:30') selected @endif   >09:30</option>
                                            <option value="10:00" @if(old('booking_time') == '10:00') selected @endif   >10:00</option>
                                            <option value="10:30" @if(old('booking_time') == '10:30') selected @endif   >10:30</option>
                                            <option value="11:00" @if(old('booking_time') == '11:00') selected @endif   >11:00</option>
                                            <option value="11:30" @if(old('booking_time') == '11:30') selected @endif   >11:30</option>
                                            <option value="12:00" @if(old('booking_time') == '12:00') selected @endif   >12:00</option>
                                            <option value="12:30" @if(old('booking_time') == '12:30') selected @endif   >12:30</option>
                                            <option value="13:00" @if(old('booking_time') == '13:00') selected @endif   >13:00</option>
                                            <option value="13:30" @if(old('booking_time') == '13:30') selected @endif   >13:30</option>
                                            <option value="14:00" @if(old('booking_time') == '14:00') selected @endif  >14:00</option>
                                            <option value="14:30" @if(old('booking_time') == '14:30') selected @endif  >14:30</option>
                                            <option value="15:00" @if(old('booking_time') == '15:00') selected @endif   >15:00</option>
                                            <option value="15:30" @if(old('booking_time') == '15:30') selected @endif  >15:30</option>
                                            <option value="16:00" @if(old('booking_time') == '16:00') selected @endif   >16:00</option>
                                            <option value="16:30" @if(old('booking_time') == '16:30') selected @endif   >16:30</option>
                                            <option value="17:00" @if(old('booking_time') == '17:00') selected @endif   >17:00</option>
                                            <option value="17:30" @if(old('booking_time') == '17:30') selected @endif   >17:30</option>
                                            <option value="18:00" @if(old('booking_time') == '18:00') selected @endif   >18:00</option>
                                            <option value="18:30" @if(old('booking_time') == '18:30') selected @endif   >18:30</option>
                                            <option value="19:00" @if(old('booking_time') == '19:00') selected @endif   >19:00</option>
                                            <option value="19:30" @if(old('booking_time') == '19:30') selected @endif   >19:30</option>
                                            <option value="20:00" @if(old('booking_time') == '20:00') selected @endif  >20:00</option>
                                            
                                       </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label form="location">Work Location</label>
                                    <select class="form-control" name="location" required>
                                        <option value=""></option>
                                        <option value="0" >Drop In </option>
                                        <option value="1" @if(old('location') == 1) selected @endif>Home/Office Visit</option>
                                        <option value="2" @if(old('location') == 2) selected @endif>Remote Support Call</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="device_id">Device Type</label>
                                    <select class="form-control" name="device_id" required>

                                        <option value="0"></option>
                                        @foreach($devices as $device)
                                            <option value="{{$device->id}}"  @if(old('device_id') == $device->id) selected @endif             >{{$device->device_type}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="model">Make/Model and Serial No</label>
                                    <input type="text" class="form-control" name="model" value="{{ old('model') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" value="{{ old('password') }}" required >
                                </div>

                                <div class="form-group">
                                    <label for="data_backup">Data Backup Required?</label>
                                    <select class="form-control" name="data_backup" required>
                                        <option value=""></option>
                                        <option value="Not Required"  @if(old('data_backup') == 'Not Required') selected @endif>Not Required</option>
                                        <option value="Required" @if(old('data_backup') == 'Required') selected @endif>Required</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="order_notes">Problem Detail</label>
                                     <textarea class="form-control" name="order_notes" rows="8"  id="order_notes" >{{$quote->work_detail }}</textarea>
                                    <!-- <input type="text" class="form-control" name="order_notes" value="{{$quote->work_detail}}" required> -->
                                </div>
                                
                                <div class="form-group">
                                    <label for="worked_by">Assign Engineer</label>

                                    
                                        <select class="form-control" name="worked_by" required>
                                        <option value=""></option>
                                        @foreach($engineers AS $eng)
                                            <option value="{{$eng->id}}" @if(old('worked_by') == $eng->id) selected @endif>{{$eng->first_name}} {{$eng->last_name}}</option>
                                         @endforeach   
                                        </select>

                                </div>

                            <!-- </div>  -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                    <div class="panel-footer">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
