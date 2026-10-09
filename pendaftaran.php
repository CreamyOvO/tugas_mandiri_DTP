<!-- Dibelakang URL akan ada parameter nilai yang dikirim melalui GET -->
 <!-- Karena Form yang dikirim melalui GET akan tertampil pada parameter di belakang URL dan berpotensi dapat dilihat dari riwayat URL membuat kebocoran Data -->
  <!-- Fungsi Isset pada PHP digunakan untuk mengecek apakah variabel atau sesuatu itu sudah pernah di set atau belum -->

<?php 
include "koneksi.php";

$nama = "";
$nis = "";
$email = "";
$jurusan = "";
$perusahaan = "";
$kompetensi = [];
$alasan = "";
$id_jurusan = 0;

if (isset($_POST['nama_lengkap']) && isset($_POST['nis']) && isset($_POST['email'])) {
    $nama = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $perusahaan = $_POST['perusahaan'];
    $kompetensi = $_POST['kompetensi'];
    $alasan = $_POST['alasan'];
};

if (isset($_POST['kirim'])) {
    
    if ($jurusan === "SIJA") {
        $id_jurusan = 1;
    }
    elseif ($jurusan === "TJAT") {
        $id_jurusan = 2;
    };

    mysqli_query($conn, "INSERT INTO siswa (nama, nis, email, id_jurusan, perusahaan, alasan) 
    VALUES ('$nama', '$nis', '$email', '$id_jurusan', '$perusahaan', '$alasan')");
};

$id_siswa = mysqli_insert_id($conn);

if (isset($_POST['kompetensi'])) {

    foreach($_POST['kompetensi'] as $skill) {
        mysqli_query($conn, "INSERT INTO kompetensi_siswa (id_siswa, nama_skill) VALUES ($id_siswa, '$skill')");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="baju.css">
</head>
<body>
    <div id="formdaftar">
        <h1>Pendaftaran Peserta PKL</h1>
        <form method="POST" action="pendaftaran.php">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="text" required>
            <label for="nis">NIS:</label>
            <input type="number" name="nis" class="text" required>
            <label for="email">Email Siswa:</label>
            <input type="email" name="email" class="text" required>
            <label for="jurusan">Kompetensi Keahlian / Jurusan:</label>
            <div id="jurusan">
                <input type="radio" name="jurusan" value="SIJA">
                <label for="jurusan">SIJA</label>
                <input type="radio" name="jurusan" value="TJAT">
                <label for="jurusan">TJAT</label>
            </div>
            <label for="perusahaan">Pilihan Perusahaan PKL:</label>
            <select name="perusahaan" id="perusahaan" required>
                <option value="" disabled selected>-- Pilih --</option>
                <option value="mojiken">Mojiken Studio</option>
                <option value="steelwool">Steelwool Studio</option>
                <option value="ea">EA Studio</option>
                <option value="ubisoft">Ubisoft Studio</option>
            </select>
            <label for="kompetensi" id="kompetensip">Kompetensi / Tech Stack yang Dikuasai:</label>
            <div id="kompetensi">
                <input type="checkbox" name="kompetensi[]" value="UI/UX">
                <label for="kompetensi">UI/UX</label>
                <input type="checkbox" name="kompetensi[]" value="Game Dev">
                <label for="kompetensi">Game Developer</label>
                <input type="checkbox" name="kompetensi[]" value="2D Artist">
                <label for="kompetensi">2D Artist</label>
            </div>
            <label for="alasan">Alasan Memilih Perusahaan:</label>
            <textarea name="alasan" cols="30" rows="6"> </textarea required>
            <input type="submit" name="kirim" value="Kirim" id="kirim">
        </form>
    </div>
    <div id="tampil" hidden>
        <?php
            echo "<p>Nama Lengkap : ".$nama."</p";
            echo "<br>";
            echo "<p>NIS : ".$nis;
            echo "<br>";
            echo "<p>Email Siswa : ".$email."</p";
            echo "<br>";
            echo "<p>Jurusan : ".$jurusan."</p";
            echo "<br>";
            echo "<p>Perusahaan : ".$perusahaan."</p";
            echo "<br>";
            echo "<p>Kompetensi Siswa :";
            foreach ($kompetensi as $skill) {
                echo ($skill).", ";
                echo "<br>";
            };

            echo "<p>Alasan Memilih Perusahaan : ".$alasan."</p";
            echo "<br>";
        ?>
    </div>
</body>
</html>