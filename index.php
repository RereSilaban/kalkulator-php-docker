<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Performance Test</title>
</head>
<body>
    <h2>Kalkulator Sederhana</h2>
    <form method="post">
        <input type="number" name="n1" placeholder="Angka 1" required>
        <select name="op">
            <option value="tambah">+</option>
            <option value="kurang">-</option>
            <option value="kali">x</option>
            <option value="bagi">/</option>
        </select>
        <input type="number" name="n2" placeholder="Angka 2" required>
        <button type="submit" name="hitung">Hitung</button>
    </form>

    <?php
    if(isset($_POST['hitung'])){
        $n1 = $_POST['n1'];
        $n2 = $_POST['n2'];
        $op = $_POST['op'];
        
        // Simulasi delay sedikit agar Performance Test lebih terlihat hasilnya
        usleep(100000); // delay 0.1 detik

        switch($op){
            case 'tambah': $hasil = $n1 + $n2; break;
            case 'kurang': $hasil = $n1 - $n2; break;
            case 'kali':   $hasil = $n1 * $n2; break;
            case 'bagi':   $hasil = ($n2 != 0) ? $n1 / $n2 : "Error: Bagi Nol"; break;
        }
        echo "Pertanyaan: <h3>$n1  $op  $n2</h3>";
        echo "<h3>Hasil: $hasil</h3>";
    }
    ?>
</body>
</html>