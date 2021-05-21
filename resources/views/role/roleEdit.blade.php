@extends('layouts.app')

@section('title')
    <title>New Role</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Role</div>

                    <div class="panel-body">
                        <form method="POST" action="{{url('role/'.$role->id)}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" >Role Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$role->name}}"required>

                                </div>
                                <div class="form-group">
                                    <label for="label" >Detail</label>
                                    <input type="text" class="form-control" name="label" value="{{$role->label}}" required>

                                </div>
                                <div class="form-group">

                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Please select one or more permission for this role</h5>
                                @foreach($permissions AS $p)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{$p->id}}" name="permissions_checked[]" @if($p->hasRole($role->name)) checked @endif> {{$p->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection