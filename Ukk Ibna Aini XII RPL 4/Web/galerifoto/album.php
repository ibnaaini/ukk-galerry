<?php
session_start();
include 'proses/koneksi.php';
    if ($_SESSION['status_login'] != true) {
        echo '<script>alert("maaf anda belum login");window.location="login-register.php"</script>';
    }
    
    $userid = $_SESSION['id'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" type="text/css" href="css/style-albumfoto.css">
    <title>Halaman Album</title>
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
        <h3>Album <button href="dashboard.php" class="back"><i class="fa-solid fa-arrow-left"></i></button> </h3>
        <div class="box">
            <a href="javascript:void(0);" onclick="openModal()">
                <div id="awal1"><button id="button1"><i class="fa-solid fa-plus"></i>Tambah Album</button></div>
            </a>

            <div id="tambahAlbumModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Tambah Album</h2>
                    <div class="box">
                        <form action="" method="POST">
                            <p class="judul">Nama Album :</p>
                            <input type="text" name="namaalbum" class="input-control" required>
                            <p class="judul">Deskripsi Album :</p>
                            <input type="text" name="deskripsi" class="input-control" required>
                            <input type="submit" name="submit" value="Tambah" class="btn">
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $namaalbum = isset($_POST['namaalbum']) ? $_POST['namaalbum'] : '';
                            $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
                            $tanggal = date('Y-m-d'); // Membuat Tanggal Menjadi Otomatis
                            $userid = $_SESSION['id']; // Mengambil userid dari sesi
                            // Menambahkan data ke dalam tabel "album"
                            $insert = mysqli_query($conn, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid) VALUES ('$namaalbum', '$deskripsi', '$tanggal', '$userid')");
                            if ($insert) {
                                echo '<script>alert("Album berhasil ditambahkan")</script>';
                            } else {
                                echo '<script>alert("Gagal menambahkan album")</script>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="pagination">
                    <?php
                        $perpage = 10;

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        if ($page > 1) {
                            $start = ($page * $perpage) - $perpage;
                        } else {
                            $start = 0;
                        }

                        $data = mysqli_query($conn, "SELECT * FROM album WHERE userid = '$userid'");
                        $jmlhbaris = mysqli_num_rows($data);
                        $halaman = ceil($jmlhbaris / $perpage);

                        // Simpan nomor urut aktual
                        $no = ($page - 1) * $perpage + 1;

                        for ($i = 1; $i <= $halaman; $i++) {
                            echo "<a href='?page=$i'> $i </a>";
                        }
                    ?>
            </div>

            <table border="1" class="table" id="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Album</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                        <?php
                            $album = mysqli_query($conn, "SELECT * FROM album WHERE userid = '$userid' ORDER BY albumid DESC LIMIT $start, $perpage");
                            // $album = mysqli_query($conn, "SELECT * FROM album ORDER BY albumid DESC"); //semua album bakalan muncul
                            if (mysqli_num_rows($album) > 0) {
                                while ($row = mysqli_fetch_array($album)) {
                                
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['namaalbum'] ?></td>
                                    <td><?php echo $row['deskripsi'] ?></td>
                                    <td><?php echo $row['tanggaldibuat'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="openEditModal(<?php echo $row['albumid']; ?>, '<?php echo $row['namaalbum']; ?>', '<?php echo $row['deskripsi']; ?>')" class="pena"> <i class="fa-solid fa-pen"></i></a>
                                        <a href="proses/proses-hapus.php?idk=<?php echo $row['albumid'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')" class="sampah"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>

                                <div id="editAlbumModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeEditModal()">&times;</span>
                                        <h2>Edit Album</h2>
                                        <div class="box">
                                            <form action="" method="POST">
                                                <input type="hidden" name="edit_albumid" id="edit_albumid">
                                                <p>Nama Album :</p>
                                                <input type="text" name="namaalbumEdit" id="namaalbumEdit" class="input-control" required>
                                                <p>Deskripsi Album :</p>
                                                <input type="text" name="deskripsiEdit" id="deskripsiEdit" class="input-control" required>
                                                <input type="submit" name="submitEdit" value="Simpan Perubahan" class="btn">
                                            </form>
                                            <!-- Handling edit form submission -->
                                            <?php
                                            if (isset($_POST['submitEdit'])) {
                                                $edit_albumid = $_POST['edit_albumid'];
                                                $edit_namaalbum = $_POST['namaalbumEdit'];
                                                $edit_deskripsi = $_POST['deskripsiEdit'];

                                                $update = mysqli_query($conn, "UPDATE album SET namaalbum = '$edit_namaalbum', deskripsi = '$edit_deskripsi' WHERE albumid = '$edit_albumid'");

                                                if ($update) {
                                                    echo '<script>alert("Album berhasil diedit")</script>';
                                                    echo '<script>window.location="album.php"</script>';
                                                } else {
                                                    echo '<script>alert("Gagal menyimpan perubahan album")</script>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="5">Tidak Ada Data</td>
                            </tr>

                        <?php } ?>
                </tbody>

            </table>

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
    function openModal() {
        document.getElementById('tambahfotoModal').style.display = 'block';
    }

    function openModal() {
            document.getElementById('tambahAlbumModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('tambahAlbumModal').style.display = 'none';
        }

        function openEditModal(albumid, namaalbum, deskripsi) {
            document.getElementById('editAlbumModal').style.display = 'block';
            document.getElementById('edit_albumid').value = albumid;
            document.getElementById('namaalbumEdit').value = namaalbum;
            document.getElementById('deskripsiEdit').value = deskripsi;
        }

        function closeEditModal() {
            document.getElementById('editAlbumModal').style.display = 'none';
        }
</script>


</html>