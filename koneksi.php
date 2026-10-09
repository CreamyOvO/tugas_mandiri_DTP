<?php 

$conn = mysqli_connect("localhost", "root", "", "pendaftaranpkl");

if (!$conn) {
    die("Koneksi gagal ".mysqli_connect_error());
}

?>