    <?php
    include 'config/db.php';

    $q = isset($_GET['q']) ? $_GET['q'] : '';

    if ($q != '') {
        $result = mysqli_query($conn, "
            SELECT * FROM barang 
            WHERE nama_barang LIKE '%$q%' 
            OR kategori_barang LIKE '%$q%'
            OR harga_barang LIKE '%$q%'
            OR jumlah_stok LIKE '%$q%'
            OR tanggal_masuk LIKE '%$q%'
        ");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM barang");
    }

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Inventory Barang</title>

    <style>

    body {
        font-family: 'Segoe UI', sans-serif;
        background: #e6f0ff;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 1000px;
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
        font-size: 28px;
        margin-bottom: 20px;
    }

    .top-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .btn-add, .btn {
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        display: inline-block;
        transition: 0.2s ease-in-out;
    }

    .btn-add {
        background: #1a73e8;
    }

    .btn {
        background: #4d94ff;
    }

    .btn-add:hover,
    .btn:hover {
        transform: scale(1.06);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .searchbar input {
        padding: 10px;
        width: 240px;
        border-radius: 8px;
        border: 1px solid #b5c6e0;
        background: #f8fbff;
        transition: 0.25s;
    }

    .searchbar input:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 8px #1a73e84f;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    th {
        background: #3366cc;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #e2e8f5;
        background: #ffffff;
        transition: 0.2s ease;
    }

    tr:hover td {
        background: #f0f5ff;
        transform: scale(1.01);
    }

    .btn-edit,
    .btn-delete {
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-edit {
        background: #ffd633;
        color: black;
    }

    .btn-delete {
        background: #e63946;
        color: white;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    </style>
    </head>
    <body>

    <div class="container">

    <h2>Inventory Barang</h2>

    <div class="top-bar">

        <a href="create.php" class="btn-add">+ Tambahkan Barang</a>

        <a href="kategori.php" class="btn">Kategori Barang</a>

        <form method="get" action="index.php" class="searchbar">
            <input type="text" name="q" placeholder="Cari Barang..."
                value="<?= htmlspecialchars($q) ?>">
        </form>

    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['kategori_barang'] ?></td>
            <td><?= $row['jumlah_stok'] ?></td>
            <td><?= number_format($row['harga_barang'], 0, ',', '.') ?></td>
            <td><?= $row['tanggal_masuk'] ?></td>

            <td>
                <a class="btn-edit" href="edit.php?id=<?= $row['id_barang'] ?>">Edit</a>
                <a class="btn-delete" href="delete.php?id=<?= $row['id_barang'] ?>"
                onclick="return confirm('Hapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    </div>

    </body>
    </html>
