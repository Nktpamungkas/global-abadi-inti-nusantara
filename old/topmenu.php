<?php
if($this->session->userdata('language')=='IND'){
	$beranda="Beranda";
	$tentang="Tentang Kami";
	$layanan="Layanan";
	$kantor="Kantor Cabang";
	$kontak="Kontak";
	$bahasa="Bahasa";
	}
	else{
	$beranda="Home";
	$tentang="About Us";
	$layanan="Services";
	$kantor="Office";
	$kontak="Contact";
	$bahasa="Language";
	}
?>

<!-- main menu -->
<nav class="collapse navbar-collapse navbar-right" role="navigation">
	<div class="main-menu">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?php echo site_url();?>home/index"><?php echo $beranda;?></a></li>
			<li><a href="<?php echo site_url();?>home/about"><?php echo $tentang;?></a></li>
			<li><a href="<?php echo site_url();?>home/service"><?php echo $layanan;?></a></li>
			<li><a href="<?php echo site_url();?>home/location"><?php echo $kantor;?></a></li>
			<li><a href="<?php echo site_url();?>home/contact"><?php echo $kontak;?></a></li>
			<li><a href="<?php echo site_url();?>webapp/dashboard" target="_blank">Customer Area</a></li>
			<li class="dropdown"> 
			  <a href="service.php" class="dropdown-toggle" data-toggle="dropdown"><?php echo $bahasa;?> <span class="caret"></span></a> 
				<div class="dropdown-menu">
					<ul>
					    <li><a href="<?php echo site_url();?>home/set_language/EN">English</a></li>
						<li><a href="<?php echo site_url();?>/home/set_language/IND">Indonesia</a></li>
					</ul>
				</div>
			</li> 
		</ul>
	</div>
</nav>