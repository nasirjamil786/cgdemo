@extends('layouts.app')

@section('title')
    <title>Delete Confirm</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Customer Delet Confirmation</div>

                <div class="panel-body">
                    
                    <h4>are you sure you would like to delete this customer record?</h4>

                    <form method="post" action="{{url('customer/'.$cust->id)}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <ul class="list-unstyled">
                            <li>{{$cust->id}}</li>
                            <li>{{$cust->first_name}}</li>
                            <li>{{$cust->last_name}}</li>
                            <li>{{$cust->email}}</li>
                        </ul>

                    <button type="submit" class="btn btn-primary">Delete</button>
                    <a href="{{ URL::previous()}}" class="btn btn-primary">Cancel</a>




                    </form>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
