@extends('layouts.app')
@section('content')
    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-4">
        <a href="{{ route('produk.create') }}">
            <button
                class="w-full sm:w-auto bg-primary flex justify-center items-center px-4 py-2 hover:bg-primary/90 duration-300 transition-colors text-white font-bold rounded-md">
                Tambah Produk
            </button>
        </a>
        <form method="GET" action="{{ route('produk.index') }}" class="w-full sm:w-auto" autocomplete="off">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-primary">
                <tr>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Aksi</th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Foto
                    </th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Nama Produk
                    </th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Deskripsi
                    </th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Harga</th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Jenis Kue</th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Keterangan
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($produks as $produk)
                    <tr>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800 flex gap-2 items-center">
                            <a href="{{ route('produk.edit', $produk->id) }}">
                                <i
                                    class="fa-solid fa-pencil text-green-500 hover:text-green-700 text-lg duration-300 ease-in-out"></i>
                            </a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i
                                        class="fa-solid fa-trash text-red-400 hover:text-red-700 duration-300 ease-in-out"></i>
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800"><img src="{{ asset($produk->foto) }}"
                             class="w-[75px]"   alt="">
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">{{ $produk->nama_produk }}
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800"><p class="line-clamp-2">{{ $produk->deskripsi }}</p>
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">Rp
                            {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">{{ $produk->jenis_kue }}</td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">
                            <p class="line-clamp-2">{{ $produk->status }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-xs sm:text-sm text-gray-500">
                            Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3 flex justify-center">
            {{ $produks->links() }}
        </div>
    </div>
@endsection
