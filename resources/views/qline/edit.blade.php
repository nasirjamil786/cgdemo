@extends('layouts.app')

@section('title')
    <title>Edit Quote Line</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">



                      <a href="{{url('quote/'.$qline->quote_id.'/editdetail')}}" class="btn btn-primary pull-right">Back</a>
                       

                        <h4><small>Edit Quote Line No</small> {{$qline->id}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('qline/'.$qline->id.'/update')}}">
                            {!! csrf_field() !!}


                               <div class="form-group">
                                    <label for="item_type">Item type</label>
                                    <select class="form-control" name="item_type" id="item_type" required>
                                        <option value=""></option>
                                            <option value="labour" @if($qline->item_type == 'labour') selected @endif >Labour</option>
                                            <option value="parts" @if($qline->item_type == 'parts') selected @endif>Parts</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="item_detail">Product/Service Detail</label>
                                    <input type="text" class="form-control" name="item_detail" value="{{ $qline->item_detail }}" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="{{ $qline->quantity }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="value">Price</label>
                                        <input type="number" class="form-control" step="0.01" name="value" value="{{ $qline->value }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Cost">Cost</label>
                                        <input type="number" class="form-control" step="0.01" name="cost" value="{{ $qline->cost }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="Cost">Commission</label>
                                        <input type="number" class="form-control" step="0.01" name="commission" value="{{ $qline->commission }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="supp_id">Supplier</label>
                                        <select class="form-control" name="supp_id">
                                            <option value="0">Select....</option>
                                            @foreach($suppliers as $supp)
                                                <option value="{{$supp->id}}" @if($qline->supp_id == $supp->id) SELECTED @endif>{{$supp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                         <label for="supp_ref">Supplier Reference</label>
                                         <input type="text" class="form-control" name="supp_ref" value="{{ $qline->supp_ref }}">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <h4>Specifications</h4>
                                <div class="form-group">
                                     
                                    <input type="text" class="form-control" name="spec1" value="{{ $qline->spec1 }}">
                                </div>
                                <div class="form-group">
                                     
                                    <input type="text" class="form-control" name="spec2" value="{{ $qline->spec2 }}">
                                </div>
                                <div class="form-group">
                                   
                                    <input type="text" class="form-control" name="spec3" value="{{ $qline->spec3}}">
                                </div>
                                <div class="form-group">
                                     
                                    <input type="text" class="form-control" name="spec4" value="{{ $qline->spec4 }}">
                                </div>
                                <div class="form-group">
                                     
                                    <input type="text" class="form-control" name="spec5" value="{{ $qline->spec5 }}">
                                </div>
                                

                                <div class="form-group">
                                    <label >Private Notes (will not show to customer)</label>
                                    <textarea class="form-control" name="item_notes" rows=8 id="item_notes">{{ $qline->item_notes}}</textarea> 
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
