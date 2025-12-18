<?php
session_start();
require_once '../config/database.php';
require_once '../includes/auth.php';

// Check if user is logged in
checkAdmin();

$db = new Database();
$conn = $db->connect();

// Get statistics
$stats = [
    'total_players' => $conn->query("SELECT COUNT(*) FROM players")->fetchColumn(),
    'active_players' => $conn->query("SELECT COUNT(*) FROM players WHERE status='active'")->fetchColumn(),
    'pending_registrations' => $conn->query("SELECT COUNT(*) FROM players WHERE status='pending'")->fetchColumn(),
    'total_programs' => $conn->query("SELECT COUNT(*) FROM programs")->fetchColumn()
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SSB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Admin Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">SSB Admin</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="manage_players.php"><i class="fas fa-users"></i> Pemain</a>
                <a class="nav-link" href="manage_content.php"><i class="fas fa-newspaper"></i> Konten</a>
                <a class="nav-link" href="../includes/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Stats Cards -->
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Pemain</h5>
                        <h2><?php echo $stats['total_players']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pemain Aktif</h5>
                        <h2><?php echo $stats['active_players']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <h2><?php echo $stats['pending_registrations']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Program</h5>
                        <h2><?php echo $stats['total_programs']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="manage_players.php?action=add" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Tambah Pemain
                        </a>
                        <a href="manage_content.php?type=news" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Berita
                        </a>
                        <a href="manage_players.php?status=pending" class="btn btn-warning">
                            <i class="fas fa-clock"></i> Review Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>