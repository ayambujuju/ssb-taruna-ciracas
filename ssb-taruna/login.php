<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($cek) > 0) {
        $d = mysqli_fetch_object($cek);
        $_SESSION['admin'] = $user;
        $_SESSION['nama_admin'] = $d->nama_admin;
        header("location:admin.php");
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - SSB Taruna Ciracas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { navy: '#001f3f', gold: '#D4AF37' } } }
        }
    </script>
</head>
<body class="bg-navy h-screen flex items-center justify-center font-sans">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl border-t-8 border-gold relative overflow-hidden">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-navy tracking-wider">SSB TARUNA CIRACAS</h1>
            <p class="text-xs text-gray-500 font-semibold tracking-widest mt-1">ADMINISTRATOR PANEL</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center border border-red-200">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-navy focus:ring-1 focus:ring-navy outline-none transition" placeholder="Masukkan username" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-navy focus:ring-1 focus:ring-navy outline-none transition" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login" class="w-full bg-navy text-white py-3 rounded-lg font-bold hover:bg-blue-900 transition duration-300 shadow-lg transform hover:-translate-y-1">
                MASUK KE DASHBOARD
            </button>
        </form>

        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; 2024 SSB Taruna Ciracas System
        </div>
    </div>

</body>
</html>