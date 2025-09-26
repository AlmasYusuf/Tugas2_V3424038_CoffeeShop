<?php
include "Form.php";

echo '
<style>
    body {
        font-family: "Segoe UI", Arial, sans-serif;
        background-color: #f5f1eb;
        margin: 0;
        padding: 20px;
        color: #4a3827;
    }
    
    h2 {
        color: white;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 500;
        background-color: #6b4423;
        padding: 15px;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    form {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        color: #6b4423;
        font-weight: 500;
    }
    
    input[type="text"], 
    input[type="password"], 
    textarea, 
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #d4c3b3;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 8px;
    }
    
    .radio-group,
    .checkbox-group {
        margin-bottom: 15px;
    }
    
    input[type="submit"] {
        background-color: #6b4423;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    input[type="submit"]:hover {
        background-color: #8b5e3c;
    }
    
    a {
        color: #6b4423;
        text-decoration: none;
    }
    
    a:hover {
        text-decoration: underline;
    }
</style>
';

// Koneksi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "coffee_shop";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if (isset($_POST['submit'])) {
    $nama_produk    = $_POST['nama_produk'];
    $kode_admin     = $_POST['kode_admin'];
    $kategori       = $_POST['kategori_produk'];
    $topping        = isset($_POST['topping']) ? implode(",", $_POST['topping']) : null;
    $ukuran         = $_POST['ukuran'];
    $deskripsi      = $_POST['deskripsi_produk'];
    $harga          = $_POST['harga'];

    $sql = "INSERT INTO produk (nama_produk, kode_admin, kategori_produk, topping, ukuran, deskripsi_produk, harga) 
            VALUES ('$nama_produk', '$kode_admin', '$kategori', '$topping', '$ukuran', '$deskripsi', '$harga')";

    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil ditambahkan! <a href='input_produk.php'>Tambah lagi</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Buat Form
$form = new Form("input_produk.php", "POST");
$form->text("nama_produk", "Nama Produk");
$form->password("kode_admin", "Kode Admin");
$form->radio("kategori_produk", "Kategori Produk", ["Coffee", "Non Coffee", "Snack"]);
$form->checkbox("topping", "Topping", ["Extra Sugar", "Whipped Cream", "Ice"]);
$form->select("ukuran", "Ukuran", ["Small", "Medium", "Large"]);
$form->textarea("deskripsi_produk", "Deskripsi Produk");
$form->text("harga", "Harga");
$form->submit("Simpan");

echo "<h2>Tambah Menu Baru</h2>";
echo $form->end();
?>