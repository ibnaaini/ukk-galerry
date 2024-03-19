<?php
        if(isset($_POST['submit'])){
            session_start();
            include 'koneksi.php';

            $username = mysqli_real_escape_string($conn, $_POST['user']);
            $password = mysqli_real_escape_string($conn,$_POST['pass']);

                $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'");
                if(mysqli_num_rows($cek) > 0){
                    $d = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['a_global'] = $d;
                    $_SESSION['id'] = $d->userid;
                    $_SESSION['selamatdatang'] = 'Selamat Datang ' . $username . ' di Website Galeri Foto Zaura';
    header('Location: ../dashboard.php');
    exit();
                }else{
                    echo '<script>alert("Username atau password Anda Salah!"); window.location="../login-register.php"</script>';
                }
            } else if(isset($_POST['submitreg'])){
                include 'koneksi.php';
                $username = $_POST['user'];
                $password = $_POST['pass'];
                $email = $_POST['email'];
                $namalengkap = $_POST['namalengkap'];
                $alamat = $_POST['alamat'];

                $check_username = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
                if(mysqli_num_rows($check_username) > 0){
                    echo '<script>alert("Username sudah digunakan, pilih username lain"); window.location="../login-register.php";</script>';
                } else {
                    $query = mysqli_query($conn, "INSERT INTO user (username, password, email, namaLengkap, alamat) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')");
                    if($query){
                        echo '<script>alert("Registrasi berhasil. Silakan login."); window.location="../login-register.php";</script>';
                    } else {
                        echo '<script>alert("Registrasi gagal. Silakan coba lagi."); window.location="../login-register.php";</script>';
                    }
                }
            }
            ?>
