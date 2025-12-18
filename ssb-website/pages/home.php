<?php
// Get data for homepage
$featuredPrograms = getFeaturedPrograms($conn, 4);
$latestNews = getLatestNews($conn, 4);
$coaches = getActiveCoaches($conn);
$gallery = getGalleryByCategory($conn, null, 8);
$playerStats = getPlayerStats($conn);
?>
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center min-vh-80">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-3 fw-bold text-white mb-4">
                    <?php echo $settings['site_name']; ?>
                </h1>
                <p class="lead text-white mb-4">
                    <?php echo $settings['site_description']; ?>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="?page=registration" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="?page=programs" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-futbol me-2"></i> Lihat Program
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image position-relative">
                    <img src="assets/images/hero-player.png" alt="SSB Player" class="img-fluid rounded shadow-lg">
                    <div class="floating-badge bg-primary text-white rounded-pill p-3 shadow">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-trophy fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-0">50+</h5>
                                <small class="d-block">Prestasi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Animated background elements -->
    <div class="hero-shape-1"></div>
    <div class="hero-shape-2"></div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <h2 class="fw-bold text-primary"><?php echo $playerStats['total'] ?? 0; ?>+</h2>
                    <p class="text-muted mb-0">Total Pemain</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-user-tie fa-3x text-primary"></i>
                    </div>
                    <h2 class="fw-bold text-primary"><?php echo count($coaches); ?>+</h2>
                    <p class="text-muted mb-0">Pelatih Bersertifikat</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-trophy fa-3x text-primary"></i>
                    </div>
                    <h2 class="fw-bold text-primary">50+</h2>
                    <p class="text-muted mb-0">Prestasi</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                    </div>
                    <h2 class="fw-bold text-primary">10+</h2>
                    <p class="text-muted mb-0">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Programs -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Program Unggulan</span>
                <h2 class="display-5 fw-bold mb-3">Program Kami</h2>
                <p class="lead text-muted">Kami menawarkan berbagai program sepak bola untuk semua usia dan tingkat keterampilan.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach($featuredPrograms as $index => $program): ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="card program-card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body p-4">
                        <div class="program-icon mb-4">
                            <i class="fas fa-futbol fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3"><?php echo $program['title']; ?></h5>
                        <p class="card-text text-muted mb-4"><?php echo substr($program['description'], 0, 100); ?>...</p>
                        
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <i class="fas fa-users text-primary me-2"></i>
                                <small><?php echo $program['age_group']; ?></small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <small><?php echo $program['schedule']; ?></small>
                            </li>
                            <li>
                                <i class="fas fa-clock text-primary me-2"></i>
                                <small><?php echo $program['time']; ?></small>
                            </li>
                        </ul>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary"><?php echo formatCurrency($program['fee']); ?></span>
                            <a href="?page=programs&id=<?php echo $program['id']; ?>" class="btn btn-outline-primary btn-sm">
                                Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="?page=programs" class="btn btn-primary px-4 py-3">
                <i class="fas fa-list me-2"></i> Lihat Semua Program
            </a>
        </div>
    </div>
</section>

<!-- Coaches Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Pelatih Profesional</span>
                <h2 class="display-5 fw-bold mb-3">Tim Pelatih Kami</h2>
                <p class="lead text-muted">Didukung oleh pelatih bersertifikat dan berpengalaman.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach($coaches as $index => $coach): ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="card coach-card border-0 shadow-sm h-100">
                    <div class="coach-image position-relative">
                        <?php if($coach['photo']): ?>
                        <img src="uploads/coaches/<?php echo $coach['photo']; ?>" class="card-img-top" alt="<?php echo $coach['name']; ?>">
                        <?php else: ?>
                        <img src="assets/images/default-coach.jpg" class="card-img-top" alt="<?php echo $coach['name']; ?>">
                        <?php endif; ?>
                        <div class="coach-overlay bg-primary text-white p-3">
                            <h6 class="mb-0"><?php echo $coach['title']; ?></h6>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold mb-2"><?php echo $coach['name']; ?></h5>
                        <p class="card-text text-muted mb-3"><?php echo $coach['specialization']; ?></p>
                        
                        <?php if($coach['license']): ?>
                        <span class="badge bg-light text-dark mb-3"><?php echo $coach['license']; ?></span>
                        <?php endif; ?>
                        
                        <div class="social-links mt-3">
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Latest News -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Berita Terbaru</span>
                <h2 class="display-5 fw-bold mb-3">Berita & Artikel</h2>
                <p class="lead text-muted">Tetap update dengan informasi terbaru dari SSB kami.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach($latestNews as $index => $news): ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="card news-card border-0 shadow-sm h-100">
                    <?php if($news['image']): ?>
                    <img src="uploads/news/<?php echo $news['image']; ?>" class="card-img-top" alt="<?php echo $news['title']; ?>">
                    <?php else: ?>
                    <img src="assets/images/default-news.jpg" class="card-img-top" alt="<?php echo $news['title']; ?>">
                    <?php endif; ?>
                    
                    <div class="card-body p-4">
                        <div class="news-meta mb-3">
                            <span class="badge bg-light text-dark me-2">
                                <i class="fas fa-calendar me-1"></i>
                                <?php echo date('d M Y', strtotime($news['created_at'])); ?>
                            </span>
                            <span class="badge bg-primary">
                                <?php echo ucfirst($news['category']); ?>
                            </span>
                        </div>
                        
                        <h5 class="card-title fw-bold mb-3">
                            <a href="?page=news_detail&id=<?php echo $news['id']; ?>" class="text-decoration-none text-dark">
                                <?php echo $news['title']; ?>
                            </a>
                        </h5>
                        
                        <p class="card-text text-muted mb-4">
                            <?php echo substr(strip_tags($news['content']), 0, 120); ?>...
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="?page=news_detail&id=<?php echo $news['id']; ?>" class="text-primary text-decoration-none">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                            <span class="text-muted small">
                                <i class="fas fa-eye me-1"></i> <?php echo $news['views']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="?page=news" class="btn btn-outline-primary px-4 py-3">
                <i class="fas fa-newspaper me-2"></i> Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Galeri Kegiatan</span>
                <h2 class="display-5 fw-bold mb-3">Momen Terbaik</h2>
                <p class="lead text-muted">Kumpulan momen berharga selama latihan dan pertandingan.</p>
            </div>
        </div>
        
        <div class="row g-3">
            <?php foreach($gallery as $index => $item): ?>
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 50; ?>">
                <a href="uploads/gallery/<?php echo $item['image']; ?>" class="gallery-item" data-lightbox="gallery" data-title="<?php echo $item['title']; ?>">
                    <div class="gallery-thumb position-relative overflow-hidden rounded">
                        <img src="uploads/gallery/<?php echo $item['image']; ?>" class="img-fluid w-100" alt="<?php echo $item['title']; ?>">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="?page=gallery" class="btn btn-primary px-4 py-3">
                <i class="fas fa-images me-2"></i> Lihat Galeri Lengkap
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-6 fw-bold mb-3">Siap Bergabung dengan Kami?</h2>
                <p class="lead mb-4">Daftarkan putra/putri Anda sekarang dan jadilah bagian dari keluarga besar <?php echo $settings['site_name']; ?>.</p>
            </div>
            <div class="col-lg-4 text-end" data-aos="fade-left">
                <div class="d-flex flex-column flex-md-row gap-3">
                    <a href="?page=registration" class="btn btn-light btn-lg px-4 py-3">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="?page=contact" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-phone-alt me-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Testimoni</span>
                <h2 class="display-5 fw-bold mb-3">Kata Orang Tua</h2>
                <p class="lead text-muted">Apa kata orang tua tentang pengalaman anak mereka di <?php echo $settings['site_name']; ?>.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel testimonial-carousel" data-aos="fade-up">
                    <!-- Testimonial 1 -->
                    <div class="testimonial-item p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img src="assets/images/testimonial-1.jpg" class="rounded-circle me-3" width="60" height="60" alt="Testimonial">
                            <div>
                                <h5 class="mb-0">Budi Santoso</h5>
                                <p class="text-muted mb-0">Orang tua dari Andi (U-12)</p>
                            </div>
                        </div>
                        <p class="mb-0">"Anak saya sangat senang latihan di sini. Pelatihnya profesional dan metode latihannya modern. Prestasi sekolahnya juga tidak terganggu."</p>
                        <div class="rating mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="testimonial-item p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img src="assets/images/testimonial-2.jpg" class="rounded-circle me-3" width="60" height="60" alt="Testimonial">
                            <div>
                                <h5 class="mb-0">Sari Dewi</h5>
                                <p class="text-muted mb-0">Orang tua dari Rina (U-10)</p>
                            </div>
                        </div>
                        <p class="mb-0">"Disiplin dan karakter anak saya jauh lebih baik sejak bergabung. Tidak hanya skill sepak bola, tapi juga nilai-nilai kehidupan yang diajarkan."</p>
                        <div class="rating mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="testimonial-item p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img src="assets/images/testimonial-3.jpg" class="rounded-circle me-3" width="60" height="60" alt="Testimonial">
                            <div>
                                <h5 class="mb-0">Ahmad Fauzi</h5>
                                <p class="text-muted mb-0">Orang tua dari Dika (U-14)</p>
                            </div>
                        </div>
                        <p class="mb-0">"Fasilitas lengkap, pelatih berkualitas, dan manajemen yang transparan. Biaya juga terjangkau untuk kualitas yang diberikan."</p>
                        <div class="rating mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>