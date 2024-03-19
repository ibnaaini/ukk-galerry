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
    <link rel="stylesheet" type="text/css" href="css/style-datafoto.css">
    <title>Halaman Foto</title>
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
            <h3>Data Foto <a href="dashboard.php" class="back"><i class="fa-solid fa-arrow-left"></i></a> </h3>
            <div class="box">
                <a href="javascript:void(0);" onclick="openModal()">
                    <div id="awal1"><button id="button1"><i class="fa-solid fa-plus"></i>Tambah Foto</button></div>
                </a>

                <div id="tambahfotoModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Tambah Foto</h2>
                        <div class="box">
                            <form action="proses/proses-unggah.php" method="POST" enctype="multipart/form-data">
                                <p>Pilih Album :</p>
                                <select name="albumid" class="input-control" required>
                                    <option value="">---Pilih Album---</option>
                                    <?php
                                    $album = mysqli_query($conn, "SELECT * FROM album ORDER BY albumid DESC");
                                    while ($r = mysqli_fetch_array($album)) {
                                    ?>
                                        <option value="<?php echo $r['albumid'] ?>"><?php echo $r['namaalbum'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                <input type="hidden" name="fotoid" placeholder="fotoid" class="input-control" required>

                                <p>Judul Foto :</p>
                                <input type="text" name="judulfoto" class="input-control" required>

                                <p>Deskripsi Foto :</p>
                                <textarea name="deskripsifoto" class="input-control" required rows="2" cols="20"></textarea>

                                <input type="hidden" name="tanggalunggah" value="<?php echo date('Y-m-d'); ?>">

                                <p>Masukkan File Foto :</p>
                                <div class="sama">
                                    <img id="preview_img" src="img/noimage.jpg" alt="Current profile photo" />
                                    <input type="file" name="lokasifile" id="file" class="input-control" required onchange="loadFile(event)">
                                </div>
                                
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                                <input type="submit" name="submit" value="Tambah" class="btn">
                            </form>
                            
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

                    $data = mysqli_query($conn, "SELECT * FROM foto WHERE userid = '$userid'");
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
                            <th>Album</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $foto = mysqli_query($conn, "SELECT * FROM foto
                        LEFT JOIN album USING(albumid)
                        WHERE foto.userid = '$userid'
                        ORDER BY fotoid DESC LIMIT $start, $perpage");

                        if (mysqli_num_rows($foto) > 0) {
                            while ($row = mysqli_fetch_array($foto)) {
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['namaalbum'] ?></td>
                            <td><?php echo $row['judulfoto'] ?></td>
                            <td><?php echo $row['deskripsifoto'] ?></td>
                            <td><?php echo $row['tanggalunggah'] ?></td>
                            <td><img src="foto/<?php echo $row['lokasifile'] ?>" height="50rem" onclick="openFullscreenImage('foto/<?php echo $row['lokasifile'] ?>')"></td>
                            <td>
                                <a href="javascript:void(0);" onclick="openEditModal('<?php echo $row['fotoid']; ?>', '<?php echo $row['judulfoto']; ?>', '<?php echo $row['deskripsifoto']; ?>', '<?php echo $row['lokasifile']; ?>', '<?php echo $row['userid']; ?>')" class="pena"><i class="fa-solid fa-pen"></i></a>
                                <a href="proses/proses-hapus.php?idp=<?php echo $row['fotoid'] ?>" onclick="return confirm('Yakin Ingin Hapus foto ?')" class="sampah"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <div id="editfotoModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeEditModal()">&times;</span>
                                        <h2>Edit Foto</h2>
                                        <div class="box">
                                            <form action="proses/edit-foto.php" method="POST" enctype="multipart/form-data">
                                                <p>Pilih Album :</p>
                                                <select name="albumid" id="edit_albumid" class="input-control" required>
                                                    <?php
                                                    $selectedAlbumId = $row['albumid']; // Mendapatkan albumid dari data foto yang sedang diedit
                                                    $album = mysqli_query($conn, "SELECT * FROM album ORDER BY albumid DESC");
                                                    while ($r = mysqli_fetch_array($album)) {
                                                        $selected = ($r['albumid'] == $selectedAlbumId) ? 'selected' : ''; // Menandai opsi yang sesuai
                                                    ?>
                                                        <option value="<?php echo $r['albumid'] ?>" <?php echo $selected ?>><?php echo $r['namaalbum'] ?></option>
                                                    <?php } ?>
                                                </select>

                                                <input type="hidden" name="fotoid" id="edit_fotoid" value="">

                                                <p>Judul Foto :</p>
                                                <input type="text" name="judulfoto" id="edit_judulfoto" placeholder="judulfoto" class="input-control" required>

                                                <p>Deskripsi Foto :</p>
                                                <textarea name="deskripsifoto" id="edit_deskripsifoto" placeholder="deskripsifoto" class="input-control"></textarea>

                                                <input type="hidden" name="tanggalunggah" value="<?php echo date('Y-m-d'); ?>">

                                                <p>Lokasi File :</p>
                                                <div class="sama">
                                                <img id="edit_foto_preview" src="" alt="Current profile photo" height="80rem">
                                                <input type="hidden" name="foto" id="edit_foto" value="">
                                                <input type="file" name="lokasifile" id="edit_file" class="input-control" onchange="editLoadFile(event)">
                                                </div>
                                                
                                                <input type="hidden" name="userid" id="edit_userid" value="">

                                                <input type="submit" name="edit_submit" value="Submit" class="btn">
                                            </form>

                                        </div>
                                    </div>
                                </div>

                        <?php } } else { ?>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
                
            </div>
        </div>
    </div>

<div class="fullscreen-overlay" onclick="closeFullscreenImage()">
  <span class="close-overlay" onclick="closeFullscreenImage()">&times;</span>
  <img class="fullscreen-image" onclick="closeFullscreenImage()">
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
    
    function openFullscreenImage(imagePath) {
      const overlay = document.querySelector('.fullscreen-overlay');
      const image = document.querySelector('.fullscreen-image');

      image.src = imagePath;
      overlay.style.display = 'flex';
    }

    function closeFullscreenImage() {
      const overlay = document.querySelector('.fullscreen-overlay');
      overlay.style.display = 'none';
    }

    function openModal() {
      document.getElementById('tambahfotoModal').style.display = 'block';
    }
  
    function closeModal() {
        document.getElementById('tambahfotoModal').style.display = 'none';
    }

    var loadFile = function (event) {
    var input = event.target;
    var file = input.files[0];
    var type = file.type;

    var output = document.getElementById('preview_img');

    output.src = URL.createObjectURL(file);
    output.onload = function () {
        URL.revokeObjectURL(output.src);
    };
};

    function openEditModal(fotoid, judulfoto, deskripsifoto, foto, albumid, userid) {
        // Isi formulir dengan data yang ada
        document.getElementById('edit_fotoid').value = fotoid;
        document.getElementById('edit_judulfoto').value = judulfoto;
        document.getElementById('edit_deskripsifoto').value = deskripsifoto;
        document.getElementById('edit_foto_preview').src = "foto/" + foto;

        // document.querySelector('.edit_albumid').value = albumid; 
        document.getElementById('edit_foto').value = foto;
        document.getElementById('edit_userid').value = userid;
        document.getElementById('edit_file').value = '';

        // Show the current photo preview
        document.getElementById('edit_foto_preview').src = "foto/" + foto;
        
        // Display the edit modal
        document.getElementById('editfotoModal').style.display = 'block';
    }

        function closeEditModal() {
            // Close the edit modal
            document.getElementById('editfotoModal').style.display = 'none';
        }

        function editLoadFile(event) {
        var input = event.target;
        var file = input.files[0];
        var output = document.getElementById('edit_foto_preview');

        output.src = URL.createObjectURL(file);
        output.onload = function () {
            URL.revokeObjectURL(output.src);
        };
    }
   
</script>


</html>