@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <div class="border-b border-primary/5 pb-4">
        <h1 class="text-2xl font-bold font-serif text-primary">Daftar Pendaki Terdaftar</h1>
        <p class="text-xs text-text-dark/50">Berikut adalah database pengguna/pendaki yang terdaftar di platform Puncak & Bara.</p>
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
                    <th class="p-4">Nama Pendaki</th>
                    <th class="p-4">Alamat Email</th>
                    <th class="p-4">Nomor WhatsApp</th>
                    <th class="p-4">Kontak Darurat</th>
                    <th class="p-4">Tanggal Gabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5 text-text-dark/75">
                @forelse($users as $usr)
                    <tr>
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0">
                                @if($usr->foto_profil)
                                    <img src="{{ $usr->foto_profil }}" class="w-8 h-8 rounded-full object-cover" alt="Profile">
                                @else
                                    {{ substr($usr->name, 0, 1) }}
                                @endif
                            </div>
                            <span class="font-bold text-primary">{{ $usr->name }}</span>
                        </td>
                        <td class="p-4 font-semibold text-text-dark/80">{{ $usr->email }}</td>
                        <td class="p-4 font-semibold">{{ $usr->no_hp }}</td>
                        <td class="p-4 text-xs">{{ $usr->kontak_darurat ?: '-' }}</td>
                        <td class="p-4 text-xs">{{ $usr->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-text-dark/50">Belum ada pendaki terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
