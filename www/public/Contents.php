<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contents extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('/admin/contents_model');
		$this->_header("contents");
	}

	function contents($page=1,$query=NULL){
		if(!is_numeric($page))	$page=1;
		
		$pagePerNumber=20;
		$option=array(
		'pagePerNumber'=>$pagePerNumber,
		'page'=>$page,
		'query'=>$query
		);
		$result=$this->contents_model->gets($option);
		
		
		$this->load->helper('paging');
		$paging=page_nav($this->db->count_all('beauty_contents'),$pagePerNumber,10,$page,$query,"contents","contents");
		$this->load->view('/admin/contents/contents',array('contents'=>$result,'paging'=>$paging));

		$this->_footer();
		$this->load->view('/admin/contents/resource');
		
	}
	function content_add(){
		$this->load->view('/admin/contents/content_add');
		$this->_footer();
		$this->load->view('/admin/contents/resource');
	}
	function content_add_action(){
		$config['upload_path'] = './public/upload/contents/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size'] = '100';
		$config['file_ext_tolower'] = '100';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('thumbnail_square')){
               $thumbnail_square=NULL;
        }else{
                $thumbnail_square = $this->upload->data()['file_name'];
        }
		if ( ! $this->upload->do_upload('thumbnail_rectangle')){
                $thumbnail_rectangle=NULL;
        }else{
                $thumbnail_rectangle=$this->upload->data()['file_name'];
        }


		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('title', 'title', 'required');
		
		
		if($this->form_validation->run() === false){
			$this->content_add();
		}else{
			$data=array(
			'title'=>$this->input->post('title'),
			'content'=>$this->input->post('content'),
			'content_owner'=>$this->input->post('content_owner'),
			'type_sns'=>$this->input->post('type_sns'),
			'tags'=>$this->input->post('tags'),
			'link'=>$this->input->post('link'),
			'thumbnail_square'=>$thumbnail_square,
			'thumbnail_rectangle'=>$thumbnail_rectangle
			);
			
			
			$result=$this->contents_model->add($data);
			
			$this->session->set_flashdata("join_success",$result); 
			redirect('/admin/contents/contents');
		}

	}

	function content_modify($index=0){
		$result = $this->contents_model->getByIdx(array("idx"=>$index));
		if(!$result) redirect('/admin/auth');
		
		
		
		$this->load->view("/admin/contents/content_modify",array("entry"=>$result));
		$this->_footer();
		$this->load->view("/admin/contents/resource");
		
	}
	function content_modify_action(){
			
		$idx=$this->input->post('idx');
		$result = $this->contents_model->getByIdx(array("idx"=>$idx));
		if(!$result) redirect('/admin/auth');
		
		$title=$this->input->post('title') ? $this->input->post('title') : $result->title;
		$content=$this->input->post('content') ? $this->input->post('content') : $result->content;
		$count=$this->input->post('count') ? $this->input->post('count') : $result->count;
		$content_owner=$this->input->post('content_owner') ? $this->input->post('content_owner') : $result->content_owner;
		$type_sns=$this->input->post('type_sns') ? $this->input->post('type_sns') : $result->type_sns;
		$tags=$this->input->post('tags') ? $this->input->post('tags') : $result->tags;
		$link=$this->input->post('link') ? $this->input->post('link') : $result->link;
		$thumbnail_square=$result->thumbnail_square;
		$thumbnail_rectangle=$result->thumbnail_rectangle;
		
		$config['upload_path'] = './public/upload/contents/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size'] = '100';
		$config['file_ext_tolower'] = '100';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('thumbnail_square')){
				unlink($config['upload_path'].$thumbnail_square);
               $thumbnail_square = $this->upload->data()['file_name'];
        }
		if ($this->upload->do_upload('thumbnail_rectangle')){
				unlink($config['upload_path'].$thumbnail_rectangle);
                $thumbnail_rectangle=$this->upload->data()['file_name'];
        }

		$data = array(
			'title'=>$title,
			'content'=>$content,
			'count'=>$count,
			'content_owner'=>$content_owner,
			'type_sns'=>$type_sns,
			'tags'=>$tags,
			'link'=>$link,
			'thumbnail_square'=>$thumbnail_square,
			'thumbnail_rectangle'=>$thumbnail_rectangle
			);
			
			
			$result=$this->contents_model->updateByIdx($data,array("idx"=>$idx));
		var_dump($result);
		redirect('/admin/contents/content_modify/'.$idx);
		
	}

	function delete($idx){
		$result = $this->contents_model->getByIdx(array("idx"=>$idx));
		if(!$result) redirect('/admin/auth');
		
		if($result->thumbnail_square) unlink('./public/upload/contents/'.$result->thumbnail_square);
		if($result->thumbnail_rectangle) unlink('./public/upload/contents/'.$result->thumbnail_rectangle);
		
		$this->contents_model->deleteByIdx(array("idx"=>$idx));
		
		redirect("/admin/contents/contents");
	}


}
?>