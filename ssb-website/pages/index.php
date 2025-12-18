<?php
$programs = getPrograms($conn, 3);
$news = getNews($conn, 3);
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">SSB BINTANG MUDA</h1>
                <p class="lead">Membentuk Generasi Unggul melalui Sepak Bola</p>
                <a href="?page=registration" class="btn btn-primary btn-lg mt-3">Daftar Sekarang</a>
            </div>
            <div class="col-md-6">
                <img src="assets/images/hero-image.jpg" class="img-fluid rounded" alt="SSB Hero">
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Program Kami</h2>
        <div class="row">
            <?php foreach($programs as $program): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $program['title']; ?></h5>
                        <p class="card-text"><?php echo substr($program['description'], 0, 100); ?>...</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-users"></i> Kelompok: <?php echo $program['age_group']; ?></li>
                            <li><i class="fas fa-calendar"></i> Jadwal: <?php echo $program['schedule']; ?></li>
                            <li><i class="fas fa-tag"></i> Biaya: Rp <?php echo number_format($program['fee'], 0, ',', '.'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="?page=programs" class="btn btn-outline-primary">Lihat Semua Program</a>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Berita Terbaru</h2>
        <div class="row">
            <?php foreach($news as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if($item['image']): ?>
                    <img src="uploads/<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['title']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['title']; ?></h5>
                        <p class="card-text"><?php echo substr(strip_tags($item['content']), 0, 150); ?>...</p>
                        <small class="text-muted"><?php echo date('d M Y', strtotime($item['created_at'])); ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats Counter -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h3 class="display-4">250+</h3>
                <p>Pemain Aktif</p>
            </div>
            <div class="col-md-3">
                <h3 class="display-4">15</h3>
                <p>Pelatih Bersertifikat</p>
            </div>
            <div class="col-md-3">
                <h3 class="display-4">50+</h3>
                <p>Prestasi</p>
            </div>
            <div class="col-md-3">
                <h3 class="display-4">10</h3>
                <p>Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</section>