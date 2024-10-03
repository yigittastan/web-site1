<?php
include "baglanti.php";

if (isset($_POST["get"])) {
  $email = $_POST["email"];
  $password = $_POST["password"]; // Şifre doğrudan veritabanına kaydedilecek
  $ad_soyad = $_POST["ad_soyad"];

  // E-posta tekrar kontrolü
  $stmt = $baglanti->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $emailCount = $row['COUNT(*)'];


  if ($emailCount > 0) {
    $Mesaj = "Bu e-posta adresi zaten kullanılıyor.";
  } else {
    // E-posta benzersiz ise kayıt işlemi
    $datab = "INSERT INTO users (email, password, ad) VALUES (?, ?, ?)";
    $stmt = $baglanti->prepare($datab);
    $stmt->bind_param("sss", $email, $password, $ad_soyad);
    $stmt->execute();

    $Mesaj = "Kayıt Başarılı.";
  }

  $stmt->close();
}
?>
