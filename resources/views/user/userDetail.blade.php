@extends('layouts.app')

@section('title')
    <title>Home</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Details</div>
                    <div class="panel-body">
                        <dl>
                            <dt>Status</dt>
                            <dd>{{$user->user_status}}</dd>
                            <dt>Id</dt>
                            <dd>{{$user->id}}</dd>
                            <dt>Name</dt>
                            <dd>{{$user->user_title}} {{$user->first_name}} {{$user->last_name}}</dd>
                            <dt>Position</dt>
                            <dd>{{$user->position}}</dd>
                            <dt>Address</dt>
                            <dd>{{$user->address1}}</dd>
                            <dd>{{$user->address2}}</dd>
                            <dd>{{$user->area}}</dd>
                            <dd>{{$user->town}}</dd>
                            <dd>{{$user->county}}</dd>
                            <dd>{{$user->postcode}}</dd>
                            <dt>Contact Numbers</dt>
                            <dd>{{$user->phone}}  {{$user->mobile}}</dd>
                            <dt>Nationa Insurance No</dt>
                            <dd>{{$user->tax_no}}</dd>
                            <dt>IP Address</dt>
                            <dd>{{$user->ipaddress}}</dd>
                            <dt>Login Device</dt>
                            <dd>{{$user->login_device}}</dd>
                            <dt>Email</dt>
                            <dd>{{$user->email}}</dd>
                            <dt>CC</dt>
                            <dd>{{$user->cc}}</dd>
                            <dt>BCC</dt>
                            <dd>{{$user->bcc}}</dd>
                            <dt>Password Hint</dt>
                            <dd>{{$user->password_hint}}</dd>
                            <dt>Time Stamp </dt>
                            <dd>{{$user->updated_by}}</dd>
                            <dd>{{$user->created_at}}</dd>
                            <dd>{{$user->updated_at}}</dd>
                        </dl>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection