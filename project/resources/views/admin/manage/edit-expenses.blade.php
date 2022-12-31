@extends('layouts.admin-app')
@section('content')

    <div class="container">
        <a href="{{ route('admin.expenses-view', ['id'=>$eventExpenses->event_id]) }}" class="btn btn-outline-secondary mb-1">&larr;</a>

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
        
        <div class="card card-body shadow"> 

            <form action="{{ route('admin.allocate-expenses-update', ['id'=>$eventExpenses->id]) }}" class="row fw-bold m-3" method="POST">
                @csrf
                <div class="col-md">
                    <label for="">Purpose</label>
                    <input type="text" name="purpose" value="{{ $eventExpenses->purpose }}" class="shadow">
                </div>

                <div class="col-md">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" value="{{ $eventExpenses->quantity }}" class="shadow">
                </div>

                <div class="col-md">
                    <label for="">Rate</label>
                    <input type="number" name="rate" value="{{ $eventExpenses->rate }}" class="shadow">
                </div>

                <div class="text-center mt-4">
                    <input type="submit" value="UPDATE" class="btn btn-sm shadow btn-primary">
                </div>
            </form>
        </div>
    </div>
    
@endsection