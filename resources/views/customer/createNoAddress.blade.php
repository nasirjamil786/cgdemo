@extends('layouts.app')

@section('title')
    <title>Create New Customer</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary pull-right" href="{{ url('/customer/goback')}}">Back</a>  <h4>Enter New Cusomer </h4>

                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('customerstorenoadd')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Title*</label>
                                <div class="col-md-6">

                                    <select class="form-control" name="cust_title" id="cust_title" required>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="MS">MS</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Cllr">Cllr</option>
                                        <option value="Rev">Cllr</option>
                                        <option value="Sir">Cllr</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >First Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control"   name="first_name" id="first_name" value="{{ old('first_name') }}"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Last Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email*</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Mobile/Phone*</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Newsletter?</label>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="newsletter" id="newsletter" value="on">
                                            Would you like to receive newsletter ?
                                            <p>The information you provide during account setup will only be used to 
                                               send you updates and personalized marketing. Your privacy is important to us! 
                                               Please let us know how you'd like to stay in touch. We will send you occasional 
                                               emails about promotions, new products, and important updates to keep you in the loop!
                                            </p>
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Recommended by</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="recommended_by" id="recommended_by" required>
                                        <option value="Google" @if(old('recommended_by') == 'Google') selected @endif>Google</option>
                                        <option value="iTechnician"@if(old('recommended_by') == 'iTechnician') selected @endif>iTechnician</option>
                                        <option value="Phone4Less" @if(old('recommended_by') == 'Phone4Less') selected @endif>Phone4Less</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Word of Mounth">Word of Mouth</option>
                                        <option value="Bing">Bing</option>
                                        <option value="Yahoo">Yahoo</option>
                                        <option value="Leaflet">Leaflet</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Website">Website</option>
                                        <option value="Signboard">Signboard</option>
                                        <option value="Newspaper Advert">Newspaper Advert</option>
                                        <option value="Newspaper Story">Newspaper Story</option>
                                        <option value="Magazine Advert">Magazine Advert</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Radio">Radio</option>
                                        <option value="TV">TV</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Notes</label>
                                <div class="col-md-6">
                                    <textarea class="form-control"  name="notes" id="notes" placeholder="Notes">
                                        {{ old('notes') }}
                                    </textarea>
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