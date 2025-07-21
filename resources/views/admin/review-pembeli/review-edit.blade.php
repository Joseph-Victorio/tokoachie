@extends('layouts.app')

@section('content')
    <form action="{{ route('review.store', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Foto -->
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                @if ($review->foto)
                    <div class="mb-2">
                        <img src="{{ asset($review->foto) }}" alt="Foto review" class="w-32 rounded shadow">
                    </div>
                @endif
                <input type="file" name="foto" id="foto"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengubah foto</p>
            </div>

            <!-- Nama -->
            <div>
                <label for="nama_klien" class="block text-sm font-medium text-gray-700 mb-1">Nama Klien</label>
                <input type="text" name="nama_klien" id="nama_klien"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $review->nama_klien }}" required>
            </div>

            <!-- isi_review -->
            <div class="md:col-span-2 lg:col-span-3">
                <label for="isi_review" class="block text-sm font-medium text-gray-700 mb-1">Isi Review</label>
                <textarea name="isi_review" id="isi_review" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>{{ $review->isi_review }}</textarea>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="flex gap-2 items-center">
            <div class="mt-6">
                <a href="{{ route('review.index') }}"
                    class="px-6 py-3 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition">
                    Kembali
                </a>
            </div>
            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </div>
    </form>
@endsection
