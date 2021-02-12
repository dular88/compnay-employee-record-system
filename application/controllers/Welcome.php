<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
        parent::__construct();
    $this->load->model('CommonModel');
    }


	public function index()
	{
		$data['title']=PROJECT_NAME." | Company Registration";
		$this->load->view('registration',$data);
	}

	public function login()
	{
		$data['title']=PROJECT_NAME." | Company Login";
		$this->load->view('login',$data);
	}

	public function company_add()
	{
		$email=$this->input->post("email");
		$already_check=$this->CommonModel->already_check("company",array("email"=>$email));
		/////////If Fresh Data
		if($already_check->num_rows()==0){
			$this->CommonModel->insert_update("company",array(),array());
			echo json_encode(array("result"=>"success"));
		}else{
			echo json_encode(array("result"=>"already"));
		}
	}

		    	////////////////Company Login Check started///////////
		public function login_submit(){

			$email=$this->input->post("email");
			$pwd=md5($this->input->post("password"));
			
		$validate=$this->CommonModel->already_check("company",array("email"=>$email,"password"=>$pwd));
		
			if($validate->num_rows()==1){
				
				$company_id=$validate->row()->company_id;
				$company_name=$validate->row()->company_name;

				$this->session->set_userdata(array("company_id"=>$company_id,"company_name"=>$company_name,"email"=>$email));
					redirect(base_url()."company_dashboard");
				}else{
				$this->session->set_flashdata("msg_login","invalid");
				  redirect(base_url()."login");
			}
		}


		//////////////Logout Started///////////////////
		public function logout()
			{
			    $user_data = $this->session->all_userdata();
			        foreach ($user_data as $key => $value) {
			           $this->session->unset_userdata($key);
			 }
			 
			    $this->session->set_flashdata("msg_login","logout");
			    redirect(base_url()."login");
			}
}
