<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "kullanicilar"; 

$baglanti = new mysqli($host, $user, $pass, $dbname);

// Bağlantı kontrolü
if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}
?>
