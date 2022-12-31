@extends('layouts.admin-app')
@section('content')

<div class="container">
    <div class="row m-4">

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>TOTAL EVENTS</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalEvent }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>HOTEL EVENTS</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $hotelEvent }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>CONCERT EVENTS</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $concertEvent }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>AUD EVENTS</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $audEvent }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>Ticket Sold</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $ticketSold }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>Rating</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md">
                            <div class="h5 mb-0 fw-bold text-gray-800">Consumers: {{ $totalRating }}</div>
                        </div>
                        <div class="col-md">
                            <div class="h5 mb-0 fw-bold text-gray-800">Rated: {{ $avgRating }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="">
                        <div class="fw-bold text-secondary mb-1">
                            <h5>Earned</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $earned }}</div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection