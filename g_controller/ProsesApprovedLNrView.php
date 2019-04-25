<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C") {
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<?php
include_once 'database/connection.php';

$id_pelunasan = $_POST['id_pelunasan'];
$selectLN = mysql_query("SELECT * FROM pelunasan_po WHERE id = '$id_pelunasan'");
$data = mysql_fetch_assoc($selectLN);
$rekening = $data['rekening'];

$queryUpdate = mysql_query("UPDATE kaskecil SET kas = '$rekening' WHERE id_pelunasan = '$id_pelunasan' AND SUBSTR(uraian, 1,2) = 'PO'");

if ($queryUpdate) {
    echo "<script>window.location.href = '/?g=ApproveR';</script>";
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?> 