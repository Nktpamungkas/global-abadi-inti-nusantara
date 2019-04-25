<?php
include_once "database/connection.php";

$perusahaan = $_GET['perusahaan'];
// Syntax MySql untuk melihat semua record yang
// ada di tabel animal
$sql = "SELECT * FROM perusahaan WHERE perusahaan='$perusahaan'";

//Execetute Query diatas
$query = mysql_query($sql);
while($dt=mysql_fetch_array($query)){
$item=$dt['alamat'];
}

//Menampung data yang dihasilkan
$json = [
    'alamat' => $item
];

//Merubah data kedalam bentuk JSON
// header('Content-Type: application/json');
echo json_encode($json);
?>