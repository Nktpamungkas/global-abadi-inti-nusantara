<?php
$server = mysql_connect('localhost', 'k8517903_gain_br', 's4tudu4t1g4');
// $server = mysql_connect('localhost', 'root', '');

if ($server) {
	$serverNote = '';
	$database = mysql_select_db('k8517903_gain_database');
	// $database = mysql_select_db('gain');
	if ($database) {
		$databaseNote = '';
	} else {
		$databaseNote = 'Tidak Terkoneksi dengan Database';
	}
} else {
	$serverNote = 'Sambungan Server Tidak Terhubung';
}

echo $database = $serverNote . '  ' . $databaseNote;

