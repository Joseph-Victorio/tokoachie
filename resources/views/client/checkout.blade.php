@extends('layouts.client')

@section('content')
    <div class="max-w-xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Pembayaran</h2>
        @foreach ($items as $item )
            <div class="flex gap-5 mt-2 items-center">
                <img src="{{ asset($item['foto']) }}" alt="" class="w-[75px]">
                <p>{{ $item['name'] }}</p>
                <p>{{ $item['quantity'] }} Pcs</p>
                <p>Rp{{ number_format($item['price'] * $item['quantity'],0,',','.') }}</p>
            </div>
        @endforeach
        <hr class="mt-5 border-2 border-primary">
        <p class="mb-2 text-2xl font-bold text-right">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>

        <button id="pay-button" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 ">
            Bayar Sekarang
        </button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran sukses!");
                    window.location.href = "{{ route('checkout.success') }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran...");
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                },
                onClose: function(){
                    alert("Kamu belum menyelesaikan pembayaran.");
                }
            });
        });
    </script>
@endsection
