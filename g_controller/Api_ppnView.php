<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
 include_once 'database/connection.php';

 $perusahaan = $_GET['perusahaan'];
 // Syntax MySql untuk melihat semua record yang
 // ada di tabel animal
 $sql = "SELECT * FROM perusahaan WHERE perusahaan='$perusahaan'";
  
 //Execetute Query diatas
 $query = mysql_query($sql);
 while($dt=mysql_fetch_array($query)){
  $vat=$dt["vat"];
  $nilaivat=$dt["nilai_vat"];
 }
 
 //Menampung data yang dihasilkan
 $json = array(
    'vat' => $vat,
    'nilaivat' => $nilaivat
   );
 
 //Merubah data kedalam bentuk JSON
 header('Content-Type: application/json');
 echo json_encode($json);
?>