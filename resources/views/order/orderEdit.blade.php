@extends('layouts.app')

@section('title')
    <title>Order Edit</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

            <form role="form" name="updateorder" method="POST" action="{{url('/order/'.$order->id)}}">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($order->signature == NULL && $order->quote_id == 0)
                            <div class="signaturealert" role="alert">
                                  <h4>Customer's signature required - please press the button to get signature</h4>
                                  <a href="{{url('signature/'.$order->id)}}" class="btn btn-danger">Get Signature</a>
                           </div>
                       @endif
                        <h4>  
                            <small>Order No</small> {{$order->id}}  <small> for </small>
                           <a href="{{url('customer/'.$order->customer->id)}}">{{$order->customer->first_name}} {{$order->customer->last_name}} </a>
                           <span class="label label-info">{{$order->order_status}}</span>
                           @if ($order->quote_id != NULL) <span> <small> Quote Ref: {{$order->quote_id}} </small> </span> @endif
                        </h4>
                        <button type="submit" class="btn btn-primary"  >Save</button>
                        <a href="{{url('/order/'.$order->id.'/emailpreview')}}" class="btn btn-primary">Print/Email</a>
                        <a href="{{ url('order') }}" class="btn btn-primary">Back</a>
                        
                    </div>

                    <div class="panel-body">

                        @include('partials.error')
                        @include('partials.success')

                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#booking">Booking</a></li>
                                <li><a data-toggle="tab" href="#device">Device</a></li>
                                <li><a data-toggle="tab" href="#parts">Parts/Services</a></li>
                                <li><a data-toggle="tab" href="#payment">Payment</a></li>
                            </ul>

                            <div class="tab-content">

                                <!--Booking Tab --> 

                                <div id="booking" class="tab-pane fade in active">

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="order_status">Order Status</label>
                                            <select class="form-control" name="order_status" required>
                                                @include('partials.orderstatuslist')
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="booking_date">Job Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="booking_date" value="{{ $order->booking_date }}" id="booking_date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="booking_time">Job Time</label>
                                            <select class="form-control" name="booking_time" required>
                                                @include('partials.timelist')
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label form="location">Job Location</label>
                                            <select class="form-control" name="location" required>
                                                <option value="0" @if($order->location == 0) selected @endif>Drop In</option>
                                                <option value="1" @if($order->location == 1) selected @endif>Home/Office Visit</option>
                                                <option value="2" @if($order->location == 2) selected @endif>Remote Support Call</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="created_at">Booked at</label>
                                            <input type="text" class="form-control" name="created_at" value="{{$order->created_at}}">
                                            
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="booking_date">Booking Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="booking_date" value="{{$order->booking_date}}" id="booking_date" required>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div> -->


                                        <!-- <div class="form-group">
                                            <label for="collection_date">Collection/Onsite Visit Date </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="collection_date" value="{{ $order->collection_date }}" id="collection_date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="collection_time">Collection/Onsite Visit Time</label>
                                            <select class="form-control" name="collection_time" >
                                                @include('partials.collectiontimelist')
                                            </select>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="worked_by">Engineer</label>
                                            <select class="form-control" name="worked_by" required>
                                                @foreach($engineers as $eng)
                                                   <option value="{{$eng->id}}" @if($order->worked_by == $eng->id) selected @endif>{{$eng->first_name}} </option>
                                                @endforeach
                                                
                                            </select>
                                        </div>

                                       

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_notes">Work Detail(<span style="color: red">This will be printed on Booking Form</span>)</label>
                                            <textarea class="form-control" name="order_notes" rows="10" >{{$order->order_notes}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="recommendations">Notes for Customer(<span style="color: red">This will be printed on Invoice/Receipt</span>)</label>
                                            <textarea class="form-control" name="recommendations" rows="5">{{$order->recommendations}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="private_notes">Private Notes (Not for customer)</label>
                                            <textarea class="form-control" name="private_notes" rows="10" >{{$order->private_notes}}</textarea>
                                        </div>
                                    </div>
                                    

                                </div>

                                {{-- Device --}}
                                <div id="device" class="tab-pane fade">


                                    <div class="col-md-6">

                                        <label for="device_id">Device Type</label>
                                        <select class="form-control" name="device_id" required>


                                            @foreach($devices as $device)
                                                <option value="{{$device->id}}" @if($order->device_id == $device->id) selected @endif>{{$device->device_type}}</option>
                                                @endforeach

                                        </select>

                                        <div class="form-group">
                                            <label for="make_id">Make</label>
                                            <select class="form-control" name="make_id" required>


                                                @foreach($makes as $make)
                                                    <option value="{{$make->id}}" @if($order->make_id == $make->id) selected @endif>{{$make->make}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" class="form-control" name="model" value="{{$order->model}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="serial_no">Serial No</label>
                                            <input type="text" class="form-control" name="serial_no" value="{{$order->serial_no}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="operating_system">Operating System</label>
                                            <input type="text" class="form-control" name="operating_system" value="{{$order->operating_system}}" >
                                        </div>

                                    </div>


                                     <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="condition">Condition</label>
                                            <input type="text" class="form-control" name="condition" value="{{$order->condition}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="colour">Colour</label>
                                            <input type="text" class="form-control" name="colour" value="{{$order->colour}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="data_backup">Databackup</label>
                                            <input type="text" class="form-control" name="data_backup" value="{{$order->data_backup}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{$order->username}}" >
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" value="{{$order->password}}" >
                                        </div>

                                     </div>

                                </div>


                                <!-- Parts -->

                                <div id="parts" class="tab-pane fade">
                                    
                                    <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#myModal"  data-backdrop="static"      >
                                        Add Line
                                    </button>


                                    <table class="table">

                                        <tr>
                                            <th></th>
                                            <th>Parts/Services</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Cost</th>
                                            <th>Comm</th>

                                        </tr>
                                        @foreach($orlines AS $ol)
                                            <tr>
                                                <td><a href="{{url('orline/'.$ol->id.'/delete')}}">Delete</a></td>
                                                <td>{{$ol->item_detail}}</td>
                                                <td>{{$ol->value}}</td>
                                                <td>{{$ol->item_notes}}</td>
                                                <td><small>{{$ol->cost}}</small></td>
                                                <td><small>{{$ol->commission}}</small></td>
                                            </tr>
                                        @endforeach
                                    </table>

                                    <hr>
                                        <div class="col-md-8">

                                        </div>
                                        <div class="col-md-4">
                                            <table class="table">
                                              <tr>
                                                  <td>Line Total</td>
                                                  <td>{{$order->line_total}}</td>
                                              </tr>

                                            <tr>

                                                <td>

                                                    <div class="form-group">
                                                        <label for="discount_percent">Services Discount% </label>
                                                        <select class="form-control" name="discount_percent" id="discount_percent">
                                                            <option value="0" @if($order->discount_percent == "0") selected @endif>0</option>
                                                            <option value="5" @if($order->discount_percent == '5') selected @endif>5</option>
                                                            <option value="10"@if($order->discount_percent == '10') selected @endif>10</option>
                                                            <option value="15"@if($order->discount_percent == '15') selected @endif>15</option>
                                                            <option value="20"@if($order->discount_percent == '20') selected @endif>20</option>
                                                            <option value="25"@if($order->discount_percent == '25') selected @endif>25</option>
                                                            <option value="30"@if($order->discount_percent == '30') selected @endif>30</option>
                                                            <option value="35"@if($order->discount_percent == '35') selected @endif>35</option>
                                                            <option value="40"@if($order->discount_percent == '40') selected @endif>40</option>
                                                            <option value="45"@if($order->discount_percent == '45') selected @endif>45</option>
                                                            <option value="50"@if($order->discount_percent == '50') selected @endif>50</option>
                                                            <option value="50"@if($order->discount_percent == '50') selected @endif>60</option>
                                                            <option value="50"@if($order->discount_percent == '50') selected @endif>70</option>
                                                            <option value="50"@if($order->discount_percent == '50') selected @endif>80</option>
                                                            <option value="50"@if($order->discount_percent == '50') selected @endif>100</option>
                                                        </select>

                                                    </div></td>
                                                <td>{{$order->discount}}</td>
                                            </tr>

                                            @if($order->vat != 0)
                                              <tr>
                                                <td>Total before VAT</td>
                                                <td>{{$order->total_beforevat}}</td>
                                               </tr>
                                               <tr>
                                                 <td>VAT @ {{$order->vat_rate}}%</td>
                                                 <td>{{$order->vat}}</td>
                                               </tr>
                                              @endif

                                            <tr>
                                                <td><h4>Order Total</h4></td>
                                                <td><h4>{{$order->order_total}}</h4></td>
                                            </tr>
                                            <tr>
                                                 
                                                <td>
                                                   @if($order->complete_date <> NULL)
                                                     <a href="{{url('invprint/'.$order->id)}}" class="btn btn-primary"
                                                      @if($order->order_total == 0) disabled @endif>Print Invoice</a>
                                                   @endif

                                                   @if($order->complete_date == NULL)
                                                     <a href="{{url('/order/'.$order->id.'/1/confirmCompleteDate')}}" class="btn btn-primary"
                                                     @if($order->order_total == 0) disabled @endif>Print Invoice</a>
                                                   @endif
                                                </td>
                                                <td>
                                                   @if($order->complete_date <> NULL)
                                                     <a href="{{url('invpreview/'.$order->id)}}" class="btn btn-primary"
                                                      @if($order->order_total == 0) disabled @endif>Email Invoice</a>
                                                   @endif

                                                   @if($order->complete_date == NULL)
                                                     <a href="{{url('/order/'.$order->id.'/2/confirmCompleteDate')}}" class="btn btn-primary"
                                                     @if($order->order_total == 0) disabled @endif>Email Invoice</a>
                                                   @endif
                                                </td>
                                            </tr>

                                            </table>

                                        </div>


                                </div>

                                <!-- Payments -->

                    
                                <div id="payment" class="tab-pane fade">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 style="color: red">Balance Due £{{$order->order_total - $order->payment}}</h4>
                                             @if($order->payment != 0)  
                                                <a href="{{url('recpreview/'.$order->id)}}" class="btn btn-primary">Email/Print Receipt</a>
                                             @endif
                                             
                                            <!--This button will open a Modal dialogue with form to enter payments -->
                                            <!--Model is defined below the page -->
                                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal" data-backdrop="static">
                                                        New Payment
                                             </button>


                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Method</th>
                                                        <th>Ref</th>
                                                        <th>Detail</th>
                                                        <th>Action</th>
                                                         
                                                    </tr>
                                                    @foreach($payments AS $pay)
                                                        <tr>
                                                            <td>{{$pay->amount}}</td>
                                                            <td>{{$pay->payment_date}}</td>
                                                            <td>{{$pay->payment_method}}</td>
                                                            <td>{{$pay->payment_ref}}</td>
                                                            <td>{{$pay->detail}}</td>
                                                            <td><a href="{{url('payment/'.$pay->id.'/delete')}}">Delete</a></td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div> {{-- Tab Content --}}

                    </div>  <!--end of panel body-->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary"  >Save</button>
                        
                        <a href="{{url('/order/'.$order->id.'/emailpreview')}}" class="btn btn-primary">Print/Email</a>

                    </div>


                </div> <!--end of panel -->

            </form>

                 {{-- Modal To add lines  --}}

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Order Line</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form   role="form" name="addline" method="POST" action="{{url('orline/'.$order->id)}}">

                                            {!! csrf_field() !!}

                                            <div class="form-group">
                                                <label for="item_notes">Item type</label>
                                                <select class="form-control" name="item_notes" id="item_notes" required>
                                                    <option value=""></option>
                                                    <option value="labour">Labour</option>
                                                    <option value="parts">Parts</option>
                                                    <option value="advance">Advance</option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="item_detail" class="control-label">Item Detail</label>
                                                <input type="text" class="form-control" name="item_detail"   id="item_detail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="value" class="control-label">Price</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="value" id="value" placeholder="£0.00" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cost" class="control-label">Cost</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="cost" id="cost" placeholder="£0.00" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="commission" class="control-label">Commission</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="commission" id="commission" placeholder="£0.00" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>

                                        </form>

                                    </div>

                                    {{--
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                        <button type="button" class="btn btn-primary" @if($order->order_status == 'Paid') disabled @endif>Save changes</button>

                                    </div>
                                    --}}
                                </div>
                            </div>
                        </div>

                        {{-- End of Order line Modal--}}

                        <!-- Payment Modal code start here -->
                        <!-- Modal -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <!-- Payment form will go here  make whole modal as a form -->
                                <form   role="form" name="addpayment" method="POST" action="{{url('payment/'.$order->id)}}">

                                            {!! csrf_field() !!}

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Enter Payment Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                            <!-- Payment Amount -->
                                            <div class="form-group">
                                                <label for="amount">Balance Due on Order £{{$order->order_total - $order->payment}}</label>
                                                <input type="number" step="0.01"    class="form-control" name="amount" value="{{}}" required>
                                            </div>

                                            <!-- Payment Date -->
                                            <div class="form-group">
                                                <label for="payment_date">Payment Date </label>
                                                <div class="input-group date">
                                                   <input type="text" class="form-control" name="payment_date" value="" id="payment_date" required="">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <!-- Payment Method -->
                                            <div class="form-group">
                                                <label for="payment_method">Method</label>
                                                <select class="form-control" name="payment_method" id="payment_method" required>
                                                    <option value=""></option>
                                                    <option value="Cash" >Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Bank Transfer" >Bank Transfer</option>
                                                    <option value="Card Payment">Card Payment</option>
                                                    <option value="Paypal">Paypal</option>
                                                </select>
                                            </div>
                                            <!-- Payment Reference -->
                                            <div class="form-group">
                                                <label for="payment_ref">Payment Reference(card last 4 digits/cheque no/bank name etc)</label>
                                                <input type="text" class="form-control" name="payment_ref" value="" placeholder="Cheque detail">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                </form>

                            </div>
                          </div>
                        </div>

                        <!-- End of Payment model -->
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = ({!! $from !!} == 1) ? '#booking':localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>

@endsection
