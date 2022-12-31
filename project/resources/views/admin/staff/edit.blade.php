@extends('layouts.admin-app')
@section('content')

    <div class='content-container'>
        <div class="container-fluid">

            <a href="{{ route('admin.show-staff') }}" class="btn btn-outline-secondary">&larr;</a>
            <h3>Edit staff {{ $staff->name }}</h3>
            
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
            
            <div>
                <form method="POST" action="{{ route('admin.update-staff', ['id'=>$staff->id]) }}" class="m-3">
                    @csrf
                    <div class="block">
                    <div>
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control block w-50 shadow-sm" value="{{ $staff->name }}">
                    </div>
    
                    <div class="mt-3">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control block w-50 shadow-sm" value="{{ $staff->address }}">
                    </div>
    
                    <div class="mt-3">
                        <label for="">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Others" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">Others</label>
                        </div>
                    </div>
    
                    <div class="mt-3">
                        <label for="">Phone</label>
                        <input type="tel" name="phone" class="form-control block w-50 shadow-sm" pattern="98[0-9]{8}" value="{{ $staff->phone }}">
                    </div>
    
                    <div class="mt-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control block w-50 shadow-sm" value="{{ $staff->email }}">
                    </div>
    
                    <div class="mt-3">
                        <input type="submit" value="Update" class="btn btn-lg btn-primary">
                    </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    
@endsection