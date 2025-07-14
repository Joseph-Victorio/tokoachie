<div x-data="{ open: false }" class="relative min-h-screen flex bg-background">

    <!-- Mobile overlay menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 bg-primary text-white sm:hidden flex flex-col p-6 space-y-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold">Menu</h2>
            <button @click="open = false" class="focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Links -->
        <a href="{{ route('dashboard') }}" @click="open = false"
            class="block text-lg py-2 hover:underline">Dashboard</a>
        <a href="{{ route('produk.index') }}" @click="open = false"
            class="block text-lg py-2 hover:underline">Produk</a>
        <a href="{{ route('review.index') }}" @click="open = false" class="block text-lg py-2 hover:underline">Review
            Pembeli</a>

        <div class="mt-auto pt-4 border-t border-white">
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="mt-1 text-left block w-full text-lg hover:underline">Log Out</button>
            </form>
        </div>
    </div>

    <!-- Sidebar (desktop) -->
    <aside class="hidden sm:flex sm:flex-col w-64 bg-primary border-r shadow-md p-6 space-y-6">
        <div class="flex items-center space-x-2">
            <a href="{{ route('dashboard') }}">
                <span class="text-xl font-bold text-secondary font-sansita">Toko Achie</span>
            </a>

        </div>

        <nav class="flex flex-col space-y-2 font-anek">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('produk.index')" :active="request()->routeIs('produk.index')">
                {{ __('Produk') }}
            </x-nav-link>
            <x-nav-link :href="route('review.index')" :active="request()->routeIs('review.index')">
                {{ __('Review Pembeli') }}
            </x-nav-link>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="mt-1 text-left block w-full text-lg hover:underline text-secondary">Log
                    Out</button>
            </form>
        </nav>


    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar (mobile only) -->
        <header class="sm:hidden flex items-center justify-between bg-white border-b shadow p-4">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="h-8 w-auto fill-current text-gray-800" />
            </a>
            <button @click="open = true" class="focus:outline-none text-gray-700">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </header>

        <main class="flex-1 overflow-auto p-6">
            {{ $slot ?? '' }}
        </main>
    </div>
</div>
