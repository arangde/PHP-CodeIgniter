<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Person Certinfo Controller
 * Created by: arangde
 * Date: 07/10/2016
 *
 */
class Pcertinfo extends CI_Controller
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
        $this->load->model('certinfo_model');
    }

    public function index()
    {
        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'pcertinfo/index', $data)
            ->render('layouts/person');
    }

    public function manage()
    {
        $this->load->model('user_model');
        $manager_id = $this->session->userdata('user_id');
        $manager = $this->user_model->getUserById($manager_id);

        $certinfo_manage_flag = !empty($this->input->post('hdn_certinfo_manage_flag'))?$this->input->post('hdn_certinfo_manage_flag'):0;
        /* get contract cert info */
        $contract_id = isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:0;
        if($contract_id !== 0){
            $certinfolist = $this->certinfo_model->getCertinfoByContractId($contract_id);
        }else{
            $certinfolist = array();
        }
        /*check certlist*/
        $chk_certinfo_list = array();
        if(!empty($this->input->post('chk_certinfo_list'))){
            foreach($this->input->post('chk_certinfo_list') as $chk){
                $chk_certinfo_list[] = $chk;
            }
        }
        
        /* get and set  cert info */
        $certinfo_temp = array('contract_id' => $contract_id,
            'insurer_id' => 1,
            'benefit_rate' => '',
            'insurance_from_validate_date' =>  '',
            'insurance_to_validate_date' => '',
            'cert_certification_state' => 0,
            'cert_protect_degree' => 0,
            'cert_certification_date' => '',
            'cert_from_validate_date' => '',
            'cert_to_validate_date' => '',
            'cert_office_id' => 1,
            'cert_notification_date' => '',
            'cert_service_apply_period' => '',
            'cert_classification_max_payment' => '',
            'cert_type_max_payment_visit_care' => '',
            'cert_type_max_payment_bathing_care' => '',
            'cert_type_max_payment_visit_nurse' => '',
            'cert_type_max_payment_rehab' => '',
            'cert_type_max_payment_day_care' => '',
            'cert_type_max_payment_ambulatory' => '',
            'cert_type_max_payment_short_term_life' => '',
            'cert_type_max_payment_medical' => '',
            'cert_type_max_payment_loan' => '',
            'cert_type_max_payment_nighttime' => '',
            'cert_type_max_payment_dementia' => '',
            'cert_type_max_payment_dementia_short' => '',
            'cert_type_max_payment_community' => '',
            'cert_consideration' => ''
        );
        $cert_info = array();
        $checked = 0;
        switch ($certinfo_manage_flag) {
            case '0':
                $cert_info = $certinfo_temp;
                break;
            case '1':
                $temp = $this->certinfo_model->getCertinfoByCertinfoId($chk_certinfo_list[0]);
                $cert_info = $temp[0];
                $checked = $chk_certinfo_list[0];
                break;
            case '2':
                $temp = $this->certinfo_model->getCertinfoByCertinfoId($chk_certinfo_list[0]);
                $cert_info = $temp[0];
                $checked = $chk_certinfo_list[0];
            case '3':
                $checked = 0;
                break;
        }
        /* get insurance data */
        $this->load->model('insurance_model');
        $insurance_data = $this->insurance_model->getAllInsurers();
        
        /* get office */
        $this->load->model('office_model');
        $office_data = $this->certinfo_model->get('offices');

        $data = array();
        $data['certinfolist'] = $certinfolist;
        $data['certinfo_contract_id'] = $contract_id;
        $data['insurance_data'] = $insurance_data;
        $data['office_id'] = $manager[0]['office_id'];
        $data['office_name'] = $manager[0]['office_name'];
        $data['certinfo_manage_flag'] = $certinfo_manage_flag;
        $data['cert_info'] = $cert_info;
        $data['checked'] = $checked;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->set('active_menu', 'certinfo')
            ->partial('main_content', 'pcertinfo/manage', $data)
            ->render('layouts/person');
    }

    public function manage_accept(){
        $contract_id = isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:0;
        $data = array(
            'contract_id' => $contract_id,
            'insurer_id' => $this->input->post('sel_certinfo_insurance_id'),
            'benefit_rate' => $this->input->post('txt_certinfo_benefit_rate'),
            'insurance_from_validate_date' =>  date_format(date_create($this->input->post('txt_certinfo_insurance_from_validate_date')), "Y-m-d"),
            'insurance_to_validate_date' => date_format(date_create($this->input->post('txt_certinfo_insurance_to_validate_date')), "Y-m-d"),
            'cert_certification_state' => $this->input->post('sel_certinfo_certification_state'),
            'cert_protect_degree' => $this->input->post('sel_certinfo_protect_degree'),
            'cert_certification_date' => date_format(date_create($this->input->post('txt_certinfo_certification_date')), "Y-m-d"),
            'cert_from_validate_date' => date_format(date_create($this->input->post('txt_certinfo_from_validate_date')), "Y-m-d"),
            'cert_to_validate_date' => date_format(date_create($this->input->post('txt_certinfo_to_validate_date')), "Y-m-d"),
            'cert_office_id' => $this->input->post('sel_certinfo_office_id'),
            'cert_notification_date' => date_format(date_create($this->input->post('txt_certinfo_notification_date')), "Y-m-d"),
            'cert_service_apply_period' => date_format(date_create($this->input->post('txt_certinfo_service_apply_period')), "Y-m-d"),
            'cert_classification_max_payment' => $this->input->post('txt_certinfo_classification_max_payment'),
            'cert_type_max_payment_visit_care' => $this->input->post('txt_cert_type_max_payment_visit_care'),
            'cert_type_max_payment_bathing_care' => $this->input->post('txt_cert_type_max_payment_bathing_care'),
            'cert_type_max_payment_visit_nurse' => $this->input->post('txt_cert_type_max_payment_visit_nurse'),
            'cert_type_max_payment_rehab' => $this->input->post('txt_cert_type_max_payment_rehab'),
            'cert_type_max_payment_day_care' => $this->input->post('txt_cert_type_max_payment_day_care'),
            'cert_type_max_payment_ambulatory' => $this->input->post('cert_type_max_payment_ambulatory'),
            'cert_type_max_payment_short_term_life' => $this->input->post('txt_cert_type_max_payment_short_term_life'),
            'cert_type_max_payment_medical' => $this->input->post('txt_cert_type_max_payment_medical'),
            'cert_type_max_payment_loan' => $this->input->post('txt_cert_type_max_payment_loan'),
            'cert_type_max_payment_nighttime' => $this->input->post('txt_cert_type_max_payment_nighttime'),
            'cert_type_max_payment_dementia' => $this->input->post('txt_cert_type_max_payment_dementia'),
            'cert_type_max_payment_dementia_short' => $this->input->post('txt_cert_type_max_payment_dementia_short'),
            'cert_type_max_payment_community' => $this->input->post('txt_cert_type_max_payment_community'),
            'cert_consideration' => $this->input->post('txt_cert_consideration'),
            'created' => date('Y-m-d H:i:s')
        );
        //0: add 1: modify 2: update 3: delete
        $manage_flag = $this->input->post('hdn_certinfo_manage_flag');
        /*check certlist*/
        $chk_certinfo_list = array();
        if(!empty($this->input->post('chk_certinfo_list'))){
            foreach($this->input->post('chk_certinfo_list') as $chk){
                $chk_certinfo_list[] = $chk;
            }
        }
        $return_value = 0;
        switch ($manage_flag) {
            case '0':
                $certinfo_id = $this->certinfo_model->addCertinfo($data);
                $return_value = '0';
                break;
            case '1':
                $certinfo_id = $this->certinfo_model->modifyCertinfo($chk_certinfo_list[0], $data);
                $return_value = '1';
                break;
            case '2':
                $certinfo_id = $this->certinfo_model->addCertinfo($data);
                $return_value = '2';
                break;
            default:
                break;
        }
        exit($return_value);
    }
    public function certdelete(){
        $chk_certinfo_list = '';
        if(!empty($this->input->post('chk_certinfo_list'))){
            foreach($this->input->post('chk_certinfo_list') as $chk){
                $chk_certinfo_list .= $chk.',';
            }
        }
        $this->certinfo_model->deleteCertinfo(substr($chk_certinfo_list, 0, -1));
        exit('1');
    }
}

/* End of file pcertinfo.php */
/* Location: ./application/controllers/pcertinfo.php */
