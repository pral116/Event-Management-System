@extends('layouts.user-app')
@section('content')

    <div class="content-container">
        <div class="container-fluid m-3">
            <a href="{{ route('view.event-detail', ["id"=>$detail->id]) }}" class="btn btn-outline-secondary">&larr;</a>
            <i><h3 class="text-primary text-center">{{ $detail->name }}</h3></i>

            <div id="map" style="height:400px; " class="my-4 m-3"></div>

            <script>
                let map;
                function initMap() {
                    showMap = new google.maps.Map(document.getElementById("map"), {
                        center: { lat: {{ $detail->latitude }}, lng: {{ $detail->longitude }} },
                        zoom: 12,
                        scrollwheel: true,
                    });

                    const mark = { lat: {{ $detail->latitude }}, lng: {{ $detail->longitude }} };
                    let marker = new google.maps.Marker({
                        position: mark,
                        map: showMap,
                        draggable: false
                    });
                }
            </script>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfCmqXXGrHcFZc32ioKRq_aMaVVRedrQU&callback=initMap"
                type="text/javascript"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        </div>
    </div>
    
@endsection