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
    $bank = $_POST['bank'];
    $address = $_POST['address'];
    $norek = $_POST['norek'];

    //query update
    $query = "UPDATE bank SET bank = '$bank', `address` = '$address', norek = '$norek' WHERE id = '$id' ";

    if (mysql_query($query)) {
     # credirect ke page index
        echo "<script>window.location.href = '/?g=MasterBank';</script>";
    }
    else{
     echo "ERROR, data gagal diupdate". mysql_error();
    }
?>