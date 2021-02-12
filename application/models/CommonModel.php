<?php
Class CommonModel extends CI_Model{

	 /////////Short Cut Method ////////////

	public function insert_update($table,$data,$where){
		
		$fields = $this->db->field_data($table);
		foreach ($fields as $field) {
			if($field->primary_key==1)
				continue;
			$value=$this->input->post($field->name);
			if(!empty($value)){
				if($field->name=="password"){
					       $data[$field->name]=md5($value);
					}else{
						$data[$field->name]=$value;
					}
				}
			}

		$form_status=$this->input->post("form_status");
		if($form_status=="add"){
			/////////Insert//////////////
			$data["entry_date"]=date("Y-m-d H:i:s");
		    $query=$this->db->insert($table,$data);
		}else{
			/////////Update//////////////
			$data['updated_date']=date("Y-m-d H:i:s");
			$this->db->where($where);
		    $query=$this->db->update($table,$data);
		}
		

		return $query;
	}
///////////////////////////////////////////////////////////////////

	////////////////Table data list ///////////////
	public function data_list($table,$where){
		$data=$this->db->get_where($table,$where);
		return $data;
	}

///////////////////////////////////////////////////

	////////////////Delete Data ///////////////
	public function delete_data($table,$where){
		$this->db->where($where);
		$data=$this->db->delete($table);
		return $data;
	  }


	public function get_name_by_id($table,$field_name,$where)
	{
	
		$query=$this->db->select($field_name)->get_where($table,$where)->row();
		$name=$query->$field_name;
		return $name;
	}

	public function get_row_count($table,$where)
	{
		$query=$this->db->get_where($table,$where);
		return $query->num_rows();
	}

	public function get_selected_field($selected_field,$table,$where)
	{
		$query=$this->db->select($selected_field)->get_where($table,$where);
		return $query->result();
	}

	//////////////////already_check///////////////////
	public function already_check($table,$where)
	{
		$query=$this->db->get_where($table,$where);
		return $query;
	}

}
?>