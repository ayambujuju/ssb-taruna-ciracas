<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'config/database.php';
    $db = new Database();
    $conn = $db->connect();
    
    // Sanitize input
    $fullname = sanitize($_POST['fullname']);
    $birth_date = sanitize($_POST['birth_date']);
    $age_group = sanitize($_POST['age_group']);
    $parent_name = sanitize($_POST['parent_name']);
    $parent_phone = sanitize($_POST['parent_phone']);
    $email = sanitize($_POST['email']);
    $address = sanitize($_POST['address']);
    
    // Generate registration number
    $registration_no = generateRegNumber();
    
    // Handle photo upload
    $photo = null;
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = uploadImage($_FILES['photo']);
    }
    
    // Insert into database
    $sql = "INSERT INTO players (registration_no, fullname, birth_date, age_group, 
            parent_name, parent_phone, email, address, photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if($stmt->execute([$registration_no, $fullname, $birth_date, $age_group, 
                       $parent_name, $parent_phone, $email, $address, $photo])) {
        $success = "Pendaftaran berhasil! Nomor Pendaftaran Anda: <strong>$registration_no</strong>";
    } else {
        $error = "Terjadi kesalahan. Silakan coba lagi.";
    }
}
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Pendaftaran SSB</h1>
    
    <?php if(isset($success)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap Pemain *</label>
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir *</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelompok Usia *</label>
                                <select class="form-select" name="age_group" required>
                                    <option value="">Pilih Kelompok Usia</option>
                                    <option value="U-6">U-6 (4-6 tahun)</option>
                                    <option value="U-8">U-8 (7-8 tahun)</option>
                                    <option value="U-10">U-10 (9-10 tahun)</option>
                                    <option value="U-12">U-12 (11-12 tahun)</option>
                                    <option value="U-14">U-14 (13-14 tahun)</option>
                                    <option value="U-16">U-16 (15-16 tahun)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto (3x4)</label>
                                <input type="file" class="form-control" name="photo" accept="image/*">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Orang Tua/Wali *</label>
                            <input type="text" class="form-control" name="parent_name" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP Orang Tua *</label>
                                <input type="tel" class="form-control" name="parent_phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Alamat *</label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Saya menyetujui syarat dan ketentuan yang berlaku
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">Daftar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>