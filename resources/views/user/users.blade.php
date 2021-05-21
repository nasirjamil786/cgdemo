@extends('layouts.app')

@section('title')
    <title>Users</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users <a href="{{url('/user/create')}}">Create New User</a> </div>

                    <div class="panel-body">
                        <div class="table-responsive">

                        </div><table class="table">
                            <tr>
                                <th>Id</th>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($users AS $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        @foreach($user->roles AS $role)
                                            {{$role->name}}
                                        @endforeach


                                    </td>
                                    <td>{{$user->user_status}}</td>
                                    <td><a href="{{url('/user/'.$user->id)}}">Detail</a>|<a href="{{url('/user/'.$user->id.'/edit')}}">Edit</a>|<a href="{{url('/user/'.$user->id.'/changePassword')}}">Pasword Reset</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection