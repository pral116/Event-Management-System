@extends('layouts.admin-app')
@section('content')

    <div class="container">

        <div>

            <div class="text-center">
                @if (Session::has('success'))
                    <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="fw-bold text-danger" style="font-size:30px;">{{ Session::get('fail') }}</div>                        
                @endif
            </div>

            {{-- Add table form --}}
        <div class="card card-body shadow m-2 bg-light"> 
            <h3 class="text-center mb-3 text-primary text-decoration-underline">Add Table</h3>
            
            <div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.store-table', ['id' => $event->id]) }}" method="POST" class="row fw-bold mb-3">
                @csrf
                <div class="col-md-4">
                    <label for="">Table</label>
                    <input type="text" name="table" value="{{ old('table') }}" class="">
                </div>
                <div class="col-md-4">
                    <label for="">Capacity:</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" class="">
                </div>
                <div class="col-md-4">
                    <div class="">
                        <input type="submit" value="ADD" class="btn btn-sm shadow btn-secondary">
                    </div>
                </div>
            </form>
        </div>

            <div class="card mt-5 text-center text-primary bg-light p-3">
                <h4>Tables</h4>
            
                <div class="table-responsive">
                    <table class="table" id="myTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">S.N.</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Table</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0; 
                            @endphp
                            @foreach ($tables as $table)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $table->event->name }}</td>
                                <td>{{ $table->table_no }}</td>
                                <td>{{ $table->seat }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-table', ['id' => $table->id]) }}" class="btn btn-sm shadow btn-primary mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.delete-table', ['id' => $event->id]) }}" class="btn btn-sm shadow btn-danger mb-1">
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