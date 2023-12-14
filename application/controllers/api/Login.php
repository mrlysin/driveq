<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('MLogin');
	}

	function verify_post()
	{
		$data = $this->MLogin->VerifyLogin();
		$this->response($data);
	}
}
