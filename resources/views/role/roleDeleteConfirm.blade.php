@extends('layouts.app')

@section('title')
    <title>Role Delete Confirmation</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Are you sure you want to delete this role?</div>

                    <div class="panel-body">
                        <form method="POST" action="{{url('role/'.$role->id)}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <dl>
                            <dt>Role</dt>
                            <dd>{{$role->name}}</dd>
                            <dt>Detail</dt>
                            <dd>{{$role->label}}</dd>
                        </dl>

                            <button type="submit" class=" btn btn-primary">Confirm Delete</button>
                            <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection