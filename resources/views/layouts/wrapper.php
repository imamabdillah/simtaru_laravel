<?php
require_once('header.php');
if($this->session->userdata('role')=="1"){
	require_once('menu.php');
} else
if($this->session->userdata('role')=="2"){
	require_once('menu_opd.php');
} else {
	require_once('menu_pemohon.php');
}
require_once('header2.php');
require_once('content.php');
require_once('footer.php');
