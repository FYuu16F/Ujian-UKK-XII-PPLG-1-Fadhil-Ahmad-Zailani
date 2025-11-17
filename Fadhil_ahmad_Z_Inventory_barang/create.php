<?php
include 'config/db.php';

if (isset($_POST['submit'])) {
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori_barang'];
    $stok     = $_POST['jumlah_stok'];
    $harga    = $_POST['harga_barang'];
    $tanggal  = $_POST['tanggal_masuk'];

    $query = "INSERT INTO barang (nama_barang, kategori_barang, jumlah_stok, harga_barang, tanggal_masuk)
              VALUES ('$nama', '$kategori', '$stok', '$harga', '$tanggal')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Gagal menambahkan barang: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambahkan Barang</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #e4f1ff, #ffffff);
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 500px;
        margin: 50px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transform: scale(0.95);
        animation: fadeIn 0.4s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.85); }
        to { opacity: 1; transform: scale(1); }
    }

    h2 {
        text-align: center;
        color: #0b5ed7;
        margin-bottom: 10px;
    }

    label {
        font-weight: bold;
        display: block;
        color: #0b3f6f;
        margin-top: 15px;
    }

    input, select {
        width: 100%;
        padding: 11px;
        margin-top: 6px;
        border-radius: 6px;
        border: 1px solid #bcd0ff;
        background: #f9fcff;
        transition: 0.2s ease;
    }

    input:focus, select:focus {
        border-color: #0b5ed7;
        box-shadow: 0 0 6px rgba(11,94,215,0.3);
        outline: none;
        transform: scale(1.02);
    }

    .btn-submit {
        margin-top: 22px;
        width: 100%;
        padding: 12px;
        background: #0b5ed7;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s ease-in-out;
    }

    .btn-submit:hover {
        background: #094fb5;
        transform: scale(1.05);
    }

    .btn-back {
        display: block;
        margin-top: 15px;
        text-align: center;
        text-decoration: none;
        padding: 12px;
        background: #6ca8ff;
        color: white;
        border-radius: 6px;
        transition: 0.2s ease-in-out;
        font-weight: bold;
    }

    .btn-back:hover {
        background: #4c8fe8;
        transform: scale(1.05);
    }
</style>

</head>
<body>

<div class="container">
    <h2>Tambahkan Barang</h2>

    <form method="POST">

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>

        <label>Kategori Barang</label>
        <input type="text" name="kategori_barang" required>

        <label>Jumlah Stok</label>
        <input type="number" name="jumlah_stok" required>

        <label>Harga Barang</label>
        <input type="number" name="harga_barang" required>

        <label>Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" required>

        <button type="submit" name="submit" class="btn-submit">Simpan</button>

        <a href="index.php" class="btn-back">Kembali</a>
    </form>
</div>

</body>
</html>
