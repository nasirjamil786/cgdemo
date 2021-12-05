@extends('layouts.app')

@section('title')
    <title>Suppliers</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <a href="{{url('suppliers/create')}}" class="btn btn-primary">New Supplier</a>
                        
                    </div>
                    <div class="panel-body">
                        @include('partials.success')
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Contacts</th>
                                    <th>Emails</th> 
                                    <th>Phones</th>
                                    <th>Our Account</th>
                                    <th>ID#</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($suppliers AS $supp)
                                    <tr>
                                        <td>
                                            <a href="{{url('suppliers/'.$supp->id)}}"> {{$supp->name}} </a>
                                        </td>
                                        
                                        <td>

                                            {{$supp->contact1}} 
                                            @if($supp->contact2 != NULL) <br> {{$supp->contact2}} @endif

                                        </td>
                                        <td>

                                            {{$supp->email1}}
                                            @if($supp->email2 != NULL) <br> {{$supp->email2}} @endif

                                        </td>
                                        <td>

                                            {{$supp->phone1}}
                                            @if($supp->phone2 != NULL ) <br> {{$supp->phone2}} @endif  
                                            @if($supp->mobile1 != NULL) <br> {{$supp->mobile1}} @endif
                                            @if($supp->mobile2 != NULL) <br> {{$supp->mobile2}} @endif

                                        </td>
                                        
                                        <td>{{$supp->account}}</td>
                                        <td>{{$supp->id}}</td>
                                        
                                        <td>

                                            <a href="{{url('suppliers/'.$supp->id.'/edit')}}" class="btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn-sm btn-primary" data-toggle="modal" data-target="#deleteModal" data-id="{{$supp->id}}" data-supp_name="{{$supp->name}}">
                                                    Delete
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>


                    </div>

                    <div class="panel-footer">
                        {!! $suppliers->links() !!}
                    </div>


                </div>
            </div>
            {{-- Delete Modal --}}
           
            <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirm Delete Supplier</h4>
                        </div>
                        <div class="modal-body">

                            <form   role="form" name="deletesupplier" id="deletesupplier" method="GET" action="">

                                {!! csrf_field() !!}

                                <p> Are you sure you want to delete this supplier? </p>
                                <h1 id="supp_name"></h1>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>

                            </form>

                        </div>

                       
                    </div>
                </div>
            </div>
            {{-- end of line change modal --}}

        </div>
    </div>
    
@endsection

@section('script')

<script type="text/javascript">
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('supp_name')

            var modal = $(this)
                modal.find('.modal-body #deletesupplier').attr('action','/suppliers/' + id + '/delete')
                modal.find('.modal-body #supp_name').text(name)
        })
    </script>
@endsection