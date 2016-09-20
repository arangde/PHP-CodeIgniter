<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Office Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Aoffice extends CI_Controller
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
        $this->load->model('office_model');
    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'aoffice/index', $data)
            ->render('layouts/default');
    }

   public function oedit()
    {
        $office_last_id=$this->office_model->getOfficeLastId();

        $office_id = ($this->input->get('mem')!='')?$this->input->get('mem'):($office_last_id + 1);
        $input_flag = 0;

        $data = array();
        $data_temp = array(
            'office_id' => $office_id,
            'office_name' => '',
            'office_phonenumber' => '',
            'office_fax' => '',
            'office_postnumber' => '',
            'office_address' => '',
            'office_insurers' => '',
            'office_area' => '',
            'office_class' => '',
            'office_note' => '',
            'office_service' => '',
            'editor_id' => '',
            'sort_id' => 0);

        $this->load->model('insurance_model');
        $insurers = $this->insurance_model->getAllInsurers();
        $data['insurers'] = $insurers;

        $this->load->model('area_model');
        $areas = $this->area_model->getAllArea();
        $data['areas'] = $areas;

        $this->load->model('officeclass_model');
        $officeclass = $this->officeclass_model->getAllOfficeClass();
        $data['officeclass'] = $officeclass;

        if($this->input->get('mem') == ""){
            $data['office_data'] = $data_temp;
            $input_flag = 1;

        }else{
            $offices = $this->office_model->getOfficeById($office_id);
            $input_flag = 0;
            if(count($offices) == 0){
                $data['office_data'] = $data_temp; // forward modify
            }else{
                $data['office_data'] = $offices[0];
            }

        }
        
        $data['input_flag'] = $input_flag;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'aoffice/oedit', $data)
            ->render('layouts/default');
    }

    public function oedit_accept()
    {
        $manager_id = $this->session->userdata('user_id');
        //register insurer
        $data = array('office_name' => $this->input->post('txt_office_name'),
            'office_phonenumber' => $this->input->post('txt_office_phonenumber'),
            'office_fax' => $this->input->post('txt_office_fax'),
            'office_postnumber' => $this->input->post('txt_office_postnumber'),
            'office_address' => $this->input->post('txt_office_address'),
            'office_insurers' => $this->input->post('hdn_insurers'),
            'office_area' => $this->input->post('hdn_areas'),
            'office_class' => $this->input->post('hdn_office_classes'),
            'office_note' => $this->input->post('txt_office_note'),
            'office_service' => $this->input->post('hdn_office_services'),
            'editor_id' => $manager_id,
            'created' => date('Y-m-d H:i:s')
            );

        $input_flag = $this->input->post('hdn_input_flag');

        if($input_flag == 0){
            $office_id = $this->office_model->updateOffice($data, $this->input->post('txt_office_id'));
        }else if($input_flag == 1){
            $office_id = $this->office_model->addOffice($data);
        }

        
        
        if($office_id){
            $result  = array('status'=>'1', 'input_id'=>$office_id, 'input_flag'=>$input_flag);
        }else{
            $result  = array('status'=>'2', 'input_id'=>$office_id, 'input_flag'=>$input_flag);
        }
        exit(json_encode($result));
    }

    public function olist()
    {
        $data = array();

        $history_flag = $this->input->post('hdn_history_flag');

        $keyword = !is_null($this->input->post('txt_search_keyword'))?$this->input->post('txt_search_keyword'):"";

        $cur_page = ($this->input->post('hdn_user_cur_page') != "")?$this->input->post('hdn_user_cur_page'):1;
        $start = ($cur_page-1)*ITEMS_PER_PAGE;
        
        $user_list_orgin = $this->office_model->getOfficeList($keyword, ITEMS_PER_PAGE, $start);
        $user_list = $user_list_orgin[1];
        $user_list_total_count = $user_list_orgin[0];



        $data = array();
        
        $data['user_list'] = $user_list;
        $data['keyword'] = $keyword;
        $data['cur_page'] = $cur_page;
        $data['total_count'] = $user_list_total_count;
        $data['page_count'] = ceil($user_list_total_count/ITEMS_PER_PAGE);

        $data['history_flag'] = $history_flag;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'aoffice/olist', $data)
            ->render('layouts/default');
    }

    public function odelete(){
        $office_id = $this->input->post('office_id');
        exit($this->office_model->deleteOffice($office_id));
    }

    
}

/* End of file aoffice.php */
/* Location: ./application/controllers/aoffice.php */
