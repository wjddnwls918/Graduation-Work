<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/**
* 사용자인증 모델
*
* @author Jongwon Byun <advisor@cikorea.net>
*/
class Auth_m extends CI_Model
{
function __construct()
{
parent::__construct();
}
 
    /**
     * 아이디, 비밀번호 체크
     *
     * @param array $auth 폼전송 받은 아이디, 비밀번호
     * @return array
     */
	 
function login($auth)
{
	if(isset($_COOKIE['ci_session'])){ 
		$user= $this->security->xss_clean($this->input->post('user'));
		$pass= $this->security->xss_clean($this->input->post('pass'));
	
		$result = $usrLog->loguearUsuario($user, $pass);

	if($result == TRUE){
		$data = $this->session->set_userdata('logged_in', $sessArray);
		$this->load->view('pages/admin', $data);
		}
	}
	
	else{
	header('Location: login'); 
	}
}

function logout($auth){
	session_start();
	//unset $id; 
	//session_unregister("id"); 
	session_destroy();
}
