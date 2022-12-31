@extends('layouts.user-app')
@section('content')
    
    <div class="container mt-5">

        <div class="text-center">
            @if (Session::has('success'))
                <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div class="fw-bold text-danger" style="font-size:30px;">{{ Session::get('fail') }}</div>                        
            @endif
        </div>

        <div>
            <ul>
                <li><a href="" class="btn btn-md bg-danger" onclick="return false;"></a> Booked</li>
                <li><a href="" class="btn btn-md bg-success" onclick="return false;"></a> Available</li>
            </ul>
        </div>
        <div class="card shadow bg-light">
            <div class="card-body">
                @foreach ($tables as $table)
                    @if ( (\App\Models\TableBooking::where('table_id', $table->id)->count()) > 0 )
                        <a href="#" class="btn btn-sm shadow btn-danger m-2" onclick="return false;">
                            <p>Table -> {{ $table->table_no }}</p>
                            <span>Capacity -> {{ $table->seat }}</span>     
                        </a>
                    @else
                        <a href="{{ route('table-booking-detail', ['id' => $table->id]) }}" class="btn btn-sm shadow btn-success m-2">
                            <p>Table -> {{ $table->table_no }}</p>
                            <span>Capacity -> {{ $table->seat }}</span>     
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

    </div>

@endsection