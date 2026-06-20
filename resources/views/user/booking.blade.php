@extends('layouts.layout')

@section('title', 'Pemesanan Open Trip ' . $trip->nama_gunung . ' | Puncak & Bara')

@section('content')
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12">
    <div class="space-y-6">
        <div class="space-y-2 reveal active">
            <span class="text-xs font-bold text-secondary uppercase tracking-widest">Formulir Pendaftaran</span>
            <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary">Registrasi Pendakian: {{ $trip->nama_gunung }}</h1>
            <p class="text-xs text-text-dark/50">Silakan isi data fisik KTP masing-masing pendaki untuk penerbitan izin SIMAKSI TN.</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-50 text-rose-600 p-4 rounded-2xl text-xs font-semibold border border-rose-200 reveal active">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.booking.store', $trip->slug) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            @csrf
            
            <!-- Left Column: Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Step 1: Count and General info -->
                <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 space-y-6 shadow-sm reveal active">
                    <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Informasi Rencana Trip</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Stepper -->
                        <div class="flex flex-col space-y-2">
                            <label class="text-xs font-bold text-primary">Jumlah Peserta</label>
                            <div class="flex items-center gap-3">
                                <button type="button" onclick="decrementParticipants()" class="w-10 h-10 rounded-xl border border-primary/10 bg-bg-light hover:bg-primary/5 text-primary flex items-center justify-center font-bold transition-all focus:outline-none">-</button>
                                <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="1" min="1" max="{{ min($trip->sisa_kuota, 10) }}" readonly class="w-14 h-10 text-center bg-transparent border border-primary/10 rounded-xl font-bold text-sm outline-none">
                                <button type="button" onclick="incrementParticipants()" class="w-10 h-10 rounded-xl border border-primary/10 bg-bg-light hover:bg-primary/5 text-primary flex items-center justify-center font-bold transition-all focus:outline-none">+</button>
                            </div>
                        </div>

                        <!-- Departure date selector (readonly) -->
                        <div class="flex flex-col space-y-2">
                            <label class="text-xs font-bold text-primary">Tanggal Keberangkatan</label>
                            <div class="flex items-center gap-2 px-3.5 h-10 rounded-xl border border-primary/10 bg-slate-100 text-text-dark/60 text-xs font-semibold">
                                <i data-lucide="calendar" class="w-4 h-4 text-primary shrink-0"></i>
                                <span>{{ $trip->tanggal_berangkat->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="notes" class="text-xs font-bold text-primary">Catatan Tambahan (Opsional)</label>
                            <input type="text" id="notes" name="notes" placeholder="Contoh: Titik jemput kustom..." class="px-3.5 h-10 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Hiker Details Section -->
                <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 space-y-6 shadow-sm reveal active">
                    <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Data Identitas Pendaki</h3>
                    
                    <div id="participants-container" class="space-y-6">
                        <!-- Participant sub-form 1 populated initially -->
                        <div class="p-5 bg-bg-alt rounded-2xl border border-primary/5 space-y-4">
                            <span class="text-xs font-bold text-secondary uppercase tracking-widest block">Pendaki #1 (Kontak Utama)</span>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="flex flex-col space-y-1">
                                    <label class="text-[10px] font-bold text-primary">Nama Lengkap (Sesuai KTP)</label>
                                    <input type="text" name="participants[0][nama]" required placeholder="Budi Santoso" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                                </div>
                                <div class="flex flex-col space-y-1">
                                    <label class="text-[10px] font-bold text-primary">Nomor KTP / NIK</label>
                                    <input type="text" name="participants[0][no_ktp]" required placeholder="320xxxxxxxxxxxxx" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                                </div>
                                <div class="flex flex-col space-y-1">
                                    <label class="text-[10px] font-bold text-primary">Nomor HP Darurat Kerabat</label>
                                    <input type="text" name="participants[0][kontak_darurat]" required placeholder="0813xxxxxxxx (Ibu)" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                                </div>
                            </div>

                            <div class="flex flex-col space-y-1">
                                <label class="text-[10px] font-bold text-primary">Catatan Riwayat Kesehatan / Alergi (Opsional)</label>
                                <input type="text" name="participants[0][catatan_kesehatan]" placeholder="Contoh: Asma, alergi telur, atau tidak ada..." class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1">
                <div class="glass-card rounded-3xl p-6 shadow-md border border-white/40 sticky top-28 space-y-6 reveal active">
                    <!-- Trip Card Header -->
                    <div class="relative h-32 rounded-2xl overflow-hidden shrink-0">
                        <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80' }}" class="w-full h-full object-cover" alt="{{ $trip->nama_gunung }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h4 class="font-serif font-bold text-sm leading-tight">{{ $trip->nama_gunung }}</h4>
                            <span class="text-[9px] text-white/70">{{ $trip->location }}</span>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-3 text-xs border-b border-primary/5 pb-4">
                        <div class="flex justify-between">
                            <span class="text-text-dark/65">Level Kesulitan</span>
                            <span class="font-bold text-primary">{{ $trip->level_kesulitan }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-text-dark/65">Jadwal Keberangkatan</span>
                            <span class="font-bold text-text-dark">{{ $trip->tanggal_berangkat->format('d M Y') }}</span>
                        </div>
                    </div>

                    <!-- Calculations -->
                    <div class="space-y-3 text-xs border-b border-primary/5 pb-4">
                        <div class="flex justify-between text-text-dark/65">
                            <span>Harga per Pax</span>
                            <span>Rp {{ number_format($trip->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-text-dark/65">
                            <span>Jumlah Peserta</span>
                            <span id="summary-pax-count" class="font-bold">1x Orang</span>
                        </div>
                        <div class="flex justify-between font-bold text-sm text-primary pt-2">
                            <span>Total Pembayaran</span>
                            <span id="price-subtotal" class="text-lg font-bold text-secondary">Rp {{ number_format($trip->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] text-sm flex items-center justify-center gap-2 btn-press">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Buat Booking Sekarang
                    </button>
                </div>
            </div>

        </form>
    </div>
</section>
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
        document.getElementById('price-subtotal').innerText = formatRupiah(subtotal);
        document.getElementById('summary-pax-count').innerText = `${count}x Orang`;

        // Update forms
        const container = document.getElementById('participants-container');
        const currentCount = container.children.length;

        if (count > currentCount) {
            for (let i = currentCount; i < count; i++) {
                const subForm = `
                    <div class="p-5 bg-bg-alt rounded-2xl border border-primary/5 space-y-4 reveal active">
                        <span class="text-xs font-bold text-secondary uppercase tracking-widest block">Pendaki #${i + 1}</span>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex flex-col space-y-1">
                                <label class="text-[10px] font-bold text-primary">Nama Lengkap (Sesuai KTP)</label>
                                <input type="text" name="participants[${i}][nama]" required placeholder="Nama Lengkap" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label class="text-[10px] font-bold text-primary">Nomor KTP / NIK</label>
                                <input type="text" name="participants[${i}][no_ktp]" required placeholder="Nomor NIK KTP" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label class="text-[10px] font-bold text-primary">Nomor HP Darurat Kerabat</label>
                                <input type="text" name="participants[${i}][kontak_darurat]" required placeholder="Nama & No WhatsApp" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
                            </div>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <label class="text-[10px] font-bold text-primary">Catatan Riwayat Kesehatan / Alergi (Opsional)</label>
                            <input type="text" name="participants[${i}][catatan_kesehatan]" placeholder="Contoh: Asma, alergi dingin, dll..." class="px-3 py-2.5 rounded-xl border border-primary/10 bg-white text-xs outline-none w-full focus:ring-1 focus:ring-primary/20">
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
