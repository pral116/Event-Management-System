@extends('layouts.user-app')
@section('content')
    <div class="mt-3">
        {{-- container --}}
        <div class="container">
            <form action="{{ route('view.by-location') }}" method="post">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="search-bar" placeholder="Enter City/Places..." name="search" required>
                    <div class="input-group-btn">
                        <button class="btn " type="submit" id="search-button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>{{-- container --}}


        <div class="container">

            @if ($topVoted)
                <div class="text-center">
                    <img src="{{ asset('images/' . $topVoted->image) }}" alt="" style="height: 200px; width: 100%">
                    <a href="{{ route('view.event-detail', ["id" => $topVoted->id]) }}" class="btn">
                        <h1 class="text-muted">{{ $topVoted->name }}</h1>
                    </a>
                </div>
            @else
                <div class="text-center text-primary">
                    <p>Top voted event appears here</p>
                </div>
            @endif  

            <div class="category">
                <h3>Category</h3>
                <a href="{{ route('view.hotel-event') }}" class="btn btn-outline-dark">Hotel Event</a>
                <a href="{{ route('view.aud-event') }}" class="btn btn-outline-dark">Auditorium Event</a>
                <a href="{{ route('view.concert-event') }}" class="btn btn-outline-dark">Concert</a>
                <a href="{{ route('view.top-event') }}" class="btn btn-outline-dark">Top Rated Organizer</a>
                <a href="{{ route('view.free-event') }}" class="btn btn-outline-dark">Free Event</a>
            </div>

            <div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-sm">
                            <h4>Upcoming Events</h4>
                        </div>
                        <div class="col-sm">
                            <div class="" style="text-align: right">
                                <a href="{{ route('view.upcoming-event') }}" class="btn btn-sm btn-primary">More</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div>
                        <div class="container bg-light my-4 p-3" style="position: relative;">
                            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                @foreach ($upcoming as $event)
                                    <div class="col">
                                        <div class="home-page">
                                            <div class="card shadow" width="100%"> 
                                                <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <div class="clearfix mb-3"> 
                                                        <span class="float-start badge rounded-pill bg-primary">{{ $event->category }}</span> 
                                                        @if ($event->cost_type == 'Free')
                                                            <span class="float-end price-hp text-success">Free</span>
                                                        @else
                                                            <span class="float-end price-hp text-success">{{ $event->rate }}</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h3>{{ $event->name }}</h3>
                                                        <h6>{{ $event->address->name }}</h6>
                                                        <p class="text-muted">{{ $event->date }}</p>
                                                    </div>
                                                    <div class="text-center my-4"> 
                                                        <a href="{{ route('view.event-detail', ["id"=>$event->id]) }}" class="btn btn-danger">View</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            {{-- This Month --}}
            <div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <h4>This Month</h4>
                    </div>
                    <div class="col-sm">
                        <div class="" style="text-align: right">
                        <a href="{{ route('view.this-month-event') }}" class="btn btn-primary btn-sm">More</a>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="container bg-light my-4 p-3" style="position: relative;">
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">

                        @foreach ($thisMonth as $event)
                            <div class="col">
                                <div class="home-page">
                                    <div class="card shadow" width="100%"> 
                                        <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3"> 
                                                <span class="float-start badge rounded-pill bg-primary">{{ $event->category }}</span> 
                                                @if ($event->cost_type == 'Free')
                                                    <span class="float-end price-hp text-success">Free</span>
                                                @else
                                                    <span class="float-end price-hp text-success">{{ $event->rate }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h3>{{ $event->name }}</h3>
                                                <h6>{{ $event->address->name }}</h6>
                                                <p class="text-muted">{{ $event->date }}</p>
                                            </div>
                                            <div class="text-center my-4"> 
                                                <a href="{{ route('view.event-detail', ["id"=>$event->id]) }}" class="btn btn-danger">View</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            {{--  --}}

            {{-- Poll --}}
            <div>
                <div class="card card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="fw-bold text-muted d-flex justify-content-center m-5" style="font-size:20px;">
                                <p>Vote your favorite event</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('save-poll') }}" method="post" class="mt-2">
                                @csrf
                                @foreach ($events as $event)
                                    <div class="radio">
                                        <label><h4><input type="radio" name="poll_event" class="" value="{{ $event->id }}" />{{ $event->name }}</h4></label>
                                    </div>
                                @endforeach
                                <input type="submit" class="btn btn-sm btn-success" />
                            </form>
                        </div>

                    </div> 
                </div>
            </div>
            {{-- End Poll --}}
            
        </div>

    </div>
@endsection