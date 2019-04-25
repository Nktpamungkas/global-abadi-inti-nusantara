<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C" || $fetchDataUserBySesion['jabatan'] == "MK") {
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<?php 
include_once 'database/connection.php';
$id = $_POST['id'];

$DeleteBA = mysql_query("DELETE from tbl_order WHERE id ='$id'");
if ($DeleteBA) {
    echo "<script>window.location.href = '/?g=ProgressOrder';</script>";
} else {
    echo "QUERY ERROR";
}
?> 