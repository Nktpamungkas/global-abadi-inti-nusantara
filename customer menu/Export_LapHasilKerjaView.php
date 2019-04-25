<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Hasil Kerja Retails.xls");
?>
 <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
        <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Lokasi</th>
            <th>Tgl Pekerjaan</th>
            <th>Teknisi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once 'database/connection.php';
            $dataDok = mysql_query("SELECT * FROM hasil_kerja ORDER BY id ASC");
            $no = 1;
            while ($fetchDataDok = mysql_fetch_array($dataDok)){
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $fetchDataDok['order_id'] ?></td>
                <td><?php echo $fetchDataDok['lokasi'] ?></td>
                <td><?php echo $fetchDataDok['tgl_pekerjaan']; ?></td>
                <td><?php echo $fetchDataDok['teknisi']; ?></td>
                <td><?php echo $fetchDataDok['keterangan_pekerjaan']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>