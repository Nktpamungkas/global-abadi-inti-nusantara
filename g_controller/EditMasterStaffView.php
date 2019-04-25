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

    $id_staff = $_POST['id_staff'];
    $nama = $_POST['nama'];
    $pas_lama = $_POST['pas_lama'];
    $pas_baru = $_POST['pas_baru'];
    date_default_timezone_set('Asia/Jakarta');
    $dateupdate = date("Y-m-d h:i:s");

    $q_select = mysql_query("SELECT * FROM staff WHERE id_staff= '$idStaff'");
    $cek_pas_lama = mysql_fetch_assoc($q_select);

    if ($cek_pas_lama['password'] == $pas_lama) {
        //Update Password
        $update = mysql_query("UPDATE staff SET nama = '$nama', `password` = '$pas_baru', staff_update = '$dateupdate' WHERE id_staff = '$id_staff'");
        echo '<script language="javascript">';
        echo 'alert("Berhasil ubah nama & password. klik tombol ok !")';
        echo '</script>';
        echo "<script>window.location.href = '/?g=MasterUsers';</script>";
    } else {
        echo '<script language="javascript">';
        echo 'alert("Password lama tidak sesuai. Silahkan ulangi kembali !")';
        echo '</script>';       
        echo "<script>window.location.href = '/?g=MasterUsers';</script>";
    }
?>