<nav x-data="{ open: false }" class="relative z-50 bg-tersier">
    <div class="m-5 p-5 font-sansita text-secondary flex justify-between items-center">

        <div>
            <h2 class="text-2xl font-bold text-primary">Toko Achie</h2>
        </div>
        <a href="{{ route('cart.show') }}" class="relative md:hidden">
            <img src="{{ asset('/gambar/shopping_cart.svg') }}" alt="keranjang belanja" class="w-7">
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
                {{ collect(session('cart', []))->sum('quantity') }}
            </span>
        </a>

        <div class="sm:hidden">
            <button @click="open = true" class="text-primary focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>


        <div
            class="hidden sm:flex space-x-8 text-secondary bg-primary rounded-2xl justify-center items-center px-10 py-2">
            <x-nav-link :href="route('beranda')" :active="request()->routeIs('beranda')">
                {{ __('Beranda') }}
            </x-nav-link>
            <x-nav-link :href="route('tentang-kami')" :active="request()->routeIs('tentang-kami')">
                {{ __('Tentang Kami') }}
            </x-nav-link>
            <x-nav-link :href="route('produk')" :active="request()->routeIs('produk')">
                {{ __('Produk') }}
            </x-nav-link>
        </div>


        <div class="hidden sm:flex gap-2 items-center">
            <a href="{{ route('cart.show') }}" class="relative">
                <img src="{{ asset('/gambar/shopping_cart.svg') }}" alt="keranjang belanja" class="w-7">
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
                    {{ collect(session('cart', []))->sum('quantity') }}
                </span>
            </a>
            <div class="bg-primary px-5 py-2 rounded-2xl">
                <a href="https://wa.me/62895612525607" class="flex gap-1 items-center">
                    <img src="{{ asset('/gambar/phone.svg') }}" alt="" class="w-5">Konsultasi
                </a>
            </div>
        </div>
    </div>


    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-primary text-secondary flex flex-col justify-center items-center space-y-8 p-6 sm:hidden">

        <button @click="open = false" class="absolute top-5 right-5 text-secondary focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        <x-nav-link @click="open = false" :href="route('beranda')" :active="request()->routeIs('beranda')">
            {{ __('Beranda') }}
        </x-nav-link>
        <x-nav-link @click="open = false" :href="route('tentang-kami')" :active="request()->routeIs('tentang-kami')">
            {{ __('Tentang Kami') }}
        </x-nav-link>
        <x-nav-link @click="open = false" :href="route('produk')" :active="request()->routeIs('produk')">
            {{ __('Produk') }}
        </x-nav-link>


        <div class="flex gap-4 items-center mt-4">

            <div class="bg-white text-primary px-6 py-3 rounded-2xl">
                <a href="https://wa.me/62895612525607" class="flex gap-2 items-center">
                    <img src="{{ asset('/gambar/phone.svg') }}" alt="" class="w-5">Konsultasi
                </a>
            </div>
        </div>
