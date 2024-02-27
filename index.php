<?php

require_once 'Nilai.php';

$nilaiPartisipasi = $_POST['nilai_partisipasi'];
$nilaiTugas = $_POST['nilai_tugas'];
$nilaiUTS = $_POST['nilai_uts'];
$nilaiUAS = $_POST['nilai_uas'];

// Validasi input
if (empty($nilaiPartisipasi) || empty($nilaiTugas) || empty($nilaiUTS) || empty($nilaiUAS)) {
    echo "<p class='alert alert-danger'>Semua nilai harus diisi!</p>";
    exit;
}

if (!is_numeric($nilaiPartisipasi) || !is_numeric($nilaiTugas) || !is_numeric($nilaiUTS) || !is_numeric($nilaiUAS)) {
    echo "<p class='alert alert-danger'>Nilai harus berupa angka!</p>";
    exit;
}

if ($nilaiPartisipasi < 0 || $nilaiPartisipasi > 100 || $nilaiTugas < 0 || $nilaiTugas > 100 || $nilaiUTS < 0 || $nilaiUTS > 100 || $nilaiUAS < 0 || $nilaiUAS > 100) {
    echo "<p class='alert alert-danger'>Nilai harus diantara 0 dan 100!</p>";
    exit;
}

// Buat objek Nilai
$nilai = new Nilai($nilaiPartisipasi, $nilaiTugas, $nilaiUTS, $nilaiUAS);

// Hitung Nilai Akhir (NA)
$na = $nilai->hitungNA();

// Konversi NA ke Nilai Huruf (NH)
$nh = $nilai->konversiNH($na);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai UNESA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqx61gVWgIGe33WN0YYsS537G0OnOOFYP6U679F0u3Y/ukypX+W+mD6y" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Konversi Nilai UNESA</h1>
        <form method="post">
            <div class="form-group">
                <label for="nilai_partisipasi">Nilai Partisipasi:</label>
                <input type="text" class="form-control" id="nilai_partisipasi" name="nilai_partisipasi" value="<?php echo $nilaiPartisipasi; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_tugas">Nilai Tugas:</label>
                <input type="text" class="form-control" id="nilai_tugas" name="nilai_tugas" value="<?php echo $nilaiTugas; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_uts">Nilai UTS:</label>
                <input type="text" class="form-control" id="nilai_uts" name="nilai_uts" value="<?php echo $nilaiUTS; ?>">
            </div>
            <div class="form-group">
                <label for="nilai_uas">Nilai UAS:</label>
                <input type="text" class="form-control" id="nilai_uas" name="nilai_uas" value="<?php echo $nilaiUAS; ?>">
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