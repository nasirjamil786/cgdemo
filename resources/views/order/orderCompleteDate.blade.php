@extends('layouts.app')

@section('title')
    <title>Confirm Order Complete Date</title>
@endsection

@section('content')
<div class="container">
  <div class="row">
  	<div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading ">
                        <a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>
                        <h4>Confirm Work Complete Date</h4>
            </div> <!--of panel-heading-->
            <div class="panel-body">
                  @include('partials.error')
                  @include('partials.success')

			      <h1>Order# {{$order->id}}</h1>
				  <h4>Please confirm the work complete date or your visit date </h4>
				  <form role="form" name="updateorder" method="POST" action="{{url('/order/'.$order->id.'/'.$p.'/updateCompleteDate')}}">

				  {!! csrf_field() !!}

				     <div class="form-group">
			             <!--<label for="complete_date">Work Complete or Visit Date </label>-->
			             <div class="input-group date">
			              <input type="text" class="form-control" name="complete_date" value="{{ $order->complete_date }}" id="complete_date">
			               <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			             </div>
			        </div> <!--of form group-->
			        <button type="submit" class="btn btn-primary"  >Proceed</button>
			      </form>


           </div> <!-- panel body-->
        </div> <!--panel-->
      </div> <!--of column-->
   </div> <!--End of Row-->
</div> <!-- end of container-->
@endsection