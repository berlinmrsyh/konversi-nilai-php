<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah formulir dikirimkan menggunakan metode POST

    // Memeriksa apakah semua nilai diisi
    if (empty($_POST['nilai_partisipasi']) || empty($_POST['nilai_tugas']) || empty($_POST['nilai_uts']) || empty($_POST['nilai_uas'])) {
        echo "<p class='alert alert-danger'>Semua nilai harus diisi!</p>";
        exit;
    }

    // Memeriksa apakah semua nilai adalah angka
    if (!is_numeric($_POST['nilai_partisipasi']) || !is_numeric($_POST['nilai_tugas']) || !is_numeric($_POST['nilai_uts']) || !is_numeric($_POST['nilai_uas'])) {
        echo "<p class='alert alert-danger'>Nilai harus berupa angka!</p>";
        exit;
    }

    // Memeriksa apakah nilai berada dalam rentang 0-100
    if ($_POST['nilai_partisipasi'] < 0 || $_POST['nilai_partisipasi'] > 100 || $_POST['nilai_tugas'] < 0 || $_POST['nilai_tugas'] > 100 || $_POST['nilai_uts'] < 0 || $_POST['nilai_uts'] > 100 || $_POST['nilai_uas'] < 0 || $_POST['nilai_uas'] > 100) {
        echo "<p class='alert alert-danger'>Nilai harus di antara 0 dan 100!</p>";
        exit;
    }

    // Buat objek Nilai
    require_once 'Nilai.php';

    $nilaiPartisipasi = $_POST['nilai_partisipasi'];
    $nilaiTugas = $_POST['nilai_tugas'];
    $nilaiUTS = $_POST['nilai_uts'];
    $nilaiUAS = $_POST['nilai_uas'];

    $nilai = new Nilai($nilaiPartisipasi, $nilaiTugas, $nilaiUTS, $nilaiUAS);

    // Hitung Nilai Akhir (NA)
    $na = $nilai->hitungNA();

    // Konversi NA ke Nilai Huruf (NH)
    $nh = $nilai->konversiNH($na);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai UNESA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" </head>

<body>
    <div class="container">
        <h1>Konversi Nilai UNESA</h1>
        <form method="post">
            <div class="form-group">
                <label for="nilai_partisipasi">Nilai Partisipasi:</label>
                <input type="number" class="form-control" id="nilai_partisipasi" name="nilai_partisipasi" value="<?php echo isset($nilaiPartisipasi) ? $nilaiPartisipasi : ''; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_tugas">Nilai Tugas:</label>
                <input type="number" class="form-control" id="nilai_tugas" name="nilai_tugas" value="<?php echo isset($nilaiTugas) ? $nilaiTugas : ''; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_uts">Nilai UTS:</label>
                <input type="number" class="form-control" id="nilai_uts" name="nilai_uts" value="<?php echo isset($nilaiUTS) ? $nilaiUTS : ''; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_uas">Nilai UAS:</label>
                <input type="number" class="form-control" id="nilai_uas" name="nilai_uas" value="<?php echo isset($nilaiUAS) ? $nilaiUAS : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </form>

        <?php if (isset($na) && isset($nh)) : ?>
            <br>
            <div class="alert alert-success">
                Nilai Akhir (NA): <?php echo $na; ?>
            </div>
            <div class="alert alert-info">
                Nilai Huruf (NH): <?php echo $nh; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
