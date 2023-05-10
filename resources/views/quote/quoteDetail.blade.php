@extends('layouts.app')

@section('title')
    <title>New Quote</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4>
                          <small>Quote No  </small> {{$quote->id}} <small>For</small> <a href="{{url('customer/'.$quote->customer->id)}}">   {{$cust->first_name}} {{$cust->last_name}} </a> <small>Date</small>{{$quote->quote_date}}<small>Valid Until</small>{{$quote->valid_date}}

                          @if($quote->order_id != NULL) <small>Order ref: {{$quote->order_id}}</small> @endif

                        </h4>
                        <small>Last Email Sent: {{$quote->email_sent}}</small>
                         
                    </div>

                    <div class="panel-body">

                        @include('partials.success')
                             
                         <h4>Quote Title</h4>
                         <div class="well well-sm">{{$quote->quote_title}}</div>
                        
                        <h4>Work Detail</h4>
                        <div class="well well-lg">{{$quote->work_detail}}</div> 

                        <a href="{{url('quote/'.$quote->id.'/edit')}}" class="btn btn-primary">Update Quote</a>
                        <hr>
                        
                        <a href="{{url('qline/'.$quote->id.'/create')}}" class="btn btn-primary">Add Quote Line</a>

                        <div class="table responsive">
                            
                            <table class="table">
                                <tr>
                                    <td></td> 
                                    <td>Produt/Service</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Actions</td>
                                </tr>
                                @foreach($qlines as $ql)
                                  <tr>
                                      <td>

                                        @if($ql->item_image != null)
                                            <a href="{{url('qline/'.$ql->id.'/image')}}"><img src="{{ url('qline/'.$ql->id.'/getimage/') }}" style="width: 120px;height: 120px"></a>
                                        @else
                                             <a href="{{url('qline/'.$ql->id.'/image')}}">Add Image</a>
                                         @endif   

                                      </td>
                                      <td><a href="{{url('qline/'.$ql->id.'/edit')}}">{{$ql->item_detail}}</a>
                                          <ul>
                                             @if($ql->spec1 != null)
                                               <li>{{$ql->spec1}}</li>
                                             @endif
                                             @if($ql->spec2 != null)
                                               <li>{{$ql->spec2}}</li>
                                             @endif
                                             @if($ql->spec3 != null)
                                               <li>{{$ql->spec3}}</li>
                                             @endif
                                             @if($ql->spec4 != null)
                                               <li>{{$ql->spec4}}</li>
                                             @endif
                                             @if($ql->spec5 != null)
                                               <li>{{$ql->spec5}}</li>
                                             @endif

                                          </ul>

                                      </td>

                                      <td> {{$ql->quantity}}</td>
                                      <td> {{$ql->value}} </td>
                                      
                                      <td><a href="{{url('qline/'.$ql->id.'/delete')}}">Delete</a></td>
                                  </tr>
                                @endforeach
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>Total without VAT</td>
                                  <td>{{$quote->total_beforevat}}</td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>VAT @ {{$quote->vat_rate}}%</td>
                                  <td>{{$quote->vat}}</td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td><h4>Quote Total</h4></td>
                                  <td><h4>{{$quote->quote_total}}</h4></td>
                                  <td></td>
                                  <td></td>
                                </tr>

                            </table>

                        </div>
                         
                    </div>
                    <div class="panel-footer">
                         <a href="{{url('quote/'.$quote->id.'/print')}}" class="btn btn-primary">Print</a>
                        
                        <a href="{{url('quote/'.$quote->id.'/emailpreview')}}" class="btn btn-primary">Email</a>
                        <a href="{{url('quote/'.$quote->id.'/copy')}}" class="btn btn-primary">Copy</a>
                        @if($quote->order_id == NULL)
                          <a href="{{url('quote/'.$quote->id.'/convorder')}}" class="btn btn-primary">Convert to Order</a>
                        @endif
                    </div>
                    
                </div>  <!-- end of panel -->


            </div>
        </div>
    </div>
@endsection
