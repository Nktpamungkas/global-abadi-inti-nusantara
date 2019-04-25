<?php
if (isset($_SESSION['userId'])){
	// Sesi Ada
	$idStaff = $_SESSION['userId'];
	include_once 'g_controller/database/connection.php';
	$dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$id_staff'");
	$fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
	
	if ($fetchDataUserBySesion['jabatan'] == "C"){
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>