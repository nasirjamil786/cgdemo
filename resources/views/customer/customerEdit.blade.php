@extends('layouts.app')

@section('title')
    <title>Edit Customer</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>
                        <h4>Edit Customer's Details</h4>
                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        @include('partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('customer/'.$cust->id)}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Title*</label>
                                <div class="col-md-6">

                                    <select class="form-control" name="cust_title" id="cust_title" required>
                                        <option value="Mr" @if($cust->cust_title == 'Mr') SELECTED @endif>Mr</option>
                                        <option value="Mrs" @if($cust->cust_title == 'Mrs') SELECTED @endif>Mrs</option>
                                        <option value="MS" @if($cust->cust_title == 'MS') SELECTED @endif>MS</option>
                                        <option value="Miss" @if($cust->cust_title == 'Miss') SELECTED @endif>Miss</option>
                                        <option value="Dr" @if($cust->cust_title == 'Dr') SELECTED @endif>Dr</option>
                                        <option value="Cllr" @if($cust->cust_title == 'Cllr') SELECTED @endif>Cllr</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >First Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="first_name" id="first_name" value="{{$cust->first_name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Last Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="last_name" id="last_name" value="{{$cust->last_name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Company</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="company" id="company" value="{{$cust->company}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address 1*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="address1" id="address1" value="{{$cust->address1}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address2/Area</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="address2" id="address2" value="{{$cust->address2}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Town*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="town" id="town" value="{{$cust->town}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >County</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="county" id="county" value="{{$cust->county}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Postcode*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="postcode" id="postcode" value="{{$cust->postcode}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Country</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="country" id="country" value="{{$cust->country}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email*</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control" name="email" id="email" value="{{$cust->email}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >CC Email</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control" name="ccemail" id="ccemail" value="{{$cust->ccemail}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone*</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control" name="phone" id="phone" value="{{$cust->phone}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Mobile</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control" name="mobile" id="mobile" value="{{$cust->mobile}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >News Letter?</label>
                                <div class="col-md-6">
                                    <input  type="checkbox" class="form-control" name="newsletter" id="newsletter" value="on"
                                            @if($cust->newsletter == 'on') checked @endif >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Recommended by</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="recommended_by" id="recommended_by" required>
                                        <option value="Google" @if($cust->recommended_by == "Google") selected @endif >Google</option>
                                        <option value="Bing" @if($cust->recommended_by == "Bing") selected @endif >Bing</option>
                                        <option value="Yahoo" @if($cust->recommended_by == "Yahoo") selected @endif >Yahoos</option>
                                        <option value="Leaflet" @if($cust->recommended_by == "Leaflet") selected @endif >Leaflet</option>
                                        <option value="Word of Mounth" @if($cust->recommended_by == "Word of Mounth") selected @endif>Word of Mouth</option>
                                        <option value="Signboard" @if($cust->recommended_by == "signboard") selected @endif>Signboard</option>
                                        <option value="Newspaper Advert" @if($cust->recommended_by == "Newspaper Advert") selected @endif>Newspaper Advert</option>
                                        <option value="Newspaper Story" @if($cust->recommended_by == "Newspaper story") selected @endif>Newspaper Story</option>
                                        <option value="Magazine Advert" @if($cust->recommended_by == "Magazine Advert") selected @endif>Magazine Advert</option>
                                        <option value="Facebook" @if($cust->recommended_by == "Facebook") selected @endif>Facebook</option>
                                        <option value="Twitter" @if($cust->recommended_by == "Twitter") selected @endif>Twitter</option>
                                        <option value="Instagram" @if($cust->recommended_by == "Instagram") selected @endif>Instagram</option>
                                        <option value="Others" @if($cust->recommended_by == "Others") selected @endif>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Recommended Name</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "   name="recommended_name" id="recommended_name" value="{{$cust->recommended_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >One Off Discount% Applied to the Services Only</label>
                                <div class="col-md-6">
                                    <input  type="number" class="form-control" name="discount" id="discount" value="{{$cust->discount}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Account Status</label>
                                <div class="col-md-6">
                                    
                                        <select class="form-control" name="status" id="status" required >
                                            <option value="Active" @if($cust->status == "Active") selected @endif >Active</option>
                                            <option value="Inactive" @if($cust->status == "Inactive") selected @endif>Inactive</option>
                                        </select>
                                    
                                       
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">Monthly Subscription Status</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="subscription_status" id="subscription_status" required>
                                        <option value="Off" @if($cust->subcription_status == "Off") selected @endif >Off</option>
                                        <option value="On" @if($cust->subcription_status == "On") selected @endif >On</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Old Ref No</label>
                                <div class="col-md-6">
                                    <input  type="number" class="form-control" name="old_ref" id="old_ref" value="{{$cust->old_ref}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  ></label>
                                <div class="col-md-6">
                                    sbeast,sbwest,sbnorth,stjohns
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-md-2 control-label" for="reviewed">Review Date </label> 
                                    <div class="col-md-6 input-group date">
                                        <input type="text" class="form-control" name="reviewed" value="{{$cust->reviewed}}" id="reviewed">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>

                            <div class="form-group">
                                
                                <label class="col-md-2 control-label"  >Notes</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="4" name="notes" id="notes">{{$cust->notes}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-4">
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

