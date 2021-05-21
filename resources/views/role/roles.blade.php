@extends('layouts.app')

@section('title')
    <title>Roles</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles <a href="{{url('role/create')}}">New Role</a></div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($roles AS $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->label}}</td>
                                        <td><a href="{{url('role/'.$role->id.'/edit')}}">Edit</a>|<a href="{{url('role/'.$role->id.'/deleteConfirm')}}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection