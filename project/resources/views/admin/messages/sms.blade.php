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

        <div class="card card-body bg-light shadow mt-2">
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

            <div>
                <form action="{{ route('admin.send-sms', ['id' => $id]) }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center mb-2">
                        <label for="" class="me-2 fw-bold text-muted">Message: </label>
                        <textarea rows="6" cols="100" name="message" placeholder="Enter Messages..."></textarea>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="SEND" class="btn btn-sm shadow btn-danger">
                    </div>
                </form>
            </div>

        </div>
    </div>
    
@endsection