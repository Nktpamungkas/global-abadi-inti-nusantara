<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	var $data = array();
	var $modul = 'website';
	
	function __construct()
    {   
	  parent::__construct();
	  ob_start();
	  $this->load->library('form_validation');


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

	public function set_language($language)
	{
		$this->session->set_userdata('language', $language);
		redirect('home/index');
	}
	 
	public function index()
	{
		$data['isi']='website/theme3/v_index';	
		$this->load->view('website/theme3/layout', $data);
	}
	
	public function about()
	{
		if($this->session->userdata('language')=='IND')$data['isi']='website/theme3/v_about_ind';
		else $data['isi']='website/theme3/v_about_en';
		//$data['isi']='website/theme3/v_about';	
		$this->load->view('website/theme3/layout', $data);
	}
	
	public function service()
	{
		if($this->session->userdata('language')=='IND'){
			$data['layanan']="Layanan PT. GAIN";
			$data['beranda']="Beranda";
			$data['produk']="Produk dan Layanan";
			$data['detail']="Detil";
			$data['ket']="Kami menyediakan berbagai layanan untuk keperluan telekomukasi anda";
			$data['layanan_1']="Instalasi Jaringan VSAT";
			$data['layanan_2']="Perbaikan Perangkat VSAT";
			$data['layanan_3']="Internet Teknologi VSAT";
			$data['layanan_4']="Instalasi Fiber Optic";
			$data['layanan_5']="Pembuatan Website";
			$data['layanan_6']="Aplikasi Berbasis Web";
			$data['layanan_7']="Perangkat Telekomunikasi";
			$data['layanan_8']="<i>Forwarder</i>";
			$data['ket_1']="Jasa instalasi, <i>dismantle</i>, serta pemeliharaan VSAT dengan menggunakan ukuran antena 0.74 m sampai 13 m";
			$data['ket_2']="Jasa perbaikan seperti modem, BUC, LNA/B, SSPA, HPA, TWTA, <i>up</i> dan <i>down converter</i> dengan garansi 3 bulan.";
			$data['ket_3']="Komunikasi data atau <i>voice</i> yang terintegrasi dengan harga yang kompetitif.";
			$data['ket_4']="Pemeliharaan, penarikan dan penyambungan fiber optik dengan tipe kabel multi mode maupun single mode.";
			$data['ket_5']="Kami menyediakan jasa dalam pembuatan serta pengembangan website <i>company profile</i> secara spesifik.";
			$data['ket_6']="Aplikasi sebagai tools dengan database platform web based untuk mempermudah pekerjaan yang memiliki cabang di berbagai daerah.";
			$data['ket_7']="Bekerja sama dengan beberapa perusahaan telekomunikasi yang mempunyai produk-produk telekomunikasi dan catuan seperti server, <i>router</i>, <i>inverter</i> dan UPS.";
			$data['ket_8']="Mempercepat proses instalasi sehingga setiap project mencapai target yang telah ditentukan oleh para pelanggan kami.";
			}
		else{
			$data['layanan']="Services";
			$data['beranda']="Home";
			$data['detail']="Detail";
			$data['produk']="Product and Services";
			$data['ket']="We provide a range of services for telecommunication purposes you";
			$data['layanan_1']="VSAT Network Installation";
			$data['layanan_2']="Repair VSAT Device";
			$data['layanan_3']="Internet VSAT Technology";
			$data['layanan_4']="Fiber Optic Installation";
			$data['layanan_5']="Website Builder";
			$data['layanan_6']="Web Based Application";
			$data['layanan_7']="Telecommunications Equipment";
			$data['layanan_8']="Forwarder";
			$data['ket_1']="Installation services, dismantle, and maintenance by using the VSAT antenna size is 0.74 m to 13 m";
			$data['ket_2']="Repair services such as modem, BUC, LNA / B, SSPA, HPA, TWTA, up and down converter with a 3 month warranty.";
			$data['ket_3']="Data or voice communication integrated with competitive price.";
			$data['ket_4']="Maintenance, withdrawal and splicing fiber optic cable with a type of multi-mode or single mode.";
			$data['ket_5']="We provide services in the manufacture and development of specific company profile website.";
			$data['ket_6']="Database applications as tools with web-based platform to facilitate the work which has branches in various regions.";
			$data['ket_7']="Working closely with several telecommunications companies that have telecommunication products and ration such as servers, routers, inverters and UPS.";
			$data['ket_8']="Speed up the installation process so each project to achieve the target that has been determined by our customers.";
			}	
		$data['isi']='website/theme3/v_service';	
		$this->load->view('website/theme3/layout', $data);
	}
		
	public function location()
	{
		$data['isi']='website/theme3/v_location';	
		$this->load->view('website/theme3/layout', $data);
	}
		
	public function contact()
	{
		/**/
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('subject', 'Judul', 'required|min_length[3]');
		$this->form_validation->set_rules('message', 'Pesan', 'required|min_length[3]');
		$this->form_validation->set_rules('name', 'Nama', 'required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE){
			
			$data['isi']='website/theme3/v_contact';	
			$this->load->view('website/theme3/layout', $data);
			}
		else{
			echo "<script> alert('Pesan berhasil dikirim'); </script>";
			//redirect('home/index','refresh');
			redirect('home/index');
			}
	}
	
	public function produk($no)
	{
		$no=$this->uri->segment(3);
		if($this->session->userdata('language')=='IND')
			$data['isi']='website/theme3/v_produk_ind_'.$no;	
		else $data['isi']='website/theme3/v_produk_en_'.$no;
		$this->load->view('website/theme3/layout', $data);
	}
	
 
	
}
