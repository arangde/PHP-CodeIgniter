<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Person Useslip Controller
 * Created by: kgh
 * Date: 07/10/2016
 *
 */
class Puseslip extends CI_Controller
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
        $this->load->model('useslip_model');
    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'phome/index', $data)
            ->render('layouts/person');
    }

    public function usedit()
    {
        $this->load->model('user_model');
        $manager_id = $this->session->userdata('user_id');
        $manager = $this->user_model->getUserById($manager_id);

        // get action flag
        $useslip_edit_manage_flag = !empty($this->input->post('hdn_useslip_edit_manage_flag'))?$this->input->post('hdn_useslip_edit_manage_flag'):0;
        // get global contract id
        $contract_id = isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:0;
        //set useslip year & month
        $useslip_year = !empty($this->input->post('hdn_useslip_year'))?$this->input->post('hdn_useslip_year'):date('Y');
        $useslip_month = !empty($this->input->post('sel_useslip_month'))?$this->input->post('sel_useslip_month'):date('m');
        $useslip_current_weeks = !empty($this->input->post('sel_useslip_current_weeks'))?$this->input->post('sel_useslip_current_weeks'):1;

        // get service code list
        $userslip_service_code_list = $this->useslip_model->getSeviceCodeList($contract_id, $useslip_year, $useslip_month);

        // get office list
        $office_list = $this->useslip_model->get('offices');

        // count of week any month year
        $useslip_weeks =  $this->getCountofWeekByMonth($useslip_year, $useslip_month);
        // get days in current week
        $useslip_days_current_week = $this->getDatesofWeek($useslip_year, $useslip_month, $useslip_current_weeks);

        // get useslip result data by year, month and week
        $str_us_dates = "";
        foreach($useslip_days_current_week as $uw){
            $str_us_dates .= $uw.",";
        }
        $str_us_dates = substr($str_us_dates, 0, -1);
        // get useslip data list
        $useslip_list = $this->useslip_model->getMonthlyUserslipListByContractId($contract_id, $useslip_year, $useslip_month, $useslip_current_weeks-1);
        foreach ($useslip_list as $key => $useslip_data) {
            $monthly_schedule_count = 0;
            $ur_contract_id = $useslip_data['us_contract_id'];
            $ur_year = $useslip_data['us_year'];
            $ur_month = $useslip_data['us_month'];
            $ur_service_id = $useslip_data['us_provide_service_code'];
            $usr_weekly_list = $this->useslip_model->getUsResultbyYMW($ur_contract_id, $ur_service_id, $ur_year, $ur_month, $str_us_dates);
            //print_r($usr_weekly_list);
            foreach ($usr_weekly_list as $key2 => $usrwl) {
                $monthly_schedule_count++;
                $useslip_list[$key]['usr'][$usrwl['ur_week']][$usrwl['ur_date']] = $usrwl;
            }
            $useslip_list[$key]['monthly_schedule_count'] = $monthly_schedule_count;
            $useslip_list[$key]['monthly_schedule_total_unit'] = $monthly_schedule_count*$useslip_data['us_provide_schedule_unit'];
        }
        /* get copy month and year*/
        $cur_month_first_day = mktime(0, 0, 0, $useslip_month, 1, $useslip_year);
        $next_month_year =  date("Y", strtotime('+1 month', $cur_month_first_day));
        $next_month_month =  date("n", strtotime('+1 month', $cur_month_first_day));
        /* get and set useslip data */
        $useslip_temp = array('chk_useslip_select_all_week' => 0,
            'us_office_id' => 1,
            'us_provide_from_time' => '',
            'us_provide_to_time' =>  '',
            'us_provide_service_code' => '',
            'us_provide_schedule_unit' => '',
            'us_provide_consumtion_tax' => 0,
            'chkweek' => array('99')
        );
        /*check certlist*/
        $chk_useslip_list = array();
        if(!empty($this->input->post('chk_uselip_data_item'))){
            foreach($this->input->post('chk_uselip_data_item') as $chk){
                $chk_useslip_list[] = $chk;
            }
        }
        //0: add 1: update 2: copy 3: delete
        $checked = 0;
        $useslip_info = $useslip_temp;
        switch ($useslip_edit_manage_flag) {
            case '0':
                $useslip_info = $useslip_temp;
                break;
            case '1':
                $useslip_temp = $this->useslip_model->getUseslipById($chk_useslip_list[0]);
                $chkweek = explode(',', $useslip_temp[0]['us_provide_day_of_week']);
                $useslip_temp[0]['chkweek'] = $chkweek;
                $useslip_info = $useslip_temp[0];
                $checked = $chk_useslip_list[0];
                break;
            case '2':
                $useslip_temp = $this->useslip_model->getUseslipById($chk_useslip_list[0]);
                $chkweek = explode(',', $useslip_temp[0]['us_provide_day_of_week']);
                $useslip_temp[0]['chkweek'] = $chkweek;
                $useslip_info = $useslip_temp[0];
                $checked = $chk_useslip_list[0];
            case '3':
                $checked = 0;
                break;
        }
        $data = array();
        $data['userslip_service_code_list'] = $userslip_service_code_list;
        $data['useslip_list'] = $useslip_list;
        $data['office_id'] = $manager[0]['office_id'];
        $data['office_name'] = $manager[0]['office_name'];
        $data['contract_id'] = $contract_id;
        $data['useslip_year'] = $useslip_year;
        $data['useslip_month'] = $useslip_month;
        $data['useslip_weeks'] = $useslip_weeks;
        $data['useslip_current_weeks'] = $useslip_current_weeks;
        $data['useslip_days_current_week'] = $useslip_days_current_week;
        $data['useslip_info'] = $useslip_info;
        $data['checked'] = $checked;
        $data['useslip_edit_manage_flag'] = $useslip_edit_manage_flag;
        $data['next_month_year'] = $next_month_year;
        $data['next_month_month'] = $next_month_month;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'useslip')
            ->partial('main_content', 'puseslip/usedit', $data)
            ->render('layouts/person');
    
    }

    public function usedit_accept(){
        //0: add 1: update 2: copy 3: delete
        $useslip_edit_manage_flag = !empty($this->input->post('hdn_useslip_edit_manage_flag'))?$this->input->post('hdn_useslip_edit_manage_flag'):0;
        // get selected useslip id(default:0)
        $useslip_selected_id = !empty($this->input->post('hdn_useslip_selected_id'))?$this->input->post('hdn_useslip_selected_id'):0;
        /*check certlist*/
        $chk_userslip_checked_days = "";
        $days = array();
        if(!empty($this->input->post('chk_useslip_select_week'))){
            foreach($this->input->post('chk_useslip_select_week') as $chk){
                $chk_userslip_checked_days .= $chk.",";
                $datas = $this->getDaysByDayofweek($this->input->post('hdn_useslip_year'), $this->input->post('sel_useslip_month'), $chk);
                foreach($datas as $key=>$data){
                    if($data > 0)
                        $days[] = array($key, $data);
                }
            }
        }
        $manager_id = $this->session->userdata('user_id');
        $contract_id = isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:0;
        $ur_year = $this->input->post('hdn_useslip_year');
        $ur_month = $this->input->post('sel_useslip_month');
        $ur_service_code = $this->input->post('txt_useslip_service_code');
        $us_provide_schedule_unit = $this->input->post('txt_useslip_service_unit');
        $data = array(
            'us_contract_id' => $this->input->post('hdn_useslip_contract_id'),
            'us_year' => $ur_year,
            'us_month' => $ur_month,
            'us_provide_service_code' =>  $this->input->post('txt_useslip_service_code'),
            'us_office_id' => $this->input->post('sel_useslip_office_id'),
            'us_provide_day_of_week' => substr($chk_userslip_checked_days, 0, -1),
            'us_provide_from_time' => $this->input->post('txt_useslip_from_provide_time'),
            'us_provide_to_time' => $this->input->post('txt_useslip_to_provide_time'),
            'us_provide_consumtion_tax' => $this->input->post('txt_useslip_consumption_tax'),
            'us_provide_daily_times' => 1,
            'us_provide_schedule_unit' => $us_provide_schedule_unit,
            'us_provide_result_unit' => 0,
            'created' => date('Y-m-d H:i:s')
        );
        /*check certlist*/
        $chk_useslip_list = array();
        if(!empty($this->input->post('chk_uselip_data_item'))){
            foreach($this->input->post('chk_uselip_data_item') as $chk){
                $chk_useslip_list[] = $chk;
            }
        }
        $return_value = 0;
        switch ($useslip_edit_manage_flag) {
            case '0':
                //$this->useslip_model->checkUserslips($contract_id, $service_id, $date);
                $this->useslip_model->deleteUseslipByServiceCode($contract_id, $ur_service_code, $ur_year, $ur_month);
            
                $userslips_id = $this->useslip_model->addUseslip($data);
                $this->useslip_model->deleteUseslipResult($contract_id, $ur_service_code, $ur_year, $ur_month);
                foreach($days as $key=>$day){
                    $result = array(
                            'ur_us_id' => $userslips_id,
                            'ur_contract_id' => $contract_id,
                            'ur_service_id' => $ur_service_code,
                            'ur_year' => $ur_year,
                            'ur_month' => $ur_month,
                            'ur_date' => $day[1],
                            'ur_week' => $day[0],
                            'ur_times' => 1,
                            'ur_schedule_unit' => $us_provide_schedule_unit,
                            'ur_result_unit' => 0,
                            'ur_manager_id' => $manager_id,
                            'created' => date('Y-m-d H:i:s')
                        );
                    $this->useslip_model->addUseslipResult($result);
                }
                $return_value = '0';
                break;
            case '1':
                $userslips_id = $this->useslip_model->updateUseslip($chk_useslip_list[0], $data);
                //$this->useslip_model->deleteUseslipByServiceCode($contract_id, $ur_service_code, $ur_year, $ur_month);
            
                //$userslips_id = $this->useslip_model->addUseslip($data);
                $this->useslip_model->deleteUseslipResult($contract_id, $ur_service_code, $ur_year, $ur_month);
                foreach($days as $key=>$day){
                    $result = array(
                            'ur_us_id' => $userslips_id,
                            'ur_contract_id' => $contract_id,
                            'ur_service_id' => $ur_service_code,
                            'ur_year' => $ur_year,
                            'ur_month' => $ur_month,
                            'ur_date' => $day[1],
                            'ur_week' => $day[0],
                            'ur_times' => 1,
                            'ur_schedule_unit' => $us_provide_schedule_unit,
                            'ur_result_unit' => 0,
                            'ur_manager_id' => $manager_id,
                            'created' => date('Y-m-d H:i:s')
                        );
                    $this->useslip_model->addUseslipResult($result);
                }
                $return_value = '1';
                break;
            case '2':
                $userslips_id = $this->useslip_model->copyUseslip($data);
                $return_value = '2';
                break;
            default:
                break;
        }
        exit($return_value);
    }
    public function uscreate()
    {
        // get global contract id
        $contract_id = isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:0;
        $useslip_year = !empty($this->input->post('hdn_useslip_year'))?$this->input->post('hdn_useslip_year'):date('Y');
        $useslip_month = !empty($this->input->post('sel_useslip_month'))?$this->input->post('sel_useslip_month'):date('m');

        $last_day = cal_days_in_month(CAL_GREGORIAN, $useslip_month, $useslip_year);

        // get useslip data list
        $useslip_list = $this->useslip_model->getMonthlyUserslipListByContractId($contract_id, $useslip_year, $useslip_month, "");
        foreach ($useslip_list as $key => $useslip_data) {
            $monthly_schedule_count = 0;
            $monthly_result_count = 0;
            $monthly_result_total_unit = 0;
            $ur_contract_id = $useslip_data['us_contract_id'];
            $ur_year = $useslip_data['us_year'];
            $ur_month = $useslip_data['us_month'];
            $ur_service_id = $useslip_data['us_provide_service_code'];
            $usr_weekly_list = $this->useslip_model->getUsResultbyYMW($ur_contract_id, $ur_service_id, $ur_year, $ur_month, "");
            //print_r($usr_weekly_list);
            foreach ($usr_weekly_list as $key2 => $usrwl) {
                $monthly_schedule_count++;
                if($usrwl['ur_result_unit'] != 0){
                    $monthly_result_count++;
                    $monthly_result_total_unit += $usrwl['ur_result_unit'];
                }
                $useslip_list[$key]['usr'][$usrwl['ur_date']] = $usrwl;
            }
            $useslip_list[$key]['monthly_schedule_count'] = $monthly_schedule_count;
            $useslip_list[$key]['monthly_schedule_total_unit'] = $monthly_schedule_count*$useslip_data['us_provide_schedule_unit'];
            $useslip_list[$key]['monthly_result_count'] = $monthly_result_count;
            $useslip_list[$key]['monthly_result_total_unit'] = $monthly_result_total_unit;
        }

        $data = array();
        $data['contract_id'] = $contract_id;
        $data['useslip_year'] = $useslip_year;
        $data['useslip_month'] = $useslip_month;

        $data['useslip_list'] = $useslip_list;
        $data['last_day'] = $last_day;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'useslip')
            ->partial('main_content', 'puseslip/uscreate', $data)
            ->render('layouts/person');
    
    }
    public function uscreate_accept(){
        $useslip_year = $this->input->post('hdn_modal_useslip_year');
        $useslip_month = $this->input->post('hdn_modal_useslip_month');
        $us_create_id = $this->input->post('hdn_modal_us_id');

        $last_day = cal_days_in_month(CAL_GREGORIAN, $useslip_month, $useslip_year);
        for($i=1; $i<=$last_day; $i++){
            $ur_value = !empty($this->input->post('txt_ur_'.$i))?$this->input->post('txt_ur_'.$i):0;
            $ur_update_array = array('ur_result_unit'=>$ur_value);
            $this->useslip_model->updateUseslipResult($ur_update_array, $us_create_id, $i);
        }
        exit('1');
    }
    public function uscreate_get_monthly_data_by_usid(){
        $useslip_year = $this->input->post('useslip_year');
        $useslip_month = $this->input->post('useslip_month');

        $us_create_id = $this->input->post('us_create_id');
        $last_day = cal_days_in_month(CAL_GREGORIAN, $useslip_month, $useslip_year);

        
        $user_data = array();
        for($i=1; $i<=$last_day; $i++){
            $user_data[] = array('day'=>$i, 'data'=>$this->useslip_model->getUsResultbyUsidAndDay($us_create_id, $i));
        }

        exit(json_encode($user_data));
    }
    public function usdelete(){
        $manager_id = $this->session->userdata('user_id');
        /*check certlist*/
        $chk_useslip_list = array();
        if(!empty($this->input->post('chk_uselip_data_item'))){
            foreach($this->input->post('chk_uselip_data_item') as $chk){
                $chk_useslip_list[] = $chk;
            }
        }else{
            exit('2');
        }
        $useslip_copy_month = $this->input->post('sel_useslip_copy_month');
        $explode_useslip_copy_month = explode(':', $useslip_copy_month);
        foreach ($chk_useslip_list as $key => $chk) {

            $useslip_data = $this->useslip_model->getUseslipById($chk);

            $contract_id = $useslip_data[0]['us_contract_id'];
            $ur_service_code = $useslip_data[0]['us_provide_service_code'];
            $ur_year = $useslip_data[0]['us_year'];
            $ur_month = $useslip_data[0]['us_month'];
            $us_provide_schedule_unit = $useslip_data[0]['us_provide_schedule_unit'];

            $this->useslip_model->deleteUseslipByServiceCode($contract_id, $ur_service_code, $ur_year, $ur_month);
            
            $this->useslip_model->deleteUseslipResult($contract_id, $ur_service_code, $ur_year, $ur_month);
        }         
        exit('1');
    }
    public function uscopy(){
        $manager_id = $this->session->userdata('user_id');
        /*check certlist*/
        $chk_useslip_list = array();
        if(!empty($this->input->post('chk_uselip_data_item'))){
            foreach($this->input->post('chk_uselip_data_item') as $chk){
                $chk_useslip_list[] = $chk;
            }
        }else{
            exit('2');
        }
        $useslip_copy_month = $this->input->post('sel_useslip_copy_month');
        $explode_useslip_copy_month = explode(':', $useslip_copy_month);
        foreach ($chk_useslip_list as $key => $chk) {

            $useslip_data = $this->useslip_model->getUseslipById($chk);
            unset($useslip_data[0]['useslip_id']);

            $contract_id = $useslip_data[0]['us_contract_id'];
            $ur_service_code = $useslip_data[0]['us_provide_service_code'];
            $ur_year = $explode_useslip_copy_month[0];
            $ur_month = $explode_useslip_copy_month[1];
            $us_provide_schedule_unit = $useslip_data[0]['us_provide_schedule_unit'];

            $useslip_data[0]['us_year'] = $ur_year;
            $useslip_data[0]['us_month'] = $ur_month;

            $this->useslip_model->deleteUseslipByServiceCode($contract_id, $ur_service_code, $ur_year, $ur_month);
            $userslips_id = $this->useslip_model->addUseslip($useslip_data[0]);

            $days = array();
            $weeks = explode(',', $useslip_data[0]['us_provide_day_of_week']);

            foreach($weeks as $chk1){
                $chk_userslip_checked_days .= $chk1.",";
                $datas = $this->getDaysByDayofweek($ur_year, $ur_month, $chk1);
                foreach($datas as $key=>$data){
                    if($data > 0)
                        $days[] = array($key, $data);
                }
            }
            
            $this->useslip_model->deleteUseslipResult($contract_id, $ur_service_code, $ur_year, $ur_month);
            foreach($days as $key=>$day){
                $result = array(
                        'ur_us_id' => $userslips_id,
                        'ur_contract_id' => $contract_id,
                        'ur_service_id' => $ur_service_code,
                        'ur_year' => $ur_year,
                        'ur_month' => $ur_month,
                        'ur_date' => $day[1],
                        'ur_week' => $day[0],
                        'ur_times' => 1,
                        'ur_schedule_unit' => $us_provide_schedule_unit,
                        'ur_result_unit' => 0,
                        'ur_manager_id' => $manager_id,
                        'created' => date('Y-m-d H:i:s')
                    );
                $this->useslip_model->addUseslipResult($result);
            }

        }         
        exit('1');
    }
    function getDaysByDayofweek($y, $m, $dayofweek){ 
        $date = "$y-$m-01";
        $first_day = date('N',strtotime($date));
        $first_day =  - $first_day + 1 + $dayofweek;
        $last_day =  date('t',strtotime($date));
        $days = array();
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
           // if($i > 0){
                $days[] = $i;
           // }
        }
        return  $days;
    }

    function getCountofWeekByMonth($y, $m){
        $days = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $week_day = date("N", mktime(0,0,0,$m,1,$y));
        $weeks = ceil(($days + $week_day) / 7);
        return $weeks;
    }
    
    function getDatesofWeek($y, $m, $numberofweek){
        $date = "$y-$m-01";
        $first_day = date('N',strtotime($date));
        $first_day =   - $first_day + 1;
        $last_day =  date('t',strtotime($date));
        $firsdayofweek = array();
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
                $firsdayofweek[] = $i;
        }
        $days = array();
        for($j=$firsdayofweek[$numberofweek-1];$j<$firsdayofweek[$numberofweek-1]+7;$j++){
            if($j>0 && $j <= $last_day){
                $days[] = $j;
            }else{
                $days[] = 0;
            }
        }
        return  $days;
    }
}

/* End of file useslip.php */
/* Location: ./application/controllers/useslip.php */
