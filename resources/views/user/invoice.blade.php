@extends('layouts.layout')

@section('title', 'Invoice Pemesanan #' . $booking->id . ' | Puncak & Bara')

@section('content')
<!-- Print stylesheet embedded for clean printing -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-invoice, #printable-invoice * {
            visibility: visible;
        }
        #printable-invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
        nav, footer, .no-print {
            display: none !important;
        }
    }
</style>

<section class="max-w-4xl mx-auto px-6 py-12">
    <div class="space-y-8">
        
        <!-- Alerts bar for actions -->
        <div class="flex justify-between items-center no-print">
            <a href="{{ route('user.dashboard') }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard
            </a>
            <button onclick="window.print()" class="bg-primary hover:bg-primary-light text-white font-bold text-xs px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-md shadow-primary/10">
                <i data-lucide="printer" class="w-4 h-4"></i> Cetak Invoice / Simpan PDF
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200 no-print">
                {{ session('success') }}
            </div>
        @endif

        <!-- Printable Invoice Container -->
        <div id="printable-invoice" class="bg-white rounded-3xl border border-primary/10 p-8 shadow-sm space-y-8">
            
            <!-- Invoice Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-primary/5 pb-8 gap-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white">
                        <i data-lucide="mountain" class="w-5 h-5"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif text-lg font-bold text-primary leading-none">Puncak & Bara</span>
                        <span class="text-[9px] uppercase tracking-widest text-secondary font-bold">Open Trip Gunung</span>
                    </div>
                </div>

                <div class="text-left md:text-right space-y-1">
                    <h2 class="text-xl font-bold font-serif text-primary">INVOICE PEMESANAN</h2>
                    <p class="text-xs text-text-dark/50">ID Registrasi: #{{ $booking->id }}</p>
                    <p class="text-[10px] text-text-dark/40">Dibuat: {{ $booking->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            <!-- Booking Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Detail Pendaki Utama</span>
                    <div class="space-y-1">
                        <p class="font-bold text-primary">{{ $booking->user->name }}</p>
                        <p class="text-xs text-text-dark/70">WhatsApp: {{ $booking->user->no_hp }}</p>
                        <p class="text-xs text-text-dark/70">Email: {{ $booking->user->email }}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Detail Trip Gunung</span>
                    <div class="space-y-1">
                        <p class="font-bold text-primary">{{ $booking->trip->nama_gunung }}</p>
                        <p class="text-xs text-text-dark/70">Lokasi: {{ $booking->trip->location }}</p>
                        <p class="text-xs text-text-dark/70">Jadwal: {{ $booking->trip->tanggal_berangkat->format('d M Y') }} s/d {{ $booking->trip->tanggal_pulang->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Participants Table -->
            <div class="space-y-3">
                <span class="text-xs font-bold text-secondary uppercase tracking-widest">Daftar Pendaki yang Didaftarkan</span>
                
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-primary/10 text-primary font-bold bg-bg-alt">
                            <th class="p-3">Nama Lengkap</th>
                            <th class="p-3">NIK KTP</th>
                            <th class="p-3">Kontak Darurat Kerabat</th>
                            <th class="p-3">Catatan Kesehatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary/5 text-text-dark/75">
                        @foreach($booking->participants as $index => $part)
                            <tr>
                                <td class="p-3 font-semibold">{{ $part->nama }}</td>
                                <td class="p-3">{{ $part->no_ktp }}</td>
                                <td class="p-3">{{ $part->kontak_darurat }}</td>
                                <td class="p-3">{{ $part->catatan_kesehatan ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pricing Calculation -->
            <div class="border-t border-primary/5 pt-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Status Tagihan</span>
                    <div class="mt-2">
                        @if($booking->status_pembayaran === 'Pending')
                            <span class="inline-block bg-yellow-50 text-yellow-600 border border-yellow-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                Belum Bayar
                            </span>
                        @elseif($booking->status_pembayaran === 'Terverifikasi')
                            <span class="inline-block bg-blue-50 text-blue-600 border border-blue-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                Menunggu Verifikasi
                            </span>
                        @elseif($booking->status_pembayaran === 'Lunas')
                            <span class="inline-block bg-green-50 text-green-600 border border-green-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                Pembayaran Lunas
                            </span>
                        @else
                            <span class="inline-block bg-red-50 text-red-600 border border-red-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                Batal / Ditolak
                            </span>
                        @endif
                    </div>
                </div>

                <div class="w-full md:w-auto space-y-2">
                    <div class="flex justify-between md:justify-end gap-12 text-sm text-text-dark/65">
                        <span>Biaya per Pendaki:</span>
                        <span>Rp {{ number_format($booking->trip->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between md:justify-end gap-12 text-sm text-text-dark/65">
                        <span>Jumlah Peserta:</span>
                        <span>{{ $booking->jumlah_peserta }} Orang</span>
                    </div>
                    <div class="flex justify-between md:justify-end gap-12 border-t border-primary/15 pt-2 text-md font-bold text-primary font-serif">
                        <span>Total Tagihan:</span>
                        <span class="text-secondary">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Payment Instructions & Upload Form (Only visible to user to pay) -->
        <!-- Payment Instructions & Upload Form (Only visible to user to pay) -->
        @if($booking->status_pembayaran === 'Pending' || $booking->status_pembayaran === 'Dibatalkan')
            <!-- Countdown digit timer -->
            <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left reveal active no-print">
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-amber-800 flex items-center gap-1.5 justify-center md:justify-start">
                        <i data-lucide="clock" class="w-4 h-4"></i> Batas Waktu Pembayaran
                    </h4>
                    <p class="text-xs text-amber-700/80">Selesaikan transfer sebelum masa berlaku invoice habis untuk menghindari pembatalan otomatis.</p>
                </div>
                <div class="bg-amber-800 text-white font-mono font-bold text-2xl px-6 py-2.5 rounded-2xl tracking-wider shrink-0 shadow-sm" id="countdown-timer">
                    23:59:59
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 no-print">
                <!-- Instruction bank with tabs -->
                <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 space-y-4 shadow-sm reveal active">
                    <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Metode Pembayaran</h3>
                    
                    <!-- Tabs header -->
                    <div class="flex gap-4 border-b border-primary/5 pb-2 mb-4">
                        <button type="button" onclick="switchPaymentMethod('bank', this)" class="payment-method-tab text-xs font-bold text-primary border-b-2 border-primary pb-2 focus:outline-none">
                            Transfer Bank
                        </button>
                        <button type="button" onclick="switchPaymentMethod('qris', this)" class="payment-method-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none">
                            QRIS / E-Wallet
                        </button>
                    </div>

                    <!-- Tab bank -->
                    <div id="payment-bank" class="payment-tab-content space-y-4">
                        <p class="text-xs text-text-dark/70 leading-relaxed">Transfer tepat ke salah satu rekening resmi kami:</p>
                        <div class="p-4 bg-bg-alt rounded-2xl border border-primary/5 relative">
                            <span class="text-[9px] uppercase tracking-wider text-text-dark/50 font-bold">Bank Mandiri</span>
                            <span class="text-md font-bold text-primary block mt-1">144-00-1234567-8</span>
                            <span class="text-[10px] text-text-dark/70 block">a.n. CV Puncak Bara Mandiri</span>
                            <button type="button" onclick="copyToClipboard('1440012345678', this)" class="absolute top-4 right-4 bg-primary/5 hover:bg-primary/10 px-2 py-1 rounded-md text-[10px] font-bold text-primary flex items-center gap-1 transition-all">
                                <i data-lucide="copy" class="w-3 h-3"></i> Salin
                            </button>
                        </div>
                        <div class="p-4 bg-bg-alt rounded-2xl border border-primary/5 relative">
                            <span class="text-[9px] uppercase tracking-wider text-text-dark/50 font-bold">Bank Central Asia (BCA)</span>
                            <span class="text-md font-bold text-primary block mt-1">315-0987-654</span>
                            <span class="text-[10px] text-text-dark/70 block">a.n. CV Puncak Bara Mandiri</span>
                            <button type="button" onclick="copyToClipboard('3150987654', this)" class="absolute top-4 right-4 bg-primary/5 hover:bg-primary/10 px-2 py-1 rounded-md text-[10px] font-bold text-primary flex items-center gap-1 transition-all">
                                <i data-lucide="copy" class="w-3 h-3"></i> Salin
                            </button>
                        </div>
                    </div>

                    <!-- Tab QRIS -->
                    <div id="payment-qris" class="payment-tab-content space-y-4 hidden">
                        <p class="text-xs text-text-dark/70 leading-relaxed">Pindai kode QRIS di bawah ini dengan aplikasi perbankan atau e-wallet Anda:</p>
                        <div class="flex flex-col items-center p-6 bg-slate-50 border border-primary/5 rounded-2xl space-y-4">
                            <div class="bg-white p-3 rounded-2xl border border-primary/10 shadow-sm relative group">
                                <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=300&q=80" class="w-40 h-40 object-cover rounded-xl filter blur-[1px] opacity-75" alt="QRIS Code">
                                <div class="absolute inset-0 flex flex-col justify-center items-center bg-black/40 text-white rounded-xl">
                                    <span class="text-[10px] font-bold tracking-widest uppercase mb-1">MOCK QRIS CODE</span>
                                    <i data-lucide="scan" class="w-8 h-8"></i>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-text-dark/50">Mendukung Gopay, OVO, Dana, LinkAja, ShopeePay</span>
                        </div>
                    </div>
                </div>

                <!-- Receipt Upload form with preview -->
                <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 space-y-4 shadow-sm reveal active">
                    <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Konfirmasi Bukti Transfer</h3>
                    
                    <form action="{{ route('user.payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <div class="flex flex-col space-y-2">
                            <label class="text-xs font-bold text-primary">Unggah Bukti Transfer</label>
                            
                            <div class="relative border-2 border-dashed border-primary/10 hover:border-primary/30 rounded-2xl p-6 text-center cursor-pointer transition-colors" onclick="document.getElementById('bukti_transfer').click()">
                                <input type="file" id="bukti_transfer" name="bukti_transfer" required accept="image/*" class="hidden" onchange="previewReceipt(this)">
                                
                                <div id="dropzone-prompt" class="space-y-2">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-primary/45 mx-auto animate-pulse"></i>
                                    <span class="text-xs font-bold text-text-dark/70 block">Pilih berkas foto atau seret ke sini</span>
                                    <span class="text-[10px] text-text-dark/40 block">Mendukung JPEG, PNG, WEBP (Max 2MB)</span>
                                </div>
                                
                                <div id="dropzone-preview" class="hidden space-y-3">
                                    <img id="receipt-preview-img" src="" class="max-h-40 mx-auto rounded-xl border shadow-sm object-contain" alt="Bukti Transfer Preview">
                                    <span class="text-[10px] font-bold text-green-600 block flex items-center justify-center gap-1">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Berkas terpilih: <span id="file-name" class="underline ml-1"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-md text-xs btn-press">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        @elseif($booking->status_pembayaran === 'Terverifikasi')
            <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 text-center space-y-3 no-print reveal active">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto shadow-sm">
                    <i data-lucide="info" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold font-serif text-primary">Bukti Pembayaran Sedang Diverifikasi</h3>
                <p class="text-xs text-text-dark/60 max-w-sm mx-auto leading-relaxed">
                    Terima kasih telah melakukan konfirmasi. Tim Admin kami sedang memeriksa validitas bukti transfer Anda. Biasanya proses ini memakan waktu maksimal 1-2 jam.
                </p>
            </div>
        @endif

    </div>
</section>
@endsection

@section('scripts')
<script>
    // 1. Countdown Timer logic
    const createdAt = new Date("{{ $booking->created_at->toIso8601String() }}").getTime();
    const deadline = createdAt + (24 * 60 * 60 * 1000); // 24 hours expiry

    function updateTimer() {
        const timerContainer = document.getElementById('countdown-timer');
        if (!timerContainer) return;

        const now = new Date().getTime();
        const diff = deadline - now;

        if (diff <= 0) {
            timerContainer.innerText = "EXPIRED";
            return;
        }

        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        const pad = (num) => num.toString().padStart(2, '0');
        timerContainer.innerText = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }
    setInterval(updateTimer, 1000);
    updateTimer();

    // 2. Switch Payment Method tabs
    function switchPaymentMethod(type, button) {
        document.querySelectorAll('.payment-tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(`payment-${type}`).classList.remove('hidden');

        document.querySelectorAll('.payment-method-tab').forEach(tab => {
            tab.className = "payment-method-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none";
        });
        button.className = "payment-method-tab text-xs font-bold text-primary border-b-2 border-primary pb-2 focus:outline-none";
    }

    // 3. Copy to clipboard
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = button.innerHTML;
            button.innerHTML = `<i data-lucide="check" class="w-3 h-3 text-green-600"></i> Tersalin`;
            if (window.lucide) window.lucide.createIcons();
            setTimeout(() => {
                button.innerHTML = originalHTML;
                if (window.lucide) window.lucide.createIcons();
            }, 2000);
        });
    }

    // 4. File input preview receipt
    function previewReceipt(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('receipt-preview-img').src = e.target.result;
                document.getElementById('file-name').innerText = file.name;
                document.getElementById('dropzone-prompt').classList.add('hidden');
                document.getElementById('dropzone-preview').classList.remove('hidden');
                if (window.lucide) window.lucide.createIcons();
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
