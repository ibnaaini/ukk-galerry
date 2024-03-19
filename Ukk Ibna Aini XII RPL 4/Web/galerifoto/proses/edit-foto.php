<?php
include 'koneksi.php';

if (isset($_POST['edit_submit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];
    $userid = $_POST['userid'];

    // Jika ada upload file baru
    if ($_FILES['lokasifile']['name'] != '') {
        $filename = $_FILES['lokasifile']['name'];
        $tmp_name = $_FILES['lokasifile']['tmp_name'];

        $type1 = explode('.', $filename);
        $type2 = strtolower(end($type1)); // Menggunakan strtolower dan end untuk mendapatkan ekstensi file yang benar

        $result = mysqli_query($conn, "SELECT lokasifile, albumid FROM foto WHERE fotoid = '$fotoid'");
        $row = mysqli_fetch_assoc($result);
        $old_file = $row['lokasifile'];
        $old_albumid = $row['albumid'];

        $newname = 'foto' . time() . '.' . $type2;

        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($type2, $tipe_diizinkan)) {
            echo '<script>alert("Format file tidak diizinkan")</script>';
        } else {
            move_uploaded_file($tmp_name, '../foto/' . $newname);

            // Update data foto dengan file baru
            $update = mysqli_query($conn, "UPDATE foto SET 
                    judulfoto = '$judulfoto',
                    deskripsifoto = '$deskripsifoto',
                    albumid = '$albumid',
                    lokasifile = '$newname'
                WHERE fotoid = '$fotoid'");

            if ($update) {
                // Hapus file foto lama jika album tetap sama
                if ($old_albumid == $albumid) {
                    unlink('../foto/' . $old_file);
                }

                echo '<script>alert("Update data berhasil")</script>';
                echo '<script>window.location="../foto.php"</script>';
            } else {
                echo 'Gagal' . mysqli_error($conn);
            }
        }
    } else {
        // Update data foto tanpa mengganti file
        $update = mysqli_query($conn, "UPDATE foto SET 
                judulfoto = '$judulfoto',
                deskripsifoto = '$deskripsifoto',
                albumid = '$albumid'
            WHERE fotoid = '$fotoid'");

        if ($update) {
            echo '<script>alert("Update data berhasil")</script>';
            echo '<script>window.location="../foto.php"</script>';
        } else {
            echo 'Gagal' . mysqli_error($conn);
        }
    }
}
?>
