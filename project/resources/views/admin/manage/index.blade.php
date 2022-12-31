@extends('layouts.admin-app')
@section('content')

    <div class="content-container">
        <div class="m-3">
            
            <h4>Your Events</h4>
            <div class="table-resonsive">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->cost_type }}</td>
                            <td>{{ $event->date }}</td>
                            <td>
                                <a href="{{ route('admin.staff-view', ['id' => $event->id]) }}" class="btn btn-sm shadow btn-primary mb-1">
                                    Staff
                                </a>
                                <a href="{{ route('admin.expenses-view', ['id' => $event->id]) }}" class="btn btn-sm shadow btn-primary mb-1">Expenses</a>
                                <a href="{{ route('admin.report-view', ['id' => $event->id]) }}" class="btn btn-sm shadow btn-success mb-1">Report</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection