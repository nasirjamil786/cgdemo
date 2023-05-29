@extends('layouts.app')

@section('title')
    <title>Edit Invoice</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Back</a>  <h4>Edit Purchase Invoice </h4>
                            Invoice No: {{$inv->id}}  
                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('/invoices/'.$inv->id.'/update')}}">
                            {!! csrf_field() !!}
                            <div class="col-md-6">
                            <!-- Supplier -->
                            <div class="form-group">
                                <label for="suppid">Supplier</label>
                                <select class="form-control" name="suppid" id="suppid">
                                    <option value="0">Select....</option>
                                    @foreach($suppliers as $supp)
                                        <option value="{{$supp->id}}" {{($inv->supp_id == $supp->id) ? 'selected' : ''}}>{{$supp->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- invoice Number -->
                            
                            <div class="form-group">
                                <label for="invno" >Invoice#</label>
                                    <input  type="text" class="form-control "  name="invno" id="invno"  value="{{$inv->invno}}">
                            </div>
                            <div class="form-group">
                                <label for="vatno" >VAT#</label>
                                    <input  type="text" class="form-control "  name="vatno" id="vatno" value="{{$inv->vatno}}" >
                            </div>
                            <!-- Invoice date -->
                            <div class="form-group">
                                <label for="inv_date">Invoice Date </label> 
                                <div class="input-group date" >
                                    <input type="text" class="form-control" name="inv_date"  id="invdate" value="{{$inv->inv_date}}" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>

                            <!-- lines total -->
                            <div class="form-group">
                                <label for="linetotal" class="control-label">Lines Total</label>
                                <input type="number" onblur="totals()" class="form-control"  min="0" max="90000" step="0.01" 
                                name="linetotal" id="linetotal" value="{{$inv->linetotal}}" required >
                            </div>


                            <!-- Delivery -->
                            <div class="form-group">
                                <label for="delivery" class="control-label">Delivery</label>
                                <input type="number" onblur="totals()" class="form-control" min="0" max="90000" step="0.01" 
                                 name="delivery" id="delivery" value="{{$inv->delivery}}" >
                            </div>

                            <!-- Total before vat -->
                            <div class="form-group">
                                <label for="subtotal" class="control-label">Total Before VAT</label>
                                <input type="number" class="form-control"  max="90000" step="0.01" 
                                 name="subtotal" id="subtotal" value="{{$inv->subtotal}}" >
                            </div>

                            <!-- VAT -->
                            <div class="form-group">
                                <label for="vat" class="control-label">VAT @ {{$vatrate}}%</label>
                                <input type="number" class="form-control"  max="90000" step="0.01"  
                                name="vat" id="vat" value="{{$inv->vat}}" >
                            </div>

                            <!-- total -->
                            <div class="form-group">
                                <label for="total" class="control-label">Total</label>
                                <input type="number" class="form-control"  max="90000" step="0.01" 
                                 name="total" id="total" value="{{$inv->total}}" >
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        function totals(){
            var linetotal = document.getElementById("linetotal");
            var delivery = document.getElementById("delivery");
            var lTot = 0;
            var del = 0;
            var subtot = 0;
            var vatrate =  @json($vatrate); //blade variable can be used in javascript 
            var vat = 0;
            var total = 0;

            if(parseFloat(linetotal.value)) 
                 lTot = parseFloat(parseFloat(linetotal.value).toFixed(2));
            if(parseFloat(delivery.value)) 
                 del = parseFloat(parseFloat(delivery.value).toFixed(2));
            
            subtot = lTot + del;
            vat = (vatrate * subtot / 100);
            total = subtot + vat;

            document.getElementById('subtotal').value = subtot;
            document.getElementById('vat').value = vat;
            document.getElementById('total').value = total;
        }
    </script>
    <script>
    //AJAX and jQuery Script 
    $('#suppid').on('change',function(e){
        id = e.target.value;
        $.get('/ajax-supp' + '?supp_id=' + id,function(data){
                $( "#vatno" ).val( data.vatno );
        })
    })
</script>
@endsection