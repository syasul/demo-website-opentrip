@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    
    <!-- Stats widgets -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-3xl border border-primary/10 p-6 flex items-center justify-between shadow-sm reveal active">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-text-dark/50 block">Total Pemasukan (Lunas)</span>
                <span id="stat-revenue" class="text-xl font-bold text-secondary font-serif">Rp 0</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
                <i data-lucide="wallet" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-primary/10 p-6 flex items-center justify-between shadow-sm reveal active">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-text-dark/50 block">Total Registrasi</span>
                <span id="stat-bookings" class="text-xl font-bold text-primary font-serif">0 Booking</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                <i data-lucide="file-text" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-primary/10 p-6 flex items-center justify-between shadow-sm reveal active">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-text-dark/50 block">Trip Aktif Terjadwal</span>
                <span id="stat-trips" class="text-xl font-bold text-primary font-serif">0 Gunung</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="mountain" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-primary/10 p-6 flex items-center justify-between shadow-sm reveal active">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-text-dark/50 block">Pendaki Terdaftar</span>
                <span id="stat-users" class="text-xl font-bold text-primary font-serif">0 User</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Chart Visual Card -->
    <div class="bg-white rounded-3xl border border-primary/10 p-6 space-y-4 shadow-sm reveal active">
        <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Grafik Kinerja Bulanan</h3>
        <div class="relative h-64 md:h-80">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    <!-- Double Grid layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Latest bookings -->
        <div class="bg-white rounded-3xl border border-primary/10 p-6 space-y-4 shadow-sm reveal active">
            <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Registrasi Terbaru</h3>
            
            <div class="space-y-4">
                @forelse($latestBookings as $bk)
                    <div class="flex justify-between items-center text-xs pb-3 border-b border-primary/5 last:border-b-0 last:pb-0">
                        <div class="space-y-1">
                            <p class="font-bold text-primary">{{ $bk->user->name }}</p>
                            <p class="text-text-dark/60">Trip: {{ $bk->trip->nama_gunung }} ({{ $bk->jumlah_peserta }} Pax)</p>
                        </div>
                        <div class="text-right space-y-1">
                            <span class="font-bold text-secondary block">Rp {{ number_format($bk->total_harga, 0, ',', '.') }}</span>
                            @if($bk->status_pembayaran === 'Lunas')
                                <span class="text-[9px] bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded font-bold uppercase">Lunas</span>
                            @elseif($bk->status_pembayaran === 'Terverifikasi')
                                <span class="text-[9px] bg-blue-50 text-blue-600 border border-blue-200 px-2 py-0.5 rounded font-bold uppercase">Verifikasi</span>
                            @else
                                <span class="text-[9px] bg-yellow-50 text-yellow-600 border border-yellow-200 px-2 py-0.5 rounded font-bold uppercase">Pending</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-text-dark/40 py-4 text-center">Belum ada registrasi baru.</p>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Trips calendar -->
        <div class="bg-white rounded-3xl border border-primary/10 p-6 space-y-4 shadow-sm reveal active">
            <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-2">Jadwal Keberangkatan</h3>
            
            <div class="space-y-5">
                @forelse($upcomingTrips as $tp)
                    <div class="space-y-2 pb-4 border-b border-primary/5 last:border-b-0 last:pb-0">
                        <div class="flex justify-between items-center text-xs">
                            <div class="space-y-0.5">
                                <p class="font-bold text-primary">{{ $tp->nama_gunung }}</p>
                                <p class="text-text-dark/60 text-[10px]">Keberangkatan: {{ $tp->tanggal_berangkat->format('d M Y') }}</p>
                            </div>
                            <div class="text-right">
                                @if($tp->status === 'Aktif')
                                    <span class="text-[9px] bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded font-bold uppercase">Aktif</span>
                                @else
                                    <span class="text-[9px] bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded font-bold uppercase">Penuh / Batal</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Quota Progress Bar -->
                        <div class="space-y-1">
                            <div class="flex justify-between text-[10px] text-text-dark/50">
                                <span>Keterisian Kursi</span>
                                <span class="font-semibold">{{ $tp->kuota - $tp->sisa_kuota }} / {{ $tp->kuota }} Pax</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-primary h-full rounded-full transition-all duration-1000" style="width: {{ min(100, max(0, (($tp->kuota - $tp->sisa_kuota) / $tp->kuota) * 100)) }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-text-dark/40 py-4 text-center">Tidak ada jadwal keberangkatan terdekat.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Count-Up animation logic
    function animateValue(obj, start, end, duration, prefix = '', suffix = '') {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const val = Math.floor(progress * (end - start) + start);
            
            if (prefix === 'Rp ') {
                obj.innerHTML = prefix + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + suffix;
            } else {
                obj.innerHTML = prefix + val + suffix;
            }
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    document.addEventListener("DOMContentLoaded", () => {
        animateValue(document.getElementById('stat-revenue'), 0, {{ $totalRevenue }}, 1000, 'Rp ');
        animateValue(document.getElementById('stat-bookings'), 0, {{ $totalBookings }}, 1000, '', ' Booking');
        animateValue(document.getElementById('stat-trips'), 0, {{ $activeTripsCount }}, 1000, '', ' Gunung');
        animateValue(document.getElementById('stat-users'), 0, {{ $totalUsers }}, 1000, '', ' User');

        // 2. Chart.js implementation
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'Pemasukan (Juta Rp)',
                        data: [12, 19, 15, 25, 32, 28, {{ max(5, round($totalRevenue / 1000000, 1)) }}],
                        borderColor: '#8B6F47',
                        backgroundColor: 'rgba(139, 111, 71, 0.1)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.45
                    },
                    {
                        label: 'Registrasi Booking',
                        data: [15, 24, 18, 35, 42, 38, {{ $totalBookings }}],
                        borderColor: '#2F5233',
                        backgroundColor: 'rgba(47, 82, 51, 0.1)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.45
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: 'Plus Jakarta Sans', size: 10, weight: 'bold' },
                            color: '#222222'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(47, 82, 51, 0.05)' },
                        ticks: { font: { family: 'Plus Jakarta Sans', size: 9 }, color: '#222222' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', size: 9 }, color: '#222222' }
                    }
                }
            }
        });
    });
</script>
@endsection
