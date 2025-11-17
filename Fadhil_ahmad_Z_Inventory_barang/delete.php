<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

$query = "DELETE FROM barang WHERE id_barang = $id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?status=deleted");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>
