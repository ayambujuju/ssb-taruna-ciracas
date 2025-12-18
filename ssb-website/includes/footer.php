<?php
// Get settings if not already loaded
if(!isset($settings) && isset($conn)) {
    $settings = getSettings($conn);
}
?>
<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h4 class="fw-bold mb-3"><?php echo $settings['site_name']; ?></h4>
                <p><?php echo $settings['site_description']; ?></p>
                <div class="social-links mt-3">
                    <?php if(!empty($settings['social_facebook'])): ?>
                    <a href="<?php echo $settings['social_facebook']; ?>" class="text-white me-3" target="_blank">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_instagram'])): ?>
                    <a href="<?php echo $settings['social_instagram']; ?>" class="text-white me-3" target="_blank">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_youtube'])): ?>
                    <a href="<?php echo $settings['social_youtube']; ?>" class="text-white me-3" target="_blank">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($settings['social_tiktok'])): ?>
                    <a href="<?php echo $settings['social_tiktok']; ?>" class="text-white" target="_blank">
                        <i class="fab fa-tiktok fa-lg"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="?page=home" class="text-white text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="?page=about" class="text-white text-decoration-none">Tentang Kami</a></li>
                    <li class="mb-2"><a href="?page=programs" class="text-white text-decoration-none">Program</a></li>
                    <li class="mb-2"><a href="?page=gallery" class="text-white text-decoration-none">Galeri</a></li>
                    <li class="mb-2"><a href="?page=news" class="text-white text-decoration-none">Berita</a></li>
                    <li class="mb-2"><a href="?page=contact" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Kontak Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo $settings['contact_address']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone-alt me-2"></i>
                        <?php echo $settings['contact_phone']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope me-2"></i>
                        <?php echo $settings['contact_email']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock me-2"></i>
                        Senin - Jumat: 08:00 - 17:00
                    </li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Berlangganan Info</h5>
                <p>Dapatkan informasi terbaru tentang program dan kegiatan kami.</p>
                <form id="newsletterForm" class="mt-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email Anda" required>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr class="bg-light mt-4 mb-4">
        
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo $settings['site_name']; ?>. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="mb-0">
                    <a href="?page=privacy" class="text-white text-decoration-none me-3">Kebijakan Privasi</a>
                    <a href="?page=terms" class="text-white text-decoration-none">Syarat & Ketentuan</a>
                </p>
            </div>
        </div>
    </div>
</footer>