@extends('layouts.app')

@section('title')
    <title>Edit Supplier</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary" href="{{route('suppliers.index') }}">Back</a>  <h4>Edit Supplier </h4>

                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        @include('partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('suppliers/'.$supp->id)}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Supplier Name*</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control"   name="name" id="name" value="{{$supp->name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Contact1</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="contact1" id="contact1" value="{{$supp->contact1}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email1</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control "  name="email1" id="email1" value="{{$supp->email1}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone1</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="phone1" id="phone1" value="{{$supp->phone1}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >mobile1</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="mobile1" id="mobile1" value="{{$supp->mobile1}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Contact2</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="contact2" id="contact2" value="{{$supp->contact2}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Email2</label>
                                <div class="col-md-6">
                                    <input  type="email" class="form-control "  name="email2" id="email2" value="{{$supp->email2}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Phone2</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="phone2" id="phone2" value="{{$supp->phone2}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >mobile2</label>
                                <div class="col-md-6">
                                    <input  type="tel" class="form-control "  name="mobile2" id="mobile2" value="{{$supp->mobile2}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address1</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address1" id="address1" value="{{$supp->address1}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address2</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address2" id="address2" value="{{$supp->address2}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Address3</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="address3" id="address3" value="{{$supp->address3}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Town</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control "  name="town" id="town" value="{{$supp->town}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Postcode</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="postcode" id="postcode" value="{{$supp->postcode}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Country</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control text-uppercase" name="country" id="country" value="{{$supp->country}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Website</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="website" id="website" value="{{$supp->website}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Our Account #</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="account" id="account" value="{{$supp->account}}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label"  >Notes</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="4" name="notes" id="notes" >{{$supp->notes}}</textarea>
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