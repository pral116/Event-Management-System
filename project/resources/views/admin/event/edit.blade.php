@extends('layouts.admin-app')
@section('content')

    <div class="content-container">
        <div class="container-fluid">

            <a href="/admin/my-event" class="btn btn-outline-secondary">&larr;</a>
            <i><h3 class="text-primary">Edit Event</h3></i>

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

            <form method="POST" action="{{ route('admin.update-event', ["id"=>$id]) }}" class="m-3" enctype="multipart/form-data" >
                @csrf
                <div>
                    <label for="">Event Name</label>
                    <input type="text" name="name" class="form-control block shadow-sm w-50 italic" value="{{ $event->name }}">
                </div>

                <div class="mt-4">
                    <label for="">City</label>
                    <select name="city">
                        <option value="">--Select--</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="form-group col-md">
                        <input type="text" hidden class="form-control input-sm"  name="lat" id="lat" value={{ $event->latitude }}>
                    </div>

                    <div class="form-group col-md">
                        <input type="text" hidden class="form-control input-sm"  name="lng" id="lng" value={{ $event->longitude }}>
                    </div>
                </div>

                <div id="map" style="height:300px; width: 60%;" class="my-4"></div>

                <script>
                    let map;
                    function initMap() {
                        showMap = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: {{ $event->latitude }}, lng: {{ $event->longitude }} },
                            zoom: 12,
                            scrollwheel: true,
                        });

                        const mark = { lat: {{ $event->latitude }}, lng: {{ $event->longitude }} };
                        let marker = new google.maps.Marker({
                            position: mark,
                            map: showMap,
                            draggable: true
                        });
                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })
                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
                    }
                </script>

                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfCmqXXGrHcFZc32ioKRq_aMaVVRedrQU&callback=initMap"
                    type="text/javascript"></script>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


                <div class="mt-3">
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control block shadow-sm w-50 italic" value="{{ $event->date }}">
                </div>

                <div class="mt-4">
                    <label for="">Type</label>
                    <select name="cost_type">
                        <option value="Paid">Paid</option>
                        <option value="Free">Free</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label for="">Ticket Count</label>
                    <input type="number" name="ticket_quantity" class="form-control block shadow-sm w-50 italic" value="{{ $event->ticket_quantity }}">
                </div>

                <div class="mt-3">
                    <label for="">Ticket Rate</label>
                    <input type="number" name="ticket_rate" class="form-control block shadow-sm w-50 italic" value="{{ $event->rate }}">
                </div>

                <div class="mt-3">
                    <label for="">Image</label>
                    <input type="file" name="image" accept="image/png, image/jpeg">
                </div>

                <div class="mt-3">
                    <label for="">Description</label>
                    <textarea id="description" name="description" class="form-control block shadow-sm w-50 italic" value="{{ $event->description }}" rows="4" cols="50"></textarea>
                </div>

                <div class="mt-3">
                    <input type="submit" value="Done" class="btn btn-lg btn-primary">
                </div>
            </form>

        </div>
    </div>
    
@endsection