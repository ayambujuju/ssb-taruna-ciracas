<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSB Taruna Ciracas - Official Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#001f3f',
                        gold: '#D4AF37',
                        goldhover: '#B5952F',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-gray-50">

    <nav class="bg-navy text-white sticky top-0 z-50 shadow-lg border-b-4 border-gold">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="assets/img/logo.png" alt="Logo SSB Taruna Ciracas" class="h-14 w-auto drop-shadow-md">
                <div>
                    <h1 class="text-lg md:text-xl font-bold tracking-wider leading-tight">SSB TARUNA <br><span class="text-gold">CIRACAS</span></h1>
                </div>
            </div>
            
            <div class="hidden md:flex space-x-6 font-semibold text-sm">
                <a href="#home" class="hover:text-gold transition py-2">BERANDA</a>
                <a href="#profil" class="hover:text-gold transition py-2">PROFIL</a>
                <a href="#galeri" class="hover:text-gold transition py-2">GALERI</a>
                <a href="#kontak" class="hover:text-gold transition py-2">KONTAK</a>
                <a href="#daftar" class="bg-gold text-navy px-5 py-2 rounded-full hover:bg-white transition font-bold shadow-lg transform hover:-translate-y-0.5">DAFTAR SEKARANG</a>
            </div>
        </div>
    </nav>

    <section id="home" class="relative h-[600px] flex items-center justify-center bg-cover bg-center bg-fixed" style="background-image: url('https://images.unsplash.com/photo-1517466787929-bc90951d0974?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-navy opacity-80"></div> 
        <div class="relative z-10 text-center px-4 max-w-4xl">
            <span class="text-gold font-bold tracking-widest uppercase mb-2 block">Official Website</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Mencetak Generasi Juara <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold to-yellow-200">Berkarakter Emas</span>
            </h1>
            <p class="text-gray-200 text-lg mb-10 max-w-2xl mx-auto">Bergabunglah bersama kami dalam pembinaan usia dini yang mengutamakan disiplin, teknik sepak bola modern, dan mentalitas pemenang.</p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <a href="#daftar" class="bg-gold text-navy px-8 py-4 rounded-full text-lg font-bold hover:bg-white transition shadow-lg flex items-center justify-center">
                    <i class="fas fa-file-signature mr-2"></i> Daftar Siswa Baru
                </a>
                <a href="#profil" class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-white hover:text-navy transition flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <section class="bg-white py-8 border-b border-gray-200">
        <div class="container mx-auto text-center">
            <p class="text-gray-400 text-xs font-bold mb-6 tracking-widest uppercase">Didukung Oleh Sponsor Resmi</p>
            <div class="flex justify-center items-center flex-wrap gap-8 md:gap-16 opacity-60 hover:opacity-100 transition duration-500 grayscale hover:grayscale-0">
                <img src="assets/img/sponsor1.png" alt="Logo Centex" class="h-12 md:h-16 object-contain grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition duration-500 cursor-pointer">
                <img src="assets/img/sponsor2.png" alt="Logo Bank Jakarta" class="h-12 md:h-16 object-contain grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition duration-500 cursor-pointer"> 
            </div>
        </div>
    </section>

    <section id="profil" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1">
                <h2 class="text-3xl font-bold text-navy mb-6 flex items-center">
                    <span class="w-2 h-10 bg-gold mr-4 rounded-full"></span>
                    Tentang SSB Taruna
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed text-justify">
                    SSB Taruna Ciracas hadir sebagai wadah pembinaan talenta muda di Jakarta Timur. Dengan kurikulum berbasis <strong>Filanesia</strong> dan pelatih berlisensi, kami fokus pada pengembangan teknik individu serta pemahaman taktik bermain.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-navy">
                        <i class="fas fa-trophy text-gold text-2xl mb-2"></i>
                        <h4 class="font-bold text-navy">Berprestasi</h4>
                        <p class="text-xs text-gray-500">Rutin juara turnamen lokal & regional.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-navy">
                        <i class="fas fa-users text-gold text-2xl mb-2"></i>
                        <h4 class="font-bold text-navy">Keluarga</h4>
                        <p class="text-xs text-gray-500">Lingkungan yang positif bagi tumbuh kembang anak.</p>
                    </div>
                </div>
            </div>
            <div class="order-1 md:order-2 grid grid-cols-2 gap-4 relative">
                <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="rounded-xl shadow-2xl transform translate-y-4">
                <img src="https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="rounded-xl shadow-2xl transform -translate-y-4">
            </div>
        </div>
    </section>

    <section id="daftar" class="py-24 bg-navy relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-gold opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-500 opacity-10 blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-gold font-bold tracking-widest uppercase">Bergabung Sekarang</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">Formulir Pendaftaran Siswa Baru</h2>
                <p class="text-gray-300 mt-2">Isi biodata lengkap di bawah ini untuk memulai perjalanan karir sepak bola Anda.</p>
            </div>

            <div class="bg-white max-w-4xl mx-auto rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gold h-2 w-full"></div>
                <div class="p-8 md:p-12">
                    <form action="proses_daftar.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="md:col-span-2">
                            <h3 class="text-navy font-bold text-lg border-b pb-2 mb-4">1. Data Calon Siswa</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy focus:ring-1 focus:ring-navy transition" placeholder="Sesuai Akta Kelahiran" required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NISN (Opsional)</label>
                            <input type="number" name="nisn" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" placeholder="Nomor Induk Siswa Nasional">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Upload Pas Foto (3x4)</label>
                            <input type="file" name="foto" class="w-full border border-gray-300 p-2 rounded-lg bg-gray-50 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-navy file:text-white hover:file:bg-blue-900" accept="image/*" required>
                            <p class="text-xs text-gray-500 mt-1">*Format: JPG/PNG, Maks 2MB.</p>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-navy font-bold text-lg border-b pb-2 mb-4">2. Data Orang Tua / Wali</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Orang Tua</label>
                            <input type="text" name="nama_ortu" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. HP / WhatsApp</label>
                            <input type="tel" name="hp_ortu" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" placeholder="Contoh: 081234567890" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Domisili</label>
                            <textarea name="alamat" rows="3" class="w-full border-gray-300 bg-gray-50 border px-4 py-3 rounded-lg focus:outline-none focus:border-navy" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="md:col-span-2 mt-6">
                            <button type="submit" name="daftar" class="w-full bg-gold hover:bg-goldhover text-navy font-bold py-4 rounded-xl transition duration-300 text-lg shadow-lg flex justify-center items-center group">
                                <i class="fas fa-paper-plane mr-3 group-hover:translate-x-1 transition"></i> KIRIM FORMULIR PENDAFTARAN
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-navy text-center mb-10">Galeri Kegiatan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group relative overflow-hidden rounded-xl shadow-lg cursor-pointer h-64">
                    <img src="https://images.unsplash.com/photo-1551958219-acbc608c6377?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy to-transparent opacity-90 flex items-end p-6">
                        <h3 class="text-white font-bold text-lg">Latihan Rutin Minggu</h3>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl shadow-lg cursor-pointer h-64">
                    <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy to-transparent opacity-90 flex items-end p-6">
                        <h3 class="text-white font-bold text-lg">Turnamen Askot 2024</h3>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl shadow-lg cursor-pointer h-64">
                    <img src="https://images.unsplash.com/photo-1434648957308-5e6a859697e8?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy to-transparent opacity-90 flex items-end p-6">
                        <h3 class="text-white font-bold text-lg">Foto Tim U-12</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-navy text-white pt-16 pb-8 border-t-4 border-gold">
        <div class="container mx-auto px-4 grid md:grid-cols-3 gap-8 mb-8">
            <div>
                <h3 class="text-xl font-bold text-gold mb-4">SSB TARUNA CIRACAS</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Membangun karakter anak bangsa melalui sepak bola. Bergabunglah bersama kami untuk masa depan yang lebih gemilang.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-4">Hubungi Kami</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start"><i class="fas fa-map-marker-alt text-gold mt-1 mr-3"></i> Jl. Raya Jakarta-Bogor No.KM.27, Ciracas, Jakarta Timur</li>
                    <li class="flex items-center"><i class="fab fa-whatsapp text-gold mr-3"></i> 0857-8200-8486</li>
                    <li class="flex items-center"><i class="fas fa-envelope text-gold mr-3"></i> tarunaciracassb@gmail.com</li>
                </ul>
            </div>
            <div>
    <h3 class="text-xl font-bold text-white mb-4">Lokasi Lapangan</h3>
    
    <div class="h-64 w-full rounded-lg overflow-hidden shadow-lg border-2 border-gold relative">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.328876613146!2d106.8675433!3d-6.3514486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec6d6706d73f%3A0x80251100570453c0!2sJl.%20Raya%20Jakarta-Bogor%20No.27%2C%20Ciracas%2C%20Kota%20Jkt%20Timur!5e0!3m2!1sid!2sid!4v1708500000000!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        
        <a href="https://goo.gl/maps/YOUR_LINK_HERE" target="_blank" class="absolute bottom-2 right-2 bg-white text-navy text-xs font-bold px-3 py-1 rounded shadow hover:bg-gold transition">
            Buka di App <i class="fas fa-external-link-alt ml-1"></i>
        </a>
    </div>
</div>
        </div>
        <div class="border-t border-gray-700 pt-8 text-center text-xs text-gray-400">
            &copy; 2026 SSB Taruna Ciracas. All Rights Reserved.
        </div>
    </footer>

    <a href="https://wa.me/6285782008486" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition z-50 animate-bounce">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

</body>
</html>