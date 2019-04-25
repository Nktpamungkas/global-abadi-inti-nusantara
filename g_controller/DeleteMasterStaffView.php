<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C"){
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<?php 
    include_once 'database/connection.php';
    $id_staff = $_GET['id_staff'];

    $DeleteBA = mysql_query("DELETE from staff WHERE id_staff ='$id_staff'");
    if($DeleteBA) {
        echo '<script language="javascript">';
        echo 'alert("Berhasil dihapus.")';
        echo '</script>';
        echo "<script>window.location.href = '/?g=MasterUsers';</script>";
    } else {
        echo "QUERY ERROR";
    }
?>