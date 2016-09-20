<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Insurance Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Ainsurance extends CI_Controller
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
        $this->load->model('insurance_model');

    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'ainsurance/index', $data)
            ->render('layouts/default');
    }

    public function iedit()
    {
        $insurer_last_id=$this->insurance_model->getInsurerLastId();

        $insurer_id = ($this->input->get('mem')!='')?$this->input->get('mem'):($insurer_last_id + 1);
        $input_flag = 0;

        $data = array();
        $insure_temp = array(
            'insurer_id' => $insurer_id,
            'insurer_name' => '',
            'sort_id' => 0);

        if($this->input->get('mem') == ""){
            $data['insurer_data'] = $insure_temp;
            $input_flag = 1;

        }else{
            $insurer = $this->insurance_model->getInsurerById($insurer_id);
            $input_flag = 0;
            if(count($insurer) == 0){
                $data['insurer_data'] = $insure_temp; // forward modify
            }else{
                $data['insurer_data'] = $insurer[0];
            }

        }
        
        $data['input_flag'] = $input_flag;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'admin')
            ->partial('main_content', 'ainsurance/iedit', $data)
            ->render('layouts/default');
    }

    public function iedit_accept()
    {
        //register insurer
        $data = array('insurer_name' => $this->input->post('txt_insurer_name'),
            'sort_id' => $this->input->post('txt_sort_id'));

        $input_flag = $this->input->post('hdn_input_flag');

        if($input_flag == 0){
            $insurer_id = $this->insurance_model->updateInsurer($data, $this->input->post('txt_insurer_id'));
        }else if($input_flag == 1){
            $insurer_id = $this->insurance_model->addInsurer($data);
        }

        
        
        if($insurer_id){
            $result  = array('status'=>'1', 'input_id'=>$insurer_id, 'input_flag'=>$input_flag);
        }else{
            $result  = array('status'=>'2', 'input_id'=>$insurer_id, 'input_flag'=>$input_flag);
        }
        exit(json_encode($result));
    }

    public function ilist()
    {
        $data = array();

        $history_flag = $this->input->post('hdn_history_flag');

        $keyword = !is_null($this->input->post('txt_user_search_keyword'))?$this->input->post('txt_user_search_keyword'):"";

        $cur_page = ($this->input->post('hdn_user_cur_page') != "")?$this->input->post('hdn_user_cur_page'):1;
        $start = ($cur_page-1)*ITEMS_PER_PAGE;
        
        $user_list_orgin = $this->insurance_model->getInsurerList($keyword, ITEMS_PER_PAGE, $start);
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
            ->partial('main_content', 'ainsurance/ilist', $data)
            ->render('layouts/default');
    }

    public function idelete(){
        $insurer_id = $this->input->post('insurer_id');
        exit($this->insurance_model->deleteInsurer($insurer_id));
    }
}

/* End of file ainsurance.php */
/* Location: ./application/controllers/ainsurance.php */
