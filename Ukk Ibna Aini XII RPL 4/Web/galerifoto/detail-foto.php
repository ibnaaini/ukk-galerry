<?php
    session_start();
    include 'proses/koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>alert("maaf anda belum login");window.location="login-register.php"</script>';
    }

    $userid = $_SESSION['id'];
    $query = "SELECT foto.*, album.namaalbum, user.namalengkap, komentarfoto.komentarid
            FROM foto
            INNER JOIN album ON foto.albumid = album.albumid
            INNER JOIN user ON foto.userid = user.userid
            LEFT JOIN komentarfoto ON foto.fotoid = komentarfoto.fotoid
            WHERE foto.fotoid = '" . $_GET['id'] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_object($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" type="text/css" href="css/style-detail.css">
    <title>Detail Foto</title>
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
            <a href="profile.php" onclick="toggleNavbar()">Profile</a>
        </nav>
    </header>


    <div class="section">
        <div class="container">
        <h3 class="detailfoto">Detail foto</h3>
        <div class="box">
            <div class="col-2">

            <div class="col-2-1">
                <div class="col-2-gambar">
                    <p class="judul"><b><?php echo $row->judulfoto ?></b></p>
                    <img src="foto/<?php echo $row->lokasifile ?>"/>
                </div>
            </div>
                
                <div class="detail">

                    <div class="detail-one" id="laptop">
                        <div class="komentarjudul">
                            <h3>Komentar</h3>
                        </div>
                        <div class="komentar-section">   
                            <div class="komentar-list">
                            <?php
                                $up = mysqli_query($conn, "SELECT k.*, u.namalengkap
                                FROM komentarfoto k
                                INNER JOIN user u ON k.userid = u.userid
                                WHERE k.fotoid = '".$_GET['id']."' 
                                ORDER BY k.tanggalkomentar DESC, k.komentarid DESC");

                                if(mysqli_num_rows($up) > 0){
                                    while($u = mysqli_fetch_array($up)){
                                ?>

                                <div class="komentar-item comment-container">
                                    <h4><?php echo $u['namalengkap'] ?></h4>
                                    <h5><?php echo $u['isikomentar'] ?></h5>
                                    <h6><?php echo $u['tanggalkomentar'] ?></h6>

                                    <?php if ($_SESSION['id'] == $u['userid']) { ?>

                                        <form action="" method="POST">
                                            <input type="hidden" name="fotoid" value="<?php echo $row->fotoid ?>">
                                            <input type="hidden" name="hapus" value="<?php echo $u['komentarid'] ?>">
                                            <button class="hpskomen" name="hapuskomen" onclick="return confirm('Anda yakin ingin menghapus komentar?')">
                                                <i class="fa-solid fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    <?php } ?>

                                </div>

                                <?php
                                    if(isset($_POST['hapuskomen'])){
                                        if(isset($_SESSION['id'])){
                                            $userid = $_SESSION['id'];
                                            $fotoid = $_POST['fotoid'];
                                            $komentarid = $_POST['hapus'];
                                            mysqli_query($conn, "DELETE FROM komentarfoto WHERE fotoid='$fotoid' AND userid='$userid' AND komentarid='$komentarid'");
                                            echo '<script>window.location="detail-foto.php?id='.$_GET['id'].'"</script>';
                                        }else{
                                            echo'gagal'.mysqli_error($conn);
                                        }
                                    }
                                
                                ?>
                                <?php
                                    }
                                } else {
                                    echo '<p style="margin: 10px;">Tidak ada komentar.</p>';
                                }
                                ?>

                            </div>
                        </div>

                    </div>

                    <div class="detail-two">

                        <p class="nama"><?php echo $row->namalengkap ?></p>
                        <p class="tanggal"><?php echo $row->tanggalunggah  ?></p>    
                        <p class="deskripsi"><?php echo $row->deskripsifoto ?></p>
                        
                        <div class="atribut">
                        <?php
                            $fotoid = $row->fotoid;
                            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid = '$fotoid' AND userid = '$userid'");
                        ?>

                        <a href="proses/like.php?fotoid=<?php echo $row->fotoid ?>" 
                           style="font-size: 1.25rem; color: <?php echo (mysqli_num_rows($sql2) == 1) ? '#1100ff' : '#808080'; ?>;
                           text-decoration: none; outline: none;">
                           <i class="fa-solid fa-thumbs-up" id="like"></i>
                        </a>

                        <?php
                            $fotoid = $row->fotoid;
                            $sql2   = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid = '$fotoid'");
                                echo mysqli_num_rows($sql2);
                        ?> 

                        <?php
                            $fotoid = $row->fotoid;
                            $sql2 = mysqli_query($conn, "SELECT * FROM dislikefoto WHERE fotoid = '$fotoid' AND userid = '$userid'");
                        ?>

                        <a href="proses/dislike.php?fotoid=<?php echo $row->fotoid ?>" 
                           style="font-size: 1.25rem; color: <?php echo (mysqli_num_rows($sql2) == 1) ? '#ff0000' : '#808080'; ?>;
                           text-decoration: none; outline: none;">
                           <i class="fa-solid fa-thumbs-down" id="dislike"></i>
                        </a>

                        <?php
                            $fotoid = $row->fotoid;
                            $sql2   = mysqli_query($conn, "SELECT * FROM dislikefoto WHERE fotoid = '$fotoid'");
                                echo mysqli_num_rows($sql2);
                        ?> 
                        
                        

                        <a href="#boxkomen" class="boxkomen" onclick="toggleComments()">
                            <i class="fa-solid fa-comment"></i>
                        </a>

                        <?php
                            $fotoid = $_GET['id'];
                            $sql3   = mysqli_query($conn, "SELECT COUNT(*) as total_komentar FROM komentarfoto WHERE fotoid = '$fotoid'");
                            $result = mysqli_fetch_assoc($sql3);
                                echo $result['total_komentar'];
                        ?> 

                        <a href="foto/<?php echo $row->lokasifile ?>" download="<?php echo $row->judulfoto ?>.jpg" class="download" >
                             <i class="fa-solid fa-download"></i> unduh
                        </a>

                        </div>

                        <form action="" method="POST">
                            <input type="hidden" name="fotoid" value="<?php echo $row->fotoid ?>">
                            <input type="hidden" name="userid" value="<?php echo $_SESSION['a_global']->userid ?>">
                            <input type="hidden" name="username" value="<?php echo $_SESSION['a_global']->username ?>">
                            <div id="komen">
                                <input type="text" id="boxkomen" name="komentar" class="input-control" required>
                                <input type="submit" name="submit" value="Kirim" class="btnk">
                            </div>
                        </form>

                        <?php
                        if(isset($_POST['submit'])){
                            // include 'koneksi.php';
                            $fotoid = $_POST['fotoid'];
                            $userid = $_POST['userid'];
                            $username = $_POST['username'];
                            $komentar = $_POST['komentar'];
                        
                            $insert = mysqli_query($conn, "INSERT INTO komentarfoto VALUES (
                                null,
                                '".$fotoid."',
                                '".$userid."',
                                '".$komentar."',
                                NOW() 
                            )");
                            
                            if($insert) {
                                echo '<script>window.location="detail-foto.php?id=' .$_GET['id'].'"</script>';
                            } else {
                                echo 'gagal'.mysqli_error($conn);
                            }
                        }
                        ?>
                    </div>


                    <div class="detail-one" id="hp">
                        <div class="komentarjudul">
                            <h3>Komentar</h3>
                        </div>
                        <div class="komentar-section">   
                            <div class="komentar-list">
                            <?php
                                $up = mysqli_query($conn, "SELECT k.*, u.namalengkap
                                FROM komentarfoto k
                                INNER JOIN user u ON k.userid = u.userid
                                WHERE k.fotoid = '".$_GET['id']."' 
                                ORDER BY k.tanggalkomentar DESC, k.komentarid DESC");

                                if(mysqli_num_rows($up) > 0){
                                    while($u = mysqli_fetch_array($up)){
                                ?>

                                <div class="komentar-item comment-container">
                                    <h4><?php echo $u['namalengkap'] ?></h4>
                                    <h5><?php echo $u['isikomentar'] ?></h5>
                                    <h6><?php echo $u['tanggalkomentar'] ?></h6>

                                    <?php if ($_SESSION['id'] == $u['userid']) { ?>

                                        <form action="" method="POST">
                                            <input type="hidden" name="fotoid" value="<?php echo $row->fotoid ?>">
                                            <input type="hidden" name="hapus" value="<?php echo $u['komentarid'] ?>">
                                            <button class="hpskomen" name="hapuskomen" onclick="return confirm('Anda yakin ingin menghapus komentar?')">
                                                <i class="fa-solid fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    <?php } ?>

                                </div>

                                <?php
                                    if(isset($_POST['hapuskomen'])){
                                        if(isset($_SESSION['id'])){
                                            $userid = $_SESSION['id'];
                                            $fotoid = $_POST['fotoid'];
                                            $komentarid = $_POST['hapus'];
                                            mysqli_query($conn, "DELETE FROM komentarfoto WHERE fotoid='$fotoid' AND userid='$userid' AND komentarid='$komentarid'");
                                            echo '<script>window.location="detail-foto.php?id='.$_GET['id'].'"</script>';
                                        }else{
                                            echo'gagal'.mysqli_error($conn);
                                        }
                                    }
                                
                                ?>
                                <?php
                                    }
                                } else {
                                    echo '<p style="margin: 10px;">Tidak ada komentar.</p>';
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
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