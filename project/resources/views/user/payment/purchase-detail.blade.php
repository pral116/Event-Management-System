@extends('layouts.user-app')
@section('content')

    <div class="container">
            {{-- <a href="/admin/add-event-option" class="btn btn-outline-secondary">&larr;</a> --}}
            {{-- <p>{{ $id }}</p> --}}
            <form method="POST" action="{{ route('purchase-detail', ["id" => $id]) }}" class="m-3">
                @csrf
                <div>
                    <label for="">Phone</label>
                    <input type="tel" name="phone" class="form-control block bg-light shadow-sm w-50 italic" value="{{ old('phone') }}">
                    <span class="text-danger">@error('phone')
                        {{ $message }}
                    @enderror</span>
                </div>

                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control block bg-light shadow-sm w-50 italic" value="{{ old('email') }}">
                    <span class="text-danger">@error('email')
                        {{ $message }}
                    @enderror</span>
                </div>

                <div class="mt-3">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" class="form-control block bg-light shadow-sm w-50 italic" value="{{ old('quantity') }}">
                    <span class="text-danger">@error('quantity')
                        {{ $message }}
                    @enderror</span>
                </div>

                <div class="mt-3">
                    <input type="submit" value="Next" class="btn btn-md btn-primary">
                </div>
            </form>
        </div>
    </div>
    
@endsection