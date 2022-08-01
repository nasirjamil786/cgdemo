@extends('layouts.app')

@section('title')
    <title>New Quote Lines</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>
                        <h4><small>New Quote for </small> {{$cust->first_name}} {{$cust->last_name}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')


                        {{$valid_date}}
                        {{$quote_title}}
                        {{$work_detail}}
                        <!-- button for adding lines -->
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" >
                                        Add Line
                         </button>


                        <!-- quote line table start here -->

                        <table class="table">

                            <tr>
                                <th></th>
                                <th>Parts/Services</th>
                                <th>Price</th>

                            </tr>
                             
                             @foreach($item_type as $it)
                                <tr>
                                    
                                    <td>{{$it[0]}}</td>
                                    <td> {{$it[1]}} </td>
                                    <td> {{$it[2]}} </td>
                                    <td> Delete </td>
                                    
                                    
                                </tr>
                               @endforeach
                             
                            
                        </table>

                        <!-- quote line table end   -->


                    </div>
                    <div class="panel-footer">
                           
                    </div>

                </div>

                <!-- start of modal -->

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Quote Line</h4>
                                    </div>
                                    <div class="modal-body">


                                        <form   role="form" name="addline" method="POST" action="{{url('quoteline/store')}}">

                                            {!! csrf_field() !!}

                                            <div class="form-group">
                                                <label for="item_notes">Item Type</label>
                                                <select class="form-control" name="item_type" id="item_type" required>
                                                    <option value=""></option>
                                                    <option value="labour">Labour</option>
                                                    <option value="parts">Parts</option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="item_detail" class="control-label">Item Detail</label>
                                                <input type="text" class="form-control" name="item_detail"   id="item_detail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="value" class="control-label">Price</label>
                                                <input type="number" class="form-control"  max="90000" step="0.01"  name="line_value" id="line_value" placeholder="£0.00" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>

                                        </form>

                                    </div>

                                    
                                </div>
                            </div>
                        </div>

                         
                     <!-- end of modal  -->


            </div>
        </div>
    </div>
@endsection

