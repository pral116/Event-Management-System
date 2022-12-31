@extends('layouts.admin-app')
@section('content')

    <div class="container">
        <a href="{{ route('admin.staff-view', ['id'=>$eventStaff->event_id]) }}" class="btn btn-outline-secondary mb-1">&larr;</a>
        
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

        <div style="font-size:30px">
            <h3 class="text-white badge rounded-pill bg-dark">Edit</h3>
        </div>

        <div class="card card-body mt-2" width="100%"> 
            <form action="{{ route('admin.allocate-staff-update', ['id'=>$eventStaff->id]) }}" method="POST" class="row fw-bold">
                @csrf
                <div class="col-md mb-2">
                    <label for="">Staff:</label>
                    <select name="staff" id="">
                        <option value="">Select</option>
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md mb-2">
                    <label for="">Role:</label>
                    <input type="text" name="role" value="{{ $eventStaff->role }}" class="shadow">
                </div>
                <div class="col-md mb-2">
                    <label for="">Salary:</label>
                    <input type="number" name="salary" value="{{ $eventStaff->salary }}" class="shadow">
                </div>
                <div class="text-center mt-4">
                    <input type="submit" value="Edit" class="btn btn-md btn-primary">
                </div>
            </form>
        </div>
    </div>
    
@endsection