@extends('layouts.app')

@section('title')
    <title>Permissions</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Permissions <a href="{{url('permission/create')}}">New Permission</a></div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Id</th>
                                    <th>Permission</th>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($permissions AS $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->label}}</td>
                                        <td><a href="{{url('permission/'.$permission->id.'/edit')}}">Edit</a>|<a href="{{url('permission/'.$permission->id.'/deleteConfirm')}}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection