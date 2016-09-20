<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Manager Officesystem Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Mofficesystem extends CI_Controller
{
    protected $logged;
    protected $role;

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('loggedin') != 1) {
			redirect('index/login', 'refresh');
		}
        if($this->session->userdata('role') != 2) {
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
            ->partial('main_content', 'mhome/index', $data)
            ->render('layouts/manager');
    }

    public function osedit()
    {

        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'mofficesystem/osedit', $data)
            ->render('layouts/manager');
    
    }

    
}

/* End of file mofficesystem.php */
/* Location: ./application/controllers/mofficesystem.php */
