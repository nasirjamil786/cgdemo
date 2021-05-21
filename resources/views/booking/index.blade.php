@extends('layouts.app')

@section('title')
    <title>Bookings</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">

                      <div class="col-md-6">
                           
                            <a href="{{url('booking/create')}}" class="btn btn-primary">New</a>
                          
                         
                      </div>

                      <form id="allbookings" method="GET" action="{{url('/allbookings')}}">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"  name="checkbox_all" id="checkbox_all"  @if($checked_state == 'on') checked @endif> Show All 
                          </label>
                        </div>
                      </form>

                       

                </div> <!-- heading -->

                <div class="panel-body">
                    @include('partials.success')
                  <div class="table-responsive">

                    <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>location</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                    @foreach($bookings as $b)
                       <tr>
                           <td><a href="{{url('booking/'.$b->id)}}">{{$b->name}}</a> </td>
                           <td>{{DateTime::createFromFormat('j/m/Y',$b->booking_date)->format('D j M Y')}}</td>
                           <td>{{$b->booking_time}}</td>
                           <td>{{$b->location}}</td>
                           <td>{{$b->phone}}</td>

                           <td>

                           @if($b->status == 'Booked' || $b->status == 'Rescheduled' || $b->status == 'Complete'
                           || $b->status == 'Followup' || $b->status == 'Call to Confirm')

                                @if($b->status == 'Booked') <span class="label label-danger" >{{$b->status}}</span>@endif
                                @if($b->status == 'Call to Confirm') <span class="label label-danger" >{{$b->status}}</span>@endif
                                @if($b->status == "Rescheduled") <span class="label label-warning">{{$b->status}}</span>@endif
                                @if($b->status == "Complete") <span class="label label-success">{{$b->status}}</span>@endif
                                @if($b->status == "Followup") <span class="label label-info">{{$b->status}}</span>@endif

                           @else
                               <span class="label label-default">{{$b->status}}</span>

                           @endif

                           </td>
                           <td>{{$b->engineer->name}}</td>
                            
                           <td><a href="{{url('booking/'.$b->id.'/edit')}}">Change</a>|<a href="{{url('booking/'.$b->id)}}">Delete</a></td>
                       </tr>

                    @endforeach

                     </table>
                 </div> <!-- table response -->

               </div> <!-- body -->

            </div> <!-- panel -->
        </div> <!-- col-md-10 -->
    </div>  <!-- row -->
</div>  <!-- end of container -->
@endsection

@section('script')

<script>

  $(document).ready(function(){
    $("#allbookings").on("change", "input:checkbox", function(){
        $("#allbookings").submit();
    });
  });

</script>

@endsection
