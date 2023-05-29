@extends('layouts.app')

@section('title')
    <title>Create New Supplier</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Back</a>  <h4>Enter New Supplier </h4>

                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('suppliers')}}">
                            {!! csrf_field() !!}
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Supplier Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control"   name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Contact1</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="contact1" id="contact1" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email1</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control "  name="email1" id="email1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone1</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="phone1" id="phone1" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >mobile1</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="mobile1" id="mobile1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Contact2</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="contact2" id="contact2" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email2</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control "  name="email2" id="email2" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone2</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="phone2" id="phone2" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >mobile2</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="mobile2" id="mobile2" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address1</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address1" id="address1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address2</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address2" id="address2" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address3</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address3" id="address3" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Town</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="town" id="town">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Postcode</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="postcode" id="postcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Country</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="country" id="country">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Website</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="website" id="website">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Our Account #</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="account" id="account" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Notes</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="4" name="notes" id="notes"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >VAT#</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="vatno" id="vat" >
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