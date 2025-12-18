<?php
/**
 * Website Functions for SSB
 */

// Prevent direct access
if (!defined('ROOT_PATH')) {
    die('Direct access not permitted');
}

/**
 * Get all settings from database
 */
function getSettings($conn) {
    $settings = [];
    try {
        $stmt = $conn->query("SELECT setting_key, setting_value FROM settings");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    } catch(PDOException $e) {
        error_log("Settings Error: " . $e->getMessage());
    }
    return $settings;
}

/**
 * Sanitize input data
 */
function sanitize($data) {
    if(is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Generate registration number
 */
function generateRegNumber() {
    $prefix = 'SSB';
    $year = date('Y');
    $month = date('m');
    $random = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    return $prefix . '-' . $year . $month . '-' . $random;
}

/**
 * Generate invoice number
 */
function generateInvoiceNo() {
    return 'INV-' . date('Ymd') . '-' . strtoupper(uniqid());
}

/**
 * Upload file with validation
 */
function uploadFile($file, $type = 'image', $maxSize = 5) {
    $result = [
        'success' => false,
        'message' => '',
        'filename' => ''
    ];
    
    // Check if file was uploaded
    if(!isset($file) || $file['error'] == UPLOAD_ERR_NO_FILE) {
        $result['message'] = 'Tidak ada file yang diupload';
        return $result;
    }
    
    // Check for upload errors
    if($file['error'] !== UPLOAD_ERR_OK) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File terlalu besar',
            UPLOAD_ERR_FORM_SIZE => 'File terlalu besar',
            UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
            UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan',
            UPLOAD_ERR_CANT_WRITE => 'Gagal menyimpan file',
            UPLOAD_ERR_EXTENSION => 'Upload dihentikan oleh ekstensi PHP'
        ];
        $result['message'] = $errors[$file['error']] ?? 'Unknown upload error';
        return $result;
    }
    
    // Check file size
    $maxSizeBytes = $maxSize * 1024 * 1024;
    if($file['size'] > $maxSizeBytes) {
        $result['message'] = "File terlalu besar. Maksimal {$maxSize}MB";
        return $result;
    }
    
    // Get file info
    $filename = $file['name'];
    $tmp_name = $file['tmp_name'];
    $size = $file['size'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // Generate unique filename
    $newFilename = uniqid() . '_' . time() . '.' . $ext;
    
    // Define upload directory based on type
    $uploadDir = 'uploads/';
    switch($type) {
        case 'player':
            $uploadDir .= 'players/';
            break;
        case 'news':
            $uploadDir .= 'news/';
            break;
        case 'gallery':
            $uploadDir .= 'gallery/';
            break;
        case 'document':
            $uploadDir .= 'documents/';
            break;
        default:
            $uploadDir .= 'temp/';
    }
    
    // Create directory if not exists
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Validate based on type
    if($type == 'image') {
        // Check if file is actually an image
        $check = getimagesize($tmp_name);
        if($check === false) {
            $result['message'] = 'File bukan gambar';
            return $result;
        }
        
        // Allowed image extensions
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if(!in_array($ext, $allowedExts)) {
            $result['message'] = 'Format file tidak didukung. Gunakan JPG, PNG, atau GIF';
            return $result;
        }
        
        // Additional security check
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileMime = mime_content_type($tmp_name);
        if(!in_array($fileMime, $allowedMimes)) {
            $result['message'] = 'Tipe file tidak valid';
            return $result;
        }
    } elseif($type == 'document') {
        $allowedExts = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
        if(!in_array($ext, $allowedExts)) {
            $result['message'] = 'Format dokumen tidak didukung';
            return $result;
        }
    }
    
    // Move uploaded file
    $targetFile = $uploadDir . $newFilename;
    
    if(move_uploaded_file($tmp_name, $targetFile)) {
        $result['success'] = true;
        $result['filename'] = $newFilename;
        $result['full_path'] = $targetFile;
    } else {
        $result['message'] = 'Gagal menyimpan file';
    }
    
    return $result;
}

/**
 * Delete file
 */
function deleteFile($filename, $type = 'image') {
    $baseDir = 'uploads/';
    switch($type) {
        case 'player':
            $baseDir .= 'players/';
            break;
        case 'news':
            $baseDir .= 'news/';
            break;
        case 'gallery':
            $baseDir .= 'gallery/';
            break;
        case 'document':
            $baseDir .= 'documents/';
            break;
    }
    
    $filePath = $baseDir . $filename;
    if(file_exists($filePath) && is_file($filePath)) {
        return unlink($filePath);
    }
    return false;
}

/**
 * Calculate age from birthdate
 */
function calculateAge($birthDate) {
    $birthDate = new DateTime($birthDate);
    $today = new DateTime('today');
    $age = $birthDate->diff($today)->y;
    return $age;
}

/**
 * Format date to Indonesian
 */
function formatDateIndonesian($date, $includeTime = false) {
    if(empty($date) || $date == '0000-00-00') {
        return '-';
    }
    
    $months = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    
    $days = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    
    $timestamp = strtotime($date);
    $day = date('l', $timestamp);
    $dateNum = date('d', $timestamp);
    $month = date('m', $timestamp);
    $year = date('Y', $timestamp);
    
    $formatted = $dateNum . ' ' . $months[$month] . ' ' . $year;
    
    if($includeTime) {
        $time = date('H:i', $timestamp);
        $formatted .= ' ' . $time;
    }
    
    return $formatted;
}

/**
 * Format currency
 */
function formatCurrency($amount, $currency = 'Rp') {
    if(empty($amount)) {
        return $currency . ' 0';
    }
    return $currency . ' ' . number_format($amount, 0, ',', '.');
}

/**
 * Get pagination links
 */
function getPagination($totalItems, $itemsPerPage, $currentPage, $url) {
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    if($totalPages <= 1) {
        return '';
    }
    
    $html = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    
    // Previous button
    if($currentPage > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . ($currentPage - 1) . '">&laquo; Sebelumnya</a></li>';
    }
    
    // Page numbers
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $startPage + 4);
    
    if($startPage > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . '1">1</a></li>';
        if($startPage > 2) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    for($i = $startPage; $i <= $endPage; $i++) {
        $active = ($i == $currentPage) ? ' active' : '';
        $html .= '<li class="page-item' . $active . '"><a class="page-link" href="' . $url . $i . '">' . $i . '</a></li>';
    }
    
    if($endPage < $totalPages) {
        if($endPage < $totalPages - 1) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . $totalPages . '">' . $totalPages . '</a></li>';
    }
    
    // Next button
    if($currentPage < $totalPages) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . ($currentPage + 1) . '">Selanjutnya &raquo;</a></li>';
    }
    
    $html .= '</ul></nav>';
    
    return $html;
}

/**
 * Send email notification
 */
function sendEmail($to, $subject, $body, $from = null) {
    if($from === null) {
        global $settings;
        $from = $settings['contact_email'];
    }
    
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $body, $headers);
}

/**
 * Generate slug from string
 */
function generateSlug($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

/**
 * Check if string is valid email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if string is valid phone number
 */
function isValidPhone($phone) {
    // Remove all non-numeric characters except +
    $clean = preg_replace('/[^0-9+]/', '', $phone);
    
    // Check if it starts with + or 0
    if(preg_match('/^(\+62|62|0)8[1-9][0-9]{6,9}$/', $clean)) {
        return true;
    }
    
    return false;
}

/**
 * Get age group from birthdate
 */
function getAgeGroup($birthDate) {
    $age = calculateAge($birthDate);
    
    if($age <= 6) return 'U-6';
    if($age <= 8) return 'U-8';
    if($age <= 10) return 'U-10';
    if($age <= 12) return 'U-12';
    if($age <= 14) return 'U-14';
    return 'U-16';
}

/**
 * Get player statistics
 */
function getPlayerStats($conn) {
    $stats = [];
    
    $query = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'inactive' THEN 1 ELSE 0 END) as inactive
              FROM players";
    $stmt = $conn->query($query);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Add age group distribution
    $ageQuery = "SELECT age_group, COUNT(*) as count FROM players WHERE status = 'active' GROUP BY age_group";
    $ageStmt = $conn->query($ageQuery);
    $stats['age_groups'] = $ageStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $stats;
}

/**
 * Get recent registrations
 */
function getRecentRegistrations($conn, $limit = 5) {
    $query = "SELECT * FROM players ORDER BY created_at DESC LIMIT :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get featured programs
 */
function getFeaturedPrograms($conn, $limit = 3) {
    $query = "SELECT * FROM programs WHERE is_featured = 1 AND is_active = 1 ORDER BY created_at DESC LIMIT :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get latest news
 */
function getLatestNews($conn, $limit = 3) {
    $query = "SELECT * FROM news WHERE is_published = 1 ORDER BY created_at DESC LIMIT :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get gallery by category
 */
function getGalleryByCategory($conn, $category = null, $limit = 6) {
    $query = "SELECT * FROM gallery WHERE 1=1";
    $params = [];
    
    if($category) {
        $query .= " AND category = :category";
        $params[':category'] = $category;
    }
    
    $query .= " ORDER BY created_at DESC LIMIT :limit";
    $params[':limit'] = $limit;
    
    $stmt = $conn->prepare($query);
    foreach($params as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get active coaches
 */
function getActiveCoaches($conn) {
    $query = "SELECT * FROM coaches WHERE is_active = 1 ORDER BY display_order, name";
    $stmt = $conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Log activity
 */
function logActivity($conn, $userId, $action, $details = null) {
    $query = "INSERT INTO activity_logs (user_id, action, details, ip_address, user_agent) 
              VALUES (:user_id, :action, :details, :ip, :agent)";
    
    $stmt = $conn->prepare($query);
    return $stmt->execute([
        ':user_id' => $userId,
        ':action' => $action,
        ':details' => $details,
        ':ip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ':agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
    ]);
}

/**
 * Generate CSRF token
 */
function generateCsrfToken() {
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF token
 */
function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Redirect with message
 */
function redirect($url, $message = null, $type = 'success') {
    if($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header('Location: ' . $url);
    exit;
}

/**
 * Get flash message
 */
function getFlashMessage() {
    if(isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'success';
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

/**
 * Create breadcrumb navigation
 */
function createBreadcrumb($items) {
    if(empty($items)) return '';
    
    $html = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
    
    foreach($items as $index => $item) {
        $isLast = ($index == count($items) - 1);
        
        $html .= '<li class="breadcrumb-item';
        $html .= $isLast ? ' active" aria-current="page">' : '">';
        
        if(!$isLast && isset($item['url'])) {
            $html .= '<a href="' . $item['url'] . '">';
        }
        
        $html .= htmlspecialchars($item['title']);
        
        if(!$isLast && isset($item['url'])) {
            $html .= '</a>';
        }
        
        $html .= '</li>';
    }
    
    $html .= '</ol></nav>';
    
    return $html;
}
?>