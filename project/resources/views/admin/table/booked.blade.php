@extends('layouts.admin-app')
@section('content')

    <div class="container">
        <div class="card card-body shadow bg-light mt-3">
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead class="fw-bold">
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Table Number</th>
                            <th>Capacity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($bookedList as $booked)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $booked->user->id }}</td>
                                <td>{{ $booked->table->table_no }}</td>
                                <td>{{ $booked->table->seat }}</td>
                                <td>{{ $booked->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection