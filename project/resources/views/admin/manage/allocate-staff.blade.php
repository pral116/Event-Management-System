@extends('layouts.admin-app')
@section('content')

    <div class="container">

        <div>

            <div class="text-center">
                @if (Session::has('success'))
                    <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                @endif
            </div>

            <div class="card mb-2 text-center text-primary bg-light p-3">
                <h4>Staff - {{ $event->name }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Role</th>
                            <th scope="col">Wages</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                           $i = 0; 
                        @endphp
                        @foreach ($eventStaffs as $staff)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $staff->staff->name }}</td>
                            <td>{{ $staff->staff->address }}</td>
                            <td>{{ $staff->staff->phone }}</td>
                            <td>{{ $staff->staff->gender }}</td>
                            <td>{{ $staff->role }}</td>
                            <td>{{ $staff->salary }}</td>
                            <td>
                                <a href="{{ route('admin.allocate-staff-edit', ['id' => $staff->id]) }}" class="btn btn-sm shadow btn-primary mb-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.allocate-staff-delete', ['id' => $staff->id]) }}" class="btn btn-sm shadow btn-danger mb-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Allocate staff form --}}
        <div class="card card-body m-2"> 
            <h3 class="text-center mb-3 text-primary text-decoration-underline">Allocate new staff</h3>
            
            <div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {{-- <button type="button" class="close" data-dismiss="close">×</button> --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.staff-allocate', ["id"=>$event->id]) }}" method="POST" class="row fw-bold">
                @csrf
                <div class="col-md">
                    <label for="">Staff:</label>
                    <select name="staff" id="">
                        <option value="">Select</option>
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <label for="">Role:</label>
                    <input type="text" name="role" value="{{ old('role') }}" class="shadow">
                </div>
                <div class="col-md">
                    <label for="">Salary:</label>
                    <input type="number" name="salary" value="{{ old('salary') }}" class="shadow">
                </div>
                <div class="text-center mt-4">
                    <input type="submit" value="ADD" class="btn btn-md btn-primary">
                </div>
            </form>
        </div>

    </div>
    
@endsection