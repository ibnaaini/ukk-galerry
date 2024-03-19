<?php
    error_reporting(0);
    session_start();
    include 'proses/koneksi.php';
	if($_SESSION['status_login'] != true){
        echo '<script>alert("maaf anda belum login");window.location="login-register.php"</script>';
    }

    // Set nilai default untuk variabel pencarian
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $kat = isset($_GET['kat']) ? mysqli_real_escape_string($conn, $_GET['kat']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <title>Galeri</title>
    <link rel="stylesheet" type="text/css" href="css/style-galeri.css">
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
            <a href="foto.php" onclick="toggleNavbar()"> Data Foto</a>
            <a href="profil.php" onclick="toggleNavbar()">Profile</a>
        </nav>
    </header>

    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari" />
            </form>
        </div>
    </div>

    <div class="section">
        <div class="container-foto">
            <?php
                $albumQuery = mysqli_query($conn, "SELECT * FROM album WHERE albumid = '$kat'");
                $album = mysqli_fetch_array($albumQuery);

                echo '<h3>Galeri ' . $album['namaalbum'] . '</h3>';
            ?>

            <div class="box">
                <?php
                    $where = "AND judulfoto LIKE '%$search%' AND albumid LIKE '%$kat%'";
                    $foto = mysqli_query($conn, "SELECT * FROM foto WHERE 1 $where ORDER BY fotoid DESC");

                    if (mysqli_num_rows($foto) > 0) {
                        while ($p = mysqli_fetch_array($foto)) {
                ?>

                <a href="detail-foto.php?id=<?php echo $p['fotoid'] ?>">
                    <div class="col-4">
                        <img src="foto/<?php echo $p['lokasifile'] ?>">
                        <p class="nama"><?php echo $p['judulfoto'] ?></p>
                        <p class="dn"><i class="fa-solid fa-download"></i></p>
                    </div>
                </a>

                <?php }} else {?>
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
    </script>

</html>