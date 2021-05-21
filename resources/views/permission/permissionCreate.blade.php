@extends('layouts.app')

@section('title')
    <title>New Permission</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Permission</div>

                    <div class="panel-body">
                        <form method="POST" action="{{url('permissions')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name" >Permission Name</label>
                                <input type="text" class="form-control" name="name" required>

                            </div>
                            <div class="form-group">
                                <label for="label" >Detail</label>
                                <input type="text" class="form-control" name="label" required>

                            </div>
                            <div class="form-group">

                                <button class="btn btn-primary" type="submit">Save</button>
                                <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection