@extends('layouts.admin-app')
@section('content')

<div class="container">

    <div>
        <form class="row d-flex justify-content-center" method="POST" action="{{ route('admin.view-sold-ticket') }}">
            @csrf
            <div class="col-md-4">
                <select name="event_id" id="" class="form-control mt-1" required>
                    <option value="">Select Event</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }} -> {{ $event->date }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input class="btn btn-xl shadow btn-primary mt-1" value="Display" type="submit">
            </div>
        </form>
    </div>

    @if ($tickets)
        <div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-3 mb-3">
                    <div class="card shadow bg-success">
                        <div class="card-body">
                            <div class="">
                                <div class="fw-bold text-white mb-1">
                                    <h5>Sold</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $soldTicket }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow bg-danger">
                        <div class="card-body">
                            <div class="">
                                <div class="fw-bold text-white mb-1">
                                    <h5>Remaining</h5>
                                </div>  
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $remainingTicket }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                
                <div class="d-flex justify-content-between">
                    <div>
                        @if ($tableExist->count() > 0)
                            <a href="{{ route('admin.view-table-booking', ['id' => $id]) }}" class="btn btn-sm shadow btn-light">Table</a>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('admin.choose-promotion', ['id' => $id]) }}" class="btn btn-sm shadow btn-secondary me-2">Promote</a>
                        @if ($tickets->count() == 0)
                            <a href="{{ route('admin.write-sms', ['id' => $id]) }}" onclick="return false;" class="btn btn-sm shadow btn-secondary me-2">SMS Notification</a>
                            <a href="{{ route('admin.write-email', ['id' => $id]) }}" onclick="return false;" class="btn btn-sm shadow btn-secondary">Email Notification</a>
                        @else
                            <a href="{{ route('admin.write-sms', ['id' => $id]) }}" class="btn btn-sm shadow btn-secondary me-2">SMS Notification</a>
                            <a href="{{ route('admin.write-email', ['id' => $id]) }}" class="btn btn-sm shadow btn-secondary">Email Notification</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card card-body shadow bg-light mt-3">
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead class="fw-bold">
                            <tr>
                                <th>S.N.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Ticket Quantity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->email }}</td>
                                    <td>{{ $ticket->phone }}</td>
                                    <td>{{ $ticket->ticket_quantity }}</td>
                                    <td>dafa</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

    @else
        <div class="fw-bold text-muted d-flex justify-content-center m-5" style="font-size:40px;">
            <p>Content appears here</p>
        </div>
    @endif

</div>
    
@endsection