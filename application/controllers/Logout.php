<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
{

	function index()
	{
		if (!empty($this->session->userdata('Site'))) {
			$site = $this->session->userdata('Site');
			$this->session->sess_destroy();
			redirect(base_url("login/Fromdokar/" . $site . "/logout/admin"));
		} else {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
}
