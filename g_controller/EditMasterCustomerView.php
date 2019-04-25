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
    $customer = $_POST['customer'];
    $description = $_POST['description'];

    //query update
    $query = "UPDATE customer SET customer = '$customer', description = '$description' WHERE id = '$id' ";

    if (mysql_query($query)) {
     # credirect ke page index
     echo "<script>window.location.href = '/?g=MasterCustomer';</script>";
    }
    else{
     echo "ERROR, data gagal diupdate". mysql_error();
    }
?>