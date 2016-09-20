<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Home Controller
 * Created by: arangde
 * Date: 07/05/2016
 *
 */
class Ahome extends CI_Controller
{
    protected $logged;
    protected $role;

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('loggedin') != 1) {
			redirect('index/login', 'refresh');
		}
        if($this->session->userdata('role') != 3) {
            redirect('index/login', 'refresh');
        }
		$this->role = $this->session->userdata('role');

    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'home')
            ->partial('main_content', 'ahome/index', $data)
            ->render('layouts/default');
    }

    
}

/* End of file ahome.php */
/* Location: ./application/controllers/ahome.php */
