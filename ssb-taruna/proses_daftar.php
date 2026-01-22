<?php
include 'koneksi.php';

if (isset($_POST['daftar'])) {
    // Menangkap data dari form index.php
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $nisn         = $_POST['nisn'];
    $nama_ortu    = $_POST['nama_ortu'];
    $hp_ortu      = $_POST['hp_ortu'];
    $alamat       = $_POST['alamat'];

    // Proses Upload Foto
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp  = $_FILES['foto']['tmp_name'];
    $fotoSize = $_FILES['foto']['size'];
    $error    = $_FILES['foto']['error'];

    // Cek apakah ada foto yg diupload
    if ($error === 4) {
        echo "<script>alert('Pilih foto terlebih dahulu!'); window.location='index.php#daftar';</script>";
        return false;
    }

    // Cek ekstensi foto (Wajib Gambar)
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFoto  = explode('.', $fotoName);
    $ekstensiFoto  = strtolower(end($ekstensiValid));
    
    // Generate nama file baru (agar tidak duplikat)
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFoto; // misal: 65a8s7d6.jpg

    $folderUpload = "uploads/";

    // Pindahkan file
    if (move_uploaded_file($fotoTmp, $folderUpload . $fotoName)) { // Menggunakan nama asli sementara utk simpel
        // Jika berhasil upload, masukkan ke Database
        // Pastikan nama kolom database sesuai dengan tabel 'pendaftaran'
        $query = "INSERT INTO pendaftaran (nama_lengkap, tempat_lahir, tgl_lahir, nisn, nama_ortu, hp_ortu, alamat, foto) 
                  VALUES ('$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$nisn', '$nama_ortu', '$hp_ortu', '$alamat', '$fotoName')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Terima kasih! Pendaftaran Berhasil. Admin kami akan segera menghubungi Anda.'); 
                    window.location='index.php';
                  </script>";
        } else {
            echo "Error DB: " . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Gagal mengupload foto!'); window.location='index.php#daftar';</script>";
    }
}
?>