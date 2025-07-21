@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-primary text-secondary">
                    <tr>
                        <th class="px-4 py-2">Nama Pembeli</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">No. Telepon</th>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Total (Rp)</th>
                        <th class="px-4 py-2">Catatan</th>
                        <th class="px-4 py-2">Tanggal Pesan</th>
                        <th class="px-4 py-2">Tanggal Kirim</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($pembelis as $pembeli)
                        <tr>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->nama_pembeli }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->alamat }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->telpon }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->nama_produk }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->jumlah }}</td>
                            <td class="px-4 py-2 text-gray-800">Rp {{ number_format($pembeli->total, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->note }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->tanggal_pesan }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $pembeli->tanggal_kirim }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pembelis->links() }}
            </div>
        </div>
    </div>
@endsection
