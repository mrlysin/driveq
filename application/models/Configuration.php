<?php	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends CI_Model { 

	function __construct(){
		parent::__construct();
	}

	function CheckKey($name, $key){
		$GetData = $this->db->query("select nama, kode, status from api_key where nama='$name' and BINARY kode='$key'");
		return $GetData->row_array();
	}

	function _ApiKey(){
		$GetKey = $this->input->request_headers();
		if($this->session->userdata('Username')==''){
			if(!empty($GetKey['key']) and !empty($GetKey['name'])){
				$CheckKey = $this->CheckKey($GetKey['name'], $GetKey['key']);
				if(empty($CheckKey)){
					redirect("ErrorResult");
				} else if($CheckKey['status'] == 0){
					redirect("ErrorResult");
				} else {
					return;
				}
			} else {
				if($this->agent->browser()!=''){
					redirect('logout');
				} else {
					redirect("ErrorResult");
				}
			}
		} else {
			return;
		}
	}
}