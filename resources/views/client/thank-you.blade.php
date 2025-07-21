@extends('layouts.client')

@section('content')
    @php
        $message = "Halo, saya telah melakukan pemesanan:\n\n";
        $message .= " Nama: {$order->nama_pembeli}\n";
        $message .= " Produk: {$order->nama_produk}\n";
        $message .= " Tanggal Pesan: {$order->tanggal_pesan}\n";
        $message .= " Tanggal Kirim: {$order->tanggal_kirim}\n";
        $message .= "\nMohon konfirmasi lebih lanjut, terima kasih! ";
        $waUrl = 'https://wa.me/62895612525607?text=' . urlencode($message);
    @endphp

    <div class="max-w-xl mx-auto px-4 py-12 text-center text-[#5A2B0C]">
        <h1 class="text-3xl font-bold text-secondary mb-4">Terima Kasih!</h1>
        <p class="text-lg text-secondary">Pembayaran Anda telah berhasil dikonfirmasi.</p>

        <div class="flex w-full justify-center gap-5">
            <a href="/"
                class="inline-block mt-6 px-6 py-3 bg-[#5A2B0C] text-white font-semibold rounded-md hover:bg-[#7A3E17] transition-all duration-300">
                Kembali
            </a>

            <a href="{{ $waUrl }}"
                class="inline-block mt-6 px-6 py-3 bg-[#5A2B0C] text-white font-semibold rounded-md hover:bg-[#7A3E17] transition-all duration-300">
                Menuju WhatsApp
            </a>
        </div>
    </div>
@endsection
