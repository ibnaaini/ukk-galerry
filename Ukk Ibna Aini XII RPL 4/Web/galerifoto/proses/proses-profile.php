<?php
session_start();
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM user WHERE userid ='".$_SESSION['id']."'");
   $d = mysqli_fetch_object($query);

    if (isset($_POST['submit'])) {

        $namalengkap   = $_POST['namalengkap'];
        $username   = $_POST['username'];
        $email   = $_POST['email'];
        $alamat  = $_POST['alamat'];

        $update = mysqli_query($conn, "UPDATE user SET 
			    namalengkap = '".$namalengkap."',
			    username = '".$username."',
			    email = '".$email."',
			    alamat = '".$alamat."'
			    WHERE userid = '".$d->userid."'");
		if($update){
			echo '<script>alert("Ubah data berhasil")</script>';
			echo '<script>window.location="../profile.php"</script>';
		}else{
			echo 'gagal '.mysqli_error($conn);
		}
					   
	} else if(isset($_POST['ubah_password'])){
                
        $pass1   = $_POST['pass1'];
        $pass2   = $_POST['pass2'];
        
        if($pass2 != $pass1){
            echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
        } else {
            $u_pass = mysqli_query($conn, "UPDATE user 
            SET password = '".$pass1."' 
            WHERE userid = '".$d->userid."'");
            
            if($u_pass) {
                echo '<script>alert("Ubah data berhasil")</script>';
                echo '<script>window.location="../profile.php"</script>';
            } else {
                echo 'gagal '.mysqli_error($conn);
            }
        }
    }
?>
