<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Corporatoin Controller
 * Created by: kgh
 * Date: 07/10/2016
 *
 */
class Acorporation extends CI_Controller
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
        $this->load->model('corporation_model');
        $this->load->model('settings_model');
    }

    public function index()
    {
        redirect('corporation/info', 'refresh');
    }

    public function info()
    {
        $corporation_data = $this->settings_model->getSettings('admin');

        $data = array();
        $data['corporation_data'] = $corporation_data;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'acorporation/info', $data)
            ->render('layouts/default');    
    }

    public function update()
    {
        $corporation_data = $this->settings_model->getSettings('admin');
        $data = array();
        $data['corporation_data'] = $corporation_data;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'acorporation/update', $data)
            ->render('layouts/default');    
    }

    public function subscription_accept()
    {
    	//$manager_id = $this->session->userdata('user_id');
        //$user = $this->user_model->getUserById($manager_id);
        $fields = substr($this->input->post('hdn_change_fields'), 0, -1);
        $fields_array = explode(',', $fields);

        $data = array();
        foreach ($fields_array as $key => $field) {
            $s_f = explode(':', $field);
            $data[] = array('option_key'=>$s_f[1], 'option_value'=>$this->input->post($s_f[0]), 'module'=>'admin');
        }

        $flag = $this->settings_model->saveSettings($data);
        
        exit('1');
    }
}

/* End of file acorporation.php */
/* Location: ./application/controllers/acorporation.php */
