@extends('layouts.admin-app')
@section('content')

    <div class="container">
        <a href="{{ route('admin.add-table', ['id'=>$table->event_id]) }}" class="btn btn-outline-secondary mb-1">&larr;</a>
        
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

        <div class="card card-body shadow bg-light" width="100%"> 
            <form action="{{ route('admin.update-table', ['id'=>$table->id]) }}" method="POST" class="row fw-bold m-3">
                @csrf
                <div class="col-md-4 mb-2">
                    <label for="">Table:</label>
                    <input type="text" name="table" value="{{ $table->table_no }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="">Capacity:</label>
                    <input type="number" name="capacity" value="{{ $table->seat }}">
                </div>
                <div class="col-md-4">
                    <div class="">
                        <input type="submit" value="UPDATE" class="btn btn-sm shadow btn-secondary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection