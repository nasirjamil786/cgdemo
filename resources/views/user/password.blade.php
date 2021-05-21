@extends('layouts.app')

@section('title')
    <title>Home</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <form method="post" action="{{url('user/'.$user->id.'/changePassword')}}">

                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a class="btn btn-default" href="{{ URL::previous() }}">Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection