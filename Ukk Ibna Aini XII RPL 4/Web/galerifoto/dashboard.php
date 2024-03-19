<?php
    error_reporting();
    session_start();
    include 'proses/koneksi.php';
	if($_SESSION['status_login'] != true){
        echo '<script>alert("maaf anda belum login");window.location="login-register.php"</script>';
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <title>Login-register</title>
    <link rel="stylesheet" type="text/css" href="css/style-dashboard.css">
    <title>Halaman Dashboard</title>
</head>

<body>


    <header class="header">
        <a href="dashboard.php" class="logo"><i class="fa-solid fa-camera"></i> Zaura Galeri</a>

        <label for="" class="icons" onclick="toggleNavbar()">
            <i class="fas fa-bars"></i>
        </label>
        <nav class="navbar">
            <a href="dashboard.php" onclick="toggleNavbar()">Dashboard</a>
            <a href="album.php" onclick="toggleNavbar()">Album</a>
            <a href="foto.php" onclick="toggleNavbar()">Foto</a>
            <a href="profile.php" onclick="toggleNavbar()">Profile</a>
        </nav>
    </header>


    <?php
        if (isset($_SESSION['selamatdatang'])) {
            echo '<div id="notif" class="notification">';
            echo $_SESSION['selamatdatang'];
            echo '</div>';
            unset($_SESSION['selamatdatang']);
        }
    ?>


    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" />
                <input type="submit" name="cari" value="Cari" />
            </form>
        </div>
    </div>
    

    <div class="section-album">
        <div class="container-album">
            <div class="box-album">

                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM album ORDER BY albumid DESC");
                        if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                
                <a href="galeri.php?kat=<?php echo $k['albumid'] ?>">
                    <div class="col-5">
                        <p><?php echo $k['namaalbum'] ?></p>
                    </div>
                </a>
                
            <?php }}else{ ?>
                
                <p>Kategori tidak ada</p>
                
            <?php } ?>

            </div>
        </div>
    </div>


    <div class="section">
        <div class="container-foto">
            <div class="box">
            <?php 
            $foto = mysqli_query($conn, "SELECT * FROM foto ORDER BY fotoid DESC");
            if(mysqli_num_rows($foto) > 0){
                while($p = mysqli_fetch_array($foto)){
            ?>

            <!-- Kode foto -->
            <a href="detail-foto.php?id=<?php echo $p['fotoid'] ?>">
                <div class="col-4">
                    <img src="foto/<?php echo $p['lokasifile'] ?>">
                    <p class="nama"><?php echo $p['judulfoto'] ?></p>
                    <p class="dn"><a href="foto/<?php echo $p['lokasifile'] ?>" download="<?php echo $p['judulfoto'] ?>.jpg" class="dn" ><i class="fa-solid fa-download"></i></p>
                </div>
            </a>

            <?php } } else { ?>
                <p>Foto Tidak Ada</p>
            <?php } ?>


            </div>
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

    setTimeout(function() {
        notif.style.display = 'none';
    }, 3000);

</script>

</html>