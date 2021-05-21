@extends('layouts.app')

@section('title')
    <title>New Edit</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New user</div>

                    <div class="panel-body">
                        @include('partials.error')
                        <form method="POST" action="{{url('user')}}" >
                            {!! csrf_field() !!}

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="user_title">Title </label>
                                    <select class="form-control" name="user_title" id="user_title" required>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="MS">MS</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Cllr">Cllr</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="first_name" id="first_name"  required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="last_name" id="last_name"  required>
                                </div>

                                <div class="form-group">
                                    <label for="address1">Address</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="address1" id="address1"  required>
                                </div>
                                <div class="form-group">
                                    <label for="address2"></label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="address2" id="address2" >
                                </div>
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="town" id="town"  required>
                                </div>
                                <div class="form-group">
                                    <label for="county">County</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="county" id="county" >
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="postcode" id="postcode" >
                                </div>




                            </div> <!-- end of col-md-4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="phone" id="phone"   required>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="mobile" id="mobile"  >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control"  name="email" id="email"   required>
                                </div>

                                <div class="form-group">
                                    <label for="cc">CC Email</label>
                                    <input type="email" class="form-control"  name="cc" id="cc">
                                </div>

                                <div class="form-group">
                                    <label for="bcc">BCC Email</label>
                                    <input type="email" class="form-control"  name="bcc" id="bcc">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation">
                                </div>
                                <div class="form-group">
                                    <label for="role">Roles</label>
                                    <select class="form-control" name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach

                                    </select>
                                    <a class="btn btn-default" href="{{ URL('roles') }}">Roles</a>

                                </div>




                            </div>
                            <div class="col-md-4">



                                <div class="form-group">
                                    <label for="password_hint">Password Hint</label>
                                    <input type="text" class="form-control" name="password_hint" id="password_hint"  >
                                </div>
                                <div class="form-group">
                                    <label for="position">Position </label>
                                    <input type="text" class="form-control" style="text-transform: capitalize" name="position" id="position"  >
                                </div>
                                <div class="form-group">
                                    <label for="tax_no">National Insurance No</label>
                                    <input type="text" class="form-control" name="tax_no" id="tax_no"  >
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
                                    <textarea class="form-control" rows="4" name="notes" id="notes" > </textarea>

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