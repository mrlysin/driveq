<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('MLogin');
	}

	function Index()
	{
		$data["title"] = "E-Arsip - Login";
		$this->load->view("admin/contents/login", $data);
	}

	function Fromdokar($site, $userid, $key)
	{
		$data['userid'] = $userid;
		$data['site'] = $site;
		$data['key'] = $key;
		$data["title"] = "E-Arsip - Login";
		$this->load->view("admin/contents/login-fromdokar", $data);
	}

	function Verify()
	{
		$verify = $this->MLogin->VerifyLogin();
		if ($verify['Status'] == 'Sukses') {
			$sess['IdUser']		= $verify['Data']['IdUser'];
			$sess['NamaUser']	= $verify['Data']['NamaUser'];
			$sess['Instansi']	= $verify['Data']['Instansi'];
			$sess['KodeInstansi']	= $verify['Data']['KodeInstansi'];
			$sess['Username'] 	= $verify['Data']['Username'];
			$sess['Level']	  	= $verify['Data']['Level'];
			$sess['LevelName']	= $verify['Data']['LevelName'];
			$this->session->set_userdata($sess);
			$Result = array(
				'Status' => 'Sukses',
				'Notif' => '<div class="alert alert-success" role="alert">' . $verify['Notif'] . '</div>'
			);
		} else {
			$Result = array(
				'Status' => 'Gagal',
				'Notif' => '<div class="alert alert-warning" role="alert">' . $verify['Notif'] . '</div>'
			);
		}
		echo json_encode($Result);
	}

	function VerifyFromDokar()
	{
		$data = $this->MLogin->FromDokar();
		if ($data->Status == 'Sukses') {
			$sess['IdUser']		= $data->Data->uid;
			$sess['NamaUser']	=  $data->Data->nama;
			$sess['Instansi']	=  $data->Data->nama_desa;
			$sess['KodeInstansi']	= $data->Data->kode_desa;
			$sess['Username'] 	=  $data->Data->user_name;
			$sess['Level']	  	= 4;
			$sess['LevelName']	= "Admin Desa";
			$sess['Site']	= $this->input->post('site');
			$this->session->set_userdata($sess);
			$Result = array(
				'Status' => 'Sukses',
				'Notif' => '<div class="alert alert-success" role="alert">' . $data->Status . '</div>'
			);
		} else {
			$Result = array(
				'Status' => 'Gagal',
				'Notif' => '<div class="alert alert-warning" role="alert">' . $data->Status . '</div>'
			);
		}
		echo json_encode($Result);
		// echo $Result;
	}
}
