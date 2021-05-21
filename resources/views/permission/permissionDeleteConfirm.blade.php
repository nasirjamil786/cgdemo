@extends('layouts.app')

@section('title')
    <title>Permission Delete Confirmation</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Are you sure you want to delete this permission?</div>

                    <div class="panel-body">
                        @include('partials.error')
                        <form method="POST" action="{{url('permission/'.$permission->id)}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <dl>
                                <dt>Permission</dt>
                                <dd>{{$permission->name}}</dd>
                                <dt>Detail</dt>
                                <dd>{{$permission->label}}</dd>
                            </dl>

                            <button type="submit" class=" btn btn-primary">Confirm Delete</button>
                            <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection