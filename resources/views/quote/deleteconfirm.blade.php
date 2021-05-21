@extends('layouts.app')

@section('title')
    <title>Quote Delete Confirm</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4>Are you sure you want to delete this quote {{$quote->id}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('quote/'.$quote->id.'/delete')}}" >
                            {!! csrf_field() !!}
                                 
                                <div class="form-group">
                                     <label>Enter DELETE and press Confirm button</label>
                                    <input type="text" class="form-control" name="confirm_delete">
                                </div>
               
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Confirm Delete</button>
                                <a href="{{url('quote')}}" class="btn btn-primary">Back</a>
                                 
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
