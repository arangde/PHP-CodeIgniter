<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Monthlytotal Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Amonthlytotal extends CI_Controller
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
            ->partial('main_content', 'ahome/index', $data)
            ->render('layouts/default');
    }

    public function conditionselect()
    {
        $year = $this->input->post('hdn_cur_year');
        $smonth = $this->input->post('sel_cur_support_month');
        $bmonth = $this->input->post('sel_cur_bill_month');
        $cur_year = !empty($year)?$year:date('Y');
        $cur_smonth = !empty($smonth)?$smonth:date('m');
        $cur_bmonth = !empty($bmonth)?$bmonth:date('m');

        $data = array();
        $data['cur_year'] = $cur_year;
        $data['cur_support_month'] = $cur_smonth;
        $data['cur_bill_month'] = $cur_bmonth;


        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'monthlytotal')
            ->partial('main_content', 'amonthlytotal/conditionselect', $data)
            ->render('layouts/default');
    }
    public function result()
    {
        $year = $this->input->post('hdn_cur_year');
        $month = $this->input->post('sel_cur_month');
        $cur_year = !empty($year)?$year:date('Y');
        $cur_month = !empty($month)?$month:date('m');
        $data = array();
        $data['cur_year'] = $cur_year;
        $data['cur_month'] = $cur_month;

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'monthlytotal')
            ->partial('main_content', 'amonthlytotal/result', $data)
            ->render('layouts/default');
    }
    public function plancalc()
    {
        $year = $this->input->post('hdn_cur_year');
        $month = $this->input->post('sel_cur_month');
        $cur_year = !empty($year)?$year:date('Y');
        $cur_month = !empty($month)?$month:date('m');
        $data = array();
        $data['cur_year'] = $cur_year;
        $data['cur_month'] = $cur_month;
        
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'monthlytotal')
            ->partial('main_content', 'amonthlytotal/plancalc', $data)
            ->render('layouts/default');
    }
    public function billinglist()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'monthlytotal')
            ->partial('main_content', 'amonthlytotal/billinglist', $data)
            ->render('layouts/default');
    }
}

/* End of file amonthlytotal.php */
/* Location: ./application/controllers/amonthlytotal.php */
