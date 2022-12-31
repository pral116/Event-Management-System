@extends('user.event.filter')
@section('events')

    <div class="container">
        <hr>
        <div>
            @if ( (request()->is('user/upcoming-event')) )
                <div class="text-center text-primary">
                    <h4>Upcoming Events</h4>
                </div>
            @elseif ( (request()->is('user/this-month-event')) )
                <div class="text-center text-primary">
                    <h4>This Month</h4>
                </div>
            @elseif ( (request()->is('user/all-events')) )
            <div class="text-center text-primary">
                <h4>All</h4>
            </div>
            @elseif ( (request()->is('user/today-events')) )
            <div class="text-center text-primary">
                <h4>Today</h4>
            </div>
            @elseif ( (request()->is('user/tomorrow-events')) )
            <div class="text-center text-primary">
                <h4>Tomorrow</h4>
            </div>
            @elseif ( (request()->is('user/concert-event')) )
                <div class="text-center text-primary">
                    <h4>Concerts</h4>
                </div>
            @elseif ( (request()->is('user/aud-event')) )
                <div class="text-center text-primary">
                    <h4>Aud</h4>
                </div>
            @elseif ( (request()->is('user/hotel-event')) )
                <div class="text-center text-primary">
                    <h4>Hotel</h4>
                </div>
            @elseif ( (request()->is('user/free-event')) )
                <div class="text-center text-primary">
                    <h4>Enjoy Free Events</h4>
                </div>
            @elseif ( (request()->is('user/near-you-event')) )
                <div class="text-center text-primary">
                    <h4>Near You</h4>
                </div>
            @elseif ( (request()->is('user/top-event')) )
                <div class="text-center text-primary">
                    <h4>From Top Rated Organizer</h4>
                </div>
            @endif

            <div>
                <div class="container bg-light my-4 p-3" style="position: relative;">
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        @if ($events->count() > 0)
                            @foreach ($events as $event)
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
                        @else
                            <div class="text-muted">
                                <i><h4 style="font-size: 30px;">No Result Found</h4></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    
@endsection