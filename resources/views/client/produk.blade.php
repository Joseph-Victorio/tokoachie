@extends('layouts.client')

@section('content')
<div class="w-full bg-tersier text-center">
    <h2 class="md:text-5xl p-5 font-sansita text-primary">Produk</h2>
    <br><br><br>
</div>
    <div class="p-5">
        <form method="GET" action="{{ route('produk') }}" class="w-full sm:w-auto" autocomplete="off">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
        </form>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1 px-4 md:px-10 mt-5">
            @foreach ($produks as $produk)
                <div
                    class="border-2 rounded-md p-5 flex flex-col items-center w-[300px]
                    {{ $produk->status === 'Habis' ? 'bg-gray-200 opacity-70 cursor-not-allowed' : 'bg-white' }}">

                    <img src="{{ asset($produk->foto) }}" alt="Foto {{ $produk->nama_produk }}"
                        class="rounded w-[220px]  border-2 border-black h-[200px] object-cover mb-4">
                    <div class="flex gap-5 items-center justify-between w-full">
                        <p class="text-xl font-bold mb-1 font-sansita text-primary">{{ $produk->nama_produk }}</p>
                        <p class="text-md mb-2 text-[#E09A04]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                    <br>
                    @if ($produk->status === 'Habis')
                        <span class="text-red-500 font-semibold mt-2">Habis</span>
                    @else
                        <a href="{{ route('produk.detail', $produk->id) }}" class="w-full"> <button type="submit"
                                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary/90 transition font-sansita w-full">
                                Lihat Produk
                            </button></a>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
@endsection
