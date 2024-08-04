@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings</div>

                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('settings/'.$settings->id)}}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Company Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control " style="text-transform: capitalize" name="company_name" id="company_name" value="{{$settings->company_name}}"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Registration No</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="reg_no"  id="reg_no" value="{{$settings->reg_no}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">VAT No</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="vat_no" id="vat_no" value="{{$settings->vat_no}}">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">VAT Rate</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.01" min="0" max="99.99"  class="form-control " style="text-transform: capitalize" name="vat_rate" id="vat_rate" value="{{$settings->vat_rate}}">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Company Address*</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="address1" id="address1" value="{{$settings->address1}}"   required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="address2" id="address2" value="{{$settings->address2}}">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Town*</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="town" id="town" value="{{$settings->town}}" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Postcode*</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control text-uppercase" name="postcode" id="postcode" value="{{$settings->postcode}}" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Phone*</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="phone" id="phone" value="{{$settings->phone}}" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Mobile</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " style="text-transform: capitalize" name="mobile" id="mobile" value="{{$settings->mobile}}" >
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Email*</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control " name="email" id="email" value="{{$settings->email}}" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Website</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " name="web" id="web" value="{{$settings->web}}" >
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Currency</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control text-uppercase" name="currency" id="currency" value="{{$settings->currency}}" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Currency Symbol</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control text-uppercase" name="currency_symbol" id="currency_symbol" value="{{$settings->currency_symbol}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Show Payment Button</label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="form-control text-uppercase" name="payment_button" id="payment_button" value="1" @if($settings->payment_button == '1') checked @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Show VAT</label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="form-control text-uppercase" name="vat" id="vat" value="1" @if($settings->vat == '1') checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Logo File Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control " name="logo_file" id="logo_file" value="{{$settings->logo_file}}">
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

                     </div>  <!--Panel Body -->
                </div>
            </div>
        </div>
    </div>
@endsection