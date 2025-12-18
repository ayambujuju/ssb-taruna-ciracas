<?php
// Get settings if not already loaded
if(!isset($settings) && isset($conn)) {
    $settings = getSettings($conn);
}
?>
<!-- Top Bar -->
<div class="top-bar bg-dark text-white py-2 d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="fas fa-phone-alt me-2"></i>
                    <span class="me-3"><?php echo $settings['contact_phone']; ?></span>
                    <i class="fas fa-envelope me-2"></i>
                    <span><?php echo $settings['contact_email']; ?></span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="social-links">
                    <?php if(!empty($settings['social_facebook'])): ?>
                    <a href="<?php echo $settings['social_facebook']; ?>" target="_blank" class="text-white me-3">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_instagram'])): ?>
                    <a href="<?php echo $settings['social_instagram']; ?>" target="_blank" class="text-white me-3">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_youtube'])): ?>
                    <a href="<?php echo $settings['social_youtube']; ?>" target="_blank" class="text-white me-3">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_tiktok'])): ?>
                    <a href="<?php echo $settings['social_tiktok']; ?>" target="_blank" class="text-white">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
            <?php if(file_exists('assets/images/logo.png')): ?>
            <img src="assets/images/logo.png" alt="<?php echo $settings['site_name']; ?>" height="50">
            <?php else: ?>
            <span class="fw-bold text-primary fs-3"><?php echo $settings['site_name']; ?></span>
            <?php endif; ?>
        </a>
        
        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'home' ? 'active fw-bold' : ''; ?>" href="<?php echo BASE_URL; ?>">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($page, ['about', 'coaches', 'facilities']) ? 'active fw-bold' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown">
                        Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=about">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="?page=coaches">Pelatih & Staff</a></li>
                        <li><a class="dropdown-item" href="?page=facilities">Fasilitas</a></li>
                        <li><a class="dropdown-item" href="?page=achievements">Prestasi</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($page, ['programs', 'schedule']) ? 'active fw-bold' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown">
                        Program
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=programs">Program Kami</a></li>
                        <li><a class="dropdown-item" href="?page=schedule">Jadwal Latihan</a></li>
                        <li><a class="dropdown-item" href="?page=tryout">Info Tryout</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'gallery' ? 'active fw-bold' : ''; ?>" href="?page=gallery">
                        Galeri
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'news' ? 'active fw-bold' : ''; ?>" href="?page=news">
                        Berita
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary ms-2 <?php echo $page == 'registration' ? 'active' : ''; ?>" href="?page=registration">
                        <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'contact' ? 'active fw-bold' : ''; ?>" href="?page=contact">
                        Kontak
                    </a>
                </li>
                
                <!-- Admin Login (only show if not logged in) -->
                <?php if(!isset($_SESSION['user_id'])): ?>
                <li class="nav-item ms-2">
                    <a class="nav-link btn btn-outline-secondary" href="admin/login.php" target="_blank">
                        <i class="fas fa-sign-in-alt me-1"></i> Admin
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<?php
$flash = getFlashMessage();
if($flash): ?>
<div class="container mt-3">
    <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $flash['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>