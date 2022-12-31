@extends('layouts.user-app')
@section('content')
    
    <div class="container mt-5">

        <div class="fw-bold">

            <div class="row mb-4">
                <div class="col-sm-3">
                    Name:
                </div>
                <div class="col-sm-3">
                    {{ $user->name }}
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    Email:
                </div>
                <div class="col-sm-3">
                    {{ $user->email }}
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    Event Name:
                </div>
                <div class="col-sm-3">
                    {{ $table->event->name }}
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    Table No:
                </div>
                <div class="col-sm-3">
                    {{ $table->table_no }}
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    Capacity:
                </div>
                <div class="col-sm-3">
                    {{ $table->seat }}
                </div>
            </div>

            <div>
                <a href="{{ route('book-table', ['id' => $table->id]) }}" class="btn btn-sm btn-primary">Book</a>
            </div>

        </div>

    </div>

@endsection