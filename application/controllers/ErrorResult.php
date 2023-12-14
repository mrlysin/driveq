<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class ErrorResult extends REST_Controller {

	function __construct($config = 'rest') {
		parent::__construct($config);
	}

	function index_get(){
		$this->response(array('Status' => "Akses Ditolak"), 200);
	}
}