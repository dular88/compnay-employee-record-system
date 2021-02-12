<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CompanyController extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata("company_id")==""){
            redirect("login");
        }
    $this->load->model('CommonModel');
    }

     public function company_dashboard()
    {
        $company_id=$this->session->userdata("company_id");
        $data['employee_count']=$this->CommonModel->get_row_count("employee",array("company_id"=>$company_id));
        $data['title']=PROJECT_NAME." | Company Dashboard";
        $this->load->view('company/company_dashboard',$data);
    }


     public function company_edit_data()
         {
    $company_id=$this->session->userdata("company_id");
    $query=$this->CommonModel->data_list("company",array("company_id"=>$company_id));
    $data=array();
    foreach ($query->result() as $key => $value) {
        $data[]=$value;
            }
    echo json_encode(array("result"=>"success","data"=>$data));
    }

    public function company_update()
    {
         $company_id=$this->session->userdata("company_id");
         $query=$this->CommonModel->insert_update("company",array(),array("company_id"=>$company_id));
        if($query){
            echo json_encode(array("result"=>"success"));
        }else{
            echo json_encode(array("result"=>"fail"));
        }
    }

    
    


    ////////////////////////////////////
     public function add_employee_page()
    {
        $data['title']=PROJECT_NAME." | Add Employee";
        $this->load->view('company/add_employee',$data);
    }

    ///////////////////////////////////////
     public function employee_list()
    {
        $data['title']=PROJECT_NAME." | Employee List";
        $this->load->view('company/employee_list',$data);
    }
    ////////////////////////////////////////
    public function add_update_employee_data()
    {
        $email=$this->input->post("email");
        $company_id=$this->input->post("company_id");
        $form_status=$this->input->post("form_status");


        $already_check=$this->CommonModel->already_check("employee",array("email"=>$email,"company_id"=>$company_id));
        
        if($form_status=="add"){
            ///////If Fresh Data////////
                if($already_check->num_rows()==0){
                    $this->CommonModel->insert_update("employee",array(),array());
                    echo json_encode(array("result"=>"success"));
                }else{
                    echo json_encode(array("result"=>"already"));
                }
        }

         if($form_status=="edit"){
                $employee_id=$this->input->post("employee_id");
                $query=$this->CommonModel->insert_update("employee",array(),array("employee_id"=>$employee_id));
                if($query){
                    echo json_encode(array("result"=>"success"));
                }else{
                    echo json_encode(array("result"=>"fail"));
                }
        }
        
    }




    public function employee_list_data()
    {
        $company_id=$this->session->userdata("company_id");
        $data_array=array("company_id"=>$company_id);

        $query=$this->CommonModel->data_list("employee",$data_array);
        $table_heading='<table class="table table-bordered" id="my_table">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Employee Name</th>
                      <th>Email</th>
                      <th>Mobile No.</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>';
                $result_row_count=$this->CommonModel->get_row_count("employee",$data_array);
                if($result_row_count>0){
                    $i=1;
                    $tbody_data="";
                      foreach ($query->result() as $key => $value) {
                       
                         $tbody_data=$tbody_data. '<tr>
                                  <td>'.$i.'</td>
                                  <td>'.$value->name.'</td>
                                  <td>'.$value->email.'</td>
                                  <td>'.$value->mobile_no.'</td>
                                  <td>'.$value->address.'</td>
                                  <td>
                                    <button type="button" class="btn btn-primary" onclick="edit_data('.$value->employee_id.');"><i class="fa fa-edit" title="Edit"></i></button>
                                    &nbsp;
                                    <button type="button" class="btn btn-danger" onclick="show_modal('.$value->employee_id.');" title="Delete"><i class="fa fa-trash"></i>
                                    </button>
                                  </td>
                                  
                                </tr>';
                                $i++;
                      }
                  }
                    
        $full_table=$table_heading.$tbody_data.'</tbody>
                </table>';
        if($query){
            echo json_encode(array("result"=>"success","data"=>$full_table));
        }else{
            echo json_encode(array("result"=>"fail"));
        }
    }


         public function employee_edit_data()
         {
    $company_id=$this->session->userdata("company_id");
    $employee_id=$this->input->post("employee_id");
    $query=$this->CommonModel->data_list("employee",array("company_id"=>$company_id,"employee_id"=>$employee_id));
    $data=array();
    foreach ($query->result() as $key => $value) {
        $data[]=$value;
            }
    echo json_encode(array("result"=>"success","data"=>$data));
    }


         public function delete_employee_data()
         {
    $employee_id=$this->input->post("employee_id");
    $query=$this->CommonModel->delete_data("employee",array("employee_id"=>$employee_id));
    if($query){
          echo json_encode(array("result"=>"success"));
             }else{
          echo json_encode(array("result"=>"fail"));
             }
    }


    public function my_last_query()
    {
        echo $this->db->last_query();
    }


}


