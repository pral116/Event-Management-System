@extends('layouts.admin-app')
@section('content')
    
    <div class="content-container">
        <div class="container-fluid">

            <div class="text-center">
                @if (Session::has('success'))
                    <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                @endif
            </div>

            @foreach ($myEvents as $myEvent)
                <div class="m-4 p-2 border bg-light">
                    <div style="text-align:right" class="m-2">
                        @if ($myEvent->category == "Hotel" && $myEvent->cost_type != "Free")
                        <a href="{{ route('admin.add-table', ['id' => $myEvent->id]) }}" class="btn btn-success">Manage Table</a>
                        @endif
                        <a href="{{ route('admin.edit-event', ["id"=>$myEvent->id]) }}" class="btn btn-primary">Edit</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </div>

                    <div class="card card-body p-0 pt-1" width="100%">
                        <div class="my-event-image text-center">
                            <img src="{{ asset('images/' . $myEvent->image) }}">
                        </div><hr>
                        <div class="text-center">
                            <h5>{{ $myEvent->name }}</h5>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm text-center">
                                <p>Type</p>
                                <p class="fw-bold">{{ $myEvent->category }}</p>
                            </div>
                            <div class="col-sm text-center">
                                <p>Status</p>
                                <p class="fw-bold">{{ $myEvent->date }}</p>
                            </div>
                            <div class="col-sm text-center">
                                <button type="button" class="btn btn-primary detail-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $myEvent->id }}">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="name"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="category"></p>
              <p id="address"></p>
              <p id="date"></p>
              <p id="cost_type"></p>
              <p id="ticket_quantity"></p>
              <p id="rate"></p>
              <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <script>
          $(document).ready(function(){
            $('.detail-btn').click(function(){
                const id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/my-event-detail/' + id,
                    type: 'GET',
                    data:{
                        'id': id
                    },
                    success: function(data){
                        $('#name').html(data.name);
                        $('#category').html("Category: " + data.category);
                        // $('#address').html(data.address);
                        $('#date').html("Date: " + data.date);
                        $('#cost_type').html("Cost Type: " + data.cost_type);
                        $('#ticket_quantity').html("Ticket: " + data.ticket_quantity);
                        $('#rate').html("Rate: " + data.rate);
                        $('#desc').html("Description: " + data.description);
                    }
                })
            });
          });
      </script>

@endsection