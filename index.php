<?php
class Utama
{

	public function ambilLink()
	{

		if (isset($_GET['g'])) { //mengatur Variabel G setiap folder
			$link = $_GET['g'];

			if (empty($link)) {
				include_once 'index';
				include_once 'index';
			} elseif ($link == 'out') {
				session_destroy();
				header("Location: ?");
			} else {
				$controller = 'g_controller/' . ucfirst($link) . 'View.php';

				if (file_exists($controller)) {
					include_once $controller;
				} else {
					include_once 'http://database.gain.co.id/?g=Error';
				}
			}
		} else {
			include_once 'g_controller/IndexView.php';
		}
	}

	private function callCtrl($ctrl = null)
	{
		return 'g_controller/' . ucfirst($ctrl) . 'View.php';
	}
}

session_start();

$utama = new Utama();
$link = $utama->ambilLink();

