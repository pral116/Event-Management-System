@extends('layouts.admin-app')
@section('content')

    <div class="content-container">
        <div class="text-center report-buttons">
            <a href="{{ route('admin.overall-report-view', ['id' => $event->id]) }}" class="text-decoration-none m-2 text-dark">Overall</a>
            <a href="{{ route('admin.staff-report-view', ["id"=>$event->id]) }}" class="text-decoration-none m-2 text-dark">Staff</a>
            <a href="{{ route('admin.expenses-report-view', ["id"=>$event->id]) }}" class="text-decoration-none m-2 text-dark">Expenses</a><hr>
        </div>

        @if ( (request()->is('admin/manage/report/*')) )
            <div class="fw-bold text-muted d-flex justify-content-center m-5" style="font-size:40px;">
                <p>View Overall/Staff/Expenses report</p>
            </div>
        @endif

        @yield('report-section')
    </div>
    
@endsection