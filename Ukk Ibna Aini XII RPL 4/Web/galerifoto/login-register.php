<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <title>Login-register</title>
    <link rel="stylesheet" type="text/css" href="css/style-logreg.css">
</head>

<body>

<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="login">
        <form action="proses/proses-login-register.php" method="POST" autocomplete="off">
            <label for="chk" aria-hidden="true">Login</label>
            <input id="login" type="text" name="user" placeholder="Username" required>
            <input id="login-pass" type="password" name="pass" placeholder="Password" required>
            <span class="password-toggle" onclick="togglePassword('login-pass', 'eye-icon-login')">
                <i class="fa-solid fa-eye-slash" id="eye-icon-login"></i>
            </span>
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <button onclick="goBack()" class="btn" style="background: #b90202;">Back</button>
    </div>
        
        

    <div class="signup">
        <form action="proses/proses-login-register.php" method="POST" autocomplete="off">
            <label for="chk" aria-hidden="true">Registrasi</label>
            <input type="text" name="user" placeholder="Username" required>
            <input type="text" name="namalengkap" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input id="regis-pass" type="password" name="pass" placeholder="Password" required>
            <span class="password-toggle" id="eye-regis" onclick="togglePassword('regis-pass', 'eye-icon-regis')">
                <i class="fa-solid fa-eye-slash" id="eye-icon-regis"></i>
            </span>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="submit" name="submitreg" value="Daftar" class="btn">
        </form>
    </div>

        
</div>
    
    

    <script>
    // Fungsi untuk kembali ke halaman sebelumnya
    function goBack() {
        window.history.back();
    }


    function togglePassword(inputId, eyeIconId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
    </script>

</body>
</html>