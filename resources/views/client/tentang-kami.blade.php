@extends('layouts.client')

@section('content')
<div class="w-full bg-tersier text-center">
    <h2 class="md:text-5xl p-5 font-sansita text-primary">Tentang Kami</h2>
    <br><br><br>
</div>
    <!-- TENTANG KAMI SECTION -->
    <section class="bg-primary py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center gap-8 px-4 md:px-10">
            <!-- Image -->
            <div class="flex-1 w-full flex justify-center mb-6 md:mb-0 ">
                <img src="{{ asset('/gambar/kuesalju.png') }}" alt="Tentang Kami"
                    class="w-full max-w-xs md:max-w-md rounded-md">
            </div>
            <!-- Text -->
            <div class="flex-1 w-full text-justify ">
                <h1 class="font-sansita font-bold text-tersier  text-4xl md:text-5xl mb-4">Tentang Kami</h1>
                <p class="mb-4 text-tersier">
                    Toko Achie adalah usaha rumahan yang berdiri sejak 2022 dan bergerak di bidang penjualan kue basah,
                    kue kering, dan berbagai dessert. Setiap produk dibuat secara homemade dengan perhatian pada kualitas
                    rasa dan tampilan.
                </p>
                <p class="mb-6 text-tersier">
                    Kini, Toko Achie hadir secara digital untuk memudahkan pelanggan dalam melihat menu dan melakukan
                    pemesanan. Rasakan manisnya momen spesial dengan pilihan kue terbaik dari Toko Achie.
                </p>
               
            </div>
        </div>
    </section>
    <section class=" p-5 py-12">
        <h2 class="font-sansita text-3xl text-primary text-center">Lokasi Toko Kami</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6070580739984!2d106.8539983731667!3d-6.183312860581517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f450fc1cc8bb%3A0xe64503c7e531cf67!2sJl.%20johar%20Baru%20Utara%20II%20No.3%2C%20RT.3%2FRW.3%2C%20Johar%20Baru%2C%20Kec.%20Johar%20Baru%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010560!5e0!3m2!1sen!2sid!4v1752419262934!5m2!1sen!2sid"
             style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="mx-auto mt-5 md:w-[800px] md:h-[300px]"></iframe>
    </section>
@endsection
