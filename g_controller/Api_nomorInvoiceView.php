<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
	include_once 'database/connection.php';

	$perusahaan = $_GET['perusahaan'];

	$tahun = date('y');
	$array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
    $bulan = $array_bulan[date('n')];

	// Syntax MySql untuk melihat semua record yang
	// ada di tabel perusahaan
	$sql = "SELECT * FROM perusahaan WHERE perusahaan='$perusahaan'";

  
	//Execetute Query diatas
	$query = mysql_query($sql);
	while($dt=mysql_fetch_array($query)){
	$item=$dt["kode"];
	}
 
	//Menampung data yang dihasilkan
	$json = array(
		'kode' => $item,
		'bulan' => $bulan,
		'tahun' => $tahun
	);
 
	//Merubah data kedalam bentuk JSON
	// header('Content-Type: application/json');
	echo json_encode($json);
?>