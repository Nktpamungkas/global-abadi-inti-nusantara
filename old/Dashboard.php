<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	var $p_body = array();
	var $modul = 'dashboard';
	
	function __construct()
    {   parent::__construct();
		parent::cek_session();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->func_modul = $this->modul;

		$this->load->model(array('keuangan_mod', 'invoice_mod', 'orderjob_mod'));
		
		$get_config = $this->dashboard_mod->get_config();
		
		$get = $this->input->get();
		
		if ( isset($get['tahun']) && $get['tahun'] != '' ) {
			$this->p_body['tahun'] = $get['tahun'];
		} else {
			$this->p_body['tahun'] = $get_config['tahun'];
		}
		
		if ( isset($get['threshold_pendapatan_pengeluaran']) && $get['threshold_pendapatan_pengeluaran'] != '' ) {
			$this->p_body['threshold_pendapatan_pengeluaran'] = $get['threshold_pendapatan_pengeluaran'];
		} else {
			$this->p_body['threshold_pendapatan_pengeluaran'] = $get_config['threshold_pendapatan_pengeluaran'];
		}
		
		if ( isset($get['threshold_invoice_pengeluaran']) && $get['threshold_invoice_pengeluaran'] != '' ) {
			$this->p_body['threshold_invoice_pengeluaran'] = $get['threshold_invoice_pengeluaran'];
		} else {
			$this->p_body['threshold_invoice_pengeluaran'] = $get_config['threshold_invoice_pengeluaran'];
		}
		
		if ( isset($get['threshold_arus_kasbesar_arus_kaskecil']) && $get['threshold_arus_kasbesar_arus_kaskecil'] != '' ) {
			$this->p_body['threshold_arus_kasbesar_arus_kaskecil'] = $get['threshold_arus_kasbesar_arus_kaskecil'];
		} else {
			$this->p_body['threshold_arus_kasbesar_arus_kaskecil'] = $get_config['threshold_arus_kasbesar_arus_kaskecil'];
		}
		
		if ( isset($get['threshold_pendapatan']) && $get['threshold_pendapatan'] != '' ) {
			$this->p_body['threshold_pendapatan'] = $get['threshold_pendapatan'];
		} else {
			$this->p_body['threshold_pendapatan'] = $get_config['threshold_pendapatan'];
		}
		
		if ( isset($get['threshold_pengeluaran']) && $get['threshold_pengeluaran'] != '' ) {
			$this->p_body['threshold_pengeluaran'] = $get['threshold_pengeluaran'];
		} else {
			$this->p_body['threshold_pengeluaran'] = $get_config['threshold_pengeluaran'];
		}
		
		if ( isset($get['threshold_arus_kasbesar']) && $get['threshold_arus_kasbesar'] != '' ) {
			$this->p_body['threshold_arus_kasbesar'] = $get['threshold_arus_kasbesar'];
		} else {
			$this->p_body['threshold_arus_kasbesar'] = $get_config['threshold_arus_kasbesar'];
		}
		
		if ( isset($get['threshold_arus_kaskecil']) && $get['threshold_arus_kaskecil'] != '' ) {
			$this->p_body['threshold_arus_kaskecil'] = $get['threshold_arus_kaskecil'];
		} else {
			$this->p_body['threshold_arus_kaskecil'] = $get_config['threshold_arus_kaskecil'];
		}
		
		if( is_array($get) && count($get)){			
			$this->dashboard_mod->set_config($get);
		}
		
		$data['tahun_kasbesar'] = $data['tahun_kaskecil'] =  $data['tahun_invoice'] = $data['tahun_orderjob'] = $this->p_body['tahun'];
		$data_kasbesar	= $this->keuangan_mod->get_daftar_kasbesar($data);
		$data_kaskecil	= $this->keuangan_mod->get_daftar_kaskecil($data);
		$data_invoice	= $this->invoice_mod->get_daftar_invoice($data);
		$data_orderjob	= $this->orderjob_mod->get_daftar_orderjob($data);
		
		$arr_bulan = array(
			'Januari', 'Februari', 'Maret', 'April', 
			'Mei', 'Juni', 'Juli', 'Agustus', 
			'September', 'Oktober', 'November', 'Desember'
		);
		
		$arr_kas_kosong = array('income' => 0, 'cost' => 0);
		$arr_kasbesar = $arr_kaskecil = $arr_invoice = $arr_orderjob = array(); 
		$bln = 1;
		foreach($arr_bulan as $bulan)
		{
			$arr_kasbesar[$bln] = $arr_kas_kosong;
			$arr_kaskecil[$bln] = $arr_kas_kosong;
			$bln++;
		}
		
		// get data saldo dan arus kas besar
		foreach($data_kasbesar as $kasbesar)
		{
			$bln = date('n', strtotime($kasbesar['tanggal_kasbesar']));
			// $nominal = round( ceil($kasbesar['nominal_kasbesar']/1000) );
			$nominal = $kasbesar['nominal_kasbesar'];
			
			if( $kasbesar['debitkredit_account'] == 'Debit' )
			{
				if( isset($arr_kasbesar[$bln]['income']) )
				{
					$arr_kasbesar[$bln]['income'] += $nominal;
				}
				else
				{
					$arr_kasbesar[$bln]['income'] = $nominal;
				}
			}
			elseif( $kasbesar['debitkredit_account'] == 'Kredit' )
			{
				if( isset($arr_kasbesar[$bln]['cost']) )
				{
					$arr_kasbesar[$bln]['cost'] += $nominal;
				}
				else
				{
					$arr_kasbesar[$bln]['cost'] = $nominal;
				}
			}
		}
		
		// get data saldo dan arus kas kecil
		foreach($data_kaskecil as $kaskecil)
		{
			$bln = date('n', strtotime($kaskecil['tanggal_kaskecil']));
			// $nominal = round( ceil($kaskecil['nominal_kaskecil']/1000) );
			$nominal = $kaskecil['nominal_kaskecil'];
			
			if( $kaskecil['debitkredit_account'] == 'Debit' )
			{
				if( isset($arr_kaskecil[$bln]['income']) )
				{
					$arr_kaskecil[$bln]['income'] += $nominal;
				}
				else
				{
					$arr_kaskecil[$bln]['income'] = $nominal;
				}
			}
			elseif( $kaskecil['debitkredit_account'] == 'Kredit' )
			{
				if( isset($arr_kaskecil[$bln]['cost']) )
				{
					$arr_kaskecil[$bln]['cost'] += $nominal;
				}
				else
				{
					$arr_kaskecil[$bln]['cost'] = $nominal;
				}
			}
		}

		// get data invoice
		foreach($data_invoice as $invoice)
		{
			$bln = date('n', strtotime($invoice['tgl_invoice']));
			// $nominal = round( ceil($invoice['grand_total']/1000) );
			$nominal = $invoice['grand_total'];

			if( isset($arr_invoice[$bln]) )
			{
				$arr_invoice[$bln] += $nominal;
			}
			else
			{
				$arr_invoice[$bln] = $nominal;
			}
		}

		// get data orderjob
		foreach($data_orderjob as $orderjob)
		{
			$index = $orderjob['id_keu_account_perusahaan'];
			if( isset($arr_orderjob[$index]) )
			{
				$arr_orderjob[$index]['data'] += 1;
			}
			else
			{
				$arr_orderjob[$index]['data'] = 1;
				$arr_orderjob[$index]['label'] = $orderjob['perusahaan'];
			}
		}
		
		// foreach bulanan
		$arr_income = $arr_cost = $arr_aruskasbesar_ = $arr_aruskasbesar = $arr_aruskaskecil_ = $arr_aruskaskecil = array();				
		$bln = 1;
		foreach($arr_bulan as $bulan)
		{
			// $income_kb 		= $arr_kasbesar[$bln]['income'];
			// $cost_kb 		= $arr_kasbesar[$bln]['cost'];
			// $income_kk 		= $arr_kaskecil[$bln]['income'];
			// $cost_kk 		= $arr_kaskecil[$bln]['cost'];
			
			$income_kb 		=  round( $arr_kasbesar[$bln]['income']/1000);
			$cost_kb 		=  round( $arr_kasbesar[$bln]['cost']/1000);
			$income_kk 		=  round( $arr_kaskecil[$bln]['income']/1000);
			$cost_kk 		=  round( $arr_kaskecil[$bln]['cost']/1000);
			$invoice 		= isset($arr_invoice[$bln]) ? round( $arr_invoice[$bln]/1000) : 0;
			
			$arr_income_kb[]= array( $bulan, $income_kb );
			$arr_cost_kb[] 	= array( $bulan, $cost_kb );
			$arr_invoice_new[] 	= array( $bulan, $invoice );
			
			$saldo_kb = $income_kb - $cost_kb;
			$saldo_kk = $income_kk - $cost_kk;
			
			$aruskasbesar = $saldo_kb;
			if( isset($arr_aruskasbesar_[$bln-1]) )
			{
				$aruskasbesar = $saldo_kb + $arr_aruskasbesar_[$bln-1];
			}

			if( $saldo_kb )
			{
				$arr_aruskasbesar_[$bln] = $aruskasbesar;
				$arr_aruskasbesar[] = array( $bulan, $aruskasbesar );	
			}
			else
			{
				$arr_aruskasbesar_[$bln] = 0;
				$arr_aruskasbesar[] = array( $bulan, 0 );
			}
			
			$aruskaskecil = $saldo_kk;
			if( isset($arr_aruskaskecil_[$bln-1]) )
			{
				$aruskaskecil = $saldo_kk + $arr_aruskaskecil_[$bln-1];
			}

			if( $saldo_kb )
			{
				$arr_aruskaskecil_[$bln] = $aruskaskecil;
				$arr_aruskaskecil[] = array( $bulan, $aruskaskecil );	
			}
			else
			{
				$arr_aruskaskecil_[$bln] = 0;
				$arr_aruskaskecil[] = array( $bulan, 0 );
			}
			
			$bln++;
		}
		
		$this->p_body['json_pendapatan'] = json_encode($arr_income_kb);
		$this->p_body['json_pengeluaran'] = json_encode($arr_cost_kb);
		$this->p_body['json_aruskasbesar'] = json_encode($arr_aruskasbesar);
		$this->p_body['json_aruskaskecil'] = json_encode($arr_aruskaskecil);
		$this->p_body['json_invoice'] = json_encode($arr_invoice_new);
		$this->p_body['json_orderjob'] = json_encode($arr_orderjob);
		
		$this->load->view('webapp/theme1/header');
		$this->load->view('webapp/theme1/menu');
		$this->load->view('webapp/theme1/dashboard', $this->p_body);
		$this->load->view('webapp/theme1/footer');
	}
}
