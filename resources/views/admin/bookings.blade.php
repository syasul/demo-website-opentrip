@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <div class="flex justify-between items-center border-b border-primary/5 pb-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-primary">Kelola & Verifikasi Pembayaran</h1>
            <p class="text-xs text-text-dark/50">Tinjau bukti transfer manual pendaki, validasi status pembayaran, dan kelola manifest peserta.</p>
        </div>
        <button onclick="exportCSV()" class="bg-secondary hover:bg-secondary/90 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-md flex items-center gap-1.5 btn-press">
            <i data-lucide="download" class="w-4.5 h-4.5"></i> Ekspor CSV
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bookings Table -->
    <div class="overflow-x-auto bg-white rounded-2xl border border-primary/5 shadow-sm">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="border-b border-primary/10 text-[10px] font-bold uppercase tracking-wider text-text-dark/50 bg-bg-alt">
                    <th class="p-4">ID Booking</th>
                    <th class="p-4">Nama Pendaki</th>
                    <th class="p-4">Trip Gunung</th>
                    <th class="p-4">Jumlah Pax</th>
                    <th class="p-4">Total Biaya</th>
                    <th class="p-4">Pembayaran</th>
                    <th class="p-4 text-right">Verifikasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5 text-text-dark/75">
                @forelse($bookings as $bk)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 font-bold text-primary">#{{ $bk->id }}</td>
                        <td class="p-4">
                            <div class="font-bold text-primary text-sm">{{ $bk->user->name }}</div>
                            <div class="text-[9px] text-text-dark/50">{{ $bk->user->no_hp }}</div>
                        </td>
                        <td class="p-4 font-semibold text-primary-light">{{ $bk->trip->nama_gunung }}</td>
                        <td class="p-4">
                            <button onclick="openManifestModal({{ json_encode($bk->participants) }})" class="text-[10px] font-bold text-primary hover:underline bg-primary/5 px-2.5 py-1.5 rounded-lg transition-colors">
                                {{ $bk->jumlah_peserta }} Orang (Manifest)
                            </button>
                        </td>
                        <td class="p-4 font-bold text-secondary">Rp {{ number_format($bk->total_harga, 0, ',', '.') }}</td>
                        <td class="p-4">
                            @if($bk->status_pembayaran === 'Lunas')
                                <span class="bg-green-50 text-green-600 border border-green-200 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase">Lunas</span>
                            @elseif($bk->status_pembayaran === 'Terverifikasi')
                                <span class="bg-blue-50 text-blue-600 border border-blue-200 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase">Verifikasi</span>
                            @elseif($bk->status_pembayaran === 'Pending')
                                <span class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase">Pending</span>
                            @else
                                <span class="bg-red-50 text-red-600 border border-red-200 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase">Batal</span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            @if($bk->payment && $bk->payment->status_verifikasi === 'Pending')
                                <button onclick="openReceiptModal('{{ $bk->id }}', '{{ $bk->payment->bukti_transfer_url }}')" class="bg-secondary hover:bg-secondary/90 text-white font-bold text-[10px] px-3 py-1.5 rounded-lg shadow-sm btn-press">
                                    Tinjau Resi
                                </button>
                            @elseif($bk->payment)
                                <span class="text-[10px] text-text-dark/50">Diverifikasi: <strong class="text-primary font-bold">{{ $bk->payment->status_verifikasi }}</strong></span>
                            @else
                                <span class="text-[10px] text-text-dark/40 italic">Belum bayar</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-text-dark/50">Belum ada data pendaftaran booking masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Manifest Modal -->
<div id="manifest-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-[2rem] border border-primary/10 p-6 md:p-8 max-w-lg w-full mx-6 space-y-6 shadow-2xl relative">
        <button onclick="closeManifestModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Manifest Anggota Pendaki</h3>
        
        <div id="manifest-list" class="space-y-4 max-h-[50vh] overflow-y-auto pr-2">
            <!-- Dynamically injected -->
        </div>
    </div>
</div>

<!-- Receipt Modal with Verification Actions -->
<div id="receipt-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-[2rem] border border-primary/10 p-6 md:p-8 max-w-md w-full mx-6 space-y-6 shadow-2xl relative">
        <button onclick="closeReceiptModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Verifikasi Bukti Transfer</h3>
        
        <div class="w-full h-64 bg-slate-100 rounded-2xl overflow-hidden border border-primary/10 relative group">
            <img id="receipt-image" src="" class="w-full h-full object-contain cursor-zoom-in transition-transform hover:scale-105" alt="Bukti Transfer" onclick="zoomReceipt(this.src)">
            <!-- Zoom Icon indicator -->
            <div class="absolute bottom-3 right-3 bg-black/60 text-white rounded-full p-2 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                <i data-lucide="zoom-in" class="w-4 h-4"></i>
            </div>
        </div>

        <form id="verify-form" action="" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="action" id="verify-action" value="approve">
            
            <!-- Rejection reason input container (collapsed by default) -->
            <div id="rejection-reason-container" class="hidden flex flex-col space-y-1.5 transition-all duration-300">
                <label for="rejection_reason" class="text-[10px] font-bold text-red-600">Alasan Penolakan Pembayaran</label>
                <textarea id="rejection_reason" rows="2" placeholder="Contoh: Bukti transfer terpotong atau nominal tidak sesuai..." class="px-3.5 py-2 rounded-xl border border-red-200 bg-red-50/10 text-xs outline-none focus:ring-1 focus:ring-red-500"></textarea>
            </div>

            <!-- Standard actions buttons -->
            <div id="standard-actions" class="grid grid-cols-2 gap-4">
                <button type="button" onclick="showRejectionReason()" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 rounded-xl border border-red-200 transition-colors text-xs text-center btn-press">
                    Tolak Pembayaran
                </button>
                <button type="submit" onclick="setAction('approve')" class="bg-primary hover:bg-primary-light text-white font-bold py-3 rounded-xl transition-all shadow-md text-xs btn-press">
                    Setujui & Lunas
                </button>
            </div>

            <!-- Rejection action buttons (hidden by default) -->
            <div id="rejection-actions" class="hidden grid grid-cols-2 gap-4">
                <button type="button" onclick="cancelRejection()" class="bg-bg-light hover:bg-primary/5 text-primary border border-primary/10 font-bold py-3 rounded-xl transition-colors text-xs text-center btn-press">
                    Batal
                </button>
                <button type="submit" onclick="setAction('reject')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition-all shadow-md text-xs btn-press">
                    Kirim Penolakan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Fullscreen Zoom Lightbox -->
<div id="receipt-zoom-lightbox" class="fixed inset-0 z-[60] bg-black/95 flex items-center justify-center p-4 hidden" onclick="closeZoomReceipt()">
    <button class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors">
        <i data-lucide="x" class="w-8 h-8"></i>
    </button>
    <img id="zoomed-receipt-image" src="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-all" alt="Bukti Transfer Zoomed">
</div>
@endsection

@section('scripts')
<script>
    // 1. Manifest listing
    function openManifestModal(participants) {
        const list = document.getElementById('manifest-list');
        list.innerHTML = '';

        participants.forEach((p, index) => {
            const block = `
                <div class="p-4 bg-bg-alt rounded-2xl border border-primary/5 text-xs space-y-2">
                    <span class="font-bold text-secondary uppercase block">Pendaki #${index + 1}: ${p.nama}</span>
                    <div class="grid grid-cols-2 gap-2 text-text-dark/70">
                        <p><strong>NIK:</strong> ${p.no_ktp}</p>
                        <p><strong>HP Darurat:</strong> ${p.kontak_darurat}</p>
                    </div>
                    <p class="text-text-dark/70"><strong>Riwayat Kesehatan:</strong> ${p.catatan_health || p.catatan_kesehatan || 'Tidak ada'}</p>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', block);
        });

        document.getElementById('manifest-modal').classList.remove('hidden');
        if (window.lucide) window.lucide.createIcons();
    }
    
    function closeManifestModal() {
        document.getElementById('manifest-modal').classList.add('hidden');
    }

    // 2. Receipt Verifikasi modal controls
    function openReceiptModal(bookingId, imageUrl) {
        document.getElementById('receipt-image').src = imageUrl;
        document.getElementById('verify-form').action = `/admin/bookings/${bookingId}/verify`;
        document.getElementById('receipt-modal').classList.remove('hidden');
        cancelRejection(); // reset step views
        if (window.lucide) window.lucide.createIcons();
    }
    
    function closeReceiptModal() {
        document.getElementById('receipt-modal').classList.add('hidden');
    }

    function setAction(val) {
        document.getElementById('verify-action').value = val;
    }

    // 3. Rejection UI transitions
    function showRejectionReason() {
        document.getElementById('rejection-reason-container').classList.remove('hidden');
        document.getElementById('rejection-actions').classList.remove('hidden');
        document.getElementById('standard-actions').classList.add('hidden');
    }

    function cancelRejection() {
        document.getElementById('rejection-reason-container').classList.add('hidden');
        document.getElementById('rejection-actions').classList.add('hidden');
        document.getElementById('standard-actions').classList.remove('hidden');
        document.getElementById('rejection_reason').value = '';
    }

    // 4. Fullscreen image lightbox
    function zoomReceipt(src) {
        document.getElementById('zoomed-receipt-image').src = src;
        document.getElementById('receipt-zoom-lightbox').classList.remove('hidden');
        if (window.lucide) window.lucide.createIcons();
    }
    
    function closeZoomReceipt() {
        document.getElementById('receipt-zoom-lightbox').classList.add('hidden');
    }

    // 5. Client side CSV generation
    function exportCSV() {
        // Collect bookings from the HTML table (for simplicity and direct client-side utility)
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Booking ID,Nama User,Trip Gunung,Status Pembayaran\n";
        
        document.querySelectorAll('tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 6) {
                const bookingId = cells[0].innerText.trim();
                const userName = cells[1].querySelector('div').innerText.trim();
                const tripName = cells[2].innerText.trim();
                const status = cells[5].innerText.trim();
                
                csvContent += `"${bookingId}","${userName}","${tripName}","${status}"\n`;
            }
        });
        
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "manifest_opentrip_bookings.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endsection
