@extends('layouts.app')

@section('title')
    <title>New Quote Line</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">


                      <a href="{{url('quote/'.$quote->id.'/editdetail')}}" class="btn btn-primary pull-right">Back</a>
                        
                        <h4><small>New Quote Line for</small> {{$quote->id}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('qline/'.$quote->id.'/store')}}">
                            {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="item_type">Item type</label>
                                    <select class="form-control" name="item_type" id="item_type" required>
                                        <option value=""></option>
                                            <option value="labour">Labour</option>
                                            <option value="parts">Parts</option>
                                    </select>

                                </div>
                                
                                <div class="form-group">
                                    <label for="item_detail">Product/Service Detail</label>
                                    <input type="text" class="form-control" name="item_detail" value="{{ old('item_detail') }}" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="value">Unit Price</label>
                                        <input type="number" class="form-control" step="0.01" name="value" value="{{ old('value') }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                         <label for="cost">cost</label>
                                         <input type="number" class="form-control" step="0.01" name="cost" value="{{ old('cost') }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                         <label for="cost">Commission</label>
                                         <input type="number" class="form-control" step="0.01" name="commission" value="{{ old('commission') }}" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="supp_id">Supplier</label>
                                        <select class="form-control" name="supp_id">
                                            <option value="0">Select....</option>
                                            @foreach($suppliers as $supp)
                                                <option value="{{$supp->id}}">{{$supp->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                        
                                    </div>



                                    <div class="form-group col-md-3">
                                         <label for="supp_ref">Supplier Reference</label>
                                         <input type="text" class="form-control" name="supp_ref" value="{{ old('supp_ref') }}">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-row">
                                    
                                    <div class="form-group">
                                         <label for="spec1"> Specifications</label>
                                        <input type="text" class="form-control" name="spec1" value="{{ old('spec1') }}">
                                    </div>
                                    <div class="form-group">
                                         
                                        <input type="text" class="form-control" name="spec2" value="{{ old('spec2') }}">
                                    </div>
                                    <div class="form-group">
                                         
                                        <input type="text" class="form-control" name="spec3" value="{{ old('spec3') }}">
                                    </div>
                                    <div class="form-group">
                                         
                                        <input type="text" class="form-control" name="spec4" value="{{ old('spec4') }}">
                                    </div>
                                    <div class="form-group">
                                         
                                        <input type="text" class="form-control" name="spec5" value="{{ old('spec5') }}">
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label >Private Notes (will not show to customer)</label>
                                    <textarea class="form-control" name="item_notes" rows=8 id="item_notes">{{ old('item_notes') }}</textarea> 
                                </div>

                                
                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>  <!-- end of form -->
                    </div>
                    <div class="panel-footer">

                    </div>
                    
                </div>  <!-- end of panel -->


            </div>
        </div>
    </div>
@endsection
