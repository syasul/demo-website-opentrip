@extends('layouts.layout')

@section('title', 'Tentang Kami | Puncak & Bara')

@section('content')
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12 space-y-16">
    <div class="text-center space-y-4 max-w-2xl mx-auto reveal">
        <span class="text-xs font-bold text-secondary uppercase tracking-widest">Tentang Kami</span>
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary">Melangkah Bersama Menembus Batas</h1>
        <p class="text-text-dark/65 text-sm leading-relaxed">
            Puncak & Bara lahir dari cinta mendalam pada bentang alam pegunungan Indonesia dan komitmen tinggi untuk menyediakan petualangan yang aman bagi setiap orang.
        </p>
    </div>

    <!-- Banner Image -->
    <div class="relative h-[40vh] md:h-[50vh] rounded-3xl overflow-hidden shadow-md reveal">
        <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover" alt="Pendaki di Puncak">
        <div class="absolute inset-0 bg-primary/20"></div>
    </div>

    <!-- Mission & Credential -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 reveal">
            <h2 class="text-2xl md:text-4xl font-bold font-serif text-primary">Pemandu Gunung Profesional Berlisensi</h2>
            <p class="text-text-dark/70 text-sm leading-relaxed">
                Kami memahami bahwa keselamatan adalah prioritas mutlak dalam sebuah petualangan. Oleh karena itu, seluruh pimpinan perjalanan kami adalah pemandu gunung bersertifikat resmi dari **APGI (Asosiasi Pemandu Gunung Indonesia)** dan dibekali dengan sertifikasi First Aid kedaruratan lapangan.
            </p>
            <p class="text-text-dark/70 text-sm leading-relaxed">
                Setiap pendakian dirancang dengan logistik matang, jalur resmi, manajemen sampah nihil (Zero Waste Policy), serta rasio pendampingan peserta yang ideal demi memastikan perjalanan berjalan lancar.
            </p>
        </div>

        <div class="glass-card rounded-3xl p-8 space-y-6 shadow-sm reveal border border-white/40">
            <h3 class="text-xl font-bold font-serif text-primary border-b border-primary/5 pb-3">Legalitas Usaha</h3>
            <div class="space-y-4 text-sm text-text-dark/75">
                <div class="flex justify-between">
                    <span class="font-semibold text-text-dark/50">Nama Badan Hukum</span>
                    <span class="font-bold text-primary text-right">CV Puncak Bara Mandiri</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-text-dark/50">Izin TDUP</span>
                    <span class="font-bold text-primary text-right">503/TDUP-WISATA/2026</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-text-dark/50">Afiliasi Resmi</span>
                    <span class="font-bold text-primary text-right">Mitra Resmi Taman Nasional (TNGR, TNBTS, TNGGP)</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-text-dark/50">Kantor Utama</span>
                    <span class="font-bold text-primary text-right">Jl. Rinjani Raya No. 45, Malang, Jawa Timur</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
