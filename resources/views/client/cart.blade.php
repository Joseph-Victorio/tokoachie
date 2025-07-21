@extends('layouts.client')

@php
    $cart = session('cart', []);
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['harga'] * $item['quantity'];
    }
@endphp

@section('content')
<div class="max-w-2xl mx-auto py-8 space-y-8 text-[#5A2B0C] font-sansita">

    {{-- Cart Items --}}
    @foreach ($cart as $item)
    <div class="bg-white rounded-lg shadow p-4 flex flex-col sm:flex-row items-center justify-between">
        <div class="flex items-center gap-4">
            <img src="{{ asset($item['foto']) }}" alt="" class="w-20 h-20 object-cover rounded bg-[#B97D52]">
            <div>
                <p class="font-bold text-lg">{{ $item['nama_produk'] }}</p>
                <p class="text-sm text-yellow-600 font-semibold">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="flex gap-4 mt-4 sm:mt-0">
            <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                @csrf
                <input type="hidden" name="action" value="decrease">
                <button class="px-2 py-1 bg-gray-200 rounded text-xl">-</button>
            </form>
            <span class="text-lg font-semibold">{{ $item['quantity'] }}</span>
            <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                @csrf
                <input type="hidden" name="action" value="increase">
                <button class="px-2 py-1 bg-gray-200 rounded text-xl">+</button>
            </form>
            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                @csrf
                <button class="text-red-600 text-sm">✕</button>
            </form>
        </div>
    </div>
    @endforeach

    {{-- Formulir Pembeli --}}
    <div class="bg-[#FDF6ED] p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-primary ">Formulir Pembeli</h2>
        <form id="pembeliForm" class="text-primary">
            @csrf
            <div class="space-y-3">
                <div>
                    <label>Nama Pembeli *</label>
                    <input type="text" name="nama_pembeli" required class="w-full p-2 rounded bg-gray-100 border">
                </div>
                <div>
                    <label>Nomor Telepon *</label>
                    <input type="text" name="telpon" required class="w-full p-2 rounded bg-gray-100 border">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label>Tanggal Pemesanan *</label>
                        <input type="date" name="tanggal_pesan" required class="w-full p-2 rounded bg-gray-100 border">
                    </div>
                    <div>
                        <label>Tanggal Pengiriman *</label>
                        <input type="date" name="tanggal_kirim" required class="w-full p-2 rounded bg-gray-100 border">
                    </div>
                </div>
                <div>
                    <label>Alamat *</label>
                    <textarea name="alamat" rows="2" required class="w-full p-2 rounded bg-gray-100 border"></textarea>
                </div>
                <div>
                    <label>Catatan</label>
                    <textarea name="note" rows="2" class="w-full p-2 rounded bg-gray-100 border"></textarea>
                </div>
            </div>
        </form>
    </div>

    {{-- Total Section --}}
    <div class="bg-[#FDF6ED] p-6 rounded-lg shadow text-sm font-anek">
        <h3 class="text-lg font-bold mb-3 text-center font-sansita ">Total Pesanan</h3>
        <div class="grid grid-cols-2 gap-2">
            <p>Total Produk:</p>
            <p class="text-right">{{ collect($cart)->sum('quantity') }}</p>
            <p>Total Harga:</p>
            <p class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        <button id="checkout-button" class="w-full mt-6 bg-[#5A2B0C] hover:bg-[#7A3E17] text-white py-2 rounded font-sansita">
            Pesan Produk
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.getElementById('checkout-button').addEventListener('click', function () {
        const form = document.getElementById('pembeliForm');
        const formData = new FormData(form);

        fetch("{{ route('pembeli.ajax.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        window.location.href = "/checkout/success";
                    },
                    onPending: function (result) {
                        window.location.href = "/checkout/success";
                    },
                    onError: function (result) {
                        alert("Terjadi kesalahan pembayaran.");
                    },
                    onClose: function () {
                        alert("Anda menutup popup sebelum menyelesaikan pembayaran.");
                    }
                });
            } else {
                alert(data.message || 'Terjadi kesalahan saat memproses data.');
            }
        })
        .catch(err => {
            console.error(err);
            alert("Gagal terhubung ke server.");
        });
    });
</script>
@endsection
