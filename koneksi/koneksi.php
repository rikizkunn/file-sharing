<?php
// Informasi database
$host = "localhost"; // Ganti dengan nama host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "safe_pdf"; // Ganti dengan nama database Anda

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $koneksi->exec("SET NAMES 'utf8'");

} catch (PDOException $e) {
    die("failed connection : " . $e->getMessage());
}



?>