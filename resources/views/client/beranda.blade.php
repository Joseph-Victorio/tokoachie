@extends('layouts.client')

@section('content')
    <!-- HERO SECTION -->
    <section class="bg-background py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center gap-8 px-4 md:px-10">
            <!-- Text -->
            <div class="flex-1 w-full text-justify">
                <h1 class="font-sansita font-bold text-primary text-4xl md:text-5xl mb-4">Toko Achie</h1>
                <p class="mb-4">
                    Toko Achie adalah usaha rumahan yang berdiri sejak 2022 dan bergerak di bidang penjualan kue basah,
                    kue kering, dan berbagai dessert. Setiap produk dibuat secara homemade dengan perhatian pada kualitas
                    rasa dan tampilan.
                </p>
                <p class="mb-6">
                    Kini, Toko Achie hadir secara digital untuk memudahkan pelanggan dalam melihat menu dan melakukan
                    pemesanan. Rasakan manisnya momen spesial dengan pilihan kue terbaik dari Toko Achie.
                </p>
                <a href="/produk"
                    class="inline-block font-sansita bg-primary text-secondary px-5 py-2 rounded-md hover:bg-primary/80">
                    Beli Sekarang →
                </a>
            </div>
            <!-- Image -->
            <div class="flex-1 w-full flex justify-center">
                <img src="{{ asset('/gambar/HeroKanan.png') }}" alt="Hero Image"
                    class="w-full max-w-xs md:max-w-md rounded-md ">
            </div>
        </div>
    </section>

    <!-- MENU FAVORIT SECTION -->
    <section class="bg-primary py-12">
        <h2 class="font-sansita text-3xl md:text-4xl text-background text-center mb-8">Menu Favorit</h2>
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4 md:px-10">
            <!-- Card 1 -->
            <div class="border-2 rounded-md border-black bg-background p-5 flex flex-col items-center">
                <img src="{{ asset('/gambar/bolen.png') }}" alt="Bolen" class="rounded-md w-full max-w-[250px] mb-4">
                <p class="font-sansita text-2xl mb-2">Bolen</p>
                <p class="font-anek text-sm text-center">
                    Kue bolen dengan isian pisang dan keju yang lumer, jadi salah satu menu paling diminati karena rasa
                    manis dan gurihnya yang pas.
                </p>
            </div>

            <div class="border-2 rounded-md border-black bg-background p-5 flex flex-col items-center">
                <img src="{{ asset('/gambar/Brownies.png') }}" alt="Brownies" class="rounded-md w-full max-w-[250px] mb-4">
                <p class="font-sansita text-2xl mb-2">Brownies</p>
                <p class="font-anek text-sm text-center">
                    Brownies favorit dengan rasa cokelat yang rich dan tekstur lembut, jadi andalan pelanggan di setiap
                    pesanan.
                </p>
            </div>

            <div class="border-2 rounded-md border-black bg-background p-5 flex flex-col items-center">
                <img src="{{ asset('/gambar/chiffon.png') }}" alt="Chiffon" class="rounded-md w-full max-w-[250px] mb-4">
                <p class="font-sansita text-2xl mb-2">Chiffon</p>
                <p class="font-anek text-sm text-center">
                    Chiffon cake lembut dan ringan dengan rasa manis yang seimbang, cocok untuk teman ngopi atau camilan
                    santai kapan saja.
                </p>
            </div>
        </div>
        <br><br>
    </section>



    <section class="border-y-4 border-black py-4 bg-background">
        <marquee behavior="scroll" direction="left" scrollamount="10">
            <p class="font-sansita text-3xl md:text-5xl text-primary">
                Toko Achie ~ Toko Achie ~ Toko Achie ~ Toko Achie ~ Toko Achie ~ Toko Achie ~ Toko Achie ~
            </p>
        </marquee>
    </section>
     <div class="bg-primary">
        <br><br><br><br><br><br>
    </div>
    <section class="bg-background py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center gap-8 px-4 md:px-10">
            <!-- Image -->
            <div class="flex-1 w-full flex justify-center mb-6 md:mb-0">
                <img src="{{ asset('/gambar/kuesalju.png') }}" alt="Tentang Kami"
                    class="w-full max-w-xs md:max-w-md rounded-md">
            </div>
            <!-- Text -->
            <div class="flex-1 w-full text-justify">
                <h1 class="font-sansita font-bold text-primary text-4xl md:text-5xl mb-4">Tentang Kami</h1>
                <p class="mb-4">
                    Toko Achie adalah usaha rumahan yang berdiri sejak 2022 dan bergerak di bidang penjualan kue basah,
                    kue kering, dan berbagai dessert. Setiap produk dibuat secara homemade dengan perhatian pada kualitas
                    rasa dan tampilan.
                </p>
                <p class="mb-6">
                    Kini, Toko Achie hadir secara digital untuk memudahkan pelanggan dalam melihat menu dan melakukan
                    pemesanan. Rasakan manisnya momen spesial dengan pilihan kue terbaik dari Toko Achie.
                </p>
                <a href="/produk"
                    class="inline-block font-sansita bg-primary text-secondary px-5 py-2 rounded-md hover:bg-primary/90">
                    Beli Sekarang →
                </a>
            </div>
        </div>
        
    </section>
    <div class="bg-primary">
        <br><br><br><br>
    </div>
    <section class=" py-8">
        <h2 class="font-sansita text-3xl md:text-5xl text-secondary text-center mb-8">Kata Mereka</h2>
        <div x-data="{ scroll: $refs.container }" class="relative">

            <div x-ref="container"
                class="flex overflow-x-hidden space-x-4 scroll-smooth snap-x snap-mandatory px-4 md:px-10 pb-4">
                @foreach ($reviews as $review)
                    <div class="flex-shrink-0 snap-center w-80 md:w-96 border-2 rounded-md border-black bg-background p-5 flex flex-col items-center"
                        style="height: 400px;">
                        <img src="{{ asset($review->foto) }}" alt="Foto"
                            class="rounded-full w-full max-w-[100px] mb-4 object-cover">
                        <p class="font-sansita text-2xl mb-2">{{ $review->nama_klien }}</p>
                        <p class="font-anek text-sm text-center overflow-auto">
                            {{ $review->isi_review }}
                        </p>
                    </div>
                @endforeach
            </div>


            <div class="flex justify-between mt-4 px-4 md:px-10">
                <button @click="scroll.scrollBy({left: -300, behavior: 'smooth'})"
                    class="bg-gray-300 text-black hover:bg-gray-500 transition-colors ease-in-out duration-300 px-4 py-2 rounded-md">
                    Prev
                </button>
                <button @click="scroll.scrollBy({left: 300, behavior: 'smooth'})"
                    class="bg-gray-300 text-black hover:bg-gray-500 transition-colors ease-in-out duration-300 px-4 py-2 rounded-md">
                    Next
                </button>
            </div>
        </div>


    </section>
@endsection
