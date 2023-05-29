@extends('layouts.app')

@section('title')
    <title>Upload Purchase Invoice File</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><small>Upload Purchase Invoice File</small> {{$inv->id}}</h4>
                    </div>
                    <div class="panel-body">
                        @include('partials.error')
                        <form method="POST" action="{{url('invoices/'.$inv->id.'/storefile')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="{{url('invoices')}}" class="btn btn-primary">Back</a>
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
