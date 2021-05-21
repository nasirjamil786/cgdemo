@extends('layouts.app')

@section('title')
    <title>A</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4><small>Add/Change Image for Quote Line</small> {{$qline->id}}</h4>

                    </div>

                    <div class="panel-body">
                        @include('partials.error')

                        <form method="POST" action="{{url('qline/'.$qline->id.'/imageupload')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                
                                <div class="form-group">
                                     
                                    <input type="file" class="form-control" name="item_image">
                                </div>
               
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="{{url('quote/'.$qline->quote_id.'/editdetail')}}" class="btn btn-primary">Back</a>
                                <a href="{{url('qline/'.$qline->id.'/removeimage')}}" class="btn btn-primary">Remove</a>
                            </div>

                        </form>  <!-- end of form -->
                        <div><img src="{{asset($qline->item_image)}}"  style="height: 200px;width: 200px"></div>
                        <div><a href="{{url(asset($qline->item_image))}}">{{asset($qline->item_image)}}</a></div>
                    </div>
                    <div class="panel-footer">

                    </div>
                    
                </div>  <!-- end of panel -->


            </div>
        </div>
    </div>
@endsection
