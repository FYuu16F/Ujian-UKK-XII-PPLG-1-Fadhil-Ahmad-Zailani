<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
    die("ID barang tidak ditemukan.");
}

$id = $_GET['id'];

$query = "SELECT * FROM barang WHERE id_barang = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data barang tidak ditemukan.");
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori_barang'];
    $stok     = $_POST['jumlah_stok'];
    $harga    = $_POST['harga_barang'];
    $tanggal  = $_POST['tanggal_masuk'];

    $update = "UPDATE barang SET 
                nama_barang = '$nama',
                kategori_barang = '$kategori',
                jumlah_stok = '$stok',
                harga_barang = '$harga',
                tanggal_masuk = '$tanggal'
               WHERE id_barang = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: index.php?status=updated");
        exit();
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>

    <style>

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e6f0ff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 520px;
            margin: 55px auto;
            padding: 25px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            transition: 0.3s ease;
        }

        .container:hover {
            transform: scale(1.01);
        }

        h2 {
            text-align: center;
            color: #1a3d7c;
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
            margin-top: 14px;
            display: block;
            color: #1a3d7c;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #c6d4f2;
            background: #f7faff;
            transition: 0.25s;
        }

        input:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 8px #1a73e85b;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #4d94ff;
            color: white;
            border: none;
            margin-top: 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn-submit:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }

        .btn-back {
            display: block;
            margin-top: 15px;
            padding: 11px;
            text-align: center;
            color: white;
            background: #1a73e8;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn-back:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.23);
        }
        </style>
</head>
<body>

<div class="container">
    <h2>Edit Barang</h2>

    <form method="POST">

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $row['nama_barang'] ?>" required>

        <label>Kategori Barang</label>
        <input type="text" name="kategori_barang" value="<?= $row['kategori_barang'] ?>" required>

        <label>Jumlah Stok</label>
        <input type="number" name="jumlah_stok" value="<?= $row['jumlah_stok'] ?>" required>

        <label>Harga Barang</label>
        <input type="number" name="harga_barang" value="<?= $row['harga_barang'] ?>" required>

        <label>Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" value="<?= $row['tanggal_masuk'] ?>" required>

        <button type="submit" name="update" class="btn-submit">Update Barang</button>

        <a href="index.php" class="btn-back">Kembali</a>
    </form>
</div>

</body>
</html>
