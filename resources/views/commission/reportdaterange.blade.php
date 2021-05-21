@extends('layouts.app')

@section('title')
    <title>Commission Report</title>
@endsection

@section('content')
    <div class="container"> 
    	<div class="row">
    		<div class="col-sm-4 col-sm-offset-4">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					Commision Report Date Range
    				</div>	
    				<div class="panel-body">
			        	@include('partials.error')

			        	<form method="POST" action="{{url('commissionreportextract')}}">
			            	{!! csrf_field() !!}

			            	<div class="form-group">
			                   <label for="order_date_from">Order Date From </label>
			                   <div class="input-group date">
			                       <input type="text" class="form-control" name="order_date_from" value="" id="order_date_from" required>
			                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                   </div>
			            	</div>
			            	<div class="form-group">
			                   <label for="order_date_to">Order Date To</label>
			                   <div class="input-group date">
			                       <input type="text" class="form-control" name="order_date_to" value="" id="border_date_to" required>
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