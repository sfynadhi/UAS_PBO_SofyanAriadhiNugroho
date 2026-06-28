<?php

require_once "Koneksi.php"; //[cite: 2]
require_once "mahasiswa.php"; //[cite: 2]
require_once "MahasiswaMandiri.php"; //[cite: 2]
require_once "MahasiswaBidikmisi.php"; //[cite: 2]
require_once "MahasiswaPrestasi.php"; //[cite: 2]

$db = new Koneksi(); //[cite: 2]
$conn = $db->getConnection(); //[cite: 2]

// FITUR FILTER: Ambil parameter filter dari URL (jika ada)
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Mengambil semua data mahasiswa untuk menghitung statistik card[cite: 2]
$queryAll = mysqli_query($conn, "SELECT * FROM tabel_mahasiswa");
$totalMahasiswa = 0;
$totalMandiri = 0;
$totalBidikmisi = 0;
$totalPrestasi = 0;

while ($row = mysqli_fetch_assoc($queryAll)) {
    $totalMahasiswa++;
    if ($row['jenis_pembayaran'] == 'Mandiri') $totalMandiri++; //
    if ($row['jenis_pembayaran'] == 'Bidikmisi') $totalBidikmisi++; //
    if ($row['jenis_pembayaran'] == 'Prestasi') $totalPrestasi++; //[cite: 1]
}

// Jalankan query filter data yang akan ditampilkan di tabel
if ($filter == 'mandiri') {
    $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Mandiri' ORDER BY nama_mahasiswa";
} elseif ($filter == 'bidikmisi') {
    $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Bidikmisi' ORDER BY nama_mahasiswa";
} elseif ($filter == 'prestasi') {
    $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'Prestasi' ORDER BY nama_mahasiswa";
} else {
    $sql = "SELECT * FROM tabel_mahasiswa ORDER BY jenis_pembayaran, nama_mahasiswa";
}

$query = mysqli_query($conn, $sql);

if (!$query) {
    die(mysqli_error($conn)); //[cite: 2]
}

$listMahasiswa = [];

while ($row = mysqli_fetch_assoc($query)) {
    if ($row['jenis_pembayaran'] == 'Mandiri') {
        $listMahasiswa[] = new MahasiswaMandiri(
            $row['id_mahasiswa'],
            $row['nama_mahasiswa'],
            $row['nim'],
            $row['semester'],
            $row['tarif_ukt_nominal'],
            $row['golongan_ukt'],
            $row['nama_wali']
        );
    } elseif ($row['jenis_pembayaran'] == 'Bidikmisi') {
        $listMahasiswa[] = new MahasiswaBidikmisi(
            $row['id_mahasiswa'],
            $row['nama_mahasiswa'],
            $row['nim'],
            $row['semester'],
            $row['tarif_ukt_nominal'],
            $row['nomor_kip_kuliah'],
            $row['dana_saku_subsidi']
        );
    } elseif ($row['jenis_pembayaran'] == 'Prestasi') {
        $listMahasiswa[] = new MahasiswaPrestasi(
            $row['id_mahasiswa'],
            $row['nama_mahasiswa'],
            $row['nim'],
            $row['semester'],
            $row['tarif_ukt_nominal'],
            $row['nama_instansi_beasiswa'],
            $row['minimal_ipk_syarat']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Dashboard - UAS PBO</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 flex min-h-screen antialiased">

    <!-- SIDEBAR (Lingkaran Kecil yang Bisa Dipencet) -->
    <aside class="w-72 bg-[#0f172a] text-slate-200 flex flex-col fixed h-screen z-50 shadow-2xl border-r border-slate-800">
        <div class="p-6 flex items-center gap-3 border-b border-slate-800/60">
            <div class="bg-gradient-to-tr from-sky-500 to-indigo-500 p-2.5 rounded-xl shadow-lg">
                <i class="fa-solid fa-graduation-cap text-xl text-white"></i>
            </div>
            <div>
                <h1 class="font-extrabold text-base tracking-wide text-white">UAS PBO PANEL</h1>
                <p class="text-[11px] text-sky-400 font-medium tracking-widest uppercase">Software Engine</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5">
            <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>
            
            <!-- Link Dashboard: Menampilkan Semua Data -->
            <a href="index.php?filter=all" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-300 <?= $filter == 'all' ? 'bg-gradient-to-r from-sky-600 to-indigo-600 text-white shadow-md' : 'text-slate-400 hover:text-sky-400 hover:bg-slate-800/50' ?>">
                <i class="fa-solid fa-chart-pie text-lg"></i>
                <span>Dashboard Statistik</span>
            </a>
            
            <!-- Link Data Mahasiswa: Menampilkan Semua Data -->
            <a href="index.php?filter=all" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-300 <?= $filter != 'all' ? 'text-sky-400 bg-slate-800/40' : 'text-slate-400 hover:text-sky-400 hover:bg-slate-800/50' ?>">
                <i class="fa-solid fa-users text-lg"></i>
                <span>Data Mahasiswa</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800/60 bg-slate-950/40 text-center">
            <p class="text-xs text-slate-500 font-medium">&copy; 2026 Sofyan Apriadhi Nugroho</p>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="ml-72 flex-1 p-8 min-w-0">
        
        <!-- HEADER -->
        <header class="flex justify-between items-center bg-white/80 backdrop-blur-md px-8 py-4 rounded-2xl shadow-sm border border-slate-100 mb-8 sticky top-4 z-40">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">
                    <?= $filter == 'all' ? 'Semua Ringkasan Akademik' : 'Filter Kategori: Mahasiswa ' . ucfirst($filter) ?>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Sistem Manajemen Data Polimorfisme Berbasis Objek</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">SA</div>
                <div>
                    <p class="text-sm font-bold text-slate-800 leading-none">Sofyan Apriadhi Nugroho</p>
                    <p class="text-[11px] font-medium text-slate-400 mt-1">Administrator Utama</p>
                </div>
            </div>
        </header>

        <!-- CARDS STATISTIK (Lingkaran Panjang yang Memfilter Otomatis) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card Total -->
            <a href="index.php?filter=all" class="bg-white p-6 rounded-2xl border flex items-center justify-between group hover:shadow-md transition-all duration-300 <?= $filter == 'all' ? 'border-sky-500 ring-2 ring-sky-100' : 'border-slate-100' ?>">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Mahasiswa</p>
                    <h3 class="text-3xl font-extrabold text-slate-900"><?= $totalMahasiswa; ?></h3>
                </div>
                <div class="bg-sky-50 text-sky-500 w-12 h-12 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </a>

            <!-- Card Mandiri -->
            <a href="index.php?filter=mandiri" class="bg-white p-6 rounded-2xl border flex items-center justify-between group hover:shadow-md transition-all duration-300 <?= $filter == 'mandiri' ? 'border-amber-500 ring-2 ring-amber-100' : 'border-slate-100' ?>">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jalur Mandiri</p>
                    <h3 class="text-3xl font-extrabold text-slate-900"><?= $totalMandiri; ?></h3>
                </div>
                <div class="bg-amber-50 text-amber-500 w-12 h-12 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-id-card"></i>
                </div>
            </a>

            <!-- Card Bidikmisi -->
            <a href="index.php?filter=bidikmisi" class="bg-white p-6 rounded-2xl border flex items-center justify-between group hover:shadow-md transition-all duration-300 <?= $filter == 'bidikmisi' ? 'border-emerald-500 ring-2 ring-emerald-100' : 'border-slate-100' ?>">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jalur Bidikmisi</p>
                    <h3 class="text-3xl font-extrabold text-slate-900"><?= $totalBidikmisi; ?></h3>
                </div>
                <div class="bg-emerald-50 text-emerald-500 w-12 h-12 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </a>

            <!-- Card Prestasi -->
            <a href="index.php?filter=prestasi" class="bg-white p-6 rounded-2xl border flex items-center justify-between group hover:shadow-md transition-all duration-300 <?= $filter == 'prestasi' ? 'border-purple-500 ring-2 ring-purple-100' : 'border-slate-100' ?>">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jalur Prestasi</p>
                    <h3 class="text-3xl font-extrabold text-slate-900"><?= $totalPrestasi; ?></h3>
                </div>
                <div class="bg-purple-50 text-purple-500 w-12 h-12 rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-award"></i>
                </div>
            </a>
        </div>

        <!-- TABLE DATA CONTAINER -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Data Registrasi & Hasil Kalkulasi Tagihan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Menampilkan <?= count($listMahasiswa) ?> data dari total database[cite: 1]</p>
                </div>
                <?php if($filter != 'all'): ?>
                    <a href="index.php?filter=all" class="bg-rose-50 text-rose-600 hover:bg-rose-100 font-semibold text-xs px-4 py-2 rounded-xl border border-rose-200 transition-all">
                        <i class="fa-solid fa-xmark mr-1"></i> Hapus Filter
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/30">
                            <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center w-16">No</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Jalur/Jenis</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Spesifikasi Akademik (OOP)</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Tagihan Semester</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php 
                        if(empty($listMahasiswa)): 
                        ?>
                        <tr>
                            <td colspan="7" class="px-8 py-12 text-center text-sm font-medium text-slate-400">Tidak ada data mahasiswa dalam kategori ini.</td>
                        </tr>
                        <?php 
                        else:
                        $no = 1;
                        foreach ($listMahasiswa as $mhs) : 
                            $jenis = str_replace('Mahasiswa', '', get_class($mhs));
                            
                            if ($jenis == 'Mandiri') {
                                $badgeStyle = "bg-amber-50 text-amber-700 border-amber-200/60";
                            } elseif ($jenis == 'Bidikmisi') {
                                $badgeStyle = "bg-emerald-50 text-emerald-700 border-emerald-200/60";
                            } else {
                                $badgeStyle = "bg-purple-50 text-purple-700 border-purple-200/60";
                            }
                        ?>
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-8 py-4.5 text-center text-sm font-semibold text-slate-400"><?= $no++; ?></td>
                            <td class="px-6 py-4.5 text-sm font-bold text-slate-900 tracking-tight"><?= $mhs->getNim(); ?></td>
                            <td class="px-6 py-4.5 text-sm font-medium text-slate-700 group-hover:text-indigo-600 transition-colors"><?= $mhs->getNamaMahasiswa(); ?></td>
                            <td class="px-6 py-4.5 text-sm text-slate-500 font-medium">Semester <?= $mhs->getSemester(); ?></td>
                            <td class="px-6 py-4.5">
                                <span class="px-3 py-1 rounded-full text-xs font-bold border <?= $badgeStyle; ?>">
                                    <?= $jenis; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4.5 text-xs text-slate-600 font-medium leading-relaxed">
                                <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100 group-hover:bg-white transition-colors">
                                    <?= $mhs->tampilkanSpesifikasiAkademik(); ?>
                                  </div>
                            </td>
                            <td class="px-8 py-4.5 text-sm font-extrabold text-slate-900 text-right tracking-tight">
                                <span class="text-xs font-bold text-slate-400 mr-0.5">Rp</span><?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>