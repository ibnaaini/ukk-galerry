<?php
include 'koneksi.php';
session_start();

$fotoid  = $_GET['fotoid'];
$userid = $_SESSION['id'];

// Cek apakah pengguna sudah memberikan like pada foto ini
$checkdisLike = mysqli_query($conn, "SELECT * FROM dislikefoto WHERE fotoid='$fotoid' AND userid='$userid'");
if(mysqli_num_rows($checkdisLike) == 1) {
    // Jika sudah memberikan like, hapus like sebelumnya
    mysqli_query($conn, "DELETE FROM dislikefoto WHERE fotoid='$fotoid' AND userid='$userid'");
}

// Cek apakah pengguna sudah memberikan dislike pada foto ini
$checklike = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
if(mysqli_num_rows($checklike) == 1) {
    // Jika sudah memberikan dislike, hapus dislike
    mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
    header("location:../detail-foto.php?id=" . $fotoid);
} else {
    // Jika belum memberikan dislike, tambahkan dislike baru
    $tanggallike = date("Y-m-d");
    mysqli_query($conn, "INSERT INTO likefoto (fotoid, userid, tanggallike) VALUES ('$fotoid','$userid','$tanggallike')");
    header("location:../detail-foto.php?id=" . $fotoid);
}
?>
