<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['admin'])) { header("location:login.php"); exit; }

// Hitung Statistik
$total_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pendaftaran"));
$menunggu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE status='Menunggu'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - SSB Taruna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { navy: '#001f3f', gold: '#D4AF37', goldlight: '#F3E5AB' } } }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    <aside class="w-64 bg-navy text-white flex flex-col shadow-2xl z-20 hidden md:flex">
        <div class="h-20 flex items-center justify-center border-b border-gray-700">
            <h2 class="text-xl font-bold tracking-wider text-gold">ADMIN PANEL</h2>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="admin.php" class="flex items-center px-4 py-3 bg-gray-800 text-gold rounded-lg transition">
                <i class="fas fa-home w-6"></i> <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition">
                <i class="fas fa-users w-6"></i> <span>Data Siswa</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition">
                <i class="fas fa-images w-6"></i> <span>Galeri</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <a href="logout.php" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900 hover:text-white rounded-lg transition">
                <i class="fas fa-sign-out-alt w-6"></i> <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        
        <header class="bg-white shadow px-8 py-4 flex justify-between items-center sticky top-0 z-10">
            <div class="md:hidden text-navy text-xl"><i class="fas fa-bars"></i></div> <h2 class="text-xl font-bold text-gray-700">Overview</h2>
            <div class="flex items-center space-x-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-navy"><?php echo $_SESSION['nama_admin']; ?></p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <div class="h-10 w-10 bg-gold rounded-full flex items-center justify-center text-navy font-bold">
                    A
                </div>
            </div>
        </header>

        <div class="p-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-navy flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-navy mr-4">
                        <i class="fas fa-user-graduate text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Pendaftar</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $total_siswa; ?></h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-gold flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Perlu Verifikasi</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $menunggu; ?></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-navy text-lg">Data Pendaftaran Terbaru</h3>
                    <button onclick="window.print()" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="px-6 py-3 font-bold border-b">Foto</th>
                                <th class="px-6 py-3 font-bold border-b">Biodata Siswa</th>
                                <th class="px-6 py-3 font-bold border-b">Kontak Ortu</th>
                                <th class="px-6 py-3 font-bold border-b">Status</th>
                                <th class="px-6 py-3 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM pendaftaran ORDER BY id DESC");
                            while($d = mysqli_fetch_array($data)){
                            ?>
                            <tr class="hover:bg-gray-50 border-b border-gray-100 transition">
                                <td class="px-6 py-4">
                                    <img src="uploads/<?php echo $d['foto']; ?>" class="h-12 w-12 rounded object-cover shadow-sm border border-gray-200" alt="Foto">
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800"><?php echo $d['nama_lengkap']; ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $d['tempat_lahir'].', '.$d['tgl_lahir']; ?></p>
                                    <p class="text-xs text-blue-500">NISN: <?php echo $d['nisn']; ?></p>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <p><i class="fas fa-user text-gray-400 mr-1"></i> <?php echo $d['nama_ortu']; ?></p>
                                    <a href="https://wa.me/62<?php echo substr($d['hp_ortu'], 1); ?>" target="_blank" class="text-green-600 hover:text-green-800 font-semibold text-xs mt-1 inline-block">
                                        <i class="fab fa-whatsapp"></i> <?php echo $d['hp_ortu']; ?>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <?php 
                                    if($d['status'] == 'Menunggu') {
                                        echo '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold">Menunggu</span>';
                                    } elseif($d['status'] == 'Diterima') {
                                        echo '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">Diterima</span>';
                                    } else {
                                        echo '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold">Ditolak</span>';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="#" class="text-blue-500 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-500 hover:text-red-700" title="Hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if(mysqli_num_rows($data) == 0): ?>
                    <div class="p-8 text-center text-gray-400">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p>Belum ada data pendaftaran masuk.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>