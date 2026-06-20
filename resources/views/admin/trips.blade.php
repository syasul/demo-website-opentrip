@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <div class="flex justify-between items-center border-b border-primary/5 pb-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-primary">Kelola Open Trip Gunung</h1>
            <p class="text-xs text-text-dark/50">Tambah paket trip baru, perbarui sisa kuota, status keberangkatan, atau hapus trip.</p>
        </div>
        <button onclick="openAddModal()" class="bg-secondary hover:bg-secondary/90 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-md btn-press">
            Tambah Trip Baru
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Trips Table -->
    <div class="overflow-x-auto bg-white rounded-2xl border border-primary/5 shadow-sm">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="border-b border-primary/10 text-[10px] font-bold uppercase tracking-wider text-text-dark/50 bg-bg-alt">
                    <th class="p-4">Gunung / Destinasi</th>
                    <th class="p-4">Tanggal Keberangkatan</th>
                    <th class="p-4">Harga Tiket</th>
                    <th class="p-4">Kapasitas Kuota</th>
                    <th class="p-4">Tingkat Kesulitan</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5 text-text-dark/75">
                @forelse($trips as $trip)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4">
                            <div class="font-bold text-primary text-sm">{{ $trip->nama_gunung }}</div>
                            <div class="text-[9px] text-text-dark/50">{{ $trip->location }}</div>
                        </td>
                        <td class="p-4">{{ $trip->tanggal_berangkat->format('d M Y') }}</td>
                        <td class="p-4 font-semibold text-secondary">Rp {{ number_format($trip->harga, 0, ',', '.') }}</td>
                        <td class="p-4 font-bold">{{ $trip->sisa_kuota }} / {{ $trip->kuota }} Kursi</td>
                        <td class="p-4 font-bold text-primary">{{ $trip->level_kesulitan }}</td>
                        <td class="p-4">
                            @if($trip->status === 'Aktif')
                                <span class="bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded text-[9px] font-bold uppercase">Aktif</span>
                            @elseif($trip->status === 'Penuh')
                                <span class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-2 py-0.5 rounded text-[9px] font-bold uppercase">Penuh</span>
                            @else
                                <span class="bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded text-[9px] font-bold uppercase">Batal / Selesai</span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="openEditModal({{ json_encode($trip) }})" class="text-[10px] font-bold text-primary hover:underline bg-primary/5 px-2.5 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </button>
                                <form action="{{ route('admin.trips.delete', $trip->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus trip ini?')">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-bold text-red-600 hover:underline bg-red-50 px-2.5 py-1.5 rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-text-dark/50">Belum ada paket trip ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Trip (Multi-Step Wizard) -->
<div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-[2rem] border border-primary/10 p-6 md:p-8 max-w-lg w-full mx-6 space-y-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeAddModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <div class="flex items-center justify-between pb-4 border-b border-primary/5">
            <div class="flex items-center gap-2">
                <h3 class="text-xl font-bold font-serif text-primary">Tambah Trip Baru</h3>
                <span id="autosave-indicator" class="text-[9px] font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full flex items-center gap-1 hidden">
                    <i data-lucide="check" class="w-2.5 h-2.5"></i> Draft tersimpan
                </span>
            </div>
            <!-- Wizard step indicator dots -->
            <div class="flex items-center gap-1.5">
                <div id="step-dot-1" class="w-2.5 h-2.5 rounded-full bg-primary"></div>
                <div id="step-dot-2" class="w-2.5 h-2.5 rounded-full bg-slate-200"></div>
                <div id="step-dot-3" class="w-2.5 h-2.5 rounded-full bg-slate-200"></div>
            </div>
        </div>
        
        <form action="{{ route('admin.trips.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Step 1: Destination Details -->
            <div id="wizard-step-1" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Nama Gunung</label>
                        <input type="text" name="nama_gunung" id="add-nama_gunung" required placeholder="Gunung Rinjani..." class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Lokasi Wilayah</label>
                        <input type="text" name="location" id="add-location" required placeholder="Lombok, NTB..." class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Level Kesulitan</label>
                        <select name="level_kesulitan" id="add-level_kesulitan" class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none font-medium">
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Banner Image (Unsplash URL)</label>
                        <input type="url" name="image_url" id="add-image_url" placeholder="https://images.unsplash.com/..." class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>
                </div>
                
                <div class="flex justify-end pt-2">
                    <button type="button" onclick="goToStep(2)" class="bg-primary hover:bg-primary-light text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all btn-press flex items-center gap-1">
                        Lanjut <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Schedule & Pricing -->
            <div id="wizard-step-2" class="space-y-4 hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Harga Tiket</label>
                        <input type="number" name="harga" id="add-harga" required placeholder="1500000" class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Total Kuota Kursi</label>
                        <input type="number" name="kuota" id="add-kuota" required placeholder="15" class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Tanggal Berangkat</label>
                        <input type="date" name="tanggal_berangkat" id="add-tanggal_berangkat" required class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label class="text-[10px] font-bold text-primary">Tanggal Pulang</label>
                        <input type="date" name="tanggal_pulang" id="add-tanggal_pulang" required class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                    </div>
                </div>

                <div class="flex justify-between pt-2">
                    <button type="button" onclick="goToStep(1)" class="bg-bg-light border border-primary/10 hover:bg-primary/5 text-primary font-bold text-xs px-5 py-2.5 rounded-xl transition-all flex items-center gap-1">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
                    </button>
                    <button type="button" onclick="goToStep(3)" class="bg-primary hover:bg-primary-light text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all btn-press flex items-center gap-1">
                        Lanjut <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Description Details -->
            <div id="wizard-step-3" class="space-y-4 hidden">
                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Deskripsi Trip Lengkap</label>
                    <textarea name="deskripsi" id="add-deskripsi" required rows="5" placeholder="Masukkan detail rute, perlengkapan yang didapat, atau hal penting lainnya..." class="wizard-input px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none"></textarea>
                </div>

                <div class="flex justify-between pt-2">
                    <button type="button" onclick="goToStep(2)" class="bg-bg-light border border-primary/10 hover:bg-primary/5 text-primary font-bold text-xs px-5 py-2.5 rounded-xl transition-all flex items-center gap-1">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
                    </button>
                    <button type="submit" onclick="clearDraft()" class="bg-secondary hover:bg-secondary/90 text-white font-bold text-xs px-6 py-2.5 rounded-xl transition-all shadow-md btn-press">
                        Simpan Paket Trip
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- Modal Edit Trip -->
<div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-[2rem] border border-primary/10 p-6 md:p-8 max-w-lg w-full mx-6 space-y-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeEditModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <h3 class="text-xl font-bold font-serif text-primary border-b border-primary/5 pb-2">Perbarui Paket Trip</h3>
        
        <form id="edit-form" action="" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Nama Gunung</label>
                    <input type="text" id="edit-nama" name="nama_gunung" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Lokasi Wilayah</label>
                    <input type="text" id="edit-location" name="location" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Harga Tiket</label>
                    <input type="number" id="edit-harga" name="harga" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Kapasitas Kuota</label>
                    <input type="number" id="edit-kuota" name="kuota" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Level Kesulitan</label>
                    <select id="edit-difficulty" name="level_kesulitan" class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none font-medium">
                        <option value="Pemula">Pemula</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Tinggi">Tinggi</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Status</label>
                    <select id="edit-status" name="status" class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none font-medium">
                        <option value="Aktif">Aktif</option>
                        <option value="Penuh">Penuh</option>
                        <option value="Selesai">Selesai / Batal</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Tanggal Berangkat</label>
                    <input type="date" id="edit-berangkat" name="tanggal_berangkat" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>

                <div class="flex flex-col space-y-1">
                    <label class="text-[10px] font-bold text-primary">Tanggal Pulang</label>
                    <input type="date" id="edit-pulang" name="tanggal_pulang" required class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label class="text-[10px] font-bold text-primary">Deskripsi Trip</label>
                <textarea id="edit-description" name="deskripsi" required rows="3" class="px-3.5 py-2 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 rounded-xl transition-all shadow-md text-xs btn-press">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // 1. Wizard Step Navigation Logic
    function goToStep(step) {
        document.getElementById('wizard-step-1').classList.add('hidden');
        document.getElementById('wizard-step-2').classList.add('hidden');
        document.getElementById('wizard-step-3').classList.add('hidden');
        
        document.getElementById('step-dot-1').className = "w-2.5 h-2.5 rounded-full bg-slate-200";
        document.getElementById('step-dot-2').className = "w-2.5 h-2.5 rounded-full bg-slate-200";
        document.getElementById('step-dot-3').className = "w-2.5 h-2.5 rounded-full bg-slate-200";

        document.getElementById('wizard-step-' + step).classList.remove('hidden');
        
        for (let i = 1; i <= step; i++) {
            document.getElementById('step-dot-' + i).className = "w-2.5 h-2.5 rounded-full bg-primary";
        }
        
        if (window.lucide) window.lucide.createIcons();
    }

    // 2. LocalStorage draft autosave logic
    const wizardFields = ['nama_gunung', 'location', 'level_kesulitan', 'image_url', 'harga', 'kuota', 'tanggal_berangkat', 'tanggal_pulang', 'deskripsi'];

    function loadDraft() {
        wizardFields.forEach(field => {
            const value = localStorage.getItem('draft_' + field);
            if (value) {
                const input = document.getElementById('add-' + field);
                if (input) {
                    input.value = value;
                }
            }
        });
        const hasDraft = wizardFields.some(field => localStorage.getItem('draft_' + field));
        if (hasDraft) {
            showAutosaveIndicator();
        }
    }

    function showAutosaveIndicator() {
        const indicator = document.getElementById('autosave-indicator');
        indicator.classList.remove('hidden');
        setTimeout(() => {
            indicator.classList.add('hidden');
        }, 3000);
    }

    function clearDraft() {
        wizardFields.forEach(field => {
            localStorage.removeItem('draft_' + field);
        });
    }

    // Attach listeners
    document.addEventListener("DOMContentLoaded", () => {
        loadDraft();

        document.querySelectorAll('.wizard-input').forEach(input => {
            input.addEventListener('input', (e) => {
                const field = e.target.id.replace('add-', '');
                localStorage.setItem('draft_' + field, e.target.value);
                showAutosaveIndicator();
            });
        });
    });

    // 3. Modal show/hide actions
    function openAddModal() {
        document.getElementById('add-modal').classList.remove('hidden');
        goToStep(1);
    }
    
    function closeAddModal() {
        document.getElementById('add-modal').classList.add('hidden');
    }

    function openEditModal(trip) {
        document.getElementById('edit-form').action = `/admin/trips/${trip.id}`;
        document.getElementById('edit-nama').value = trip.nama_gunung;
        document.getElementById('edit-location').value = trip.location;
        document.getElementById('edit-harga').value = Math.round(trip.harga);
        document.getElementById('edit-kuota').value = trip.kuota;
        document.getElementById('edit-difficulty').value = trip.level_kesulitan;
        document.getElementById('edit-status').value = trip.status;
        
        document.getElementById('edit-berangkat').value = trip.tanggal_berangkat.slice(0, 10);
        document.getElementById('edit-pulang').value = trip.tanggal_pulang.slice(0, 10);
        document.getElementById('edit-description').value = trip.deskripsi;

        document.getElementById('edit-modal').classList.remove('hidden');
        if (window.lucide) window.lucide.createIcons();
    }
    
    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>
@endsection
