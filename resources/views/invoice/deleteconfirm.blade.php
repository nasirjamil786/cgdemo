@extends('layouts.app')

@section('title')
    <title>Delete Confirm Invoice</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Please Confirm Delete Invoice# {{$invno}}</div>

                <div class="panel-body">
                    <form method="post" action="{{url('/invoices/'.$invno.'/delete')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <a href="{{ URL::previous()}}" class="btn btn-primary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection