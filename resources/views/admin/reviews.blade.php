@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <div class="border-b border-primary/5 pb-4">
        <h1 class="text-2xl font-bold font-serif text-primary">Moderasi Ulasan Pendaki</h1>
        <p class="text-xs text-text-dark/50">Tinjau ulasan yang dikirim oleh pendaki setelah menyelesaikan trip mereka sebelum ditampilkan di halaman publik.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-text-dark/50 bg-bg-alt">
                    <th class="p-4">Pendaki</th>
                    <th class="p-4">Trip Gunung</th>
                    <th class="p-4">Rating</th>
                    <th class="p-4">Komentar</th>
                    <th class="p-4">Status Tampil</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5 text-text-dark/75">
                @forelse($reviews as $rev)
                    <tr>
                        <td class="p-4">
                            <div class="font-bold text-primary">{{ $rev->user->name }}</div>
                            <div class="text-[10px] text-text-dark/50">{{ $rev->user->email }}</div>
                        </td>
                        <td class="p-4 font-semibold text-primary-light">{{ $rev->trip->nama_gunung }}</td>
                        <td class="p-4">
                            <div class="flex text-yellow-500">
                                @for($i=0; $i<$rev->rating; $i++)
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="p-4 max-w-xs text-xs truncate" title="{{ $rev->komentar }}">{{ $rev->komentar }}</td>
                        <td class="p-4">
                            @if($rev->status_approve)
                                <span class="bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded text-xs font-bold">Aktif Publik</span>
                            @else
                                <span class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-2 py-0.5 rounded text-xs font-bold">Tertahan (Pending)</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                @if(!$rev->status_approve)
                                    <form action="{{ route('admin.reviews.approve', $rev->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-bold text-white bg-primary hover:bg-primary-light px-2.5 py-1 rounded">
                                            Setujui
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.reviews.reject', $rev->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak/menghapus ulasan ini?')">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold text-red-600 hover:underline bg-red-50 px-2.5 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-text-dark/50">Belum ada ulasan terkirim dari pendaki.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
