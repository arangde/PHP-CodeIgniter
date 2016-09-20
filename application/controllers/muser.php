<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Master User Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Muser extends CI_Controller
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
        $this->load->model('user_model');

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

    public function uedit()
    {
        $user_last_id=$this->user_model->getUserLastId();

        $user_id = ($this->input->get('mem')!='')?$this->input->get('mem'):($user_last_id + 1);
        
        $input_flag = 0;

        $data = array();
        if($this->session->userdata('role')==3){
            $user_temp = array(
                'user_id' => $user_id,
                'user_email' => '',
                'furigana' => '',
                'username' => '',
                'symbol' => '',
                'sex' => 0,
                'phone_number' => '',
                'job_title' => '',
                'support_number' => '',
                'note' => '',
                'sort_id' => 0,
                'login_id' => '',
                'password' => '',
                'role' => 3,
                'employment' => 0,
                'office_id' => 0,
                'office_name' => '');
        }else{
            $manager_id = $this->session->userdata('user_id');
            $manager = $this->user_model->getUserById($manager_id);
            $user_temp = array(
                'user_id' => $user_id,
                'user_email' => '',
                'furigana' => '',
                'username' => '',
                'symbol' => '',
                'sex' => 0,
                'phone_number' => '',
                'job_title' => '',
                'support_number' => '',
                'note' => '',
                'sort_id' => 0,
                'login_id' => '',
                'password' => '',
                'role' => 3,
                'employment' => 0,
                'office_id' => $manager[0]['office_id'],
                'office_name' => $manager[0]['office_name']);
        }
        

        if($this->input->get('mem') == ""){
            $data['user_data'] = $user_temp;
            $input_flag = 1;

        }else{
            $user = $this->user_model->getUserById($user_id);
            $input_flag = 0;
            if(count($user) == 0){
                $data['user_data'] = $user_temp; // forward modify
            }else{
                $data['user_data'] = $user[0];
            }

            //log history
            $manager_id = $this->session->userdata('user_id');
            $this->user_model->setUserViewHistory($manager_id, $user_id);
        }
        
        $data['input_flag'] = $input_flag;

        $offices = $this->user_model->get('offices');
        $data['offices'] = $offices;

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'muser/uedit', $data)
            ->render('layouts/manager');
    
    }

    public function uedit_accept()
    {
        $manager_id = $this->session->userdata('user_id');
        //register employee
        $data = array('user_id' => $this->input->post('txt_user_id'),
            'user_email' => $this->input->post('txt_user_email'),
            'furigana' => $this->input->post('txt_user_furigana'),
            'username' => $this->input->post('txt_user_name'),
            'managername' => $manager_id,
            'symbol' => $this->input->post('txt_user_symbol'),
            'sex' => $this->input->post('sel_user_sex'),
            'phone_number' => $this->input->post('txt_user_phone_number'),
            'mobile_number' => '',
            'post_number' => '',
            'job_title' => $this->input->post('sel_user_job_title'),
            'support_number' => $this->input->post('txt_user_support_number'),
            'note' => $this->input->post('txt_user_note'),
            'sort_id' => $this->input->post('txt_user_sort_id'),
            'login_id' => $this->input->post('txt_user_login_id'),
            'role' => $this->input->post('rd_user_role'),
            'employment' => $this->input->post('rd_user_employment'),
            'office_id' => $this->input->post('sel_user_office_id'),
            'created' => date('Y-m-d H:i:s'));

        $input_flag = $this->input->post('hdn_input_flag');

        if($input_flag == 0){
            if($this->input->post('chk_password_change')){
                $data['password'] = sha1($this->config->item('encryption_key') . $this->input->post('txt_user_password'));
            }
            $user_id = $this->user_model->updateUser($data, $this->input->post('txt_user_id'));
        }else if($input_flag == 1){
            //login id check
            $this->load->model('settings_model');
            $app_manager = $this->settings_model->getSettings('admin');
            $login_id = $this->input->post('txt_user_login_id');
            if($login_id == $app_manager['manager_id']){
                $result = array('status'=>'3', 'input_id'=>0, 'input_flag'=>$input_flag);
                exit(json_encode($result));
            }
            if($this->user_model->userCheckByName($login_id)){
                $result = array('status'=>'4', 'input_id'=>0, 'input_flag'=>$input_flag);
                exit(json_encode($result));
            }else{
                $data['password'] = sha1($this->config->item('encryption_key') . $this->input->post('txt_user_password'));
                $user_id = $this->user_model->addUser($data);
            }
            
        }

        
        
        if($user_id){
            $result  = array('status'=>'1', 'input_id'=>$user_id, 'input_flag'=>$input_flag);
        }else{
            $result  = array('status'=>'2', 'input_id'=>$user_id, 'input_flag'=>$input_flag);
        }
        exit(json_encode($result));
    }

    public function udelete(){
        $user_id = $this->input->post('user_id');
        exit($this->user_model->deleteUser($user_id));
    }
    public function ulist()
    {
        $role = $this->session->userdata('role');
        $manager_id = $this->session->userdata('user_id');
        $data = array();

        $history_flag = $this->input->post('hdn_history_flag');

        $keyword = !is_null($this->input->post('txt_user_search_keyword'))?$this->input->post('txt_user_search_keyword'):"";
        $employment_id = ($this->input->post('sel_user_search_employment') != "")?$this->input->post('sel_user_search_employment'):99;
        $job_id = ($this->input->post('sel_user_search_job')  != "")?$this->input->post('sel_user_search_job'):99;
        $office_id = ($this->input->post('sel_user_search_office') != "")?$this->input->post('sel_user_search_office'):99;
        $kana = ($this->input->post('hdn_user_search_kana_id') != "")?$this->input->post('hdn_user_search_kana_id'):0;

        $cur_page = ($this->input->post('hdn_user_cur_page') != "")?$this->input->post('hdn_user_cur_page'):1;
        $start = ($cur_page-1)*ITEMS_PER_PAGE;
        $user_data = $this->user_model->getUserById($manager_id);
        if($role == 2){
            $user_list_orgin = $this->user_model->getUserList($user_data[0]['office_id'], $manager_id, $keyword, $employment_id, $job_id, $office_id, $kana, ITEMS_PER_PAGE, $start);
        }else if($role == 3){
            $user_list_orgin = $this->user_model->getUserList(0,0, $keyword, $employment_id, $job_id, $office_id, $kana, ITEMS_PER_PAGE, $start);
        }
        $user_list = $user_list_orgin[1];
        $user_list_total_count = $user_list_orgin[0];



        $data = array();
        if($history_flag == 1){
            $history_list = $this->user_model->getUserViewHistory($manager_id);
            $data['history_list'] = $history_list;
        }
        $offices = $this->user_model->get('offices');
        $data['offices'] = $offices;

        $data['user_list'] = $user_list;
        $data['keyword'] = $keyword;
        $data['employment'] = $employment_id;
        $data['job'] = $job_id;
        $data['office'] = $office_id;
        $data['kana'] = $kana;
        $data['cur_page'] = $cur_page;
        $data['total_count'] = $user_list_total_count;
        $data['page_count'] = ceil($user_list_total_count/ITEMS_PER_PAGE);

        $data['history_flag'] = $history_flag;

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'muser/ulist', $data)
            ->render('layouts/manager');
    
    }


    
}

/* End of file muser.php */
/* Location: ./application/controllers/muser.php */
