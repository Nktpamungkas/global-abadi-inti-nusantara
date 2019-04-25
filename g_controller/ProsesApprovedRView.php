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

    $id_rembust = $_POST['id_rembust'];
    $selectKas = mysql_query("SELECT * FROM rembust WHERE id = '$id_rembust'");
    $data = mysql_fetch_assoc($selectKas);
    $kas = $data['Kas'];

    $queryUpdate = mysql_query("UPDATE kaskecil SET kas = '$kas' WHERE id_rembust = '$id_rembust'");

    if ($queryUpdate) {
        echo "<script>window.location.href = '/?g=ApproveR';</script>";	
    } else {
        echo "<script>window.location.href = '/?';</script>";	
    }
?>