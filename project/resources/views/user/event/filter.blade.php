@extends('layouts.user-app')
@section('content')

    <div class="container mt-3">
        <div class="filter-btn text-center">
            <a href="{{ route('view.all-events') }}" class="btn">All</a>
            <a href="{{ route('view.today-events') }}" class="btn">Today</a>
            <a href="{{ route('view.tomorrow-events') }}" class="btn">Tomorrow</a>
            <a href="{{ route('view.hotel-event') }}" class="btn">Hotel</a>
            <a href="{{ route('view.concert-event') }}" class="btn">Concert</a>
            <a href="{{ route('view.aud-event') }}" class="btn">Auditorium</a>
            <a href="{{ route('view.free-event') }}" class="btn">Free</a>
            <a href="{{ route('view.top-event') }}" class="btn">Top Rated</a>
        </div>

        @yield('events')

    </div>
    
@endsection