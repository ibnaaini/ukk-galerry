<?php
session_start();
include 'proses/koneksi.php';

    if ($_SESSION['status_login'] != true) {
        echo '<script>alert("maaf anda belum login");window.location="login-register.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM user WHERE userid ='".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" type="text/css" href="css/style-profil.css">
    <title>Halaman Profile</title>
</head>

<style>
    
</style>

<body>

    <header class="header">
        <a href="dashboard.php" class="logo"><i class="fa-solid fa-camera"></i> Zaura Galeri</a>

        <label for="" class="icons" onclick="toggleNavbar()">
            <i class="fas fa-bars"></i>
        </label>
        <nav class="navbar">
            <a href="dashboard.php" onclick="toggleNavbar()">Dashboard</a>
            <a href="album.php" onclick="toggleNavbar()">Album</a>
            <a href="foto.php" onclick="toggleNavbar()"> Data Foto</a>
            <a href="profile.php" onclick="toggleNavbar()">Profile</a>
        </nav>
    </header>
    

    <div class="section">

        <div class="container">
            <h3>Profile</h3>
            <div class="box">
                <form action="proses/proses-profile.php" method="POST" class="form">
                    <p>Nama Lengkap</p><input type="text" name="namalengkap" class="input-control" autocomplete="off" value="<?php echo $d->namalengkap ?>" required>
                    <p>Username</p><input type="text" name="username" class="input-control" autocomplete="off" value="<?php echo $d->username ?>" required>
                    <p>Email</p><input type="email" name="email" class="input-control" autocomplete="off" value="<?php echo $d->email ?>" required>
                    <p>Alamat</p><input type="text" name="alamat" class="input-control" autocomplete="off" value="<?php echo $d->alamat ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>

                <form action="proses/proses-profile.php" method="POST" class="form">
                    <p>Password Baru</p><input type="password" name="pass1" class="input-control" required>
                    <p>Konfirmasi Password</p><input type="password" name="pass2" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                    <a href="proses/logout.php" class="logout">Logout</a>
                </form>
            </div>

            <!-- <h3>Ubah Password</h3>
            <div class="box">
                <form action="proses/proses-profile.php" method="POST">
                    <p>Password Baru</p><input type="password" name="pass1" class="input-control" required>
                    <p>Konfirmasi Password</p><input type="password" name="pass2" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                    <a href="proses/logout.php" class="logout">Logout</a>
                </form>
            </div> -->
        </div>
        
    </div>


    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Website Galeri Foto.</small>
        </div>
    </footer>


</body>


<script>

    function toggleNavbar() {
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('active');
    }
    function openModal() {
        document.getElementById('tambahfotoModal').style.display = 'block';
    }

</script>


</html>