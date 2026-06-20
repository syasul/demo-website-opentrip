@extends('layouts.layout')

@section('title', 'Pemesanan Open Trip ' . $trip->nama_gunung . ' | Puncak & Bara')

@section('content')
<!-- Cinematic Header Briefing -->
<header class="relative h-[50vh] min-h-[400px] w-full bg-slate-950 overflow-hidden -mt-24">
    <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1600' }}" 
         class="absolute inset-0 w-full h-full object-cover scale-110 opacity-70" 
         alt="{{ $trip->nama_gunung }}">
    <div class="absolute inset-0 bg-gradient-to-t from-bg-light via-bg-light/40 to-transparent"></div>
    
    <div class="absolute inset-0 z-20 flex flex-col justify-end pb-20">
        <div class="max-w-8xl mx-auto px-6 md:px-12 w-full">
            <div class="max-w-4xl space-y-6 reveal active">
                <span class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Konfirmasi Keberangkatan</span>
                <h1 class="text-4xl md:text-7xl font-black font-serif text-primary leading-tight lowercase tracking-tight">
                    {{ $trip->nama_gunung }}
                </h1>
                <p class="text-text-dark/40 max-w-xl text-sm leading-relaxed font-medium">
                    Langkah terakhir sebelum petualangan dimulai. Pastikan data identitas sesuai dengan KTP untuk otorisasi SIMAKSI dan asuransi pendakian.
                </p>
            </div>
        </div>
    </div>
</header>

<main class="max-w-8xl mx-auto px-6 md:px-12 py-20 relative z-30">
    <form action="{{ route('user.booking.store', $trip->slug) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        @csrf
        
        <!-- Left Side: Logistics & Participants -->
        <div class="lg:col-span-8 space-y-16">
            
            @if($errors->any())
                <div class="bg-rose-50 border border-rose-100 p-8 rounded-[3rem] animate-shake reveal active">
                    <ul class="space-y-3">
                        @foreach($errors->all() as $error)
                            <li class="text-[10px] font-black text-rose-600 uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section 1: Expedition Logistics -->
            <div class="space-y-12 reveal active">
                <h3 class="text-2xl font-black font-serif text-primary border-b border-primary/5 pb-6">Logistik Ekspedisi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="group">
                        <label class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block">Jumlah Anggota</label>
                        <div class="flex items-center justify-between px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner">
                            <button type="button" onclick="decrementParticipants()" class="w-12 h-12 rounded-2xl bg-bg-alt text-primary flex items-center justify-center font-black hover:bg-secondary transition-all shadow-sm">-</button>
                            <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="1" min="1" max="{{ min($trip->sisa_kuota, 10) }}" readonly class="w-20 text-center bg-transparent border-0 font-black text-xl text-primary outline-none">
                            <button type="button" onclick="incrementParticipants()" class="w-12 h-12 rounded-2xl bg-bg-alt text-primary flex items-center justify-center font-black hover:bg-secondary transition-all shadow-sm">+</button>
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block">Rencana Penjemputan</label>
                        <div class="flex items-center gap-4 px-8 py-5 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary/20"></i>
                            <input type="text" id="notes" name="notes" placeholder="CONTOH: STASIUN JEMBER" class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Identity Registry -->
            <div class="space-y-12 reveal active">
                <h3 class="text-2xl font-black font-serif text-primary border-b border-primary/5 pb-6">Registrasi Identitas</h3>
                
                <div id="participants-container" class="space-y-10">
                    <!-- Participant Case #1 -->
                    <div class="glass-card p-10 rounded-[3rem] border border-white/60 shadow-xl space-y-8 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="flex items-center justify-between border-b border-primary/5 pb-4">
                            <span class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Pendaki Utama #1</span>
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Nama Sesuai KTP</label>
                                <input type="text" name="participants[0][nama]" required placeholder="BUDI SANTOSO" class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Nomor NIK KTP</label>
                                <input type="text" name="participants[0][no_ktp]" required placeholder="320..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Kontak Darurat</label>
                                <input type="text" name="participants[0][kontak_darurat]" required placeholder="IBU - 0812..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Riwayat Kesehatan</label>
                                <input type="text" name="participants[0][catatan_kesehatan]" placeholder="OPSIONAL: ASMA..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Interaction Sidebar -->
        <div class="lg:col-span-4">
            <aside class="sticky top-32 space-y-10">
                <div class="glass-card p-12 rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(27,60,34,0.1)] border border-white/60 space-y-10 relative overflow-hidden bg-white/70 backdrop-blur-3xl reveal active">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                    
                    <div class="space-y-6 relative z-10">
                        <span class="text-[10px] font-black text-text-dark/40 uppercase tracking-[0.3em]">Ringkasan Ekspedisi</span>
                        <div class="flex items-center gap-6 pb-6 border-b border-primary/5">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md">
                                <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-sm font-black font-serif text-primary lowercase">{{ $trip->nama_gunung }}</h4>
                                <span class="text-[9px] font-black text-primary/30 uppercase tracking-[0.2em]">{{ $trip->location }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center group">
                            <span class="text-[9px] font-black text-text-dark/40 uppercase tracking-[0.2em]">Keberangkatan</span>
                            <span class="text-[10px] font-black text-primary">{{ $trip->tanggal_berangkat->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center group">
                            <span class="text-[9px] font-black text-text-dark/40 uppercase tracking-[0.2em]">Total Peserta</span>
                            <span id="summary-pax-count" class="text-[10px] font-black text-primary uppercase tracking-[0.1em]">1 Anggota Aktif</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-primary/5 space-y-8">
                        <div class="flex justify-between items-end">
                            <span class="text-[9px] font-black text-primary uppercase tracking-[0.3em] mb-1">Total Investasi</span>
                            <div id="price-subtotal" class="text-3xl font-black text-secondary font-serif leading-none">
                                Rp {{ number_format($trip->harga/1000, 0, ',', '.') }}K
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-black text-[10px] py-6 rounded-3xl transition-all shadow-2xl hover:scale-105 active:scale-95 uppercase tracking-[0.3em] flex items-center justify-center gap-4">
                            <i data-lucide="check-circle" class="w-4 h-4"></i> Finalisasi Booking
                        </button>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-[2.5rem] border border-white/60 flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-[9px] font-black text-primary uppercase tracking-[0.2em]">Pembayaran Aman</span>
                        <p class="text-[9px] text-text-dark/40 leading-relaxed font-medium uppercase tracking-[0.1em]">Layanan enkripsi bank-level diaplikasikan pada setiap transaksi.</p>
                    </div>
                </div>
            </aside>
        </div>
    </form>
</main>
@endsection

@section('scripts')
<script>
    const tripPrice = {{ $trip->harga }};
    const maxQuota = {{ min($trip->sisa_kuota, 10) }};

    function formatRupiah(num) {
        return "Rp " + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function incrementParticipants() {
        const input = document.getElementById('jumlah_peserta');
        let val = parseInt(input.value);
        if (val < maxQuota) {
            val++;
            input.value = val;
            updateParticipants(val);
        }
    }

    function decrementParticipants() {
        const input = document.getElementById('jumlah_peserta');
        let val = parseInt(input.value);
        if (val > 1) {
            val--;
            input.value = val;
            updateParticipants(val);
        }
    }

    function updateParticipants(count) {
                // Update subtotal price and labels
        const subtotal = tripPrice * count;
        document.getElementById('price-subtotal').innerText = "Rp " + (subtotal/1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "K";
        document.getElementById('summary-pax-count').innerText = `${count} Anggota Aktif`;

        // Update forms
        const container = document.getElementById('participants-container');
        const currentCount = container.children.length;

        if (count > currentCount) {
            for (let i = currentCount; i < count; i++) {
                                const subForm = `
                    <div class="glass-card p-10 rounded-[3rem] border border-white/60 shadow-xl space-y-8 relative overflow-hidden group reveal active">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="flex items-center justify-between border-b border-primary/5 pb-4">
                            <span class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Anggota Ekspedisi #${i + 1}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Nama Sesuai KTP</label>
                                <input type="text" name="participants[${i}][nama]" required placeholder="NAMA LENGKAP" class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Nomor NIK KTP</label>
                                <input type="text" name="participants[${i}][no_ktp]" required placeholder="320..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Kontak Darurat</label>
                                <input type="text" name="participants[${i}][kontak_darurat]" required placeholder="IBU - 0812..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                            <div class="group">
                                <label class="text-[9px] font-black text-primary/30 uppercase tracking-[0.3em] ml-4 mb-2 block group-focus-within:text-primary transition-colors">Riwayat Kesehatan</label>
                                <input type="text" name="participants[${i}][catatan_kesehatan]" placeholder="OPSIONAL: ASMA..." class="w-full bg-bg-alt/50 border border-primary/5 px-6 py-4 rounded-2xl text-[10px] font-black text-primary placeholder:text-primary/10 outline-none focus:ring-2 focus:ring-primary/5 uppercase tracking-[0.1em]">
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', subForm);
            }
        } else if (count < currentCount) {
            for (let i = currentCount; i > count; i--) {
                container.removeChild(container.lastElementChild);
            }
        }
        
        // Reinitialize icons if any are newly generated
        if (window.lucide) {
            window.lucide.createIcons();
        }
    }
</script>
@endsection
