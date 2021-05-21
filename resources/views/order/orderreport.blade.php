@extends('layouts.app')

@section('title')
    <title>Orders</title>
@endsection

@section('content')
    <div class="container"> 
    	<div class="row">
    		<div class="col-md-10 col-md-offset-1">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					Order Report Summary
    				</div>	
    				<div class="panel-body">
			        	@include('partials.error')

			        	<form method="POST" action="{{url('ordreport')}}">
			            	{!! csrf_field() !!}

			            	<div class="form-group">
			                   <label for="booking_date_from">Booking Date From </label>
			                   <div class="input-group date">
			                       <input type="text" class="form-control" name="booking_date_from" value="" id="booking_date_from" required>
			                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                   </div>
			            	</div>
			            	<div class="form-group">
			                   <label for="booking_date_to">Booking Date To</label>
			                   <div class="input-group date">
			                       <input type="text" class="form-control" name="booking_date_to" value="" id="booking_date_to" required>
			                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                   </div>
			            	</div>
			            	<div class="form-group">
			                 <button type="submit" class="btn btn-primary">Get Report</button>
			             	</div>
			        	</form>
			        </div>	
		        </div>	
	        </div>	

    	</div>

    </div>



@endsection