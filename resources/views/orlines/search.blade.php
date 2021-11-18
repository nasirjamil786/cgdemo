@extends('layouts.app')

@section('title')
    <title>Search Order Lines</title>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="{{url('/orlinesSearch')}}">
                            {!! csrf_field() !!}
                          <div class="form-group">
                            <label for="supp_ref">Supplier</label>
                            <input type="text" class="form-control" name="supp_ref"  id="supp_ref" aria-describedby="supp_ref" placeholder="Enter Supplier Name or Ref ">
                            <small id="supp_ref" class="form-text text-muted">Enter supplier name or reference</small>
                          </div>
                          <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection