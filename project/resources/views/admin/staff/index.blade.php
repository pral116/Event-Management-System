@extends('layouts.admin-app')
@section('content')
    
<div class="container">

    <div class="text-center">
        @if (Session::has('success'))
            <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="fw-bold text-danger">{{ Session::get('fail') }}</div>                        
        @endif
    </div>

        <div class="card card-body mt-4 mb-3 bg-light" width="100%">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="fw-bold">Staff List</h3>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.add-staff') }}" class="btn btn-md btn-primary float-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mt-3" id="myTable">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($staffs as $staff)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->address }}</td>
                            <td>{{ $staff->gender }}</td>
                            <td>{{ $staff->phone }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>
                                <a href="{{ route('admin.edit-staff', ['id'=>$staff->id]) }}" class="btn btn-sm shadow btn-primary mb-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.delete-staff', ['id'=>$staff->id]) }}" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>

@endsection