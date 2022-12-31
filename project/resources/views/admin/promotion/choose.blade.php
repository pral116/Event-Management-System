@extends('layouts.admin-app')
@section('content')

    <div class="container">
        <div class="">
            <a href="{{ route('admin.index.sms-promote', ['id' => $id]) }}" class="btn m-2 bg-light text-dark">SMS</a>
            <a href="{{ route('admin.index.email-promote', ['id' => $id]) }}" class="btn bg-light text-dark">Email</a><hr>
        </div>

        @yield('promotion')
    </div>
    
@endsection