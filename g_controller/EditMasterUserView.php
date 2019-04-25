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
    $perusahaan = $_POST['perusahaan'];
    $kode = $_POST['kode'];
    $alamat = $_POST['alamat'];
    $pajak = $_POST['pajak'];
    if($pajak == "PPN 10%"){
            $nilaipajak = "0.1";
        }else{
            $nilaipajak = "0";
        }

    //query update
    $query = "UPDATE perusahaan SET kode = '$kode', perusahaan = '$perusahaan', alamat = '$alamat', vat = '$pajak', nilai_vat = '$nilaipajak' WHERE id = '$id' ";

    if (mysql_query($query)) {
     # credirect ke page index
     echo "<script>window.location.href = '/?g=MasterUser';</script>";
    }
    else{
     echo "ERROR, data gagal diupdate". mysql_error();
    }
?>