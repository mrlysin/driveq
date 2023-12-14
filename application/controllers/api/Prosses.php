<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Prosses extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('MProsses');
	}

	function appname_get()
	{
		$Data = $this->MProsses->getappname();
		$this->response($Data);
	}

	function editprofile_post()
	{
		$Edit = $this->MProsses->editprofile();
		$this->response($Edit);
	}

	function tambahfolder_post()
	{
		$tambah = $this->MProsses->tambahfolder();
		$this->response($tambah);
	}

	function renamefolder_post()
	{
		$rename = $this->MProsses->renamefolder();
		$this->response($rename);
	}

	function trashfolder_post()
	{
		$trash = $this->MProsses->trashfolder();
		$this->response($trash);
	}

	function deletefolder_post()
	{
		$delete = $this->MProsses->deletefolder();
		$this->response($delete);
	}

	function restorefolder_post()
	{
		$restore = $this->MProsses->restorefolder();
		$this->response($restore);
	}

	function sharefolder_post()
	{
		$share = $this->MProsses->sharefolder();
		$this->response($share);
	}

	function unsharefolder_post()
	{
		$unshare = $this->MProsses->unsharefolder();
		$this->response($unshare);
	}

	function addfavoritfolder_post()
	{
		$addfavorit = $this->MProsses->addfavoritfolder();
		$this->response($addfavorit);
	}

	function removefavoritfolder_post()
	{
		$removefavorit = $this->MProsses->removefavoritfolder();
		$this->response($removefavorit);
	}

	function tambahfile_post()
	{
		$tambah = $this->MProsses->tambahfile();
		$this->response($tambah);
	}

	function deletefile_post()
	{
		$delete = $this->MProsses->deletefile();
		$this->response($delete);
	}

	function trashfile_post()
	{
		$trash = $this->MProsses->trashfile();
		$this->response($trash);
	}

	function editfile_post()
	{
		$edit = $this->MProsses->editfile();
		$this->response($edit);
	}

	function restorefile_post()
	{
		$restore = $this->MProsses->restorefile();
		$this->response($restore);
	}

	function sharefile_post()
	{
		$share = $this->MProsses->sharefile();
		$this->response($share);
	}

	function unsharefile_post()
	{
		$unshare = $this->MProsses->unsharefile();
		$this->response($unshare);
	}

	function addfavoritfile_post()
	{
		$addfavorit = $this->MProsses->addfavoritfile();
		$this->response($addfavorit);
	}

	function removefavoritfile_post()
	{
		$removefavorit = $this->MProsses->removefavoritfile();
		$this->response($removefavorit);
	}


















	function user_get()
	{
		$Data = $this->MProsses->datausers();
		if (empty($Data)) {
			$this->response(array(array('id' => 'NotFound')));
		} else {
			$this->response($Data);
		}
	}

	function userbyid_post()
	{
		$id = $this->input->post('id');
		$Data = $this->MProsses->datausersbyid($id);
		if (empty($Data)) {
			$this->response(array('id' => 'NotFound'));
		} else {
			$this->response($Data);
		}
	}

	function inputuser_post()
	{
		$Input = $this->MProsses->inputuser();
		$this->response($Input);
	}

	function edituser_post()
	{
		$Edit = $this->MProsses->edituser();
		$this->response($Edit);
	}

	function deleteuser_post()
	{
		$Delete = $this->MProsses->deleteuser();
		$this->response($Delete);
	}
}
