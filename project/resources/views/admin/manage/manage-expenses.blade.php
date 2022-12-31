@extends('layouts.admin-app')
@section('content')

    <div class="container-fluid">

        <div>

            <div class="text-center">
                @if (Session::has('success'))
                    <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                @endif
            </div>

            <div class="card mb-2 text-center bg-light p-4">
                <h5>Expenses - {{ $event->name }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                           $i = 0; 
                        @endphp
                        @foreach ($eventExpenses as $expenses)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $expenses->purpose }}</td>
                            <td>{{ $expenses->quantity }}</td>
                            <td>{{ $expenses->rate }}</td>
                            <td>{{ $expenses->total }}</td>
                            <td>
                                <a href="{{ route('admin.allocate-expenses-edit', ['id'=>$expenses->id]) }}" class="btn btn-sm btn-primary mb-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.allocate-expenses-delete', ['id'=>$expenses->id]) }}" class="btn btn-sm btn-danger mb-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Record in expenses form --}}
        <div class="card card-body m-3"> 
            <h3 class="text-center mb-3 text-primary text-decoration-underline">Record Expenses</h3>

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

            <form action="{{ route('admin.expenses-allocate', ['id'=>$event->id]) }}" method="POST" class="row fw-bold mt-3">
                @csrf
                <div class="col-md">
                    <label for="">Purpose:</label>
                    <input type="text" name="purpose" class="shadow" value="{{ old('purpose') }}">
                </div>

                <div class="col-md">
                    <label for="">Quantity:</label>
                    <input type="number" name="quantity" class="shadow" value="{{ old('quantity') }}">
                </div>

                <div class="col-md">
                    <label for="">Rate:</label>
                    <input type="number" name="rate" class="shadow" value="{{ old('rate') }}">
                </div>

                {{-- <div class="col-md">
                    <label for="">Date</label>
                    <input type="date" name="date">
                </div> --}}
                <div class="text-center mt-4">
                    <input type="submit" value="ADD" class="btn btn-md btn-primary">
                </div>
            </form>
        </div>

    </div>
    
@endsection