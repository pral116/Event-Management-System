@extends('layouts.admin-app')
@section('content')

<div class="content-container">
    <div class="row event-type">
        <div class="col-md-2">
            <a href="{{ route('admin.view-concert') }}" style="text-decoration:none" class="btn text-dark">
                <div class="card bg-light">
                    <div class="card-body">
                        <p>Concert</p>
                            <i class="fa fa-plus"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.view-hotel') }}" style="text-decoration:none" class="btn text-dark">
                <div class="card bg-light">
                    <div class="card-body">
                        <p>Hotel</p>
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.view-aud') }}" style="text-decoration:none" class="btn text-dark">
                <div class="card bg-light">
                    <div class="card-body">
                        <p>Audotorium</p>
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
    
@endsection