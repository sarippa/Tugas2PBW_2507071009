<?php

function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai)
{
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilai)
{
    if ($nilai >= 65) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

function tentukanPredikat($nilai)
{
    if ($nilai >= 85) {
        return "Sangat Baik";
    } elseif ($nilai >= 75) {
        return "Baik";
    } elseif ($nilai >= 65) {
        return "Cukup";
    } elseif ($nilai >= 50) {
        return "Kurang";
    } else {
        return "Sangat Kurang";
    }
}

function nilaiValid($nilai)
{
    return $nilai >= 0 && $nilai <= 100;
}

$jumlah = 3;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Penghitung Nilai Mahasiswa</title>
</head>
<body>
    <h2>Penghitung Nilai Mahasiswa</h2>
    <p>Isi data mahasiswa (baris yang dikosongkan akan dilewati).</p>

    <form method="post">
        <?php for ($i = 0; $i < $jumlah; $i++): ?>
            <p>
                <b>Mahasiswa <?= $i + 1 ?></b><br>
                Nama: <input type="text" name="nama[]">
                NIM: <input type="text" name="nim[]">
                Tugas: <input type="number" name="tugas[]">
                UTS: <input type="number" name="uts[]">
                UAS: <input type="number" name="uas[]">
            </p>
        <?php endfor; ?>
        <button type="submit" name="hitung">Hitung</button>
    </form>

    <hr>

    <?php
    if (isset($_POST["hitung"])) {
        for ($i = 0; $i < $jumlah; $i++) {
            $nama  = $_POST["nama"][$i];
            $nim   = $_POST["nim"][$i];
            $tugas = $_POST["tugas"][$i];
            $uts   = $_POST["uts"][$i];
            $uas   = $_POST["uas"][$i];

            if ($nama == "") {
                continue;
            }

            echo "<h3>Data mahasiswa: " . htmlspecialchars($nama) . "</h3>";

            if ($tugas === "" || $uts === "" || $uas === "" ||
                !nilaiValid($tugas) || !nilaiValid($uts) || !nilaiValid($uas)) {
                echo "<p style='color:red'>Nilai harus diisi dan berada di antara 0 sampai 100!</p>";
                continue;
            }

            $nilaiAkhir = hitungNilaiAkhir($tugas, $uts, $uas);
            $grade      = tentukanGrade($nilaiAkhir);
            $status     = tentukanStatus($nilaiAkhir);
            $predikat   = tentukanPredikat($nilaiAkhir);

            echo "<ul>";
            echo "<li>NIM: " . htmlspecialchars($nim) . "</li>";
            echo "<li>Nilai Tugas: $tugas</li>";
            echo "<li>Nilai UTS: $uts</li>";
            echo "<li>Nilai UAS: $uas</li>";
            echo "</ul>";

            echo "<b>Hasil perhitungan</b>";
            echo "<ul>";
            echo "<li>Nilai Akhir: $nilaiAkhir</li>";
            echo "<li>Grade: $grade</li>";
            echo "<li>Predikat: $predikat</li>";
            echo "<li>Status: $status</li>";
            echo "</ul>";
        }
    }
    ?>
</body>
</html>