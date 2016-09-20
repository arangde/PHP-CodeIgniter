<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base Controller
 * Created by: arangde
 * Date: 11/21/13
 * 
 */
class MY_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('settings_model');
		
		$this->system_settings();
		
	}
	
	public function system_settings() {
		
		$system_settings = $this->settings_model->getSettings('system');
		
		$this->session->set_userdata($system_settings);
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */