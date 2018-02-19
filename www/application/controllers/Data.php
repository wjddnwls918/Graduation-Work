<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Data extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date'));

       // $this -> load -> helper(array('url', 'date'));
    }

	public function index($id)
	{
	    $page= $this->input->get("page");

		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}

		else
		{
		$option=array("pagePerNumber"=>10, "page"=>$page);

		$this->load->model('data_model');
		$this->load->library('pagination');

        $config['base_url'] = '/data/'+$id;
        $config['total_rows'] = $this->data_model->total_entry($id);
        $config['per_page'] = 10;
		//$config['num_links']=1;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = ' <ul class="pagination">';
        $config['full_tag_close'] = '</ul> <!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['anchor_class'] = 'follow_link';

        $this->pagination->initialize($config);
        $paging= $this->pagination->create_links();

		$data=$this->data_model->gets($option, $id);



		//$item2=$this->data_model->detail_info($drone_idx,$practice_Drone_Data);

		$this->load->view('include/header');
		$this->load->view('data/item', array("practice_Drone_Data"=>$data, "page"=>$paging));
		$this->load->view('include/footer');
		}
	}

	// 드론 데이터 탭에서 해당하는 날짜에 관한 정보를 출력합니다.
	public function detail($drone_idx,$practice_Drone_Data=null){


		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}




		else
		{
		//echo $practice_Drone_Data;
		$this->load->model('data_model');

		if(empty($practice_Drone_Data)){
			echo("<script>location.href='./index';</script>");
			exit;
		}

		$item=$this->data_model->detail_db($drone_idx,$practice_Drone_Data);
		$item2=$this->data_model->detail_info($drone_idx,$practice_Drone_Data);

		$this->load->view("include/header");
		$this->load->view("data/detail",array('item'=>$item2));

		$this->load->view("include/footer");
		$this->load->view("data/script",array('item'=>$item2));
		}

	}


	public function get_info_json($drone_idx=1)
	{
		$this->load->model('Data_model');


	    //드론 번호 1
		$data= $this->Data_model->detail_info($drone_idx);

		echo json_encode($data);
	}

	public function upload_form()
	{
		//$this->_head();

		$this->load->view('upload/upload_form');
		$this->load->view('include/footer');

	}

	public function upload_receive()
	{
		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		$config['upload_path'] = '/application/controllers/Dummy_create';
		// git,jpg,png 파일만 업로드를 허용한다.
		$config['allowed_types'] = 'gif|jpg|png';
		// 허용되는 파일의 최대 사이즈
		$config['max_size'] = '100';
		// 이미지인 경우 허용되는 최대 폭
		$config['max_width']  = '1024';
		// 이미지인 경우 허용되는 최대 높이
		$config['max_height']  = '768';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("user_upload_file"))
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
			echo $this->upload->display_errors();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo"성공";
			var_dump($data);
			//$this->load->view('upload_success', $data);
		}
	}

	public function add()
	{
			if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
		else
		{
		$this->load->view('include/header');
		$this->load->view('upload/add');
		$this->load->view('include/footer');
		$this->load->view("data/add_script");
		}
	}


	/// 1205 추가부
	/*
	public function _remap($method) {
        // 헤더 include
        $this -> load -> view('include/header');

        if (method_exists($this, $method)) {
           // $this -> {"{$method}"}();
        }

        // 푸터 include
        $this -> load -> view('include/footer');
    }
 */

    public function lists() {
		$page= $this->input->get("page");

		 if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}

		else
		{
		$option=array("pagePerNumber"=>10, "page"=>$page);

		$this->load->model('Board');
		$this->load->library('pagination');

        $config['base_url'] = '/data/lists';
        $config['total_rows'] = $this->Board->total_entry();
        $config['per_page'] = 10;
		//$config['num_links']=1;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = ' <ul class="pagination">';
        $config['full_tag_close'] = '</ul> <!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['anchor_class'] = 'follow_link';

        $this->pagination->initialize($config);
        $paging= $this->pagination->create_links();

		$data=$this->Board->gets($option);

		//$data['list'] = $this->Board->gets($option);

		$this->load->view('include/header');
		$this->load->view('upload/list', array("practice_Drone_Data"=>$data, "page"=>$paging));
		//$this -> load -> view('upload/list', $data);
		$this->load->view('include/footer');
		$this->load->view('upload/script');

		}
	}


	public function view($board_id)
	{
			if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
		else{


		$this->load->model('Board');
		$data = $this->Board->view_get($board_id);
		$this->Board->increase_hit($data);
		$this->load->view('include/header');

		//echo $subject.$board_id;
		//echo $data['contents'];
		$this->load->view('upload/view',array("view_data"=>$data));
		$this->load->view('include/footer');

		}

	}

	public function ck_upload()
	{
		$this->load->model('Board');
		$this->load->helper('url');
			if(!$this->session->userdata('is_login'))
		{

			redirect('/welcome');
		}
		else
		{


		//echo $this->input->post('subject');
		//echo $this->input->post('contents');

		$this->Board->insert_data($this->input->post('subject'),$this->input->post('contents'));
		redirect('/data/lists');
		}

	}

	public function file_del($board_id)
	{
		$this->load->model('Board');
		$this->load->helper('url');

		$data = $this->Board->view_get($board_id);
		$this->Board->delete_data($data);
		redirect('/data/lists');
	}


	public function modify($board_id)
	{
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
		else{


		$this->load->model('Board');
		$data = $this->Board->view_get($board_id);
		//$this->Board->increase_hit($data);
		$this->load->view('include/header');

		//echo $subject.$board_id;
		//echo $data['contents'];
		$this->load->view('upload/modify',array("view_data"=>$data));
		$this->load->view('include/footer');

		}

	}

	public function mk_upload($board_id)
	{
		$this->load->model('Board');
		$this->load->helper('url');
			if(!$this->session->userdata('is_login'))
		{

			redirect('/welcome');
		}
		else
		{


		//echo $this->input->post('subject');
		//echo $this->input->post('contents');

		$this->Board->modifiy_data($board_id,$this->input->post('subject'),$this->input->post('contents'));
		redirect('/data/lists');
		}

	}
}
