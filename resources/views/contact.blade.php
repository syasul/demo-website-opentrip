@extends('layouts.layout')

@section('title', 'Hubungi Kami & FAQ | Puncak & Bara')

@section('content')
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12 space-y-16">
    <div class="text-center space-y-4 max-w-2xl mx-auto reveal">
        <span class="text-xs font-bold text-secondary uppercase tracking-widest">Kontak & Bantuan</span>
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary">Kami Siap Membantu Pendakian Anda</h1>
        <p class="text-text-dark/65 text-sm leading-relaxed">
            Punya pertanyaan mengenai kesiapan fisik, jadwal keberangkatan, atau butuh bantuan pendaftaran? Hubungi tim kami atau baca jawaban FAQ di bawah ini.
        </p>
    </div>

    <!-- Contact Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="glass-card p-8 rounded-3xl shadow-sm text-center flex flex-col items-center space-y-4 reveal border border-white/40">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <i data-lucide="phone-call" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold font-serif text-primary">Layanan Pelanggan</h3>
            <p class="text-xs text-text-dark/60 leading-relaxed">Hubungi admin WhatsApp untuk respon instan setiap hari pukul 08.00 - 21.00 WIB.</p>
            <a href="https://wa.me/6281330012100" target="_blank" rel="noopener" class="text-sm font-bold text-secondary hover:underline">0813-3001-2100 (WhatsApp)</a>
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-sm text-center flex flex-col items-center space-y-4 reveal border border-white/40">
            <div class="w-12 h-12 rounded-2xl bg-secondary/10 flex items-center justify-center text-secondary">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold font-serif text-primary">Surat Elektronik</h3>
            <p class="text-xs text-text-dark/60 leading-relaxed">Kirim email untuk penawaran trip kelompok kustom, kerjasama media, atau sponsor.</p>
            <a href="mailto:info@puncakbara.com" class="text-sm font-bold text-primary hover:underline">info@puncakbara.com</a>
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-sm text-center flex flex-col items-center space-y-4 reveal border border-white/40">
            <div class="w-12 h-12 rounded-2xl bg-accent-blue/15 flex items-center justify-center text-primary-light">
                <i data-lucide="map-pin" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold font-serif text-primary">Basecamp Utama</h3>
            <p class="text-xs text-text-dark/60 leading-relaxed">Silakan mampir ke kantor kami untuk konsultasi rute & sewa gear premium.</p>
            <span class="text-sm font-bold text-text-dark">Malang, Jawa Timur</span>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div class="max-w-4xl mx-auto space-y-8 reveal">
        <h2 class="text-2xl md:text-3xl font-bold font-serif text-primary text-center">Tanya Jawab (FAQ)</h2>
        
        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="glass-card rounded-2xl overflow-hidden border border-white/40">
                <button onclick="toggleFaq(this)" class="w-full px-6 py-4 text-left flex justify-between items-center text-sm font-bold text-primary hover:bg-bg-alt/20 transition-colors focus:outline-none">
                    <span>Apakah pendaki pemula boleh ikut open trip ini?</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                </button>
                <div class="hidden px-6 pb-5 pt-1 text-xs text-text-dark/70 leading-relaxed border-t border-primary/5 bg-bg-light/40 backdrop-blur-sm">
                    Sangat boleh! Kami memiliki beberapa trip yang dirancang khusus untuk pemula (level kesulitan "Pemula" seperti Gunung Gede atau Gunung Merbabu). Kami juga menyediakan guide berpengalaman yang akan membimbing dan mengawal ritme langkah Anda dengan sabar.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="glass-card rounded-2xl overflow-hidden border border-white/40">
                <button onclick="toggleFaq(this)" class="w-full px-6 py-4 text-left flex justify-between items-center text-sm font-bold text-primary hover:bg-bg-alt/20 transition-colors focus:outline-none">
                    <span>Apa saja perlengkapan yang sudah disediakan oleh panitia?</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                </button>
                <div class="hidden px-6 pb-5 pt-1 text-xs text-text-dark/70 leading-relaxed border-t border-primary/5 bg-bg-light/40 backdrop-blur-sm">
                    Panitia menyediakan perlengkapan kelompok berupa tenda dome, matras angin, sleeping bag per orang, peralatan masak kelompok, bahan logistik segar, obat-obatan P3K umum, serta perlengkapan keselamatan darurat. Anda hanya perlu membawa pakaian pribadi, jaket anti dingin, dan obat-obatan pribadi khusus.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="glass-card rounded-2xl overflow-hidden border border-white/40">
                <button onclick="toggleFaq(this)" class="w-full px-6 py-4 text-left flex justify-between items-center text-sm font-bold text-primary hover:bg-bg-alt/20 transition-colors focus:outline-none">
                    <span>Bagaimana kebijakan pembatalan (refund) jika saya berhalangan hadir?</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                </button>
                <div class="hidden px-6 pb-5 pt-1 text-xs text-text-dark/70 leading-relaxed border-t border-primary/5 bg-bg-light/40 backdrop-blur-sm">
                    Pembatalan H-14 keberangkatan mendapatkan pengembalian 50% dari total biaya. Pembatalan di bawah H-7 keberangkatan dinyatakan hangus, namun Anda diperbolehkan mencari pengganti peserta (oper nama) paling lambat H-3 sebelum keberangkatan tanpa biaya tambahan.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="glass-card rounded-2xl overflow-hidden border border-white/40">
                <button onclick="toggleFaq(this)" class="w-full px-6 py-4 text-left flex justify-between items-center text-sm font-bold text-primary hover:bg-bg-alt/20 transition-colors focus:outline-none">
                    <span>Apakah porter membawakan barang-barang pribadi saya?</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                </button>
                <div class="hidden px-6 pb-5 pt-1 text-xs text-text-dark/70 leading-relaxed border-t border-primary/5 bg-bg-light/40 backdrop-blur-sm">
                    Porter kelompok yang tertera di paket hanya bertugas membawakan tenda kelompok, logistik makan, dan alat masak kelompok. Barang bawaan pribadi (carrier, pakaian pribadi, air minum pribadi) tetap menjadi tanggung jawab masing-masing peserta. Jika Anda memerlukan porter pribadi untuk membawakan tas carrier Anda, silakan hubungi admin paling lambat H-3 keberangkatan.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('[data-lucide="chevron-down"]');
        
        content.classList.toggle('hidden');
        if (content.classList.contains('hidden')) {
            icon.style.transform = 'rotate(0deg)';
        } else {
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>
@endsection
