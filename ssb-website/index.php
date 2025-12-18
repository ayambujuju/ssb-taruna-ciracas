<?php
// Start session
session_start();

// Define constants
define('ROOT_PATH', dirname(__FILE__));
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

// Include configuration
require_once 'config/database.php';
require_once 'includes/functions.php';

// Initialize database connection
$db = new Database();
$conn = $db->connect();

// Get site settings
$settings = getSettings($conn);

// Get current page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Check if page exists
$pageFile = 'pages/' . $page . '.php';
if(!file_exists($pageFile)) {
    $page = '404';
    $pageFile = 'pages/404.php';
}

// Check maintenance mode
if($settings['maintenance_mode'] == '1' && $page != 'maintenance') {
    header('Location: ' . BASE_URL . '?page=maintenance');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($settings['site_description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($settings['site_keywords']); ?>">
    
    <title><?php echo ($page == 'home' ? $settings['site_title'] : ucfirst($page) . ' | ' . $settings['site_name']); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Page-specific CSS -->
    <?php if(file_exists('assets/css/' . $page . '.css')): ?>
    <link rel="stylesheet" href="assets/css/<?php echo $page; ?>.css">
    <?php endif; ?>
    
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SportsOrganization",
        "name": "<?php echo $settings['site_name']; ?>",
        "description": "<?php echo $settings['site_description']; ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo $settings['contact_address']; ?>"
        },
        "telephone": "<?php echo $settings['contact_phone']; ?>",
        "email": "<?php echo $settings['contact_email']; ?>",
        "sport": "Soccer"
    }
    </script>
</head>
<body>
    <!-- Top Bar -->
    <?php include 'includes/topbar.php'; ?>
    
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
    
    <!-- Main Content -->
    <main id="main-content">
        <?php include $pageFile; ?>
    </main>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="btn btn-primary">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/<?php echo str_replace('+', '', $settings['contact_phone']); ?>?text=Halo%20<?php echo urlencode($settings['site_name']); ?>%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran" 
       class="whatsapp-float" target="_blank" title="Chat via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom Scripts -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/validation.js"></script>
    
    <?php if(file_exists('assets/js/' . $page . '.js')): ?>
    <script src="assets/js/<?php echo $page; ?>.js"></script>
    <?php endif; ?>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Base URL for JS
        const BASE_URL = '<?php echo BASE_URL; ?>';
        
        // CSRF Token (if needed)
        const csrf_token = '<?php echo isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : ''; ?>';
    </script>
</body>
</html>