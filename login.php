<?php
include "baglanti.php";

if (isset($_POST['gon'])) {
    $email = mysqli_real_escape_string($baglanti, $_POST['email']);
    $password = mysqli_real_escape_string($baglanti, $_POST['password']);

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: anasayfa.html");
            exit;
        } else {
            $error_message = "Geçersiz e-posta veya şifre.";
            $error_code = 1; // Set an error code for identification
        }
    } else {
        $error_message = "Geçersiz e-posta veya şifre.";
        $error_code = 2; // Set another error code for identification
    }

    mysqli_stmt_close($stmt);
    mysqli_free_result($result);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login/login.css">
</head>

<body>
  <div class="form">
    <div class="formright">
      <div class="logo">
        <img src="image/twitter.png" alt="" style="width: 40px; height: 40px;">
      </div>

      <h1>Deneyiminize devam edin</h1>
      <h2>X'e giriş yapın</h2>



     
    <div id="error-message" style="display: none;">
        <p>Geçersiz e-posta veya şifre.</p>
    </div>


<script>
    <?php if (isset($error_code)) { ?>
        document.getElementById("error-message").style.display = "block";
    <?php } ?>
</script>
      <form action="" method="post">
        <div class="input-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="deneme@email.com" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="********" required>
          <div class="password-eye"> </div>
        </div>
        <button type="submit" name="gon">Sign in</button>
      </form>

      <p class="separator">or sign in with</p>
      <div class="boption">
        <a href=""><button><img class="icon" src="image/facebook.png" alt="login1"></button></a>
        <a href=""><button><img class="icon" src="image/search.png" alt="login2"></button></a>
        <a href=""><button><img class="icon" src="image/apple.png" alt="login3"></button></a>
      </div>
      <p class="account-link">Have an account? <a href="sing_up.html">Sign up</a></p>
    </div>
  </div>
</body>

</html>