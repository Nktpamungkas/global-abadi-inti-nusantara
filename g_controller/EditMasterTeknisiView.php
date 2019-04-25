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

    $id = $_POST['id'];
    $teknisi = $_POST['teknisi'];
    $no_hp = $_POST['no_hp'];

    //query update
    $query = "UPDATE teknisi SET teknisi = '$teknisi', no_hp = '$no_hp' WHERE id = '$id' ";

    if (mysql_query($query)) {
     # credirect ke page index
     echo "<script>window.location.href = '/?g=MasterTeknisi';</script>";
    }
    else{
     echo "ERROR, Missing :". mysql_error();
    }
?>