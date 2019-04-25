<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
 include_once 'database/connection.php';

 $bank = $_GET['bank'];
 // Syntax MySql untuk melihat semua record yang
 // ada di tabel animal
 $sql = "SELECT address FROM bank WHERE bank='$bank'";
  
 //Execetute Query diatas
 $query = mysql_query($sql);
 while($dt=mysql_fetch_array($query)){
  $item=$dt["address"];
 }
 
 //Menampung data yang dihasilkan
 $json = array(
    'address' => $item
   );
 
 //Merubah data kedalam bentuk JSON
//  header('Content-Type: application/json');
 echo json_encode($json);
?>