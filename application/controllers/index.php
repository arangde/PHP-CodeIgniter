<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Index Controller
 * Created by: arangde
 * Date: 07/07/2016
 *
 */
class Index extends CI_Controller
{
    protected $logged;

    public function __construct()
    {
        parent::__construct();
        //$this->load->dbutil();
        $this->load->library('yall');
        $this->load->model('settings_model');
        $this->session->set_userdata($this->settings_model->getSettings('system'));

        $this->load->model('user_model');

        $logged = $this->session->userdata('loggedin');
        if (empty($logged)) {
            $this->logged = 0;
        }
        else {
            $this->logged = 1;
        }
    }

    public function index()
    {
    	if($this->logged == 0){
            redirect('/index/login', 'refresh');
        }else{

        }
    }

    public function login()
    {
        $app_manager = $this->settings_model->getSettings('admin');
        $add_flag = 0;
        if($app_manager['manager_email'] == ""){
            $add_flag = 1;
        }
        $data = array();
        $data['add_flag'] = $add_flag;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'index/login', $data)
            ->render('layouts/login');
    
    }
    
    /* go to the home.php while login success*/
    public function login_accept()
    {

        $username = $this->input->post('user_id');
        $password = $this->input->post('password');

        //app manager certification
        $app_manager = $this->settings_model->getSettings('admin');
        if($app_manager["manager_id"] == $username && $app_manager["manager_password"] == sha1($this->config->item('encryption_key') . $password)){
            $this->session->set_userdata('loggedin', 1);
            $this->session->set_userdata('user_id', '999999999');
            $this->session->set_userdata('user_name', $app_manager["manager_name"]);
            $this->session->set_userdata('login_id', $app_manager['manager_id']);
            $this->session->set_userdata('furigana', $app_manager["manager_name"]);
            $this->session->set_userdata('user_email', $app_manager["manager_email"]);
            $this->session->set_userdata('role', 3);
            exit('1');
        }
        //
        $result = $this->user_model->userCheck($username, sha1($this->config->item('encryption_key') . $password));

        if($result == FALSE) {
            exit('4');
        } else {
            $this->session->set_userdata('loggedin', 1);
            $this->session->set_userdata('user_id', $result['user_id']);
            $this->session->set_userdata('user_name', $result['username']);
            $this->session->set_userdata('login_id', $result['login_id']);
            $this->session->set_userdata('furigana', $result['furigana']);
            $this->session->set_userdata('user_email', $result['user_email']);
            $this->session->set_userdata('role', $result['role']);
            if($result['role'] ==2){
                exit('2');
            }else if($result['role'] ==1){
                exit('3');
            }
        }
    }

    public function signup(){
        $app_manager = $this->settings_model->getSettings('admin');
        $add_flag = 0;
        if($app_manager['manager_email'] == ""){
            $add_flag = 1;
        }
        $data = array();
        $data['add_flag'] = $add_flag;
        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'index/signup', $data)
            ->render('layouts/login');
    }
    public function signup_accept(){
        $app_manager = $this->settings_model->getSettings('admin');
        if($app_manager['manager_email'] == ""){
            $data = array(
                array('option_key'=>'manager_email', 'option_value'=>$this->input->post('emailaddress'), 'module'=>'admin'),
                array('option_key'=>'company_name', 'option_value'=>$this->input->post('username'), 'module'=>'admin'),
                array('option_key'=>'manager_id', 'option_value'=>$this->input->post('accountid'), 'module'=>'admin'),
                array('option_key'=>'manager_name', 'option_value'=>$this->input->post('managername'), 'module'=>'admin'),
                array('option_key'=>'address', 'option_value'=>$this->input->post('livingaddress'), 'module'=>'admin'),
                array('option_key'=>'phone_number', 'option_value'=>$this->input->post('telnumber'), 'module'=>'admin'),
                array('option_key'=>'post_number', 'option_value'=>$this->input->post('postnumber'), 'module'=>'admin'),
                array('option_key'=>'manager_password', 'option_value'=>sha1($this->config->item('encryption_key') . $this->input->post('accountpw')), 'module'=>'admin'));
            
            $flag = $this->settings_model->saveSettings($data);
            if(!$this->sendRegisterMail($app_manager)){
                exit('2');
            }
            exit('3');
        }else{
            exit('5');
        }


    }
    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('login_id');
        $this->session->unset_userdata('furigana');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('role');
        
    	$this->session->sess_destroy();
    	$this->load->driver('cache');
    	$this->cache->clean();
    	redirect('/index/login', 'refresh');
    }
    public function forgot(){

        $data = array();

        $this->yall
            ->set('title', $this->session->userdata('system_title'))
            ->set('description', $this->session->userdata('description'))
            ->set('author', $this->session->userdata('author'))
            ->partial('main_content', 'index/forgot', $data)
            ->render('layouts/login');
    }
    public function forgot_accept()
    {
        $data = array(
            'txt_email' => $this->input->post('txt_email'),
        );
        $app_manager = $this->settings_model->getSettings('admin');
        //$user = $this->user_model->getUserByEmail($data['forgot_email']);
        if($app_manager['manager_email'] != $data['txt_email']) {
            $data['message'] = 'Your email has not been registered.';
        }
        else {
            $new_password = generateRandomString(8);

            $data = array(
                array('option_key'=>'manager_password', 'option_value'=>sha1($this->config->item('encryption_key') . $new_password), 'module'=>'admin'));
            
            $flag = $this->settings_model->saveSettings($data);

            $subject = "Reset Password";

            $data = array(
                    "subject" => $subject,
                    "login_url" => base_url("/index"),
                    "new_password" => $new_password
            );
            $data['content'] = $this->load->view('email/email_confirm_reset_view.php', $data, true);
            $msg = $this->load->view('email/email_template_view', $data, true);

            $config_email = $this->config->item('email');
            $this->load->library('email', $config_email);

            $this->email->from($this->session->userdata("report_email"), $this->session->userdata("system_title"));
            $this->email->to($user['email_address']);
            $this->email->cc($this->session->userdata("report_email"));
            $this->email->subject($subject);
            $this->email->message($msg);
            $this->email->send();

            //echo $this->email->print_debugger();

            $data['message'] = 'You have sent password forgotten email successfully! Please check your email.';
        }

        echo json_encode($data);
        exit();
    }

    public function activate($active_code)
    {
        if($active_code == '')
            redirect('/index/', 'refresh');

        $user = $this->user_model->activateUser($active_code);

        if(!$user) {
            redirect('/index/index/invalid', 'refresh');
        }
        else {
            $this->session->set_userdata('user_id', $user['user_id']);
            $this->session->set_userdata('email_address', $user['email_address']);
            $this->session->set_userdata('role', $user['role']);

            $this->session->set_userdata('loggedin', 1);

            redirect('/index/index/activte_success', 'refresh');
        }
    }

    public function sendRegisterMail($user)
    {
        $subject = "Complete Registration With Senior Report Administrator";

        $config_email = $this->config->item('email');
        $this->load->library('email', $config_email);

        $msg = "manager ID: {$user['manager_id']}<br/>manager password: {$user['manager_password']}";
        $this->email->from("do-not-reply@seniorreport.com", "Senior Report Registration");
        $this->email->to($user['manager_email']);
        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->send();

        echo $this->email->print_debugger();
        //return true;
    }

    public function reset($active_code = '')
    {
        $data = array('active_code' => $active_code);

        if($active_code == '') {
            $data['error'] = "Invalid token. please check the url again.";
        }
        else {
            $cmd = $this->input->post('cmd');

            if($cmd =='reset') {
                $user = $this->user_model->getUserByActiveCode($active_code);

                if(empty($user)) {
                    $data['error'] = "Invalid user to be changed. please check the url again.";
                }
                else {
                    $data['password'] = $this->input->post('password');
                    $password = sha1($this->config->item('encryption_key'). $data['password']);

                    $this->user_model->update('users', array('password' => $password, 'active_code' => ''), array('user_id' => $user['user_id']));

                    $subject = "Password changed in ". $this->session->userdata("system_title");

                    $email_data = array(
                        "subject" => $subject,
                        "user" => $user
                    );
                    $email_data['content'] = $this->load->view('email/email_password_changed', $email_data, true);
                    $msg = $this->load->view('email/email_template_view', $email_data, true);

                    $config_email = $this->config->item('email');
                    $this->load->library('email', $config_email);

                    $this->email->from($this->session->userdata("report_email"), $this->session->userdata("system_title"));
                    $this->email->to($user['email_address']);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();

                    $data['success'] = "You have changed password successfully!";
                }
            }
        }

        $this->yall->set('title', $this->session->userdata('system_title'))
            ->set('data', $data)
            ->render('index/reset');
    }
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
