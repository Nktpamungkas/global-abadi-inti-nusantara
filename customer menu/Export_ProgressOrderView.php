<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Progres Order Retails.xls");
?>
<table>
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th width="200">Order ID</th>
            <th width="425">Site</th>
            <th width="125">Start Progres</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_SESSION['userId'])) {
            // Sessi Ada
            $idStaff = $_SESSION['userId'];
            include_once 'database/connection.php';
            $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
            $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
        } else {
            echo "<script>window.location.href = '/?';</script>";
        }

        include_once 'database/connection.php';
        $user = $fetchDataUserBySesion[user];
        $dataDok = mysql_query("SELECT * FROM tbl_order WHERE status_order = 'Progress Order' AND  user = '$user' ORDER BY id DESC");
        $no = 1;
        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
            ?>
        <tr>
            <td>
                <a href="#" data-toggle="modal" data-target="#myModal<?php echo $fetchDataDok['id']; ?>">
                    <span class="glyphicon glyphicon-trash red" title="Delete : <?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?>"></span></a>
            </td>
            <td><?php echo $no++; ?></td>
            <td><?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?></td>
            <td>
                <?php echo $fetchDataDok['site']; ?>
            </td>
            <td>
                <?php 
                $formatdate = date_create($fetchDataDok['start_progress']);
                echo date_format($formatdate, "d M Y");
                ?>
            </td>
        </tr>
        <?php 
    } ?>
    </tbody>
</table> 