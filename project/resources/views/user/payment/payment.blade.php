@extends('layouts.user-app')
@section('content')

    <div class="container m-5 text-center text-muted">

        <table class="table" width="100%">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>quantity</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $email }}</td>
                    <td>{{ $phone }}</td>
                    <td>{{ $quantity }}</td>
                    <td>{{ $event->rate }}</td>
                    <td>{{ $total }}</td>
                </tr>
            </tbody>
        </table>

        <div>
            <a href="{{ route('buy-ticket', ["id" => $event->id]) }}" class="btn btn-success">Previous</a>
            <button id="payment-button" class="btn btn-primary">Pay with Khalti</button>
        </div>

    </div>

    {{-- @php
        $email = $email;
        $phone = $phone;
        $quantity = $quantity;
        $total = $total;
        $event_id = $event->id;
        $rate = $event->rate;
    @endphp --}}

    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "{{ config('app.public_key') }}",
            "productIdentity": "{{ $event->id }}",
            "productName": "{{ $event->name }}",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    $.ajax({
                        type: "POST",
                        url: "{{ route('verifyPayment') }}",
                        data: {
                            token: payload.token,
                            amount: payload.amount,
                            "_token": "{{ csrf_token() }}",
                            // email: "{{ $email }}",
                            // phone: "{{ $phone }}",
                            // quantity: "{{ $quantity }}",
                        },
                        success: function(res){
                            $.ajax({
                                type: "POST",
                                url: "{{ route('storePayment') }}",
                                data: {
                                    response: res,
                                    token: payload.token,
                                    "_token": "{{ csrf_token() }}",
                                }
                            });
                            console.log(res);
                        }
                    });
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: {{ $total }}*100 });
        }
    </script>

@endsection