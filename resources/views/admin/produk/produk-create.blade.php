@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Produk</label>
                    <input type="file" name="foto" id="foto"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                </div>

                <!-- Jenis Kue -->
                <div>
                    <label for="jenis_kue" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kue</label>
                    <select name="jenis_kue" id="jenis_kue"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                        <option value="" disabled selected>Pilih Jenis Kue</option>
                        <option value="Chiffon">Chiffon</option>
                        <option value="Brownies">Brownies</option>
                        <option value="Bolen">Bolen</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2 lg:col-span-3">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required></textarea>
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="harga" id="harga"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-2 items-center">
                <div class="mt-6">
                    <a href="{{ route('produk.index') }}"
                       class="px-6 py-3 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition">
                        Kembali
                    </a>
                </div>
                <div class="mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
