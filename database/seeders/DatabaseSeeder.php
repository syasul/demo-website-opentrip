<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Trip;
use App\Models\Article;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Admins
        $admin = Admin::create([
            'name' => 'Admin Utama',
            'email' => 'admin@opentrip.com',
            'password' => Hash::make('password'),
            'role' => 'super-admin',
        ]);

        // Seed Users
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'user@opentrip.com',
            'no_hp' => '081234567890',
            'password' => Hash::make('password'),
            'foto_profil' => null,
            'kontak_darurat' => '081299998888 (Istri)',
        ]);

        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'pendaki@opentrip.com',
            'no_hp' => '082345678901',
            'password' => Hash::make('password'),
            'foto_profil' => null,
            'kontak_darurat' => '082399998888 (Ayah)',
        ]);

        // Seed Trips
        $rinjani = Trip::create([
            'nama_gunung' => 'Gunung Rinjani (3.726 MDPL)',
            'slug' => 'gunung-rinjani-3726-mdpl',
            'deskripsi' => 'Nikmati keindahan kawah Segara Anak dan kegagahan puncak Gunung Rinjani di Lombok, Nusa Tenggara Barat. Salah satu trek terindah di Asia Tenggara dengan padang sabana luas dan pemandangan Danau Segara Anak yang memukau.',
            'itinerary' => [
                'Hari 1: Penjemputan di Bandara Lombok, perjalanan ke Sembalun, registrasi kesehatan, briefing, dan istirahat di homestay.',
                'Hari 2: Trekking dari Pos 1 Sembalun menuju Sembalun Crater Rim (Plawangan Sembalun). Makan siang di jalan, camping di Plawangan.',
                'Hari 3: Summit Attack jam 02.00 WITA. Turun kembali ke Plawangan Sembalun, trekking turun ke Danau Segara Anak, mandi air panas alami.',
                'Hari 4: Naik ke Senaru Crater Rim (Plawangan Senaru), menikmati sunset, camping malam terakhir.',
                'Hari 5: Trekking turun ke Desa Senaru, makan siang, transfer kembali ke Bandara Lombok.'
            ],
            'harga' => 2450000.00,
            'kuota' => 15,
            'sisa_kuota' => 15,
            'level_kesulitan' => 'Tinggi',
            'tanggal_berangkat' => now()->addDays(15)->format('Y-m-d'),
            'tanggal_pulang' => now()->addDays(19)->format('Y-m-d'),
            'status' => 'Aktif',
            'image_url' => 'https://images.unsplash.com/photo-1568230315894-1edd16d248b7?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Lombok, Nusa Tenggara Barat',
            'what_is_included' => [
                'Transportasi AC Bandara - Sembalun / Senaru PP',
                'Simaksi & Tiket Masuk TN Gunung Rinjani',
                'Asuransi Pendakian Resmi',
                'Homestay 1 malam di Sembalun',
                'Tenda, Matras Angin, & Sleeping Bag per orang',
                'Makan 3x sehari selama pendakian (menu premium)',
                'Porter Kelompok (membawa tenda, logistik, alat masak)',
                'Guide Berlisensi Asosiasi Pemandu Gunung Indonesia'
            ]
        ]);

        $semeru = Trip::create([
            'nama_gunung' => 'Gunung Semeru (Puncak Mahameru)',
            'slug' => 'gunung-semeru-puncak-mahameru',
            'deskripsi' => 'Jelajahi atap Pulau Jawa. Trekking melewati padang rumput Oro-Oro Ombo yang ungu romantis, berkemah di tepi Danau Ranu Kumbolo yang mistis, dan taklukkan puncak abadi para dewa, Mahameru.',
            'itinerary' => [
                'Hari 1: Penjemputan di Stasiun Malang, perjalanan ke Ranupani via Tumpang menggunakan Jeep 4x4. Briefing & menginap di homestay.',
                'Hari 2: Trekking dari Ranupani menuju Danau Ranu Kumbolo. Makan siang di Pos 3, camping sore di tepi danau menikmati susu hangat.',
                'Hari 3: Trekking melewati Oro-Oro Ombo menuju Kalimati Basecamp. Makan malam awal untuk persiapan summit attack.',
                'Hari 4: Summit Attack Mahameru jam 00.30 WIB. Turun kembali ke Kalimati, lalu kembali ke Ranu Kumbolo untuk makan siang & camping santai.',
                'Hari 5: Trekking kembali ke Ranupani, perjalanan Jeep ke Malang.'
            ],
            'harga' => 1850000.00,
            'kuota' => 20,
            'sisa_kuota' => 18, // 2 booked
            'level_kesulitan' => 'Menengah',
            'tanggal_berangkat' => now()->addDays(30)->format('Y-m-d'),
            'tanggal_pulang' => now()->addDays(34)->format('Y-m-d'),
            'status' => 'Aktif',
            'image_url' => 'https://images.unsplash.com/photo-1589182373726-e4f658ab50f0?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Lumajang - Malang, Jawa Timur',
            'what_is_included' => [
                'Transportasi Jeep 4x4 Tumpang - Ranupani PP',
                'Tiket Masuk TN Bromo Tengger Semeru',
                'Surat Keterangan Sehat & Asuransi TNBTS',
                'Tenda kapasitas 4 orang diisi 3 orang',
                'Logistik makanan lengkap (masakan hangat porter)',
                'Porter Kelompok & Peralatan Masak Standard',
                'Guide Pendakian Berlisensi'
            ]
        ]);

        $merbabu = Trip::create([
            'nama_gunung' => 'Gunung Merbabu Savana Merbabu',
            'slug' => 'gunung-merbabu-savana-merbabu',
            'deskripsi' => 'Gunung dengan bentang sabana terindah di Jawa Tengah. Menawarkan panorama luar biasa ke arah Gunung Merapi, Sumbing, Sindoro, dan Lawu dari ketinggian puncak Kenteng Songo.',
            'itinerary' => [
                'Hari 1: Penjemputan di Stasiun Solo/Yogyakarta, perjalanan ke Basecamp Selo. Registrasi, briefing dan istirahat.',
                'Hari 2: Mulai trekking pagi dari Selo melewati hutan tropis dan tiba di Pos 3/Pos 4 Sabana 1 untuk camping. Sunset pemandangan Merapi.',
                'Hari 3: Summit attack Kenteng Songo (3.142 mdpl) pagi hari untuk sunrise. Kembali ke camp, sarapan, trekking turun ke Selo. Kembali ke Solo/Jogja.'
            ],
            'harga' => 950000.00,
            'kuota' => 12,
            'sisa_kuota' => 12,
            'level_kesulitan' => 'Pemula',
            'tanggal_berangkat' => now()->addDays(8)->format('Y-m-d'),
            'tanggal_pulang' => now()->addDays(10)->format('Y-m-d'),
            'status' => 'Aktif',
            'image_url' => 'https://images.unsplash.com/photo-1549880338-65ddcdfd017b?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Boyolali, Jawa Tengah',
            'what_is_included' => [
                'Transportasi Stasiun Solo/Yogyakarta - Selo PP',
                'Simaksi Online Registrasi Merbabu',
                'Tenda, Matras, Sleeping Bag disediakan panitia',
                'Makan 4x selama pendakian (dimasak porter)',
                'Porter Kelompok & Guide Porter',
                'Welcome Drink & Snack basecamp'
            ]
        ]);

        $gede = Trip::create([
            'nama_gunung' => 'Gunung Gede (Alun-Alun Surya Kencana)',
            'slug' => 'gunung-gede-alun-alun-surya-kencana',
            'deskripsi' => 'Sempurna untuk pendaki pemula atau akhir pekan. Jelajahi padang edelweiss Surya Kencana seluas 50 hektar yang menakjubkan dan nikmati pemandangan kawah aktif Gunung Gede.',
            'itinerary' => [
                'Hari 1: Kumpul di Meeting Point Jakarta (Cawang/Semanggi) jam 22.00. Perjalanan ke Basecamp Gunung Putri via Cipanas.',
                'Hari 2: Trekking pagi via Jalur Gunung Putri. Camping sore di Alun-Alun Surya Kencana. Menikmati edelweiss dan api unggun kecil.',
                'Hari 3: Summit attack pagi hari ke puncak Gede (2.958 mdpl), trekking turun via Jalur Cibodas (melewati air terjun panca weuleuh dan air panas). Kembali ke Jakarta malam hari.'
            ],
            'harga' => 650000.00,
            'kuota' => 25,
            'sisa_kuota' => 25,
            'level_kesulitan' => 'Pemula',
            'tanggal_berangkat' => now()->addDays(25)->format('Y-m-d'),
            'tanggal_pulang' => now()->addDays(26)->format('Y-m-d'),
            'status' => 'Aktif',
            'image_url' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Cianjur, Jawa Barat',
            'what_is_included' => [
                'Transportasi Elf/Bus Pariwisata Jakarta - Basecamp PP',
                'Simaksi Resmi TNGGP & Tiket Asuransi',
                'Tenda Dome kelompok kapasitas 4 orang',
                'Makan 3x selama di gunung (siap saji)',
                'Guide Pendakian APGI',
                'P3K Standard Pendakian'
            ]
        ]);

        // Seed Reviews
        Review::create([
            'user_id' => $user1->id,
            'trip_id' => $rinjani->id,
            'rating' => 5,
            'komentar' => 'Pengalaman luar biasa! Guide sangat profesional, porter masakannya enak sekali layaknya restoran bintang lima di gunung. Sangat direkomendasikan!',
            'status_approve' => true,
        ]);

        Review::create([
            'user_id' => $user2->id,
            'trip_id' => $merbabu->id,
            'rating' => 5,
            'komentar' => 'Sabana Merbabu sangat indah. Pelayanan admin ramah sekali, dari pendaftaran sampai kepulangan diurus rapi. Terima kasih Open Trip Gunung!',
            'status_approve' => true,
        ]);

        Review::create([
            'user_id' => $user1->id,
            'trip_id' => $semeru->id,
            'rating' => 4,
            'komentar' => 'Trek berpasir Semeru menantang, tapi terbayar dengan sunrise di Ranu Kumbolo. Porter sangat membantu membawakan tenda.',
            'status_approve' => true,
        ]);

        Review::create([
            'user_id' => $user2->id,
            'trip_id' => $rinjani->id,
            'rating' => 5,
            'komentar' => 'Rinjani memang berat tapi berkat guide yang sabar kami semua berhasil mencapai puncak 3.726 mdpl dengan selamat!',
            'status_approve' => false, // pending moderation
        ]);

        // Seed Articles
        Article::create([
            'judul' => '5 Perlengkapan Wajib yang Sering Terlupakan Saat Mendaki',
            'slug' => '5-perlengkapan-wajib-yang-sering-terlupakan-saat-mendaki',
            'konten' => 'Mendaki gunung membutuhkan persiapan matang. Selain tenda dan jaket tebal, ada beberapa barang kecil namun vital yang sering dilupakan pendaki pemula: 1) Balaclava/Buff ekstra untuk dingin malam hari; 2) Senter Kepala (Headlamp) cadangan baterai; 3) Trash Bag tebal untuk melindungi barang dari hujan; 4) Kaos kaki tidur berbahan wool tebal; 5) Survival Kit & obat pribadi khusus alergi. Pastikan barang ini masuk ke carrier Anda sebelum berangkat!',
            'gambar_cover' => 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=800&q=80',
            'author_admin_id' => $admin->id,
            'published_at' => now(),
        ]);

        Article::create([
            'judul' => 'Tips Aklimatisasi Menghindari Mountain Sickness di Ketinggian',
            'slug' => 'tips-aklimatisasi-menghindari-mountain-sickness-di-ketinggian',
            'konten' => 'Penyakit ketinggian (Acute Mountain Sickness / AMS) adalah musuh utama pendaki. Untuk menghindarinya, lakukan aklimatisasi dengan cara: berjalan dengan ritme santai dan konstan, perbanyak minum air putih (minimal 3 liter sehari), hindari langsung tidur setibanya di camp site, dan segera turun ke pos lebih rendah jika kepala mulai pusing berputar hebat. Dengarkan sinyal tubuh Anda!',
            'gambar_cover' => 'https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=800&q=80',
            'author_admin_id' => $admin->id,
            'published_at' => now(),
        ]);

        Article::create([
            'judul' => 'Panduan Memilih Level Gunung yang Cocok untuk Pemula',
            'slug' => 'panduan-memilih-level-gunung-yang-cocok-untuk-pemula',
            'konten' => 'Bagi Anda yang baru pertama kali mendaki gunung, pilihlah gunung dengan ketinggian di bawah 3000 mdpl dengan waktu tempuh pendakian singkat (1 hari atau maksimal 2 hari 1 malam). Beberapa rekomendasi gunung ramah pemula di Jawa antara lain Gunung Andong, Gunung Papandayan (jalur landai dan kawah belerang eksotis), Gunung Gede via Gunung Putri, atau Gunung Merbabu jalur Selo. Jangan langsung mencoba Rinjani atau Semeru tanpa latihan fisik memadai sebelumnya.',
            'gambar_cover' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80',
            'author_admin_id' => $admin->id,
            'published_at' => now(),
        ]);
    }
}
