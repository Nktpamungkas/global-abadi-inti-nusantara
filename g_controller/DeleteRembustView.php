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
    $id = $_GET['id'];

    $DeleteBA = mysql_query("DELETE from rembust WHERE id ='$id'");
    $DeleteKasKecil = mysql_query("DELETE from kaskecil WHERE id_rembust ='$id'");
    if($DeleteBA && $DeleteKasKecil) {
        echo '<script>window.history.back()</script>';
    } else {
        echo "QUERY ERROR";
    }
?>