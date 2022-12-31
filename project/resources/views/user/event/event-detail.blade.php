@extends('layouts.user-app')
@section('content')
    
<div class="container">
    <div>
        <div class="event-detail text-center">
            <img src="{{ asset('images/' . $detail->image) }}">
        </div><hr>

        <div class="row">

            <div class="col-md-6 mt-3">
                <div class="card bg-light">

                    <div class="m-3">
                        <h5>Event Organized By</h5>
                        <h6 class="badge rounded-pill bg-primary">{{ $detail->user->name }}</h6>
                        <div>
                            @php
                                $value = number_format($avgRating)
                            @endphp
                            @for ($i = 1; $i <= $value; $i++)
                                <i class="fa fa-star text-warning"></i>
                            @endfor
                            @for ($j = $value + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            
                            <span>({{ $totalRatings->count() }} ratings)</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="mt-3 fst-italic text-decoration-underline">Rate {{ $detail->user->name }}</h3>
                        <div class="rating">
                            <form action="{{ route('store.rating') }}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $detail->id }}">
                                <div>
                                    @if ($userRating)
                                        @for ($i = 1; $i <= $userRating->rating; $i++)
                                            <input class="d-none" type="radio" value="" name="rating" checked id="rating{{ $i }}">
                                            <label for="rating{{ $i }}"><i class="fa fa-star"></i></label>
                                        @endfor
                                        @for ($j = $userRating->rating + 1; $j <= 5; $j++)
                                            <input class="d-none" type="radio" value="" name="rating" id="rating{{ $j }}">
                                            <label for="rating{{ $j }}"><i class="fa fa-star"></i></label>
                                        @endfor

                                    @else
                                        <input class="d-none" type="radio" value="1" name="rating" checked id="rating1">
                                        <label for="rating1"><i class="fa fa-star"></i></label>
                                        <input class="d-none" type="radio" value="2" name="rating" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input class="d-none" type="radio" value="3" name="rating" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input class="d-none" type="radio" value="4" name="rating" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input class="d-none" type="radio" value="5" name="rating" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    @endif
                                    
                                </div>

                                <div>
                                    <input type="submit" name="Submit" class="btn btn-primary mb-2">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                    @endif
                </div>
                
            </div>
            
            <div class="col-md-6">
                <div class="card card-body bg-light mt-4">
                    <div class="ms-3 mt-2 text-center">
                        <h1>{{ $detail->name }}</h1>
                        <h5 class="badge rounded-pill bg-secondary">{{ $detail->address->name }}</h5>
                        <h5>Event Type: {{ $detail->category }}</h5>
                        <p>Date: {{ $detail->date }}</p>
                        <div class="row">
                            <div class="col-sm">
                                <div>Ticket Left</div>
                                @if ($detail->cost_type == 'Free')
                                    <h3 class="text-success">-</h3>
                                @else
                                    <h3 class="text-success">{{ $detail->ticket_quantity - $bookedTicket }}</h3>
                                @endif
                            </div>
                            <div class="col-sm">
                                <div>Rate</div>
                                @if ($detail->cost_type == 'Free')
                                    <h3 class="text-success">Free</h3>
                                @else
                                    <h3 class="text-success">{{ $detail->rate }}</h3>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-center">
                        @if ($detail->cost_type == 'Free' || ($detail->ticket_quantity - $bookedTicket) == 0)
                            <div>
                                <a href="{{ route('buy-ticket', ["id"=>$detail->id]) }}" onclick="return false;" class="btn btn-primary m-2">Buy Ticket</a>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('buy-ticket', ["id"=>$detail->id]) }}" class="btn btn-primary m-2">Buy Ticket</a>
                            </div>
                        @endif

                        @if ($tableExist->count() > 0)
                            @if (Session::has('user'))
                                @if ( \App\Models\Ticket::where('event_id', $detail->id)->where('user_id', $user->id)->count() > 0 )
                                    <a href="{{ route('show-tables', ["id"=>$detail->id]) }}" class="btn btn-primary m-2">Book Table</a>
                                @else
                                    <a href="{{ route('show-tables', ["id"=>$detail->id]) }}" onclick="return false;" class="btn btn-primary m-2">Book Table</a>
                                @endif
                            @endif
                        @endif

                        <div>
                            <a href="{{ route('show-location', ["id"=>$detail->id]) }}" class="btn btn-success m-2">Open in Map</a>
                        </div>
                        
                    </div>

                </div>
            </div>
            
        </div>

    </div><hr>

    <div class="mt-4">
        <h4>About Event</h4>
        <p>{{ $detail->description }}</p>
    </div>

    @yield('show_map')
        
</div>

@endsection