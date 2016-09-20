<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Person Monthlytotal Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Pmonthlytotal extends CI_Controller
{
    protected $logged;
    protected $role;

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('loggedin') != 1) {
            redirect('index/login', 'refresh');
        }
        if($this->session->userdata('role') != 1) {
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
            ->partial('main_content', 'phome/index', $data)
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
            ->partial('main_content', 'pmonthlytotal/conditionselect', $data)
            ->render('layouts/person');
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
            ->partial('main_content', 'pmonthlytotal/result', $data)
            ->render('layouts/person');
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
            ->partial('main_content', 'pmonthlytotal/plancalc', $data)
            ->render('layouts/person');
    }
    public function billinglist()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'monthlytotal')
            ->partial('main_content', 'pmonthlytotal/billinglist', $data)
            ->render('layouts/person');
    }
}

/* End of file pmonthlytotal.php */
/* Location: ./application/controllers/pmonthlytotal.php */
