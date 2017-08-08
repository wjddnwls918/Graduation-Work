<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Login extends CI_Controller 
{ 
    function __construct()
    {
        parent::__construct();		
    }
 
	//로그아웃 부분
	public function logout()
	{		
		$this->session->unset_userdata('is_login');
		
		
		//$this->session->set_flashdata('logout_message','로그아웃');	
		$this->load->helper('url');
		redirect('/welcome');

		exit;
	}
	//로그인 인증부분 
	public function authentication()
	{
		$this->load->model('user_model');
		$user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
		//$authentication = $this->config->item("authentication");
		if(
			//$this->input->post('id') == $authentication['id'] &&
			//$this->input->post('password') == $authentication['password']
			$this->input->post('email') == $user->email &&
			password_verify($this->input->post('password'), $user->password)
			//$this->input->post('password') == $user->password

		)
		{
			//일치하는 경우
			
			$this->session->set_userdata('is_login',true);
			$this->load->helper('url');
			
			redirect('/welcome');
		}
		
		//로그인 실패 시 (일치하지 않는 경우)
		else{
					
		$this->session->set_flashdata('login_message','로그인에 실패 했습니다.');	
		$this->load->helper('url');
		
		redirect('/welcome');
		}
	}
	public function test($str )
	{
		//if(! preg_match("/^([-a-z_ ])+$/i", $str) )
		if(! preg_match("/[a-zA-Z]+[0-9]+[!#$%^&*()?+=\/]/", $str) )
		
		{
			//echo " echo test!!";
			$this->form_validation->set_message('test', '패스워드는 문자,숫자,특수문자를 포함해야합니다.');
			
			return false;
		}
		else
		{
			
		
			return true;
		}
	}
	public function register()
	{
		//$this->_head();
		$this->load->library("form_validation");
		$this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]|callback_test');
		$this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
 

		//$this->form_validation->run();
	
	
	
		if($this->form_validation->run() === false)
		{
			$this->load->view('include/login_header');
			$this->load->view('register/form');
			$this->load->view('include/footer');
		}
	
		else{
			if(function_exists('password_hash'))
			{
				$this->load->helper('password');
			}
			
			//암호화
			$hash = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
			
			$this->load->model("user_model");
			$this->user_model->add(array(
				'email'=>$this->input->post("email"),
				'password'=>$hash,
				'nickname'=>$this->input->post("nickname")
				
			));
			
			$this->session->set_flashdata('message','회원가입에 성공했습니다.');
			$this->load->helper('url');
			redirect('/');
		}
				
					
		

	}
}
