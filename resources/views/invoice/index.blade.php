@extends('layouts.app')

@section('title')
    <title>Purchase Invoices</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    @include('partials.success')
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{url('invoices/create')}}" class="btn btn-primary">New Invoice</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <form class="form" method="POST" action="{{url('/invoices/search')}}">
                                        {!! csrf_field() !!}
                                        <div class="form-group col-sm-4">
                                        <label for="inv_date">From</label> 
                                            <div class="input-group date" >
                                                <input type="text" class="form-control" name="from"  id="from" value="{{$from}}">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4">
                                        <label for="inv_date">To</label> 
                                            <div class="input-group date" >
                                                <input type="text" class="form-control" name="to"  id="to" value="{{$to}}">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                               <button type="submit" class="btn btn-primary">Search</button>
                                                <a href="{{url('/invoices/export/'.$sfrom.'/'.$sto)}}" >Download</a>
                                            </div>
                                        </div>
                                    </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Inv#</th>
                                    <th>Inv Date</th>
                                    <th>Supplier</th>
                                    <th>Supp Inv#</th>
                                    <th>Total Before VAT</th>
                                    <th>VAT Rate%</th>
                                    <th>VAT</th>
                                    <th>TOTAL</th>
                                    <th>Action</th>
                                </tr>
                                    @foreach($invoices AS $inv)
                                        <tr>
                                            <td> <a href="{{url('invoices/'.$inv->id.'/edit')}}"> {{$inv->id}} </a>   </td>
                                            <td> {{$inv->inv_date }}</td>
                                            <td>{{$inv->suppname}}</td>
                                            <td>{{$inv->invno}}</td>
                                            <td>{{$inv->subtotal}}</td>
                                            <td> {{$inv->vatrate}}%</td>
                                            <td> {{$inv->vat}} </td>
                                            <td>{{$inv->total}}</td>
                                            <td><a href="{{url('invoices/'.$inv->id.'/downloadfile')}}">{{$inv->filename}} </a></td>
                                            <td> <a href="{{url('invoices/'.$inv->id.'/edit')}}">Edit|</a> |
                                                 <a href="{{url('invoices/'.$inv->id.'/delete')}}">Delete|</a> 
                                                 <a href="{{url('invoices/'.$inv->id.'/uploadfile')}}">Upload File</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{$subtotal}}</th>
                                    <th></th>
                                    <th>{{$vat}}</th>
                                    <th>{{$total}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                     
                        {!! $invoices->links() !!}
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection