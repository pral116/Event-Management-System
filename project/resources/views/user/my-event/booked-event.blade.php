@extends('layouts.user-app')
@section('content')
    
<div class="container mt-4">

    <div class="card card-body shadow bg-light">
        <div>
            <div>
                <h4 class="text-muted">Events</h4>
            </div>

            <div class="table-responsive">
                <table class="table text-center" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th>Image</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @php
                        $i = 0; 
                        @endphp
                        @foreach ($myEvents as $event)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('images/' . $event->event->image) }}" width="70px" height="70px" alt="image">
                                </td>
                                <td>{{ $event->event->name }}</td>
                                <td>{{ $event->event->category }}</td>
                                <td>{{ $event->event->address->name }}</td>
                                @if ($event->event->date > (\Carbon\Carbon::today()) )
                                    <td>{{ $event->event->date }}</td>
                                @else
                                    <td class="fw-bold text-danger"><i>{{ "Ended" }}</i></td>
                                @endif
                                
                                <td class="text-center">
                                    <a class="btn btn-sm shadow btn-primary mb-2" href="{{ route('show-location', ['id' => $event->event_id]) }}">
                                        <i class="fa fa-map-marker"></i>
                                    </a>
                                    {{-- <a class="btn btn-sm shadow btn-primary mb-2" href="event-detail">Detail</a> --}}
                                    <a class="btn btn-sm shadow btn-danger mb-2" href="">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            <div>
                <h4 class="text-muted">Tables</h4>
            </div>

            <div class="table-responsive">
                <table class="table text-center" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th>Image</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Table Number</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @php
                        $i = 0; 
                        @endphp
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('images/' . $table->event->image) }}" width="70px" height="70px" alt="image">
                                </td>
                                <td>{{ $table->event->name }}</td>
                                <td>{{ $table->event->address->name }}</td>
                                @if ($table->event->date > (\Carbon\Carbon::today()) )
                                    <td>{{ $table->event->date }}</td>
                                @else
                                    <td class="fw-bold text-danger"><i>{{ "Ended" }}</i></td>
                                @endif
                                <td>{{ $table->table_id }}</td>
                                <td>{{ $table->table->seat }}</td>
                                
                                <td class="text-center">
                                    <a class="btn btn-sm shadow btn-primary mb-2" href="{{ route('show-location', ['id' => $table->event_id]) }}">
                                        <i class="fa fa-map-marker"></i>
                                    </a>
                                    {{-- <a class="btn btn-sm shadow btn-primary mb-2" href="event-detail">Detail</a> --}}
                                    <a class="btn btn-sm shadow btn-danger mb-2" href="">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>


    </div>

</div>

@endsection