<?php
include 'config/db.php';

$kategoriQuery = mysqli_query($conn, "SELECT DISTINCT kategori_barang FROM barang ORDER BY kategori_barang ASC");

$filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if ($filter != '') {
    $barangQuery = mysqli_query($conn, "SELECT * FROM barang WHERE kategori_barang = '$filter'");
} else {
    $barangQuery = mysqli_query($conn, "SELECT * FROM barang");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Filter Kategori Barang</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e6f0ff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            transition: 0.3s ease;
        }

        .container:hover {
            transform: scale(1.01);
        }

        h2 {
            text-align: center;
            color: #1a3d7c;
            margin-bottom: 10px;
        }

        .btn-back {
            display: inline-block;
            background: #1a73e8;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn-back:hover {
            transform: scale(1.07);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        select {
            padding: 10px;
            width: 260px;
            border-radius: 8px;
            border: 1px solid #b5c6e0;
            background: #f8fbff;
            transition: 0.25s;
        }

        select:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 8px #1a73e84f;
        }

        button {
            padding: 10px 16px;
            border: none;
            background: #4d94ff;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.25s;
        }

        button:hover {
            transform: scale(1.07);
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }

        h3 {
            color: #1a3d7c;
            font-size: 20px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #3366cc;
            color: white;
            padding: 12px;
            font-size: 15px;
        }

        td {
            padding: 12px;
            background: #fff;
            border-bottom: 1px solid #e2e8f5;
            transition: 0.2s ease;
        }

        tr:hover td {
            background: #f0f5ff;
            transform: scale(1.01);
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        </style>
</head>
<body>

<div class="container">

    <h2>Filter Berdasarkan Kategori</h2>

    <a href="index.php" class="btn-back">Kembali</a>

    <hr><br>

    <form method="GET">
        <label>Pilih Kategori:</label>
        <select name="kategori">
            <option value="">-- Semua Kategori --</option>

            <?php while ($k = mysqli_fetch_assoc($kategoriQuery)) { ?>
                <option value="<?= $k['kategori_barang'] ?>"
                    <?= ($filter == $k['kategori_barang']) ? 'selected' : '' ?>>
                    <?= $k['kategori_barang'] ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <h3 style="margin-top: 30px;">Daftar Barang</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Tanggal</th>
        </tr>

        <?php if (mysqli_num_rows($barangQuery) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($barangQuery)) { ?>
                <tr>
                    <td><?= $row['id_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['kategori_barang'] ?></td>
                    <td><?= $row['jumlah_stok'] ?></td>
                    <td><?= number_format($row['harga_barang'], 0, ',', '.') ?></td>
                    <td><?= $row['tanggal_masuk'] ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="empty">Tidak ada barang pada kategori ini.</td>
            </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
