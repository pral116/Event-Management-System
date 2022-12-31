@extends('admin.report.choose')
@section('report-section')
    
    <div class="container">

        <div class="row">
            <div class="col-md-11">
                {{-- <a href="" class="btn btn-outline-primary"><span>&#8592;</span></a> --}}
            </div>
            <div class="col-md-1">
                <button class="btn btn-sm btn-outline-primary active" onclick="window.print()">Print</button>
            </div>  
        </div>
    
        <div class="card card-body shadow-lg mt-1">
            <div class="text-center">
                <h4>{{ $event->name }}</h4>
                <p class="badge rounded-pill bg-primary p-2" style="font-size:15px;">{{ $event->category }}</p>
                <p>(Expenses Report)</p>
            </div>

            <div class="row">
                <div class="col-md">
                    
                </div>
                <div class="col-md" style="text-align: right">
                    <p>{{ $event->address->name }}</p>
                    <p>{{ $event->date }}</p>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="fw-bold">
                            <tr>
                                <th>S.N.</th>
                                <th>Purpose</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Total</th>
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
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <div>
                                <tr>
                                    <td colspan="4" style="text-align:left" class="fw-bold">Net Amount</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            </div>
                        </tfoot>

                    </table>
                </div>
            </div><hr>
                
            
        </div>

    </div>

@endsection