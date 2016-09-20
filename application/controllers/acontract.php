<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Contract Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Acontract extends CI_Controller
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
        $this->load->model('contract_model');
    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'acontract/cindex', $data)
            ->render('layouts/default');
    }

    public function cedit()
    {
        $contract_last_id = $this->contract_model->getContractLastId();
        $contract_id = ($this->input->get('cid')!='')?$this->input->get('cid'):($contract_last_id + 1);
        $manager_id = $this->session->userdata('user_id');
        $input_flag = 0;

        $data = array();
        $contract_temp = array('contract_id' => $contract_id,
            'c_furigana' =>'',
            'c_username' => '',
            'c_symbol' => '',
            'c_sex' => 0,
            'c_birthday' => '',
            'c_blood' => '',
            'c_postnumber' => '',
            'c_address' => '',
            'c_phonenumber' => '',
            'c_mobilenumber' => '',
            'c_fax' => '',
            'c_email' => '',
            'c_masternumber' => $manager_id,
            'c_insured' => '',
            'office_id' => 0,
            'desination_flag' => 0,
            'des_furigana' => '',
            'des_name' => '',
            'des_postnumber' => '',
            'des_address' => '',
            'des_note' => '');

        if($this->input->get('cid') == ""){
            $data['contract_data'] = $contract_temp;
            $input_flag = 1;

        }else{
            $contract = $this->contract_model->getContractById($contract_id);
            $input_flag = 0;
            if(count($contract) == 0){
                $data['contract_data'] = $contract_temp; // forward modify
            }else{
                $data['contract_data'] = $contract[0];
            }

            //log history
            
            $this->contract_model->setContractViewHistory($manager_id, $contract_id);
        }

        // get contract service
        $contractServices = $this->contract_model->getContractServices($contract_id);
        $services = array();
        $service_fields = '';
        foreach($contractServices as $service){
            $services[$service['service_id']] = $service;
            $service_fields .= $service['service_id'].",";
        }

        $this->load->model('user_model');
        $offices = $this->user_model->get('offices');
        $data['offices'] = $offices;

        $data['contractServices'] = $services;
        $data['service_fields'] = $service_fields;
        $data['input_flag'] = $input_flag;

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'contract')
            ->partial('main_content', 'acontract/cedit', $data)
            ->render('layouts/default');
    
    }

    public function cedit_accept()
    {

        $manager_id = $this->session->userdata('user_id');
        //register employee
        $data = array(
            'c_furigana' => $this->input->post('txt_c_furigana'),
            'c_username' => $this->input->post('txt_c_username'),
            'c_symbol' => $this->input->post('txt_c_symbol'),
            'c_sex' => $this->input->post('sel_c_sex'),
            'c_birthday' => $this->input->post('txt_c_birthday'),
            'c_blood' => $this->input->post('txt_c_blood'),
            'c_postnumber' => $this->input->post('txt_c_postnumber'),
            'c_address' => $this->input->post('txt_c_address'),
            'c_phonenumber' => $this->input->post('txt_c_phonenumber'),
            'c_mobilenumber' => $this->input->post('txt_c_mobilenumber'),
            'c_fax' => $this->input->post('txt_c_fax'),
            'c_email' => $this->input->post('txt_c_email'),
            'c_masternumber' => $this->input->post('txt_c_masternumber'),
            'c_insured' => $this->input->post('txt_c_insurednumber'),
            'office_id' => $this->input->post('sel_c_office_id'),
            'desination_flag' => $this->input->post('rd_c_destination'),
            'des_furigana' => $this->input->post('txt_c_destination_furigana'),
            'des_name' => $this->input->post('txt_c_destination_username'),
            'des_postnumber' => $this->input->post('txt_c_destination_postnumber'),
            'des_address' => $this->input->post('txt_c_destination_address'),
            'des_note' => $this->input->post('txt_c_destination_note'),
            'created' => date('Y-m-d H:i:s'));

        $input_flag = $this->input->post('hdn_input_flag');

        if($input_flag == 0){
            $contract_id = $this->contract_model->updateContract($data, $this->input->post('txt_contract_id'));
        }else if($input_flag == 1){
            $contract_id = $this->contract_model->addContract($data);
        }
        /*add contract service*/
        $fields = substr($this->input->post('hdn_change_fields'), 0, -1);
        $fields_array = explode(',', $fields);
        if(count($fields_array) > 0){
            $contractServices = array();
            foreach ($fields_array as $key => $field) {
                $contractServices[] = array('contract_id'=>$this->input->post('txt_contract_id'), 'service_id'=>$field, 'from_date'=>$this->input->post('txt_service_from_'.$field), 'to_date'=>$this->input->post('txt_service_to_'.$field), 'created' => date('Y-m-d H:i:s'));
            }
            $flag = $this->contract_model->addContractService($this->input->post('txt_contract_id'), $contractServices);
        }
        if($contract_id){
            $result  = array('status'=>'1', 'input_id'=>$contract_id, 'input_flag'=>$input_flag);
        }else{
            $result  = array('status'=>'2', 'input_id'=>$contract_id, 'input_flag'=>$input_flag);
        }
        exit(json_encode($result));
    
    }
    public function clist()
    {

        $data = array();
        $history_flag = $this->input->post('hdn_history_flag');
        $keyword = !is_null($this->input->post('txt_search_keyword'))?$this->input->post('txt_search_keyword'):"";
        $kana = ($this->input->post('hdn_search_kana_id') != "")?$this->input->post('hdn_search_kana_id'):0;

        $cur_page = ($this->input->post('hdn_cur_page') != "")?$this->input->post('hdn_cur_page'):1;
        $start = ($cur_page-1)*ITEMS_PER_PAGE;
        
        $contract_list_orgin = $this->contract_model->getContractList($keyword, 99, 99, 99, $kana, ITEMS_PER_PAGE, $start);
        $contract_list = $contract_list_orgin[1];
        $contract_list_total_count = $contract_list_orgin[0];



        $data = array();
        if($history_flag == 1){
            $manager_id = $this->session->userdata('user_id');
            $history_list = $this->contract_model->getContractViewHistory($manager_id);
            $data['history_list'] = $history_list;
        }
        $data['contract_list'] = $contract_list;
        $data['keyword'] = $keyword;
        
        $data['kana'] = $kana;
        $data['cur_page'] = $cur_page;
        $data['total_count'] = $contract_list_total_count;
        $data['page_count'] = ceil($contract_list_total_count/ITEMS_PER_PAGE);

        $data['history_flag'] = $history_flag;

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'contract')
            ->partial('main_content', 'acontract/clist', $data)
            ->render('layouts/default');
    
    }
    public function cdelete(){
        $contract_id = $this->input->post('contract_id');
        exit($this->contract_model->deleteContract($contract_id));
    }

    public function ajaxlist(){
        $data = array();
        $history_flag = $this->input->post('hdn_searchbox_history_flag');
        $keyword = !is_null($this->input->post('txt_searchbox_search_keyword'))?$this->input->post('txt_searchbox_search_keyword'):"";
        $kana = ($this->input->post('hdn_searchbox_search_kana_id') != "")?$this->input->post('hdn_searchbox_search_kana_id'):0;

        $cur_page = ($this->input->post('hdn_searchbox_cur_page') != "")?$this->input->post('hdn_searchbox_cur_page'):1;
        $start = ($cur_page-1)*ITEMS_PER_PAGE;
        
        $contract_list_orgin = $this->contract_model->getContractList($keyword, 99, 99, 99, $kana, ITEMS_PER_PAGE, $start);
        $contract_list = $contract_list_orgin[1];
        $contract_list_total_count = $contract_list_orgin[0];

        $data = array();
        if($history_flag == 1){
            $manager_id = $this->session->userdata('user_id');
            $history_list = $this->contract_model->getContractViewHistory($manager_id);
            $data['history_list'] = $history_list;
        }
        $data['contract_list'] = $contract_list;
        $data['keyword'] = $keyword;
        
        $data['kana'] = $kana;
        $data['cur_page'] = $cur_page;
        $data['total_count'] = $contract_list_total_count;
        $data['page_count'] = ceil($contract_list_total_count/ITEMS_PER_PAGE);

        $data['history_flag'] = $history_flag;

        exit(json_encode($data));
    }

    public function ajaxcontract(){
        $contract_id = $this->input->post('contract_id');
        $contract_data = $this->contract_model->getContractById($contract_id);
        exit(json_encode($contract_data[0]));
    }
    
    public function setglobalcontract(){
        $contract_id = $this->input->post('contract_id');
        $contract_data = $this->contract_model->getContractById($contract_id);
        $this->session->set_userdata('contract_data', $contract_data[0]);
        exit('1');
    }
}

/* End of file acontract.php */
/* Location: ./application/controllers/acontract.php */
