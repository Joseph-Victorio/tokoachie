@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-4">
        <a href="{{ route('review.create') }}">
            <button
                class="w-full sm:w-auto bg-primary flex justify-center items-center px-4 py-2 hover:bg-primary/90 duration-300 transition-colors text-white font-bold rounded-md">
                Tambah review
            </button>
        </a>
       
    </div>
    <div class="overflow-x-auto ">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-primary">
                <tr>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Aksi</th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Foto
                    </th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Nama Client
                    </th>
                    <th class="px-4 py-2 text-left text-xs sm:text-sm font-medium text-secondary">Isi Review
                    </th>
                   
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($reviews as $review)
                    <tr>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800 flex gap-2 items-center">
                            <a href="{{ route('review.edit', $review->id) }}">
                                <i
                                    class="fa-solid fa-pencil text-green-500 hover:text-green-700 text-lg duration-300 ease-in-out"></i>
                            </a>
                            <form action="{{ route('review.destroy', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i
                                        class="fa-solid fa-trash text-red-400 hover:text-red-700 duration-300 ease-in-out"></i>
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800"><img src="{{ asset($review->foto) }}"
                                class="w-[75px]" alt="">
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">{{ $review->nama_klien }}
                        </td>
                        <td class="px-4 py-2 text-xs sm:text-sm text-gray-800">
                            <p class="line-clamp-2">{{ $review->isi_review }}</p>
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
        <div class="mt-3 flex justify-center gap-5">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection
