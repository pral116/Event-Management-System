@extends('layouts.admin-app')
@section('content')

    <div class="container">

        <div class="text-center">
            @if (Session::has('success'))
                <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
            @endif
        </div>

        <div class="card card-body bg-light shadow mt-3">
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

            <form action="{{ route('admin.send-email', ['id' => $id]) }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center mb-3">
                    <label for="" class="me-2 fw-bold text-muted">Email: </label>
                    <input type="text" name="email" class="form-control w-50" placeholder="Enter email" value="{{ old('email') }}">
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <label for="" class="me-2 fw-bold text-muted">Subject: </label>
                    <input type="text" name="subject" class="form-control w-50" placeholder="Enter Subject" value="{{ old('subject') }}">
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <label for="" class="me-2 fw-bold text-muted">Message: </label>
                    <textarea rows="6" cols="100" name="body" placeholder="Enter Messages..." value="{{ old('body') }}"></textarea>
                </div>
                <div class="text-center">
                    <input type="submit" value="SEND" class="btn btn-sm shadow btn-danger">
                </div>
            </form>
        </div>
    </div>
    
@endsection