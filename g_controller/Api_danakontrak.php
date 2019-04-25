<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
 include_once 'database/connection.php';

 $dana_kontrak = $_GET['dana_kontrak'];
 // Syntax MySql untuk melihat semua record yang
 // ada di tabel animal
 $sql = "SELECT * FROM tbl_order WHERE dana_kontrak='$dana_kontrak'";
  
 //Execetute Query diatas
 $query = mysql_query($sql);
 while($dt=mysql_fetch_array($query)){
  $item=$dt["dana_kontrak"];
 }
 
 //Menampung data yang dihasilkan
 $json = array(
    'dana_kontrak' => $item
   );
 
 //Merubah data kedalam bentuk JSON
//  header('Content-Type: application/json');
 echo json_encode($json);
?>