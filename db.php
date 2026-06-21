<?php
// db.php — Koneksi ke database MySQL
$host = "localhost";
$user = "root";
$pass = "";              // Kosongkan jika pakai XAMPP default
$db   = "portfolio_ziki";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("<p style='color:red;font-family:sans-serif;padding:20px'>
        <b>Koneksi database gagal!</b><br>
        Pastikan MySQL sudah START di XAMPP dan file portfolio.sql sudah di-import.<br>
        Error: " . mysqli_connect_error() . "
    </p>");
}
?>
