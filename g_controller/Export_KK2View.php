<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Keuangan Kas Kecil 2.xls");
?>
<table>
    <thead>
        <tr>
            <th width="50">No</th>
            <th width="100">Tanggal</th>
            <th width="100">Kode</th>
            <th width="100">Uraian</th>
            <th width="100">Site</th>
            <th width="100">Debit</th>
            <th width="100">Kredit</th>
            <th width="100">Saldo</th>
            <th width="200">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once 'database/connection.php';
        $dataDok = mysql_query("SELECT * from kaskecil WHERE kas = 'KK 2'");
        $no = 1;
        while ($fetchDataDok = mysql_fetch_array($dataDok)){
        echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>".$fetchDataDok['tgl']."</td>";
            echo "<td>";
                        if($fetchDataDok['account'] == "Rembust"){
                            echo "R";
                        }elseif ($fetchDataDok['account'] == "Non Rembust") {
                            echo "NR";
                        }else{
                            echo $fetchDataDok['account'];
                        }
                    "</td>";
            echo '<td>';
                    $akun = $fetchDataDok['account'];
                    $query = mysql_query("SELECT * FROM account_kasbank WHERE account = '$akun'");
                    $data = mysql_fetch_array($query);

                    if($data['uraian']){
                        echo $data['uraian'];
                    }else {
                        echo $fetchDataDok['uraian'];
                    }
                '</td>';
            echo "<td>".$fetchDataDok['site']."</td>";
            if ($no==1) {
                // Pertama Kali Deklarasi Debit
                echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                $debit = $fetchDataDok['debit'];
                $saldo = $fetchDataDok['debit'];
                echo "<td>".number_format($saldo)."</td>";
            }else{
                if ($fetchDataDok['debit'] != 0) {
                    // Jika debit tidak sama dengan 0
                    echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                    echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                    $debit = $debit + $fetchDataDok['debit'];
                    $saldo = $saldo + $fetchDataDok['debit'];
                    echo "<td>".number_format($saldo)."</td>";
                }else{
                    // Jika debit sama dengan 0
                        echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                        echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                        $kredit = 0;
                        $kredit = $kredit + $fetchDataDok['kredit'];
                        $saldo = $saldo - $fetchDataDok['kredit'];
                        echo "<td>".number_format($saldo)."</td>";
                }
            }
            echo "<td>".$fetchDataDok['keterangan']."</td>";
        echo "</tr>";
        $no++;
        }
    ?>
    </tbody>
</table>