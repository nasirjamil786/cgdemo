@extends('layouts.app')

@section('title')
    <title>New Booking</title>
@endsection

@section('content')


<form method="POST" action="{{url('booking')}}">
    {!! csrf_field() !!}

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">New Booking Over the Phone</div>

                <div class="panel-body">
                    @include('partials.error')
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <div class="input-group date">
                                <input type="text" class="form-control" name="booking_date"  id="booking_date" placeholder="Booking Date">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <select class="form-control" name="booking_time">
                                <option value="">Booking Time</option>
                                <option value="08:00"  >08:00</option>
                                <option value="08:30"    >08:30</option>
                                <option value="09:00"    >09:00</option>
                                <option value="09:30"    >09:30</option>
                                <option value="10:00"    >10:00</option>
                                <option value="10:30"    >10:30</option>
                                <option value="11:00"    >11:00</option>
                                <option value="11:30"    >11:30</option>
                                <option value="12:00"    >12:00</option>
                                <option value="12:30"    >12:30</option>
                                <option value="13:00"    >13:00</option>
                                <option value="13:30"    >13:30</option>
                                <option value="14:00"   >14:00</option>
                                <option value="14:30"   >14:30</option>
                                <option value="15:00"    >15:00</option>
                                <option value="15:30"   >15:30</option>
                                <option value="16:00"    >16:00</option>
                                <option value="16:30"    >16:30</option>
                                <option value="17:00"    >17:00</option>
                                <option value="17:30"    >17:30</option>
                                <option value="18:00"    >18:00</option>
                                <option value="18:30"    >18:30</option>
                                <option value="19:00"    >19:00</option>
                                <option value="19:30"    >19:30</option>
                                <option value="20:00"   >20:00</option>
                                <option value="20:30"    >20:30</option>
                                <option value="21:00"    >21:00</option>
                                <option value="21:30"    >21:30</option>
                                <option value="22:00"    >22:00</option>
                           </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="location" >
                                <option value="">Location/Actions</option>
                                <option value="In Office">In Office</option>
                                <option value="On Site">On Site</option>
                                <option value="Call Customer">Phone Customer</option>
                                <option value="Customer Will Call">Customer Will Call</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="cust_list" id="cust_list">
                            <option>Find Existing Customer</option>
                            @foreach($customers AS $c)
                               <option value="{{$c->id}}">{{$c->first_name}} {{$c->last_name}}</option>
                            @endforeach
                                
                            </select>
                        </div>


                        <div class="form-group">
                            
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Name">
                        </div>
                        <div class="form-group">
                             
                            <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Phone">
                        </div>

                        
                        
                        
                    </div>
                    <div class="col-md-6">

                            <div class="form-group">
                                 
                                <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}"placeholder="Address">
                            </div>
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="town" id="town" value="{{old('town')}}" placeholder="Town">
                            </div>
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="postcode" id="postcode" value="{{old('postcode')}}" placeholder="Postcode">
                            </div>
                            <div class="form-group">
                                
                                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"placeholder="Email If Known">
                            </div>

                            <div class="form-group">
                                 
                                <select class="form-control" name="assigned_to" >

                                    @foreach($users as $u)
                                        <option value="{{$u->id}}">{{$u->first_name}} {{$u->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                             
                            <input type="text" class="form-control" name="notes" id="notes" value="{{old('notes')}}" placeholder="Job Detail">
                        </div>



                    </div>

                </div> <!-- end of body -->

                <div class="panel-footer">

                    <div class="form-group">

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ URL::previous()}}" class="btn btn-primary">Cancel</a>
                            
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
 </form>
@endsection
@section('script')
<script>
    //AJAX and jQuery Script 
    $('#cust_list').on('change',function(e){

        id = e.target.value;

        $.get('/ajax-cust' + '?cust_id=' + id,function(data){

                $( "#name" ).val( data.first_name + " " + data.last_name );
                $( "#phone" ).val( data.phone );
                $( "#address" ).val( data.address1);
                $( "#town" ).val( data.town);
                $( "#postcode" ).val( data.postcode);
                $( "#email" ).val( data.email);
        })
    })
</script>
@endsection