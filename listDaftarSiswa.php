<?php 

include "koneksi.php";

$hasil = mysqli_query($conn, "SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Siswa</title>
    <link rel="stylesheet" href="baju2.css">
</head>
<body>
    <h1 id="judul">List Siswa yang Sudah Mendaftar PKL</h1>
    <div id="list">
        <?php 
        while($data = mysqli_fetch_assoc($hasil)) { $nama_jurusan = "";

            if ($data['id_jurusan'] == 1) {
                $nama_jurusan = "SIJA";
            }
            elseif ($data['id_jurusan'] == 2) {
                $nama_jurusan = "TJAT";
            }?>
            <div class="siswa">
                <p class="label">Nama Lengkap</p>
                <h3><?= $data['nama'] ?></h3>
                <div class="another">
                    <div class="nis">
                        <p class="label">NIS</p>
                        <h3><?= $data['nis'] ?></h3>
                    </div>
                    <div class="jurusan">
                        <p class="label">Jurusan</p>
                        <h3><?= $nama_jurusan ?></h3>
                    </div>
                </div>
                <p class="label">Email</p>
                <h3><?= $data['email'] ?></h3>
                <p class="label">Perusahaan yang Dipilih</p>
                <h3><?= $data['perusahaan'] ?></h3>
                <p class="label">Kompetensi yang Dimiliki :</p>
                <div class="kompetensi">
                    <?php 
                    $id_siswa = $data['id'];

                    $query_kompe = mysqli_query($conn, "SELECT nama_skill from kompetensi_siswa WHERE id_siswa = $id_siswa");

                    while ($skill = mysqli_fetch_assoc($query_kompe)) { 
                    ?>
                    <p class="skill"><?= $skill['nama_skill'] ?></p>
                    <?php }?>
                </div>
                <p class="label">Alasan Memilih Perusahaan :</p>
                <p class="alasan"><?= $data['alasan'] ?></p>
            </div> 
        <?php };?>
    </div>
</body>
</html>