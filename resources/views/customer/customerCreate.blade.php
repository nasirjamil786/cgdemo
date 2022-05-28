@extends('layouts.app')

@section('title')
    <title>Create New Customer</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Back</a>  <h4>Enter New Cusomer </h4>


                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('customer')}}">
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
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >First Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control"   name="first_name" id="first_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Last Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="last_name" id="last_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Company</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="company" id="company" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address1*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address1" id="address1" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address2 or Area</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address2" id="address2" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Town*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="town" id="town" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Postcode*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="postcode" id="postcode" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email*</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone*</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control" name="phone" id="phone" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Mobile</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control" name="mobile" id="mobile" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Newsletter?</label>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="newsletter" id="newsletter" value="on">
                                            Would you like to receive newsletter ?
                                            <p>The information you provide during account setup will only be used to provide you with updates and personalised marketing. Your privicy is important to us! please let us know how would you like to keep in touch.</p>
                                            <p>We will send you occasional emals about promotions, new products and mportant update to keep you in the loop!</p>
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Recommended by</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="recommended_by" id="recommended_by" required>
                                        <option value="Google">Google</option>
                                        <option value="Google">iTechnician</option>
                                        <option value="Google">Phone4Less</option>
                                        <option value="Google">Facebook</option>
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
                                <label class="col-md-2 control-label"  >Recommended Name</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="recommended_name" id="recommended_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  ></label>
                                <div class="col-md-6">
                                    sbeast,sbwest,sbnorth,stjohns
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Notes</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="4" name="notes" id="notes"></textarea>
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