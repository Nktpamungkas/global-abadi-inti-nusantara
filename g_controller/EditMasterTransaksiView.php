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
    $transaksi = $_POST['transaksi'];
    $kode = $_POST['kode'];

    //query update
    $query = "UPDATE transaksi SET transaksi = '$transaksi', kode = '$kode' WHERE id = '$id' ";

    if (mysql_query($query)) {
     # credirect ke page index
     echo "<script>window.location.href = '/?g=MasterTransaksi';</script>";
    }
    else{
     echo "ERROR, data gagal diupdate". mysql_error();
    }
?>