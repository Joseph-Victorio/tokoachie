@extends('layouts.client')

@section('content')
    <div class="p-6 bg-[#5A2B0C] min-h-screen flex justify-center items-start">
        <div class="flex flex-col md:flex-row gap-6 max-w-4xl bg-[#5A2B0C] text-white">
            <!-- Product Image -->
            <div class="w-[300px] h-[300px] bg-gray-200 rounded-lg overflow-hidden">
                <img src="{{ asset($produk->foto) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="flex-1">
                <h2 class="text-3xl font-semibold font-sansita italic mb-2">{{ $produk->nama_produk }}</h2>
                <p class="text-yellow-400 font-bold text-xl mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p class="text-sm text-white leading-relaxed mb-6">
                    {{ $produk->deskripsi }}
                </p>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <!-- Quantity Controls -->
                    <div class="flex items-center border border-white rounded overflow-hidden text-white">
                        <button type="button" onclick="adjustQuantity(-1)"
                            class="px-3 py-1 bg-white text-[#5A2B0C] text-xl hover:bg-gray-200">−</button>
                        <input id="quantity" name="quantity" type="text" value="1" readonly
                            class="w-12 text-center bg-transparent border-none text-white font-bold">
                        <button type="button" onclick="adjustQuantity(1)"
                            class="px-3 py-1 bg-white text-[#5A2B0C] text-xl hover:bg-gray-200">+</button>
                    </div>

                    <button type="submit"
                        class="bg-white text-[#5A2B0C] px-5 py-2 rounded-full font-semibold hover:bg-yellow-200 transition">
                        Tambah Produk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Quantity Script -->
    <script>
        function adjustQuantity(amount) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            value = isNaN(value) ? 1 : value + amount;
            if (value < 1) value = 1;
            input.value = value;
        }
    </script>
@endsection
