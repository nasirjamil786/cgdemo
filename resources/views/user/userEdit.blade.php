@extends('layouts.app')

@section('title')
    <title>User Edit</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User id {{$user->id}}</div>

                    <div class="panel-body">
                        @include('partials.error')
                        <form method="POST" action="{{url('/user/'.$user->id)}}" >
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="user_title">Title </label>
                                    <select class="form-control" name="user_title" id="user_title" required>
                                        <option value="Mr" @if($user->user_title == "Mr") SELECTED @endif >Mr</option>
                                        <option value="Mrs" @if($user->user_title == "Mrs") SELECTED @endif>Mrs</option>
                                        <option value="MS">MS</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Cllr">Cllr</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" style="text-transform: capitalize"       id="first_name" value="{{$user->first_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" style="text-transform: capitalize" id="last_name" value="{{$user->last_name}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address1">Address</label>
                                    <input type="text" class="form-control" name="address1" style="text-transform: capitalize" id="address1" value="{{$user->address1}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address2"></label>
                                    <input type="text" class="form-control" style="text-transform: capitalize"  name="address2" id="address2" value="{{$user->address2}}">
                                </div>
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize"  name="town" id="town"  value="{{$user->town}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="county">County</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="county" id="county" value="{{$user->county}}">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" class="form-control" style="text-transform: uppercase" name="postcode" id="postcode" value="{{$user->postcode}}">
                                </div>

                            </div> <!-- end of col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" name="phone" id="phone"  value="{{$user->phone}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile" value="{{$user->mobile}}" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"  value="{{$user->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="cc">CC</label>
                                    <input type="email" class="form-control" name="cc" id="cc"  value="{{$user->cc}}" >
                                </div>
                                <div class="form-group">
                                    <label for="email">BCC</label>
                                    <input type="bcc" class="form-control" name="bcc" id="bcc"  value="{{$user->bcc}}" >
                                </div>
                                <div class="form-group">
                                    <label for="role">Roles</label>
                                    <select class="form-control" name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-default" href="{{ URL('roles') }}">Roles</a>
                                </div>

                                <div class="form-group">
                                    <label for="role">Permissions</label>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="can_settings" id="can_settings" value="1" {{ $user->can_settings == 1 ? 'checked' : '' }}>Can Update Settings
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="can_reports" id="can_reports" value="1" {{ $user->can_reports == 1 ? 'checked' : '' }}>Can See Financial Reports 
                                        </label>
                                    </div>


                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="can_closeOrder" id="can_closeOrder" value="1" {{ $user->can_closeOrder == 1 ? 'checked' : '' }}>Can Close Order 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="can_delPay" id="can_delPay" value="1" {{ $user->can_delPay == 1 ? 'checked' : '' }}>Can Delete Payment
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_hint">Password Hint</label>
                                    <input type="text" class="form-control" name="password_hint" id="password_hint" value="{{$user->password_hint}}" >
                                </div>
                                <div class="form-group">
                                    <label for="position">Position </label>
                                    <input type="text" class="form-control" style="text-transform: capitalize"  name="position" id="position" value="{{$user->position}}" >
                                </div>
                                <div class="form-group">
                                    <label for="tax_no">National Insurance No</label>
                                    <input type="text" class="form-control" name="tax_no" id="tax_no" value="{{$user->tax_no}}" >
                                </div>
                                <div class="form-group">
                                    <label for="user_status">Status</label>
                                    <select class="form-control" name="user_status" id="user_status" required>
                                        <option value="Active" >Active</option>
                                        <option value="Inactive" >Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="notes"  >Notes</label>
                                    <textarea class="form-control" rows="4" name="notes" id="notes" > {{$user->notes}}</textarea>

                                </div>

                                 <div class="form-group">
                                    <label for="commission"  >Commission%</label>
                                    <input type="number" class="form-control"   name="commission" id="commission" value="{{$user->commission}}" >  

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection