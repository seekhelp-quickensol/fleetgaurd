<?php

class Admin_model extends CI_model
{
	public function __construct()
	{

		parent::__construct();
		$this->load->database();
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		// $this->db->where("(email = '$email')");
		$this->db->where("(username = '$email')");
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$res = $this->db->get('tbl_user')->row();
		if (!empty($res)) {
			if ($password == $res->password) {
				$data = array(
					'id' => $res->id,
					'name' => $res->first_name,
					'username' => $res->username,
					'email' => $res->email
				);
				$this->session->set_userdata($data);
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	// public function check_email_exists()
	// {
	// 	$email = $this->input->post('email');
	// 	$this->db->where('email', $email);
	// 	$query = $this->db->get('tbl_user');
	// 	return $query->num_rows() > 0;
	// }
	public function check_username_exists()
	{
		$email = $this->input->post('email');
		$this->db->where('username', $email);
		$query = $this->db->get('tbl_user');
		return $query->num_rows() > 0;
	}
	public function change_password()
	{
		$this->db->where("id", $this->session->userdata("admin_id"));
		$this->db->where("password", md5($this->input->post("old_password")));
		if ($this->db->get("tbl_users")->num_rows() > 0) {
			$data = array(
				"password" => md5($this->input->post("new_password")),
			);
			$this->db->update("tbl_users", $data);
			return true;
		} else {
			return false;
		}
	}


	public function inactive()
	{
		$table = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		$data = array('status' => '0');
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;
	}


	public function active()
	{
		$table = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		$data = array(
			'status' => '1'
		);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;
	}
	public function delete()
	{
		$table = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		$data = array(
			"is_deleted" => "1"
		);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;
	}


	// public function upload_students_ajax() {
	// 	$this->load->library('upload');
	// 	$this->load->helper('url');

	// 	$config['upload_path'] = './admin_assets/';
	// 	$config['allowed_types'] = 'xlsx|xls|csv';
	// 	$config['max_size'] = 1024;
	// 	$config['file_name'] = 'services_data';

	// 	$this->upload->initialize($config);

	// 	if ($this->upload->do_upload('file')) {
	// 		$fileData = $this->upload->data();
	// 		$filePath = './assets/' . $fileData['file_name'];

	// 		if (pathinfo($filePath, PATHINFO_EXTENSION) == 'csv') {
	// 			if (($handle = fopen($filePath, 'r')) !== FALSE) {
	// 				$isHeaderRow = true;
	// 				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	// 					if ($isHeaderRow) {
	// 						$isHeaderRow = false;
	// 						continue;
	// 					}

	// 					$dataToInsert = array(
	// 						'seat_no'        => isset($data[0]) ? trim($data[0]) : '',
	// 						'name'           => isset($data[1]) ? trim($data[1]) : '',
	// 						'gender'         => isset($data[2]) ? trim($data[2]) : '',
	// 						'school'         => isset($data[3]) ? trim($data[3]) : '',
	// 						'center'         => isset($data[4]) ? trim($data[4]) : '',
	// 						'taluka'         => isset($data[5]) ? trim($data[5]) : '',
	// 						'district'       => isset($data[6]) ? trim($data[6]) : '',
	// 						'class'          => isset($data[7]) ? trim($data[7]) : '',
	// 						'marks'          => isset($data[8]) ? trim($data[8]) : '',
	// 						'total'          => isset($data[9]) ? trim($data[9]) : '',
	// 						'medal'          => isset($data[10]) ? trim($data[10]) : '',
	// 						'district_merit' => isset($data[11]) ? trim($data[11]) : '',
	// 						'created_on'     => date('Y-m-d H:i:s')
	// 					);

	// 					$this->db->insert('tbl_students', $dataToInsert);
	// 				}
	// 				fclose($handle);
	// 			}
	// 			echo '<p style="color: green;">Data imported successfully!</p>';
	// 		} else {
	// 			echo '<p style="color: red;">Invalid file format. Please upload a CSV file.</p>';
	// 		}
	// 	} else {
	// 		echo '<p style="color: red;">' . $this->upload->display_errors() . '</p>';
	// 	}
	// }




	public function add_students($dataToInsert)
	{
		$this->db->insert('tbl_students', $dataToInsert);
	}

	public function get_prefix($given)
	{
		$prefix_array = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X');
		for ($i = 0; $i < count($prefix_array); $i++) {

			if ($prefix_array[$i] == $given) {
				return $i + 1;
			}
		}
		return 0;
	}



	public function get_all_students()
	{
		// $this->db->limit(100); 
		$query = $this->db->get('tbl_students');
		return $query->result_array();
	}


	public function get_student_by_seat_no($seat_no)
	{
		$this->db->where('seat_no', $seat_no);
		$query = $this->db->get('tbl_students');


		if ($query->num_rows() > 0) {

			return $query->row_array();
		}

		return null;
	}

	// jayesh 23-5-25

	public function set_site()
	{
		$data = array(
			'site_name'     => $this->input->post('site_name'),
		);


		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_site', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_site', $data);
			return 0;
		}
	}
	public function get_single_site()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_site');
		return $result->row();
	}

	public function get_all_site_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_site.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_site.site_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_site.is_deleted', '0');
		$this->db->order_by('tbl_site.id', 'DESC');
		$result = $this->db->get('tbl_site');
		return $result->result();
	}
	public function get_all_site_list_ajax_count($search = '')
	{
		$this->db->select('tbl_site.*');
		if ($search != "") {
			$this->db->group_start();

			$this->db->or_like('tbl_site.site_name', $search);


			$this->db->group_end();
		}
		$this->db->where('tbl_site.is_deleted', '0');
		$this->db->order_by('tbl_site.id', 'DESC');
		$result = $this->db->get('tbl_site');
		return $result->num_rows();
	}


	public function set_good_type()
	{
		$data = array(
			'good_type_name'     => $this->input->post('good_type_name'),
		);


		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_good_type', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_good_type', $data);
			return 0;
		}
	}
	public function get_single_good_type()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_good_type');
		return $result->row();
	}

	public function get_all_good_type_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_good_type.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_good_type.is_deleted', '0');
		$this->db->order_by('tbl_good_type.id', 'DESC');
		$result = $this->db->get('tbl_good_type');
		return $result->result();
	}
	public function get_all_good_type_list_ajax_count($search = '')
	{
		$this->db->select('tbl_good_type.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_good_type.is_deleted', '0');
		$this->db->order_by('tbl_good_type.id', 'DESC');
		$result = $this->db->get('tbl_good_type');
		return $result->num_rows();
	}


	public function set_designation()
	{
		$data = array(
			'designation_name'     => $this->input->post('designation_name'),
		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_designation', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_designation', $data);
			return 0;
		}
	}
	public function get_single_designation()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_designation');
		return $result->row();
	}

	public function get_all_designation_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_designation.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_designation.designation_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_designation.is_deleted', '0');
		$this->db->order_by('tbl_designation.id', 'DESC');
		$result = $this->db->get('tbl_designation');
		return $result->result();
	}
	public function get_all_designation_list_ajax_count($search = '')
	{
		$this->db->select('tbl_designation.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_designation.designation_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_designation.is_deleted', '0');
		$this->db->order_by('tbl_designation.id', 'DESC');
		$result = $this->db->get('tbl_designation');
		return $result->num_rows();
	}


	public function set_department()
	{

		$data = array(
			'department_name'     => $this->input->post('department_name'),
		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_department', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_department', $data);
			return 0;
		}
	}
	public function get_single_department()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_department');
		return $result->row();
	}

	public function get_all_department_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_department.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_department.department_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_department.is_deleted', '0');
		$this->db->order_by('tbl_department.id', 'DESC');
		$result = $this->db->get('tbl_department');
		return $result->result();
	}
	public function get_all_department_list_ajax_count($search = '')
	{
		$this->db->select('tbl_department.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_department.department_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_department.is_deleted', '0');
		$this->db->order_by('tbl_department.id', 'DESC');
		$result = $this->db->get('tbl_department');
		return $result->num_rows();
	}

	public function set_plant()
	{

		$data = array(
			'plant_name'     => $this->input->post('plant_name'),
			'plant_code'     => $this->input->post('plant_code'),
		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_plant', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_plant', $data);
			return 0;
		}
	}
	public function get_single_plant()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_plant');
		return $result->row();
	}

	public function get_all_plant_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_plant.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_plant.plant_name', $search);
			$this->db->or_like('tbl_plant.plant_code', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_plant.is_deleted', '0');
		$this->db->order_by('tbl_plant.id', 'DESC');
		$result = $this->db->get('tbl_plant');
		return $result->result();
	}
	public function get_all_plant_list_ajax_count($search = '')
	{
		$this->db->select('tbl_plant.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_plant.plant_name', $search);
			$this->db->or_like('tbl_plant.plant_code', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_plant.is_deleted', '0');
		$this->db->order_by('tbl_plant.id', 'DESC');
		$result = $this->db->get('tbl_plant');
		return $result->num_rows();
	}

	public function set_workshop()
	{

		$data = array(
			'workshop_name'     => $this->input->post('workshop_name'),

		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_workshop', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_workshop', $data);
			return 0;
		}
	}
	public function get_single_workshop()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_workshop');
		return $result->row();
	}

	public function get_all_workshop_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_workshop.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_workshop.workshop_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_workshop.is_deleted', '0');
		$this->db->order_by('tbl_workshop.id', 'DESC');
		$result = $this->db->get('tbl_workshop');
		return $result->result();
	}
	public function get_all_workshop_list_ajax_count($search = '')
	{
		$this->db->select('tbl_workshop.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_workshop.workshop_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_workshop.is_deleted', '0');
		$this->db->order_by('tbl_workshop.id', 'DESC');
		$result = $this->db->get('tbl_workshop');
		return $result->num_rows();
	}

	public function set_item()
	{

		$data = array(
			'item_name'     => $this->input->post('item_name'),

		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_item', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_item', $data);
			return 0;
		}
	}
	public function get_single_item()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_item');
		return $result->row();
	}

	public function get_all_item_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_item.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_item.item_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_item.is_deleted', '0');
		$this->db->order_by('tbl_item.id', 'DESC');
		$result = $this->db->get('tbl_item');
		return $result->result();
	}
	public function get_all_item_list_ajax_count($search = '')
	{
		$this->db->select('tbl_item.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_item.item_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_item.is_deleted', '0');
		$this->db->order_by('tbl_item.id', 'DESC');
		$result = $this->db->get('tbl_item');
		return $result->num_rows();
	}

	public function set_unit()
	{

		$data = array(
			'unit_name'     => $this->input->post('unit_name'),

		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_unit', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_unit', $data);
			return 0;
		}
	}
	public function get_single_unit()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_unit');
		return $result->row();
	}

	public function get_all_unit_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_unit.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_unit.unit_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_unit.is_deleted', '0');
		$this->db->order_by('tbl_unit.id', 'DESC');
		$result = $this->db->get('tbl_unit');
		return $result->result();
	}
	public function get_all_unit_list_ajax_count($search = '')
	{
		$this->db->select('tbl_unit.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_unit.unit_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_unit.is_deleted', '0');
		$this->db->order_by('tbl_unit.id', 'DESC');
		$result = $this->db->get('tbl_unit');
		return $result->num_rows();
	}

	public function set_user_data($file)
	{

		if ($file == "") {
			$file = $this->input->post('old_profile_image');
		}

		$data = array(
			'username'        => $this->input->post('username'),
			'first_name'        => $this->input->post('first_name'),
			'middle_name'         => $this->input->post('middle_name'),
			'last_name'          => $this->input->post('last_name'),
			'employee_id'                  => $this->input->post('employee_id'),
			'email'                 => $this->input->post('email'),
			'department_id'        => $this->input->post('department_id'),
			'designation_id'               => $this->input->post('designation_id'),
			'password'          => $this->input->post('password'),
			'profile_image'       => $file,
		);

		if ($this->input->post('id') == "") {
			$date = array('created_on'    => date("Y-m-d H:i:s"));
			$new_arr = array_merge($data, $date);


			$this->db->insert('tbl_user', $new_arr);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_user', $data);
			return 1;
		}
	}

	public function get_single_user_data()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_user');
		return $result->row();
	}

	public function get_all_department_data()
	{
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_department');
		return $result->result();
	}
	public function get_all_designation_data()
	{
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_designation');
		return $result->result();
	}

	public function get_all_user_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_user.*, tbl_department.department_name,tbl_designation.designation_name');
		$this->db->from('tbl_user');
		$this->db->join('tbl_department', 'tbl_department.id = tbl_user.department_id', 'left');
		$this->db->join('tbl_designation', 'tbl_designation.id = tbl_user.designation_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_user.first_name', $search);
			$this->db->or_like('tbl_user.middle_name', $search);
			$this->db->or_like('tbl_user.last_name', $search);
			$this->db->or_like('tbl_user.employee_id', $search);
			$this->db->or_like('tbl_user.username', $search);
			$this->db->or_like('tbl_user.email', $search);
			$this->db->or_like('tbl_department.department_name', $search);
			$this->db->or_like('tbl_designation.designation_name', $search);
			$this->db->or_like('tbl_user.password', $search);
			$this->db->or_like('tbl_user.profile_image', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_user.is_deleted', '0');
		$this->db->order_by('tbl_user.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_user_list_ajax_count($search = '')
	{
		$this->db->select('tbl_user.*, tbl_department.department_name,tbl_designation.designation_name');
		$this->db->from('tbl_user');
		$this->db->join('tbl_department', 'tbl_department.id = tbl_user.department_id', 'left');
		$this->db->join('tbl_designation', 'tbl_designation.id = tbl_user.designation_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_user.first_name', $search);
			$this->db->or_like('tbl_user.middle_name', $search);
			$this->db->or_like('tbl_user.last_name', $search);
			$this->db->or_like('tbl_user.employee_id', $search);
			$this->db->or_like('tbl_user.username', $search);
			$this->db->or_like('tbl_user.email', $search);
			$this->db->or_like('tbl_department.department_name', $search);
			$this->db->or_like('tbl_designation.designation_name', $search);
			$this->db->or_like('tbl_user.password', $search);
			$this->db->or_like('tbl_user.profile_image', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_user.is_deleted', '0');
		$this->db->order_by('tbl_user.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}

	public function get_all_plants()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_plant');
		return $result->result();
	}

	public function get_all_plant_codes()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('id', $this->input->post('plant_id'));
		$result = $this->db->get('tbl_plant');
		echo json_encode($result->result());
	}

	public function get_all_workshops()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_workshop');
		return $result->result();
	}

	public function set_line()
	{

		$data = array(
			'plant_id'     => $this->input->post('plant_id'),
			'plant_code'     => $this->input->post('plant_code'),
			'workshop_id'     => $this->input->post('workshop_id'),
			'line_name'     => $this->input->post('line_name'),
			'line_code'     => $this->input->post('line_code'),
		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_line', $newArr);
			$last_id = $this->db->insert_id();

			$shift_ids = $this->input->post('line_shift_id');
			$production_times = $this->input->post('line_production_time');

			if (!empty($production_times)) {
				for ($i = 0; $i < count($production_times); $i++) {
					$this->db->insert('tbl_shift_wise_line_production_time', [
						'line_id' => $last_id,
						'shift_id' => $shift_ids[$i],
						'production_time' => $production_times[$i],
						'created_on'        => date('Y-m-d H:i:s')
					]);
				}
			}

			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_line', $data);
			$last_id = $this->input->post('id');

			$this->db->where('line_id', $last_id);
			$this->db->delete('tbl_shift_wise_line_production_time');

			$shift_ids = $this->input->post('line_shift_id');
			$production_times = $this->input->post('line_production_time');

			if (!empty($production_times)) {
				for ($i = 0; $i < count($production_times); $i++) {
					$this->db->insert('tbl_shift_wise_line_production_time', [
						'line_id' => $last_id,
						'shift_id' => $shift_ids[$i],
						'production_time' => $production_times[$i],
						'created_on'        => date('Y-m-d H:i:s')
					]);
				}
			}
			return 0;
		}
	}
	public function get_single_line()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_line');
		return $result->row();
	}

	public function get_all_line_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_line.*,tbl_plant.plant_name,tbl_workshop.workshop_name');
		$this->db->from('tbl_line');
		$this->db->join('tbl_plant', 'tbl_plant.id = tbl_line.plant_id', 'left');
		$this->db->join('tbl_workshop', 'tbl_workshop.id = tbl_line.workshop_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_line.plant_code', $search);
			$this->db->or_like('tbl_plant.plant_name', $search);
			$this->db->or_like('tbl_workshop.workshop_name', $search);
			$this->db->or_like('tbl_line.line_name', $search);
			$this->db->or_like('tbl_line.line_code', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_line.is_deleted', '0');
		$this->db->order_by('tbl_line.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_line_list_ajax_count($search = '')
	{
		$this->db->select('tbl_line.*,tbl_plant.plant_name,tbl_workshop.workshop_name');
		$this->db->from('tbl_line');
		$this->db->join('tbl_plant', 'tbl_plant.id = tbl_line.plant_id', 'left');
		$this->db->join('tbl_workshop', 'tbl_workshop.id = tbl_line.workshop_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_line.plant_code', $search);
			$this->db->or_like('tbl_plant.plant_name', $search);
			$this->db->or_like('tbl_workshop.workshop_name', $search);
			$this->db->or_like('tbl_line.line_name', $search);
			$this->db->or_like('tbl_line.line_code', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_line.is_deleted', '0');
		$this->db->order_by('tbl_line.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}

	public function check_unique_line_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('plant_id', $this->input->post('plant_id'));
		$this->db->where('workshop_id', $this->input->post('workshop_id'));
		$this->db->where('line_name', $this->input->post('line_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_line')->row();

		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_line_code()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('plant_id', $this->input->post('plant_id'));
		$this->db->where('workshop_id', $this->input->post('workshop_id'));
		// $this->db->where('line_name', $this->input->post('line_name'));
		$this->db->where('line_code', $this->input->post('line_code'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_line')->row();

		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_plant_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('plant_name', $this->input->post('plant_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_plant')->row();

		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_plant_code()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('plant_code', $this->input->post('plant_code'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_plant')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_workshop_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('workshop_name', $this->input->post('workshop_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_workshop')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function get_all_lines()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_line');
		return $result->result();
	}

	public function get_all_shifts()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_shift');
		return $result->result();
	}

	public function get_all_line_names()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('line_name !=', $this->input->post('line_name_hsg_id'));
		$result = $this->db->get('tbl_line');
		echo json_encode($result->result());
	}

	public function check_unique_finish_good_item_no()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('finish_good_item_no', $this->input->post('finish_good_item_no'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_part_master')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_finish_good_description()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('finish_good_description', $this->input->post('finish_good_description'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_part_master')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_air_cleaner_part_no()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('air_cleaner_part_no', $this->input->post('air_cleaner_part_no'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_part_master')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_air_cleaner_part_description()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('air_cleaner_part_description', $this->input->post('air_cleaner_part_description'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_part_master')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	/*public function set_part_master()
	{

		$finish_good_item_id = $this->input->post('finish_good_item_no');
		$result = $this->get_single_item_number($finish_good_item_id);

		$new_data1 = array(
			'item_no' => $finish_good_item_id,
			'description' => $this->input->post('finish_good_description')
		);

		if (empty($result)) {
			$new_data1['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_item_management', $new_data1);
			$last_id = $this->db->insert_id();
		} else {
			$this->db->where('id', $result->id);
			$this->db->update('tbl_item_management', $new_data1);
			$last_id = $result->id;
		}

		$air_cleaner_part_no = $this->input->post('air_cleaner_part_no');
		$res = $this->get_single_item_number($air_cleaner_part_no);

		$new_data2 = array(
			'item_no' => $air_cleaner_part_no,
			'description' => $this->input->post('air_cleaner_part_description')
		);

		if (empty($res)) {
			$new_data2['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_item_management', $new_data2);
			$air_cleaner_part_id = $this->db->insert_id();
		} else {
			$this->db->where('id', $res->id);
			$this->db->update('tbl_item_management', $new_data2);
			$air_cleaner_part_id = $res->id;
		}

		$kit_assy_part_no = $this->input->post('kit_assy_part_no');
		$results = $this->get_single_item_number($kit_assy_part_no);

		$new_data3 = array(
			'item_no' => $kit_assy_part_no,
			'description' => $this->input->post('kit_assy_description')
		);

		if (empty($results)) {
			$new_data3['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_item_management', $new_data3);
			$kit_assy_part_id = $this->db->insert_id();
		} else {
			$this->db->where('id', $results->id);
			$this->db->update('tbl_item_management', $new_data3);
			$kit_assy_part_id = $results->id;
		}

		$data = array(
			'finish_good_item_no'     => $this->input->post('finish_good_item_no'),
			'finish_good_description'     => $this->input->post('finish_good_description'),
			'fg_id'     => $last_id,
			'air_cleaner_part_no'     => $this->input->post('air_cleaner_part_no'),
			'air_cleaner_part_description'     => $this->input->post('air_cleaner_part_description'),
			'air_cleaner_part_id'     => $air_cleaner_part_id,
			'line_name_hsg_id'     => $this->input->post('line_name_hsg_id'),
			'cycle_time1'     => $this->input->post('cycle_time1'),
			'cycle_time2'     => $this->input->post('cycle_time2'),
			'change_over_time1'     => $this->input->post('change_over_time1'),
			'kit_assy_part_no'     => $this->input->post('kit_assy_part_no'),
			'kit_assy_description'     => $this->input->post('kit_assy_description'),
			'kit_assy_part_id'     => $kit_assy_part_id,
			'line_name_kit_id'     => $this->input->post('line_name_kit_id'),
			'change_over_time2'     => $this->input->post('change_over_time2'),
		);
		if ($this->input->post('id') == '') {
			$date = array(
				'created_on'        => date('Y-m-d H:i:s')
			);
			$newArr = array_merge($data, $date);
			$this->db->insert('tbl_part_master', $newArr);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_part_master', $data);
			return 0;
		}
	}*/

	public function set_part_master()
	{
		// Get the selected part type from the form
		$part_type = $this->input->post('part_type');

		// --- 1. Process the common Finish Good Item ---
		$finish_good_item_no = $this->input->post('finish_good_item_no');
		$fg_result = $this->get_single_item_number($finish_good_item_no);
		$fg_data = [
			'item_no' => $finish_good_item_no,
			'description' => $this->input->post('finish_good_description')
		];

		if (empty($fg_result)) {
			$fg_data['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_item_management', $fg_data);
			$fg_id = $this->db->insert_id();
		} else {
			$this->db->where('id', $fg_result->id);
			$this->db->update('tbl_item_management', $fg_data);
			$fg_id = $fg_result->id;
		}

		// --- 2. Initialize variables for both part types ---
		$air_cleaner_part_no = null;
		$air_cleaner_part_description = null;
		$air_cleaner_part_id = null;
		$line_name_hsg_id = null;
		$cycle_time1 = null;
		$change_over_time1 = null;

		$kit_assy_part_no = null;
		$kit_assy_description = null;
		$kit_assy_part_id = null;
		$line_name_kit_id = null;
		$cycle_time2 = null;
		$change_over_time2 = null;

		// --- 3. Conditionally process data based on Part Type ---
		if ($part_type === 'air_cleaner') {
			$air_cleaner_part_no = $this->input->post('air_cleaner_part_no');
			$air_cleaner_part_description = $this->input->post('air_cleaner_part_description');
			$line_name_hsg_id = $this->input->post('line_name_hsg_id');
			$cycle_time1 = $this->input->post('cycle_time1');
			$change_over_time1 = $this->input->post('change_over_time1');

			$ac_result = $this->get_single_item_number($air_cleaner_part_no);
			$ac_data = [
				'item_no' => $air_cleaner_part_no,
				'description' => $air_cleaner_part_description
			];

			if (empty($ac_result)) {
				$ac_data['created_on'] = date('Y-m-d H:i:s');
				$this->db->insert('tbl_item_management', $ac_data);
				$air_cleaner_part_id = $this->db->insert_id();
			} else {
				$this->db->where('id', $ac_result->id);
				$this->db->update('tbl_item_management', $ac_data);
				$air_cleaner_part_id = $ac_result->id;
			}
		} elseif ($part_type === 'kit_assy') {
			$air_cleaner_part_no = $this->input->post('kit_assy_part_no');
			$air_cleaner_part_description = $this->input->post('kit_assy_description');
			$line_name_hsg_id = $this->input->post('line_name_kit_id');
			$cycle_time1 = $this->input->post('cycle_time2');
			$change_over_time1 = $this->input->post('change_over_time2');

			$ka_result = $this->get_single_item_number($air_cleaner_part_no);
			$ka_data = [
				'item_no' => $air_cleaner_part_no,
				'description' => $air_cleaner_part_description
			];

			if (empty($ka_result)) {
				$ka_data['created_on'] = date('Y-m-d H:i:s');
				$this->db->insert('tbl_item_management', $ka_data);
				$air_cleaner_part_id = $this->db->insert_id();
			} else {
				$this->db->where('id', $ka_result->id);
				$this->db->update('tbl_item_management', $ka_data);
				$air_cleaner_part_id = $ka_result->id;
			}
		}

		// --- 4. Build the final data array for tbl_part_master ---
		$data = [
			'part_type'     		=> $this->input->post('part_type'),
			'finish_good_item_no'     => $finish_good_item_no,
			'finish_good_description' => $this->input->post('finish_good_description'),
			'fg_id'                   => $fg_id,
			'air_cleaner_part_no'     => $air_cleaner_part_no,
			'air_cleaner_part_description' => $air_cleaner_part_description,
			'air_cleaner_part_id'     => $air_cleaner_part_id,
			'line_name_hsg_id'        => $line_name_hsg_id,
			'cycle_time1'             => $cycle_time1,
			'change_over_time1'       => $change_over_time1,
			'kit_assy_part_no'        => $kit_assy_part_no,
			'kit_assy_description'    => $kit_assy_description,
			'kit_assy_part_id'        => $kit_assy_part_id,
			'line_name_kit_id'        => $line_name_kit_id,
			'cycle_time2'             => $cycle_time2,
			'change_over_time2'       => $change_over_time2,
		];

		// --- 5. Insert or Update the record ---
		if ($this->input->post('id') == '') {
			$data['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_part_master', $data);
			return 1;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_part_master', $data);
			return 0;
		}
	}
	public function get_single_part_master()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_part_master');
		return $result->row();
	}

	public function get_all_part_master_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_part_master.*,tbl_line.line_name');
		$this->db->from('tbl_part_master');
		$this->db->join('tbl_line', 'tbl_line.id = tbl_part_master.line_name_hsg_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_part_master.finish_good_item_no', $search);
			$this->db->or_like('tbl_part_master.finish_good_description', $search);
			$this->db->or_like('tbl_part_master.air_cleaner_part_no', $search);
			$this->db->or_like('tbl_part_master.air_cleaner_part_description', $search);
			$this->db->or_like('tbl_part_master.line_name_hsg_id', $search);
			$this->db->or_like('tbl_part_master.cycle_time1', $search);
			$this->db->or_like('tbl_part_master.cycle_time2', $search);
			$this->db->or_like('tbl_part_master.change_over_time1', $search);
			$this->db->or_like('tbl_part_master.kit_assy_part_no', $search);
			$this->db->or_like('tbl_part_master.kit_assy_description', $search);
			$this->db->or_like('tbl_part_master.line_name_kit_id', $search);
			$this->db->or_like('tbl_part_master.change_over_time2', $search);
			$this->db->or_like('tbl_line.line_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_part_master.is_deleted', '0');
		$this->db->order_by('tbl_part_master.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_part_master_list_ajax_count($search = '')
	{
		$this->db->select('tbl_part_master.*,tbl_line.line_name');
		$this->db->from('tbl_part_master');
		$this->db->join('tbl_line', 'tbl_line.id = tbl_part_master.line_name_hsg_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_part_master.finish_good_item_no', $search);
			$this->db->or_like('tbl_part_master.finish_good_description', $search);
			$this->db->or_like('tbl_part_master.air_cleaner_part_no', $search);
			$this->db->or_like('tbl_part_master.air_cleaner_part_description', $search);
			$this->db->or_like('tbl_part_master.line_name_hsg_id', $search);
			$this->db->or_like('tbl_part_master.cycle_time1', $search);
			$this->db->or_like('tbl_part_master.cycle_time2', $search);
			$this->db->or_like('tbl_part_master.change_over_time1', $search);
			$this->db->or_like('tbl_part_master.kit_assy_part_no', $search);
			$this->db->or_like('tbl_part_master.kit_assy_description', $search);
			$this->db->or_like('tbl_part_master.line_name_kit_id', $search);
			$this->db->or_like('tbl_part_master.change_over_time2', $search);
			$this->db->or_like('tbl_line.line_name', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_part_master.is_deleted', '0');
		$this->db->order_by('tbl_part_master.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}

	public function get_all_item_numbers()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('tbl_item_management');
		return $result->result();
	}

	public function get_all_item_types()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->order_by('tbl_item.id', 'DESC');
		$result = $this->db->get('tbl_item');
		return $result->result();
	}

	public function get_all_uom()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->order_by('tbl_unit.id', 'DESC');
		$result = $this->db->get('tbl_unit');
		return $result->result();
	}

	public function get_all_descriptions()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('id', $this->input->post('item_id'));
		$result = $this->db->get('tbl_item_management');
		echo json_encode($result->result());
	}

	// jayesh 26-5-25

	public function get_all_site_data()
	{
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_site');
		return $result->result();
	}
	public function get_all_type_of_goods_data()
	{
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_good_type');
		return $result->result();
	}

	public function get_all_countries()
	{
		$this->db->order_by('name', 'ASC');
		$result = $this->db->get('countries');
		return $result->result();
	}
	public function get_all_state()
	{
		$country_id = $this->input->post('country_id');
		$this->db->where('country_id', $country_id);
		$result = $this->db->get('states');
		echo json_encode($result->result());
	}
	public function get_city($state_id)
	{

		$this->db->where('state_id', $state_id);
		$result = $this->db->get('cities');
		return $result->result();
	}

	public function get_all_cities()
	{
		$state_id = $this->input->post('state_id');

		$this->db->where('state_id', $state_id);
		$result = $this->db->get('cities');
		echo json_encode($result->result());
	}
	public function get_states($country_id)
	{

		$this->db->where('country_id', $country_id);
		$result = $this->db->get('states');
		return $result->result();
	}

	public function set_supplier_data()
	{
		$data = array(
			'supplier_name'        => $this->input->post('supplier_name'),
			'site_id'              => $this->input->post('site_id'),
			'address_line1'        => $this->input->post('address_line1'),
			'address_line2'        => $this->input->post('address_line2'),
			'address_line3'        => $this->input->post('address_line3'),
			'country_id'           => $this->input->post('country_id'),
			'state_id'             => $this->input->post('state_id'),
			'city_id'              => $this->input->post('city_id'),
			'pin_code'             => $this->input->post('pin_code'),
			'type_of_good_id'      => $this->input->post('type_of_good_id'),
			'last_name'            => $this->input->post('last_name'),
			'first_name'           => $this->input->post('first_name'),
			'contact_no_1'         => $this->input->post('contact_no_1'),
			'contact_no_2'         => $this->input->post('contact_no_2'),
			'email'              => $this->input->post('email'),
			'email_1'              => $this->input->post('email_1'),
			'email_2'              => $this->input->post('email_2'),
			'email_3'              => $this->input->post('email_3'),

		);


		if ($this->input->post('id') == "") {
			$date = array('created_on'    => date("Y-m-d H:i:s"));
			$new_arr = array_merge($data, $date);

			$this->db->insert('tbl_supplier_management', $new_arr);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));

			$this->db->update('tbl_supplier_management', $data);
			return 1;
		}
	}

	public function get_single_supplier_data()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_supplier_management');
		return $result->row();
	}
	public function get_all_supplier_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_supplier_management.*, tbl_site.site_name,tbl_good_type.good_type_name,countries.name AS country_name, states.name AS state_name, cities.name AS city_name');
		$this->db->from('tbl_supplier_management');
		$this->db->join('tbl_site', 'tbl_site.id = tbl_supplier_management.site_id', 'left');
		$this->db->join('tbl_good_type', 'tbl_good_type.id = tbl_supplier_management.type_of_good_id', 'left');
		$this->db->join('countries', 'countries.id = tbl_supplier_management.country_id', 'left');
		$this->db->join('states', 'states.id = tbl_supplier_management.state_id', 'left');
		$this->db->join('cities', 'cities.id = tbl_supplier_management.city_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_supplier_management.supplier_name', $search);
			$this->db->or_like('tbl_site.site_name', $search);
			$this->db->or_like('tbl_supplier_management.address_line1', $search);
			$this->db->or_like('tbl_supplier_management.address_line2', $search);
			$this->db->or_like('tbl_supplier_management.address_line3', $search);
			$this->db->or_like('countries.country_name', $search);
			$this->db->or_like('states.state_name', $search);
			$this->db->or_like('cities.city_name', $search);
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->or_like('tbl_supplier_management.pin_code', $search);
			$this->db->or_like('tbl_supplier_management.last_name', $search);
			$this->db->or_like('tbl_supplier_management.first_name', $search);
			$this->db->or_like('tbl_supplier_management.contact_no_1', $search);
			$this->db->or_like('tbl_supplier_management.contact_no_2', $search);
			$this->db->or_like('tbl_supplier_management.email', $search);
			$this->db->or_like('tbl_supplier_management.email_1', $search);
			$this->db->or_like('tbl_supplier_management.email_2', $search);
			$this->db->or_like('tbl_supplier_management.email_3', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_supplier_management.is_deleted', '0');
		$this->db->order_by('tbl_supplier_management.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_supplier_list_ajax_count($search = '')
	{
		$this->db->select('tbl_supplier_management.*, tbl_site.site_name,tbl_good_type.good_type_name,countries.name AS country_name, states.name AS state_name, cities.name AS city_name');
		$this->db->from('tbl_supplier_management');
		$this->db->join('tbl_site', 'tbl_site.id = tbl_supplier_management.site_id', 'left');
		$this->db->join('tbl_good_type', 'tbl_good_type.id = tbl_supplier_management.type_of_good_id', 'left');
		$this->db->join('countries', 'countries.id = tbl_supplier_management.country_id', 'left');
		$this->db->join('states', 'states.id = tbl_supplier_management.state_id', 'left');
		$this->db->join('cities', 'cities.id = tbl_supplier_management.city_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_supplier_management.supplier_name', $search);
			$this->db->or_like('tbl_site.site_name', $search);
			$this->db->or_like('tbl_supplier_management.address_line1', $search);
			$this->db->or_like('tbl_supplier_management.address_line2', $search);
			$this->db->or_like('tbl_supplier_management.address_line3', $search);
			$this->db->or_like('countries.country_name', $search);
			$this->db->or_like('states.state_name', $search);
			$this->db->or_like('cities.city_name', $search);
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->or_like('tbl_supplier_management.pin_code', $search);
			$this->db->or_like('tbl_supplier_management.last_name', $search);
			$this->db->or_like('tbl_supplier_management.first_name', $search);
			$this->db->or_like('tbl_supplier_management.contact_no_1', $search);
			$this->db->or_like('tbl_supplier_management.contact_no_2', $search);
			$this->db->or_like('tbl_supplier_management.email', $search);
			$this->db->or_like('tbl_supplier_management.email_1', $search);
			$this->db->or_like('tbl_supplier_management.email_2', $search);
			$this->db->or_like('tbl_supplier_management.email_3', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_supplier_management.is_deleted', '0');
		$this->db->order_by('tbl_supplier_management.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}



	public function get_all_supplier_data()
	{
		$this->db->where('is_deleted', '0');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('tbl_supplier_management');
		return $result->result();
	}

	public function get_single_item_data()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_item_management');
		return $result->row();
	}

	public function set_item_data()
	{
		$data = array(
			'item_no'        => $this->input->post('item_no'),
			'description'              => $this->input->post('description'),
			'supplier_1'        => $this->input->post('supplier_1'),
			'supplier_1_sob'        => $this->input->post('supplier_1_sob'),
			'supplier_2'        => $this->input->post('supplier_2'),
			'supplier_2_sob'           => $this->input->post('supplier_2_sob'),
			'supplier_3'             => $this->input->post('supplier_3'),
			'supplier_3_sob'               => $this->input->post('supplier_3_sob'),
			'supplier_4'               => $this->input->post('supplier_4'),
			'supplier_4_sob'      => $this->input->post('supplier_4_sob'),
			'supplier_5'            => $this->input->post('supplier_5'),
			'supplier_5_sob'           => $this->input->post('supplier_5_sob'),
		);


		if ($this->input->post('id') == "") {
			$date = array('created_on'    => date("Y-m-d H:i:s"));
			$new_arr = array_merge($data, $date);

			$this->db->insert('tbl_item_management', $new_arr);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));

			$this->db->update('tbl_item_management', $data);
			return 1;
		}
	}

	public function get_all_item_management_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('
        tbl_item_management .*,
        sm1.supplier_name as one,
        sm2.supplier_name as two,
        sm3.supplier_name as three,
        sm4.supplier_name as four,
        sm5.supplier_name as five,
    ');
		$this->db->from('tbl_item_management');
		$this->db->join('tbl_supplier_management as sm1', 'sm1.id = tbl_item_management.supplier_1', 'left');
		$this->db->join('tbl_supplier_management as sm2', 'sm2.id = tbl_item_management.supplier_2', 'left');
		$this->db->join('tbl_supplier_management as sm3', 'sm3.id = tbl_item_management.supplier_3', 'left');
		$this->db->join('tbl_supplier_management as sm4', 'sm4.id = tbl_item_management.supplier_4', 'left');
		$this->db->join('tbl_supplier_management as sm5', 'sm5.id = tbl_item_management.supplier_5', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_item_management.item_no', $search);
			$this->db->or_like('tbl_item_management.description', $search);
			$this->db->or_like('tbl_item_management.supplier_1_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_2_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_3_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_4_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_5_sob', $search);
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->or_like('sm1.supplier_1_sob', $search);
			$this->db->or_like('sm2.supplier_2_sob', $search);
			$this->db->or_like('sm3.supplier_3_sob', $search);
			$this->db->or_like('sm4.supplier_4_sob', $search);
			$this->db->or_like('sm5.supplier_5_sob', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_item_management.is_deleted', '0');
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}

	public function get_all_item_management_list_ajax_count($search = '')
	{
		$this->db->select('
        tbl_item_management .*,
        sm1.supplier_name as one,
        sm2.supplier_name as two,
        sm3.supplier_name as three,
        sm4.supplier_name as four,
        sm5.supplier_name as five,
    ');
		$this->db->from('tbl_item_management');
		$this->db->join('tbl_supplier_management as sm1', 'sm1.id = tbl_item_management.supplier_1', 'left');
		$this->db->join('tbl_supplier_management as sm2', 'sm2.id = tbl_item_management.supplier_2', 'left');
		$this->db->join('tbl_supplier_management as sm3', 'sm3.id = tbl_item_management.supplier_3', 'left');
		$this->db->join('tbl_supplier_management as sm4', 'sm4.id = tbl_item_management.supplier_4', 'left');
		$this->db->join('tbl_supplier_management as sm5', 'sm5.id = tbl_item_management.supplier_5', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_item_management.item_no', $search);
			$this->db->or_like('tbl_item_management.description', $search);
			$this->db->or_like('tbl_item_management.supplier_1_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_2_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_3_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_4_sob', $search);
			$this->db->or_like('tbl_item_management.supplier_5_sob', $search);
			$this->db->or_like('tbl_good_type.good_type_name', $search);
			$this->db->or_like('sm1.supplier_1_sob', $search);
			$this->db->or_like('sm2.supplier_2_sob', $search);
			$this->db->or_like('sm3.supplier_3_sob', $search);
			$this->db->or_like('sm4.supplier_4_sob', $search);
			$this->db->or_like('sm5.supplier_5_sob', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_item_management.is_deleted', '0');
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}


	public function get_all_bom_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_add_bom.*, im1.item_no, im2.description, tbl_item.item_name, tbl_unit.unit_name');
		$this->db->from('tbl_add_bom');
		$this->db->join('tbl_item_management as im1', 'im1.id = tbl_add_bom.item_no_id', 'left');
		$this->db->join('tbl_item_management as im2', 'im2.id = tbl_add_bom.item_desc_id', 'left');
		$this->db->join('tbl_item', 'tbl_item.id = tbl_add_bom.item_type_id', 'left');
		$this->db->join('tbl_unit', 'tbl_unit.id = tbl_add_bom.uom_id', 'left');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_add_bom.finish_good_item_id', $search);
			$this->db->or_like('tbl_add_bom.fg_item_description', $search);
			$this->db->or_like('im1.item_no', $search);
			$this->db->or_like('im2.item_desc_id', $search);
			$this->db->or_like('tbl_add_bom.item_level', $search);
			$this->db->or_like('tbl_add_bom.revision', $search);
			$this->db->or_like('tbl_item.item_name', $search);
			$this->db->or_like('tbl_add_bom.item_status', $search);
			$this->db->or_like('tbl_unit.unit_name', $search);
			$this->db->or_like('tbl_add_bom.qty', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_add_bom.is_deleted', '0');
		$this->db->order_by('tbl_add_bom.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_bom_list_ajax_count($search = '')
	{

		$this->db->select('tbl_add_bom.*, im1.item_no, im2.description, tbl_item.item_name, tbl_unit.unit_name');
		$this->db->from('tbl_add_bom');
		$this->db->join('tbl_item_management as im1', 'im1.id = tbl_add_bom.item_no_id', 'left');
		$this->db->join('tbl_item_management as im2', 'im2.id = tbl_add_bom.item_desc_id', 'left');
		$this->db->join('tbl_item', 'tbl_item.id = tbl_add_bom.item_type_id', 'left');
		$this->db->join('tbl_unit', 'tbl_unit.id = tbl_add_bom.uom_id', 'left');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_add_bom.finish_good_item_id', $search);
			$this->db->or_like('tbl_add_bom.fg_item_description', $search);
			$this->db->or_like('im1.item_no', $search);
			$this->db->or_like('im2.item_desc_id', $search);
			$this->db->or_like('tbl_add_bom.item_level', $search);
			$this->db->or_like('tbl_add_bom.revision', $search);
			$this->db->or_like('tbl_item.item_name', $search);
			$this->db->or_like('tbl_add_bom.item_status', $search);
			$this->db->or_like('tbl_unit.unit_name', $search);
			$this->db->or_like('tbl_add_bom.qty', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_add_bom.is_deleted', '0');
		$this->db->order_by('tbl_add_bom.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}

	public function set_bom_master()
	{

		$finish_good_item_id = $this->input->post('finish_good_item_id');
		$result = $this->get_single_item_number($finish_good_item_id);

		$new_data = array(
			'item_no' => $finish_good_item_id,
			'description' => $this->input->post('item_description')
		);

		if (empty($result)) {
			$new_data['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_item_management', $new_data);
			$last_id = $this->db->insert_id();
		} else {
			$last_id = $result->id;
		}

		$data = array(
			'finish_good_item_id' => $last_id,

			'fg_item_description' => $this->input->post('item_description'),

			'item_no_id' => $this->input->post('item_id'),
			'item_desc_id' => $this->input->post('item_desc'),
			'item_level' => $this->input->post('item_no'),
			'revision' => $this->input->post('revision'),
			'item_type_id' => $this->input->post('item_type_id'),
			'item_status' => $this->input->post('status'),
			'uom_id' => $this->input->post('uom_id'),
			'qty' => $this->input->post('qty'),

		);
		if (empty($this->input->post('id'))) {
			$data['created_on'] = date('Y-m-d H:i:s');
			$this->db->insert('tbl_add_bom', $data);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_add_bom', $data);
			return 1;
		}
	}

	public function get_single_item_number($finish_good_item_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_no', $finish_good_item_id);
		$result = $this->db->get('tbl_item_management');
		return $result->row();
	}

	public function get_single_bom_data()
	{
		$this->db->select('tbl_add_bom.*,tbl_item_management.item_no');
		$this->db->from('tbl_add_bom');
		$this->db->where('tbl_add_bom.id', $this->uri->segment(2));
		$this->db->where('tbl_add_bom.is_deleted', '0');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_add_bom.finish_good_item_id', 'left');
		$result = $this->db->get('');
		return $result->row();
	}
	public function get_all_fg_list_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_add_fg.*');
		$this->db->from('tbl_add_fg');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_add_fg.finish_good_item', $search);
			$this->db->or_like('tbl_add_fg.item_description', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_add_fg.is_deleted', '0');
		$this->db->order_by('tbl_add_fg.id', 'DESC');
		$result = $this->db->get('');
		return $result->result();
	}
	public function get_all_fg_list_ajax_count($search = '')
	{
		$this->db->select('tbl_add_fg.*');
		$this->db->from('tbl_add_fg');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_add_fg.finish_good_item', $search);
			$this->db->or_like('tbl_add_fg.item_description', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_add_fg.is_deleted', '0');
		$this->db->order_by('tbl_add_fg.id', 'DESC');
		$result = $this->db->get('');
		return $result->num_rows();
	}

	public function get_single_fg_data()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_add_fg');
		return $result->row();
	}

	public function set_fg_data()
	{
		$data = array(
			'finish_good_item'        => $this->input->post('finish_good_item'),
			'item_description'              => $this->input->post('item_description'),
		);
		if ($this->input->post('id') == "") {
			$date = array('created_on'    => date("Y-m-d H:i:s"));
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_add_fg', $new_arr);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_add_fg', $data);
			return 1;
		}
	}

	public function check_unique_finish_good_item()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('finish_good_item', $this->input->post('finish_good_item'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_add_fg')->row();

		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_item_description()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_description', $this->input->post('item_description'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_add_fg')->row();

		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function get_all_fg_items()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->order_by('tbl_add_fg.id', 'DESC');
		$result = $this->db->get('tbl_add_fg');
		return $result->result();
	}
	public function get_all_finish_good_item_descriptions()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('item_no', $this->input->post('finish_good_item_id'));
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('tbl_item_management');
		echo json_encode($result->result());
	}

	public function get_finish_good_item_description()
	{

		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('id', $this->input->post('finish_good_item_id'));
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('tbl_item_management');
		echo json_encode($result->result());
	}
	public function get_item_id($item_code, $description)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_no', $item_code);
		$result = $this->db->get('tbl_item_management');
		$result = $result->row();

		if (empty($result)) {
			$data = array(
				'item_no' => $item_code,
				'description' => $description,
				'created_on'    => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_item_management', $data);
			return $this->db->insert_id();
		} else {
			return $result->id;
		}
	}
	public function get_unit_id($uom)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('unit_name', $uom);
		$result = $this->db->get('tbl_unit');
		$result = $result->row();

		if (empty($result)) {
			$data = array(
				'unit_name' => $uom,
				'created_on'    => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_unit', $data);
			return $this->db->insert_id();
		} else {
			return $result->id;
		}
	}
	public function get_type_id($type)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_name', $type);
		$result = $this->db->get('tbl_item');
		$result = $result->row();

		if (empty($result)) {
			$data = array(
				'item_name' => $type,
				'created_on'    => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_item', $data);
			return $this->db->insert_id();
		} else {
			return $result->id;
		}
	}
	public function set_bom_by_excel($data)
	{
		if (!empty($data)) {
			$inserted_rows = 0;
			$errors = [];

			foreach ($data as $parent) {

				// Extract parent item details
				$finish_good_item_id = $parent['parent_item_id'] ?? null;
				$fg_item_description = $parent['parent_item_description'] ?? '';

				// Validate parent item
				if (empty($finish_good_item_id)) {
					$errors[] = "Skipping parent item with missing ID at index {$parent['parent_item_id']}";
					continue;
				}

				// Process each submaterial
				foreach ($parent['submaterial'] as $submaterial) {
					// Map submaterial fields to database columns
					$bom_data = [
						'finish_good_item_id' => $finish_good_item_id,
						'fg_item_description' => $fg_item_description,
						'item_no_id' => $submaterial['item_id'] ?? null,
						'item_desc_id' => $submaterial['description'] ?? '',
						'item_level' => $submaterial['level'] ?? null,
						'revision' => $submaterial['revision'] ?? '',
						'item_type_id' => $submaterial['type_id'] ?? '',
						'item_status' => $submaterial['status'] ?? '',
						'uom_id' => $submaterial['unit_id'] ?? '',
						'qty' => $submaterial['quantity'] ?? 0,
						'created_on'    => date("Y-m-d H:i:s")
					];

					// Validate required fields
					if (empty($bom_data['item_no_id']) || empty($bom_data['item_level'])) {
						$errors[] = "Skipping submaterial with missing item_code or level for parent {$finish_good_item_id}";
						continue;
					}

					// Insert into database
					try {
						$this->db->insert('tbl_add_bom', $bom_data);
						$inserted_rows++;
					} catch (Exception $e) {
						$errors[] = "Error inserting submaterial {$bom_data['item_no_id']} for parent {$finish_good_item_id}: " . $e->getMessage();
					}
				}
			}

			// Prepare response
			// $response = [
			// 	'status' => empty($errors) ? 'success' : 'partial_success',
			// 	'message' => empty($errors) ? "Successfully inserted {$inserted_rows} rows." : "Inserted {$inserted_rows} rows with " . count($errors) . " errors.",
			// 	'errors' => $errors
			// ];

			// Output response for debugging
			return 1;
		} else {
			return 0;
		}
	}
	public function get_bom_fg_name($fg_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $fg_id);
		$result = $this->db->get('tbl_item_management');
		$result = $result->row();
		$item_code = '';
		if (!empty($result)) {
			$item_code = $result->item_no;
		}
		return $item_code;
	}
	public function get_uploaded_report_details_single($id)
	{
		$this->db->where('report_number', $id);
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_report');
		return $result->row();
	}
	public function get_uploaded_report_details()
	{
		$this->db->where('report_number', $this->uri->segment(2));
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_report');
		return $result->row();
	}
	public function get_uploaded_order_report_data()
	{
		$this->db->select('tbl_order_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_order_report.status', '1');
		$this->db->where('tbl_order_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_order_report.report_id');
		$this->db->limit(20);
		$result = $this->db->get('tbl_order_report');
		return $result->result();
	}
	public function get_uploaded_inventory_report_data()
	{
		$this->db->select('tbl_inventory_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_inventory_report.status', '1');
		$this->db->where('tbl_inventory_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_inventory_report.report_id');
		$this->db->limit(20);
		$result = $this->db->get('tbl_inventory_report');
		return $result->result();
	}
	public function get_uploaded_mto_order_report_data()
	{
		$this->db->select('tbl_mto_order_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_mto_order_report.status', '1');
		$this->db->where('tbl_mto_order_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_mto_order_report.report_id');
		$this->db->limit(20);
		$result = $this->db->get('tbl_mto_order_report');
		return $result->result();
	}
	public function get_uploaded_trigger_report_data()
	{
		$this->db->select('tbl_trigger_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_trigger_report.status', '1');
		$this->db->where('tbl_trigger_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_trigger_report.report_id');
		$this->db->limit(20);
		$result = $this->db->get('tbl_trigger_report');
		return $result->result();
	}
	public function get_uploaded_order_report_count()
	{
		$this->db->select('tbl_order_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_order_report.status', '1');
		$this->db->where('tbl_order_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_order_report.report_id');
		$result = $this->db->get('tbl_order_report');
		return $result->num_rows();
	}
	public function get_uploaded_inventory_report_count()
	{
		$this->db->select('tbl_inventory_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_inventory_report.status', '1');
		$this->db->where('tbl_inventory_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_inventory_report.report_id');
		$result = $this->db->get('tbl_inventory_report');
		return $result->num_rows();
	}
	public function get_uploaded_mto_order_report_count()
	{
		$this->db->select('tbl_mto_order_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_mto_order_report.status', '1');
		$this->db->where('tbl_mto_order_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_mto_order_report.report_id');
		$result = $this->db->get('tbl_mto_order_report');
		return $result->num_rows();
	}
	public function get_uploaded_trigger_report_count()
	{
		$this->db->select('tbl_trigger_report.*, tbl_report.report_number');
		$this->db->where('tbl_report.report_number', $this->uri->segment(2));
		$this->db->where('tbl_trigger_report.status', '1');
		$this->db->where('tbl_trigger_report.is_deleted', '0');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_trigger_report.report_id');
		$result = $this->db->get('tbl_trigger_report');
		return $result->num_rows();
	}

	public function get_all_order_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [], $order_number = '')
	{
		$this->db->select('tbl_order_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_order_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return [];
		}
		$this->db->where('tbl_order_report.status', '1');
		$this->db->where('tbl_order_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_order_report.category', $search);
			$this->db->or_like('tbl_order_report.sub_line', $search);
			$this->db->or_like('tbl_order_report.ffpl_item_number', $search);
			$this->db->or_like('tbl_order_report.ffpl_item_description', $search);
			$this->db->or_like('tbl_order_report.customer_item_number', $search);
			$this->db->or_like('tbl_order_report.customer_item_description', $search);
			$this->db->or_like('tbl_order_report.customer_name', $search);
			$this->db->or_like('tbl_order_report.pack_size', $search);
			$this->db->or_like('tbl_order_report.green_level', $search);
			$this->db->or_like('tbl_order_report.actual_on_hand', $search);
			$this->db->or_like('tbl_order_report.reservation', $search);
			$this->db->or_like('tbl_order_report.intransit', $search);
			$this->db->or_like('tbl_order_report.gap_qty', $search);
			$this->db->or_like('tbl_order_report.penetration_in_percentage', $search);
			$this->db->or_like('tbl_order_report.priority_mark', $search);
			$this->db->or_like('tbl_order_report.plant_onhand', $search);
			$this->db->or_like('tbl_order_report.actual_gap', $search);
			$this->db->group_end();
		}
		if (!empty($sorters)) {
			foreach ($sorters as $sorter) {
				$field = $sorter['field'];
				$dir = $sorter['dir'] == 'asc' ? 'ASC' : 'DESC';
				$this->db->order_by($field, $dir);
			}
		}
		//$this->db->limit($length, $start);

		$result = $this->db->get('tbl_order_report');
		return $result->result();
	}

	public function get_all_order_report_data_ajax_count($search = '', $order_number = '')
	{
		$this->db->select('tbl_order_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_order_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return 0;
		}

		$this->db->where('tbl_order_report.status', '1');
		$this->db->where('tbl_order_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_order_report.category', $search);
			$this->db->or_like('tbl_order_report.sub_line', $search);
			$this->db->or_like('tbl_order_report.ffpl_item_number', $search);
			$this->db->or_like('tbl_order_report.ffpl_item_description', $search);
			$this->db->or_like('tbl_order_report.customer_item_number', $search);
			$this->db->or_like('tbl_order_report.customer_item_description', $search);
			$this->db->or_like('tbl_order_report.customer_name', $search);
			$this->db->or_like('tbl_order_report.pack_size', $search);
			$this->db->or_like('tbl_order_report.green_level', $search);
			$this->db->or_like('tbl_order_report.actual_on_hand', $search);
			$this->db->or_like('tbl_order_report.reservation', $search);
			$this->db->or_like('tbl_order_report.intransit', $search);
			$this->db->or_like('tbl_order_report.gap_qty', $search);
			$this->db->or_like('tbl_order_report.penetration_in_percentage', $search);
			$this->db->or_like('tbl_order_report.priority_mark', $search);
			$this->db->or_like('tbl_order_report.plant_onhand', $search);
			$this->db->or_like('tbl_order_report.actual_gap', $search);
			$this->db->group_end();
		}
		$result = $this->db->get('tbl_order_report');
		return $result->num_rows();
	}
	public function get_all_mto_order_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [], $order_number = '')
	{
		$this->db->select('tbl_mto_order_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_mto_order_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return [];
		}
		$this->db->where('tbl_mto_order_report.status', '1');
		$this->db->where('tbl_mto_order_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_mto_order_report.organization_name', $search);
			$this->db->or_like('tbl_mto_order_report.order_category', $search);
			$this->db->or_like('tbl_mto_order_report.sales_order_number', $search);
			$this->db->or_like('tbl_mto_order_report.version_no', $search);
			$this->db->or_like('tbl_mto_order_report.last_update_date', $search);
			$this->db->or_like('tbl_mto_order_report.ir_preparer_name', $search);
			$this->db->or_like('tbl_mto_order_report.customer_name', $search);
			$this->db->or_like('tbl_mto_order_report.line_entry_date', $search);
			$this->db->or_like('tbl_mto_order_report.customer_part_no', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_no', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_no_id', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_description', $search);
			$this->db->or_like('tbl_mto_order_report.category_code', $search);
			$this->db->or_like('tbl_mto_order_report.need_by_date', $search);
			$this->db->or_like('tbl_mto_order_report.order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.pending_order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.plant_on_hand_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.value', $search);
			$this->db->or_like('tbl_mto_order_report.time_buffer_penetration', $search);
			$this->db->or_like('tbl_mto_order_report.mfg_start_date', $search);
			$this->db->or_like('tbl_mto_order_report.original_request_date', $search);
			$this->db->or_like('tbl_mto_order_report.original_request_dates', $search);
			$this->db->or_like('tbl_mto_order_report.spike_order_resaon', $search);
			$this->db->or_like('tbl_mto_order_report.open_job_order_qty', $search);
			$this->db->or_like('tbl_mto_order_report.net_pending_order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.order_type', $search);
			$this->db->group_end();
		}
		if (!empty($sorters)) {
			foreach ($sorters as $sorter) {
				$field = $sorter['field'];
				$dir = $sorter['dir'] == 'asc' ? 'ASC' : 'DESC';
				$this->db->order_by($field, $dir);
			}
		}
		//$this->db->limit($length, $start);

		$result = $this->db->get('tbl_mto_order_report');
		return $result->result();
	}

	public function get_all_mto_order_report_data_ajax_count($search = '', $order_number = '')
	{
		$this->db->select('tbl_mto_order_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_mto_order_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return 0;
		}

		$this->db->where('tbl_mto_order_report.status', '1');
		$this->db->where('tbl_mto_order_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_mto_order_report.organization_name', $search);
			$this->db->or_like('tbl_mto_order_report.order_category', $search);
			$this->db->or_like('tbl_mto_order_report.sales_order_number', $search);
			$this->db->or_like('tbl_mto_order_report.version_no', $search);
			$this->db->or_like('tbl_mto_order_report.last_update_date', $search);
			$this->db->or_like('tbl_mto_order_report.ir_preparer_name', $search);
			$this->db->or_like('tbl_mto_order_report.customer_name', $search);
			$this->db->or_like('tbl_mto_order_report.line_entry_date', $search);
			$this->db->or_like('tbl_mto_order_report.customer_part_no', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_no', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_no_id', $search);
			$this->db->or_like('tbl_mto_order_report.ff_part_description', $search);
			$this->db->or_like('tbl_mto_order_report.category_code', $search);
			$this->db->or_like('tbl_mto_order_report.need_by_date', $search);
			$this->db->or_like('tbl_mto_order_report.order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.pending_order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.plant_on_hand_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.value', $search);
			$this->db->or_like('tbl_mto_order_report.time_buffer_penetration', $search);
			$this->db->or_like('tbl_mto_order_report.mfg_start_date', $search);
			$this->db->or_like('tbl_mto_order_report.original_request_date', $search);
			$this->db->or_like('tbl_mto_order_report.original_request_dates', $search);
			$this->db->or_like('tbl_mto_order_report.spike_order_resaon', $search);
			$this->db->or_like('tbl_mto_order_report.open_job_order_qty', $search);
			$this->db->or_like('tbl_mto_order_report.net_pending_order_quantity', $search);
			$this->db->or_like('tbl_mto_order_report.order_type', $search);
			$this->db->group_end();
		}
		$result = $this->db->get('tbl_mto_order_report');
		return $result->num_rows();
	}


	public function get_all_inventory_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [], $order_number = '')
	{
		$this->db->select('tbl_inventory_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_inventory_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return [];
		}
		$this->db->where('tbl_inventory_report.status', '1');
		$this->db->where('tbl_inventory_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_inventory_report.item', $search);
			$this->db->or_like('tbl_inventory_report.description', $search);
			$this->db->or_like('tbl_inventory_report.scrap', $search);
			$this->db->or_like('tbl_inventory_report.process_rej_scrap', $search);
			$this->db->or_like('tbl_inventory_report.shop_rm', $search);
			$this->db->or_like('tbl_inventory_report.shop_sa', $search);
			$this->db->or_like('tbl_inventory_report.osp', $search);
			$this->db->or_like('tbl_inventory_report.total_quantity', $search);
			$this->db->or_like('tbl_inventory_report.unit_cost', $search);
			$this->db->or_like('tbl_inventory_report.total_cost', $search);
			$this->db->or_like('tbl_inventory_report.max_quantity', $search);
			$this->db->or_like('tbl_inventory_report.on_hand', $search);
			$this->db->or_like('tbl_inventory_report.production_line', $search);
			$this->db->or_like('tbl_inventory_report.trading_flag', $search);
			$this->db->group_end();
		}
		if (!empty($sorters)) {
			foreach ($sorters as $sorter) {
				$field = $sorter['field'];
				$dir = $sorter['dir'] == 'asc' ? 'ASC' : 'DESC';
				$this->db->order_by($field, $dir);
			}
		}
		//$this->db->limit($length, $start);

		$result = $this->db->get('tbl_inventory_report');
		return $result->result();
	}

	public function get_all_inventory_report_data_ajax_count($search = '', $order_number = '')
	{
		$this->db->select('tbl_inventory_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_inventory_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return 0;
		}

		$this->db->where('tbl_inventory_report.status', '1');
		$this->db->where('tbl_inventory_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_inventory_report.item', $search);
			$this->db->or_like('tbl_inventory_report.description', $search);
			$this->db->or_like('tbl_inventory_report.scrap', $search);
			$this->db->or_like('tbl_inventory_report.process_rej_scrap', $search);
			$this->db->or_like('tbl_inventory_report.shop_rm', $search);
			$this->db->or_like('tbl_inventory_report.shop_sa', $search);
			$this->db->or_like('tbl_inventory_report.osp', $search);
			$this->db->or_like('tbl_inventory_report.total_quantity', $search);
			$this->db->or_like('tbl_inventory_report.unit_cost', $search);
			$this->db->or_like('tbl_inventory_report.total_cost', $search);
			$this->db->or_like('tbl_inventory_report.max_quantity', $search);
			$this->db->or_like('tbl_inventory_report.on_hand', $search);
			$this->db->or_like('tbl_inventory_report.production_line', $search);
			$this->db->or_like('tbl_inventory_report.trading_flag', $search);
			$this->db->group_end();
		}
		$result = $this->db->get('tbl_inventory_report');
		return $result->num_rows();
	}

	public function get_all_trigger_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [], $order_number = '')
	{
		$this->db->select('tbl_trigger_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_trigger_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return [];
		}
		$this->db->where('tbl_trigger_report.status', '1');
		$this->db->where('tbl_trigger_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_trigger_report.organization_name', $search);
			$this->db->or_like('tbl_trigger_report.item_no', $search);
			$this->db->or_like('tbl_trigger_report.description', $search);
			$this->db->or_like('tbl_trigger_report.vendor_name', $search);
			$this->db->or_like('tbl_trigger_report.vendor_site', $search);
			$this->db->group_end();
		}
		if (!empty($sorters)) {
			foreach ($sorters as $sorter) {
				$field = $sorter['field'];
				$dir = $sorter['dir'] == 'asc' ? 'ASC' : 'DESC';
				$this->db->order_by($field, $dir);
			}
		}
		//$this->db->limit($length, $start);

		$result = $this->db->get('tbl_trigger_report');
		return $result->result();
	}

	public function get_all_trigger_report_data_ajax_count($search = '', $order_number = '')
	{
		$this->db->select('tbl_trigger_report.*, tbl_report.report_number');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_trigger_report.report_id');
		if ($order_number != '') {
			$this->db->where('tbl_report.report_number', $order_number);
		} else {
			return 0;
		}

		$this->db->where('tbl_trigger_report.status', '1');
		$this->db->where('tbl_trigger_report.is_deleted', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_trigger_report.organization_name', $search);
			$this->db->or_like('tbl_trigger_report.item_no', $search);
			$this->db->or_like('tbl_trigger_report.description', $search);
			$this->db->or_like('tbl_trigger_report.vendor_name', $search);
			$this->db->or_like('tbl_trigger_report.vendor_site', $search);
			$this->db->group_end();
		}
		$result = $this->db->get('tbl_trigger_report');
		return $result->num_rows();
	}


	/*===================== AI Code ======================*/

	// Generate the BPR MTS shortage report
	private static $allocated_inventory = [];

	/**
	 * Generate the BPR MTS shortage report (optimized for memory and speed)
	 */
	public function set_bpr_mts_shortage_report()
	{
		// Do NOT reset self::$allocated_inventory, as it carries over from MTO
		error_log("set_bpr_mts_shortage_report: Starting, Allocated Inventory Count: " . count(self::$allocated_inventory));
		$report_id = $this->input->post('report_id');
		$report_number = $this->input->post('report_number');
		$now = date('Y-m-d H:i:s');

		// Fetch all records for this report
		$records = $this->db
			->where(['report_id' => $report_id, 'is_deleted' => '0', 'status' => '1'])
			->get('tbl_order_report')->result(); // Adjust table name as needed

		if (empty($records)) return 0;

		// --- Caching BOM and Inventory ---
		$fg_ids = array_unique(array_map(fn($r) => $r->ffpl_item_id, $records));
		$bom_cache = [];
		$inv_cache = [];

		// Cache BOMs
		$visited = [];
		foreach ($fg_ids as $fg_id) {
			$bom_fg_id = $this->get_bom_fg_id($fg_id);
			if (empty($bom_fg_id)) {
				error_log("set_bpr_mts_shortage_report: No BOM found for fg_id=$fg_id");
				continue;
			}
			$level1_bom = $this->get_fg_bom_material($fg_id, null, $bom_fg_id);
			$bom_cache[$fg_id] = $level1_bom;
			error_log("set_bpr_mts_shortage_report: Cached fg_id=$fg_id, Level 1 Items: " . count($level1_bom));

			foreach ($level1_bom as $bom) {
				$this->cache_bom_by_parent_id($bom->item_no_id, $bom->finish_good_item_id, $bom->id, $bom_cache, $visited);
			}
		}

		// Cache inventory
		$inv_rows = $this->db->where(['report_id' => $report_id, 'is_deleted' => '0', 'status' => '1'])->get('tbl_inventory_report')->result();
		foreach ($inv_rows as $row) {
			$inv_cache[$row->item_id] = $row;
		}

		foreach ($records as $record) {
			if ($record->gap_qty > 0) {
				$rejection_qty = $this->get_item_rejected_quantity($record->ffpl_item_id, $report_id, $bom_cache, $inv_cache);
				$receiving_qty = $this->get_item_receiving_quantity($record->ffpl_item_id, $report_id, $bom_cache, $inv_cache);
				$plan_qty = $this->calculate_plan_quantity($record->ffpl_item_id, $report_id, $record->gap_qty, $bom_cache, $inv_cache);

				// Full Kit Quantity: Constrained by remaining total_on_hand
				$full_qty = $this->calculate_full_kit_quantity($record->ffpl_item_id, $report_id, $record->gap_qty, $bom_cache, $inv_cache, false);
				$full_qty = min($full_qty, $record->gap_qty);

				$pending_quantity = $record->green_level - $record->intransit - $record->actual_on_hand - $plan_qty;
				$status_plan = $record->green_level > 0 ? ($pending_quantity / $record->green_level) * 100 : 0;
				$shortage = $record->gap_qty - $plan_qty;

				$air_cleaner_qty = $this->get_air_cleaner_on_hand_qty($record->ffpl_item_id, $report_id);
				$kit_assy_qty = $this->get_kit_assy_on_hand_qty($record->ffpl_item_id, $report_id);

				$remark = $this->get_bom_status($record->ffpl_item_id);

				$data = [
					'report_id'                 => $record->report_id,
					'report_number'             => $report_number,
					'category'                  => $record->category,
					'sub_line'                  => $record->sub_line,
					'ffpl_item_number'          => $record->ffpl_item_number,
					'ffpl_item_id'              => $record->ffpl_item_id,
					'ffpl_item_description'     => $record->ffpl_item_description,
					'customer_item_number'      => $record->customer_item_number,
					'customer_item_description' => $record->customer_item_description,
					'customer_name'             => $record->customer_name,
					'pack_size'                 => $record->pack_size,
					'green_level'               => $record->green_level,
					'actual_on_hand'            => $record->actual_on_hand,
					'reservation'               => $record->reservation,
					'intransit'                 => $record->intransit,
					'gap_qty'                   => $record->gap_qty,
					'penetration_in_percentage' => $record->penetration_in_percentage,
					'priority_mark'             => $record->priority_mark,
					'plant_onhand'              => $record->plant_onhand,
					'actual_gap'                => $record->actual_gap,
					'rejection_qty'             => $rejection_qty,
					'receiving_work_order_qty'  => $receiving_qty,
					'full_qty'                  => $full_qty,
					'plan_qty'                  => $plan_qty,
					'pending_qty_after_plan'    => $pending_quantity,
					'status_after_plan'         => $status_plan,
					'shortage'                  => $shortage,
					'air_cleaner_on_hand'       => $air_cleaner_qty,
					'kit_assy_on_hand'          => $kit_assy_qty,
					'created_on'                => $now,
					'remark'                    => $remark,
				];
				$this->db->insert('tbl_bpr_mts_shortage_report', $data);
				$shortage_report_id = $this->db->insert_id();

				// Batch insert shortage items
				$shortage_items = $this->get_shortage_items_data($record->ffpl_item_id, $report_id, $record->gap_qty, $bom_cache, $inv_cache);
				if (!empty($shortage_items)) {
					$batch = [];
					foreach ($shortage_items as $item) {
						$batch[] = [
							'report_id'           => $record->report_id,
							'report_type'         => 'MTS',
							'shortage_report_id'  => $shortage_report_id,
							'material_code'       => $item['material_code'],
							'required_quantity'   => $item['required_quantity'],
							'total_on_hand_qty'   => $item['total_on_hand_qty'],
							'balance_on_hand_qty' => $item['balance_on_hand_qty'],
							'receiving_qty'       => $item['receiving_qty'],
							'short_quantity'      => $item['short_quantity'],
							'source_first'        => $item['source_first'],
							'source_first_id'     => $item['source_first_id'],
							'source_two'          => $item['source_two'],
							'source_two_id'       => $item['source_two_id'],
							'created_on'          => $now,
						];
					}
					$this->db->insert_batch('tbl_bpr_mts_shortage_items', $batch);
				}

				$material_usage_items = $this->track_material_usage($record->ffpl_item_id, $report_id, $record->gap_qty, $bom_cache, $inv_cache);
				if (!empty($material_usage_items)) {
					$usage_batch = [];
					foreach ($material_usage_items as $item) {
						$usage_batch[] = [
							'report_id'          	=> $record->report_id,
							'fg_id'          		=> $item['fg_id'],
							'level'      			=> $item['level'],
							'item'      			=> $item['item'],
							'description'      		=> $item['description'],
							'type'      			=> $item['type'],
							'uom'      				=> $item['uom'],
							'consum_qty'      		=> $item['consum_qty'],
							'required_qty'      	=> $item['required_qty'],
							'on_hand_qty'      		=> $item['on_hand_qty'],
							'balance_qty'      		=> $item['balance_qty'],
							'shortage_qty'      	=> $item['shortage_qty'],
							'created_on'         	=> $now,
						];
					}
					$this->db->insert_batch('tbl_bpr_mts_material_usage', $usage_batch);
				}
			}
		}
		error_log("set_bpr_mts_shortage_report: Completed, Allocated Inventory Count: " . count(self::$allocated_inventory));
		return $report_number;
	}
	public function get_bom_fg_id($fg_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_level', '0');
		$this->db->where('item_no_id', $fg_id);
		$result = $this->db->get('tbl_add_bom');
		$result = $result->row();
		return !empty($result) ? $result->id : null;
	}
	private function cache_bom_by_parent_id($item_no_id, $fg_id, $parent_id, &$bom_cache, $visited = [], $depth = 0)
	{
		// Log entry
		error_log("cache_bom_by_parent_id: item_no_id=$item_no_id, parent_id=$parent_id, depth=$depth, Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");

		// Prevent cycles
		if (isset($visited[$item_no_id])) {
			error_log("cache_bom_by_parent_id: Cycle detected for item_no_id=$item_no_id");
			return;
		}
		$visited[$item_no_id] = true;

		// Limit recursion depth to prevent stack overflow
		if ($depth > 10) {
			error_log("cache_bom_by_parent_id: Max depth reached for item_no_id=$item_no_id");
			return;
		}

		// Fetch BOM entries where parent_id matches the current BOM entry's id
		if (!isset($bom_cache[$item_no_id])) {
			$bom_cache[$item_no_id] = $this->get_fg_bom_material($fg_id, null, $parent_id);
			error_log("cache_bom_by_parent_id: Cached item_no_id=$item_no_id, parent_id=$parent_id, Items: " . count($bom_cache[$item_no_id]));
		}

		// Recursively fetch BOM for each subcomponent
		foreach ($bom_cache[$item_no_id] as $bom) {
			$sub_item_no = isset($bom->item_no_id) ? $bom->item_no_id : null;
			if (empty($sub_item_no)) {
				continue;
			}
			// Recurse using the current BOM entry's id as the parent_id for the next level
			$this->cache_bom_by_parent_id($sub_item_no, $fg_id, $bom->id, $bom_cache, $visited, $depth + 1);
		}
	}

	/**
	 * Optimized: Get BOM materials for a finish good, with optional cache, level, and parent_id
	 */
	public function get_fg_bom_material($fg_id, $level = null, $parent_id = null)
	{
		$this->db->where('finish_good_item_id', $fg_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		if ($level !== null) {
			$this->db->where('item_level', $level);
		} else {
			$this->db->where('item_level != ', '0');
		}

		if ($parent_id !== null) {
			$this->db->where('parent_id', $parent_id);
		} else {
			$this->db->where('parent_id', '1');
		}
		$result = $this->db->get('tbl_add_bom');
		return $result->result();
	}

	/**
	 * Optimized: Get item rejected quantity using cache
	 */
	public function get_item_rejected_quantity($fg_id, $report_id, $bom_cache = null, $inv_cache = null)
	{
		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);

		$rejection_qty = 0;
		if (!empty($fg_bom_material)) {
			$total_mt_reject_qty = 0;
			$total_rm = count($fg_bom_material);
			foreach ($fg_bom_material as $fg_material) {
				$item_no_id = $fg_material->item_no_id ?? null;
				if (!$item_no_id) continue;
				$inv_result = $inv_cache && isset($inv_cache[$item_no_id])
					? $inv_cache[$item_no_id]
					: $this->get_material_inventory_data($item_no_id, $report_id);
				if (!empty($inv_result) && isset($inv_result->reject_rm)) {
					$total_mt_reject_qty += $inv_result->reject_rm;
				}
			}
			$rejection_qty = $total_rm > 0 ? $total_mt_reject_qty / $total_rm : 0;
		}
		return $rejection_qty;
	}

	/**
	 * Optimized: Get item receiving quantity using cache
	 */
	public function get_item_receiving_quantity($fg_id, $report_id, $bom_cache = null, $inv_cache = null)
	{
		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);

		$receiving_qty = 0;
		if (!empty($fg_bom_material)) {
			$total_mt_receiving_qty = 0;
			$total_rm = count($fg_bom_material);
			foreach ($fg_bom_material as $fg_material) {
				$item_no_id = $fg_material->item_no_id ?? null;
				if (!$item_no_id) continue;
				$inv_result = $inv_cache && isset($inv_cache[$item_no_id])
					? $inv_cache[$item_no_id]
					: $this->get_material_inventory_data($item_no_id, $report_id);
				if (!empty($inv_result) && isset($inv_result->receiving)) {
					$total_mt_receiving_qty += $inv_result->receiving;
				}
			}
			$receiving_qty = $total_rm > 0 ? $total_mt_receiving_qty / $total_rm : 0;
		}
		return $receiving_qty;
	}

	/**
	 * Optimized: Get item full quantity using cache
	 */
	public function get_item_full_quantity($fg_id, $report_id, &$bom_cache, &$inv_cache)
	{
		if (empty($fg_id) || empty($report_id)) return 0;
		if (!isset($bom_cache[$fg_id])) return 0;

		$fg_bom_material = $bom_cache[$fg_id];
		$remaining_quantities = [];
		foreach ($fg_bom_material as $material) {
			$item_no = isset($material->item_no_id) ? $material->item_no_id : null;
			if (empty($item_no)) continue;
			$required_qty = isset($material->qty) && $material->qty > 0 ? (float)$material->qty : 1;
			$inv_result = isset($inv_cache[$item_no]) ? $inv_cache[$item_no] : null;
			$on_hand = !empty($inv_result) && isset($inv_result->on_hand) ? (float)$inv_result->on_hand : 0;
			$receiving = !empty($inv_result) && isset($inv_result->receiving) ? (float)$inv_result->receiving : 0;
			$allocated = isset(self::$allocated_inventory[$item_no]) ? self::$allocated_inventory[$item_no] : 0;
			$available_qty = max(0, $on_hand - $receiving - $allocated);
			error_log("get_item_full_quantity: item_no=$item_no, on_hand=$on_hand, receiving=$receiving, allocated=$allocated, available=$available_qty, required=$required_qty");
			$remaining_quantities[$item_no] = [
				'available' => $available_qty,
				'required' => $required_qty,
				'is_subassembly' => isset($bom_cache[$item_no]) && count($bom_cache[$item_no]) > 0,
				'item_type_id' => $material->item_type_id
			];
		}

		$total_fg = 0;
		while (true) {
			$possible_fg_quantities = [];
			foreach ($remaining_quantities as $item_no => $data) {
				if ($data['item_type_id'] != '1') {
					$possible_fg = floor($data['available'] / $data['required']);
					$possible_fg_quantities[] = $possible_fg;
				}
			}
			if (empty($possible_fg_quantities)) break;
			$fg_batch = min($possible_fg_quantities);
			if ($fg_batch <= 0) break;

			foreach ($remaining_quantities as $item_no => &$data) {
				if ($data['item_type_id'] != '1') {
					$consumed = $fg_batch * $data['required'];
					$data['available'] -= $consumed;
					self::$allocated_inventory[$item_no] = isset(self::$allocated_inventory[$item_no]) ?
						self::$allocated_inventory[$item_no] + $consumed : $consumed;
					error_log("get_item_full_quantity: Allocated item_no=$item_no, consumed=$consumed, total_allocated=" . self::$allocated_inventory[$item_no]);
				}
			}
			$total_fg += $fg_batch;

			$produced_more = false;
			foreach ($remaining_quantities as $item_no => &$data) {
				if ($data['is_subassembly'] && $data['item_type_id'] != '1') {
					$additional_qty = $this->produce_subassembly($item_no, $report_id, $data['required'], $bom_cache, $inv_cache);
					if ($additional_qty > 0) {
						$data['available'] += $additional_qty;
						$produced_more = true;
					}
				}
			}
			if (!$produced_more) break;
		}
		error_log("get_item_full_quantity: fg_id=$fg_id, total_fg=$total_fg, Allocated Inventory Count: " . count(self::$allocated_inventory));
		return (int)$total_fg;
	}

	/**
	 * Optimized: Produce subassembly using cache
	 */
	private function produce_subassembly($item_id, $report_id, $required_qty_per_parent, &$bom_cache, &$inv_cache)
	{
		if (!isset($bom_cache[$item_id])) return 0;
		$sub_bom = $bom_cache[$item_id];
		$sub_remaining_quantities = [];
		foreach ($sub_bom as $material) {
			$sub_item_no = isset($material->item_no_id) ? $material->item_no_id : null;
			if (empty($sub_item_no)) continue;
			$sub_required_qty = isset($material->qty) && $material->qty > 0 ? (float)$material->qty : 1;
			$inv_result = isset($inv_cache[$sub_item_no]) ? $inv_cache[$sub_item_no] : null;
			$on_hand = !empty($inv_result) && isset($inv_result->on_hand) ? (float)$inv_result->on_hand : 0;
			$receiving = !empty($inv_result) && isset($inv_result->receiving) ? (float)$inv_result->receiving : 0;
			$allocated = isset(self::$allocated_inventory[$sub_item_no]) ? self::$allocated_inventory[$sub_item_no] : 0;
			$available_qty = max(0, $on_hand - $receiving - $allocated);
			$sub_remaining_quantities[$sub_item_no] = [
				'available' => $available_qty,
				'required' => $sub_required_qty,
				'is_subassembly' => isset($bom_cache[$sub_item_no]) && count($bom_cache[$sub_item_no]) > 0,
				'item_type_id' => $material->item_type_id
			];
		}

		$total_produced = 0;
		while (true) {
			$possible_sub_quantities = [];
			foreach ($sub_remaining_quantities as $sub_item_no => $data) {
				if ($data['item_type_id'] != '1') {
					$possible_sub = floor($data['available'] / $data['required']);
					$possible_sub_quantities[] = $possible_sub;
				}
			}
			if (empty($possible_sub_quantities)) break;
			$sub_batch = min($possible_sub_quantities);
			if ($sub_batch <= 0) break;

			foreach ($sub_remaining_quantities as $sub_item_no => &$data) {
				if ($data['item_type_id'] != '1') {
					$consumed = $sub_batch * $data['required'];
					$data['available'] -= $consumed;
					self::$allocated_inventory[$sub_item_no] = isset(self::$allocated_inventory[$sub_item_no]) ?
						self::$allocated_inventory[$sub_item_no] + $consumed : $consumed;
				}
			}
			$total_produced += $sub_batch;

			$produced_more = false;
			foreach ($sub_remaining_quantities as $sub_item_no => &$data) {
				if ($data['is_subassembly'] && $data['item_type_id'] != '1') {
					$additional_qty = $this->produce_subassembly($sub_item_no, $report_id, $data['required'], $bom_cache, $inv_cache);
					if ($additional_qty > 0) {
						$data['available'] += $additional_qty;
						$produced_more = true;
					}
				}
			}
			if (!$produced_more) break;
		}
		return $total_produced * $required_qty_per_parent;
	}

	/**
	 * Optimized: Get item plan quantity using cache
	 */
	public function get_item_plan_quantity($fg_id, $report_id, $bom_cache = null, $inv_cache = null)
	{
		if (empty($fg_id) || empty($report_id)) return 0;
		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);

		if (empty($fg_bom_material)) return 0;
		$possible_fg_quantities = [];
		foreach ($fg_bom_material as $fg_material) {
			if ($fg_material->item_type_id != '1') {
				$item_no = isset($fg_material->item_no_id) ? $fg_material->item_no_id : null;
				if (empty($item_no)) continue;
				$required_qty_per_fg = isset($fg_material->qty) && $fg_material->qty > 0 ? (float)$fg_material->qty : 1;
				$available_qty = $inv_cache && isset($inv_cache[$item_no]) && isset($inv_cache[$item_no]->on_hand)
					? (float)$inv_cache[$item_no]->on_hand
					: 0;
				$possible_fg = floor($available_qty / $required_qty_per_fg);
				$possible_fg_quantities[] = $possible_fg;
			}
		}

		$plan_qty = !empty($possible_fg_quantities) ? min($possible_fg_quantities) : 0;
		return (int)$plan_qty;
	}

	public function get_shortage_items_data($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null)
	{
		error_log("get_shortage_items_data: Start fg_id=$fg_id, order_qty=$order_qty, Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");

		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);
		// echo "<pre>";
		// print_r($fg_bom_material);
		$shortage_items = [];
		if (!empty($fg_bom_material) && $order_qty > 0) {
			foreach ($fg_bom_material as $fg_material) {
				if ($fg_material->item_type_id != '1') {
					$item_no = isset($fg_material->item_no_id) ? $fg_material->item_no_id : null;
					if (empty($item_no)) {
						continue;
					}
					$required_qty_per_fg = isset($fg_material->qty) ? (float)$fg_material->qty : 1;
					$required_qty = $required_qty_per_fg * $order_qty;
					$this->collect_shortage_items(
						$item_no,
						$report_id,
						$required_qty,
						$shortage_items,
						$bom_cache,
						$inv_cache,
						$fg_material->item_level ?? null,
						$fg_material->parent_id ?? null
					);
				}
			}
		}

		error_log("get_shortage_items_data: End, Shortage Items Count: " . count($shortage_items) . ", Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");
		return $shortage_items;
	}

	private function get_material_details($item_id, $fg_id)
	{
		$this->db->select('tbl_add_bom.*, tbl_item.item_name as item_type_name, tbl_unit.unit_name');
		$this->db->where('tbl_add_bom.item_no_id', $item_id);
		$this->db->where('tbl_add_bom.finish_good_item_id', $fg_id);
		$this->db->where('tbl_add_bom.is_deleted', '0');
		$this->db->join('tbl_item', 'tbl_item.id = tbl_add_bom.item_type_id', 'left');
		$this->db->join('tbl_unit', 'tbl_unit.id = tbl_add_bom.uom_id', 'left');
		$result = $this->db->get('tbl_add_bom')->row();
		if (!empty($result)) {
			return [
				'description' => $result->item_desc_id,
				'type' => $result->item_type_name,
				'uom' => $result->unit_name,
			];
		} else {
			return null;
		}
	}

	/**
	 * Optimized: Collect shortage items using cache
	 */
	private function collect_shortage_items($item_id, $report_id, $required_qty, &$shortage_items, $bom_cache = null, $inv_cache = null, $level = null, $parent_id = null, $visited = [], $depth = 0)
	{
		error_log("collect_shortage_items: item_id=$item_id, depth=$depth, required_qty=$required_qty, level=" . ($level ?? 'null') . ", parent_id=" . ($parent_id ?? 'null') . ", Allocated: " . (isset(self::$allocated_inventory[$item_id]) ? self::$allocated_inventory[$item_id] : 0) . ", Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");

		if (isset($visited[$item_id])) {
			error_log("collect_shortage_items: Cycle detected for item_id=$item_id");
			return;
		}
		$visited[$item_id] = true;

		if ($depth > 10) {
			error_log("collect_shortage_items: Max recursion depth reached for item_id=$item_id");
			return;
		}

		$inv_result = $inv_cache && isset($inv_cache[$item_id])
			? $inv_cache[$item_id]
			: $this->get_material_inventory_data($item_id, $report_id);

		$on_hand = !empty($inv_result) ? (float)$inv_result->on_hand : 0;
		$receiving = !empty($inv_result) ? (float)$inv_result->receiving : 0;
		$intransit = !empty($inv_result) ? (float)$inv_result->intransit : 0;
		$allocated = isset(self::$allocated_inventory[$item_id]) ? self::$allocated_inventory[$item_id] : 0;
		$total_available = max(0, $on_hand + $intransit - $allocated);
		error_log("collect_shortage_items: item_id=$item_id, on_hand=$on_hand, intransit=$intransit, allocated=$allocated, available=$total_available, required=$required_qty");

		$shortfall = max(0, $required_qty - $total_available);
		$consumed = min($required_qty, $total_available);
		error_log("collect_shortage_items: item_id=$item_id, shortfall=$shortfall, consumed=$consumed");

		if ($consumed > 0) {
			self::$allocated_inventory[$item_id] = isset(self::$allocated_inventory[$item_id]) ?
				self::$allocated_inventory[$item_id] + $consumed : $consumed;
			error_log("collect_shortage_items: Allocated item_id=$item_id, consumed=$consumed, total_allocated=" . self::$allocated_inventory[$item_id]);
		}

		$is_subassembly = $bom_cache && isset($bom_cache[$item_id]) && count($bom_cache[$item_id]) > 0;

		if ($is_subassembly) {
			$sub_bom = $bom_cache[$item_id];
			foreach ($sub_bom as $sub_material) {
				$sub_item_no = isset($sub_material->item_no_id) ? $sub_material->item_no_id : null;
				if (empty($sub_item_no)) {
					continue;
				}
				$sub_required_qty = isset($sub_material->qty) ? ((float)$sub_material->qty * $shortfall) : $shortfall;
				if ($sub_required_qty <= 0) {
					continue;
				}
				$next_level = isset($sub_material->item_level) ? $sub_material->item_level : ($level !== null ? $level + 1 : null);
				$next_parent_id = isset($sub_material->parent_id) ? $sub_material->parent_id : $item_id;
				error_log("collect_shortage_items: item_id=$item_id, proceeding to sub_item_no=$sub_item_no, sub_required_qty=$sub_required_qty, next_level=$next_level, next_parent_id=$next_parent_id");
				$this->collect_shortage_items(
					$sub_item_no,
					$report_id,
					$sub_required_qty,
					$shortage_items,
					$bom_cache,
					$inv_cache,
					$next_level,
					$next_parent_id,
					$visited,
					$depth + 1
				);
			}
		} else {
			if ($shortfall > 0) {
				$material_code = $item_id;
				$material_source_first = $this->get_material_supplier_details($material_code, '1');
				$material_source_two = $this->get_material_supplier_details($material_code, '2');

				$source_first_name = !empty($material_source_first) ? $material_source_first->supplier_name : '';
				$source_first_id = !empty($material_source_first) ? $material_source_first->supplier_1 : '';
				$source_second_name = !empty($material_source_two) ? $material_source_two->supplier_name : '';
				$source_second_id = !empty($material_source_two) ? $material_source_two->supplier_2 : '';

				$shortage_items[] = [
					'material_code' => $material_code,
					'required_quantity' => $required_qty,
					'total_on_hand_qty' => $on_hand,
					'balance_on_hand_qty' => $total_available,
					'receiving_qty' => $receiving,
					'short_quantity' => $shortfall,
					'source_first' => $source_first_name,
					'source_first_id' => $source_first_id,
					'source_two' => $source_second_name,
					'source_two_id' => $source_second_id,
					'level' => $level,
					'parent_id' => $parent_id,
				];
				error_log("collect_shortage_items: Added shortage for item_id=$item_id, shortfall=$shortfall, level=" . ($level ?? 'null') . ", parent_id=" . ($parent_id ?? 'null') . ", Shortage Items Count: " . count($shortage_items));
			}
		}

		error_log("collect_shortage_items: Exit item_id=$item_id, Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");
	}

	// Existing helper functions (unchanged)
	private function is_subassembly($item_id)
	{
		$this->db->where('finish_good_item_id', $item_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_add_bom');
		return $result->num_rows() > 0;
	}
	public function get_material_inventory_data($item_id, $report_id)
	{
		$this->db->where('item_id', $item_id);
		$this->db->where('report_id', $report_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_inventory_report');
		return $result->row();
	}

	public function get_air_cleaner_on_hand_qty($fg_id, $report_id)
	{
		$this->db->where('fg_id', $fg_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_part_master');
		$result = $result->row();
		$air_cleaner_qty = 0;
		if (!empty($result)) {
			$inv_result = $this->get_material_inventory_data($result->air_cleaner_part_id, $report_id);
			if (!empty($inv_result)) {
				$air_cleaner_qty = $inv_result->on_hand;
			}
		}
		return $air_cleaner_qty;
	}

	public function get_kit_assy_on_hand_qty($fg_id, $report_id)
	{
		$this->db->where('fg_id', $fg_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_part_master');
		$result = $result->row();
		$kit_assy_qty = 0;
		if (!empty($result)) {
			$inv_result = $this->get_material_inventory_data($result->kit_assy_part_id, $report_id);
			if (!empty($inv_result)) {
				$kit_assy_qty = $inv_result->on_hand;
			}
		}
		return $kit_assy_qty;
	}


	public function get_material_supplier_details($item_id, $supplier_number)
	{
		$this->db->select('tbl_item_management.*, tbl_supplier_management.supplier_name');
		$this->db->where('tbl_item_management.id', $item_id);
		if ($supplier_number == '1') {
			$this->db->join('tbl_supplier_management', 'tbl_supplier_management.id = tbl_item_management.supplier_1');
		}
		if ($supplier_number == '2') {
			$this->db->join('tbl_supplier_management', 'tbl_supplier_management.id = tbl_item_management.supplier_2');
		}
		$result = $this->db->get('tbl_item_management');
		return $result->row();
	}

	// Fetch paginated report data with associated shortage parts
	public function get_generated_bpr_mtd_report_data_paginated($report_number, $start, $length)
	{
		// Fetch main report data
		$this->db->select('tbl_bpr_mts_shortage_report.*');
		$this->db->where('report_number', $report_number);
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$this->db->limit($length, $start);
		$query = $this->db->get('tbl_bpr_mts_shortage_report');
		$report_data = $query->result();

		// Fetch all shortage parts for the reports in this page
		$report_ids = array_column((array)$report_data, 'id');
		$shortage_parts = [];
		if (!empty($report_ids)) {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_item_management.item_no, tbl_item_management.description');
			$this->db->where_in('tbl_bpr_mts_shortage_items.shortage_report_id', $report_ids);
			$this->db->where('tbl_bpr_mts_shortage_items.status', '1');
			$this->db->where('tbl_bpr_mts_shortage_items.is_deleted', '0');
			$this->db->where('tbl_bpr_mts_shortage_items.report_type', 'MTS');
			$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
			$query = $this->db->get('tbl_bpr_mts_shortage_items');
			$shortage_results = $query->result();

			// Group shortage parts by shortage_report_id
			foreach ($shortage_results as $sp) {
				$shortage_parts[$sp->shortage_report_id][] = $sp;
			}
		}

		// Attach shortage parts to each report
		foreach ($report_data as $report) {
			$report->shortage_parts = isset($shortage_parts[$report->id]) ? $shortage_parts[$report->id] : [];
		}

		return $report_data;
	}

	// Get total count of reports for pagination
	public function get_generated_bpr_mtd_report_data_count($report_number)
	{
		$this->db->where('report_number', $report_number);
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		return $this->db->count_all_results('tbl_bpr_mts_shortage_report');
	}

	// Existing methods (unchanged for brevity)
	public function get_shortage_part_details($id, $report_id)
	{
		$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_item_management.item_no');
		$this->db->where('tbl_bpr_mts_shortage_items.shortage_report_id', $id);
		$this->db->where('tbl_bpr_mts_shortage_items.report_id', $report_id);
		$this->db->where('tbl_bpr_mts_shortage_items.status', '1');
		$this->db->where('tbl_bpr_mts_shortage_items.is_deleted', '0');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
		$result = $this->db->get('tbl_bpr_mts_shortage_items');
		return $result->result();
	}

	public function get_all_report_data_ajax_count($search = '')
	{
		$this->db->select('tbl_report.*,tbl_user.first_name,tbl_user.middle_name,tbl_user.last_name');
		$this->db->where('tbl_report.status', '1');
		$this->db->where('tbl_report.is_deleted', '0');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.first_name', $search);
			$this->db->or_like('tbl_report.middle_name', $search);
			$this->db->or_like('tbl_report.last_name', $search);
			$this->db->group_end();
		}
		$this->db->join('tbl_user', 'tbl_user.id = tbl_report.added_by');
		$result = $this->db->get('tbl_report');
		return $result->num_rows();
	}


	public function get_all_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_report.*,tbl_user.first_name,tbl_user.middle_name,tbl_user.last_name');
		$this->db->where('tbl_report.status', '1');
		$this->db->where('tbl_report.is_deleted', '0');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.first_name', $search);
			$this->db->or_like('tbl_report.middle_name', $search);
			$this->db->or_like('tbl_report.last_name', $search);
			$this->db->group_end();
		}
		$this->db->join('tbl_user', 'tbl_user.id = tbl_report.added_by');
		//$this->db->limit($length, $start);
		$result = $this->db->get('tbl_report');
		return $result->result();
	}
	public function get_today_report_data_ajax_count($search = '')
	{
		$this->db->select('tbl_report.*,tbl_user.first_name,tbl_user.middle_name,tbl_user.last_name');
		$this->db->where('tbl_report.status', '1');
		$this->db->where('tbl_report.is_deleted', '0');
		$this->db->where('DATE(tbl_report.created_on)', date('Y-m-d'));
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.first_name', $search);
			$this->db->or_like('tbl_report.middle_name', $search);
			$this->db->or_like('tbl_report.last_name', $search);
			$this->db->group_end();
		}
		$this->db->join('tbl_user', 'tbl_user.id = tbl_report.added_by');
		$result = $this->db->get('tbl_report');
		return $result->num_rows();
	}


	public function get_today_report_data_ajax($start = 0, $length = 10, $search = '', $sorters = [])
	{
		$this->db->select('tbl_report.*,tbl_user.first_name,tbl_user.middle_name,tbl_user.last_name');
		$this->db->where('tbl_report.status', '1');
		$this->db->where('tbl_report.is_deleted', '0');
		$this->db->where('DATE(tbl_report.created_on)', date('Y-m-d'));
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.first_name', $search);
			$this->db->or_like('tbl_report.middle_name', $search);
			$this->db->or_like('tbl_report.last_name', $search);
			$this->db->group_end();
		}
		$this->db->join('tbl_user', 'tbl_user.id = tbl_report.added_by');
		//$this->db->limit($length, $start);
		$result = $this->db->get('tbl_report');
		return $result->result();
	}
	public function set_changed_report_plan_quantity()
	{
		$this->db->where('report_id', $this->input->post('report_id'));
		$this->db->where('ffpl_item_number', $this->input->post('ffpl_item_number'));
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_order_report');
		$result = $result->row();


		if (!empty($result)) {
			$data = array(
				'actual_gap' => $this->input->post('actual_gap'),
			);
			$this->db->where('id', $result->id);
			$this->db->update('tbl_order_report', $data);


			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mto_material_usage');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mto_shortage_report');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_material_usage');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_shortage_items');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_shortage_report');

			$report_details = $this->Admin_model->get_uploaded_report_details();
			redirect('uploaded-report-review/' . $report_details->report_number);

			/*$mto_report_number = 0;
            $mts_report_number = 0;

            // Generate MTO report only if the MTO file exists
            if (!empty($report_details) && $report_details->mto_order_report != '') {
                $mto_report_number = $this->Admin_model->set_bpr_mto_shortage_report();
            }

            // Generate MTS report only if the MTS file exists
            if (!empty($report_details) && $report_details->order_report != '') {
                $mts_report_number = $this->Admin_model->set_bpr_mts_shortage_report();
            }

            // Handle redirection and success messages based on which reports were generated
            if ($mto_report_number > 0 && $mts_report_number > 0) {
                $this->session->set_flashdata('success', 'BPR MTO and MTS shortage reports generated successfully.');
                redirect('bpr-mto-shortage-report/' . $mto_report_number); // Redirect to MTO report by default when both exist
            } elseif ($mto_report_number > 0) {
                $this->session->set_flashdata('success', 'BPR MTO shortage report generated successfully.');
                redirect('bpr-mto-shortage-report/' . $mto_report_number);
            } elseif ($mts_report_number > 0) {
                $this->session->set_flashdata('success', 'BPR MTS shortage report generated successfully.');
                redirect('bpr-mts-shortage-report/' . $mts_report_number);
            } else {
                $this->session->set_flashdata('message', 'Could not generate any shortage reports. Please check the uploaded files.');
                redirect('uploaded-report-review/'.$report_details->report_number);
            }*/
		}
	}
	public function set_mto_changed_report_plan_quantity()
	{
		$this->db->where('report_id', $this->input->post('report_id'));
		$this->db->where('ff_part_no', $this->input->post('ffpl_item_number'));
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_mto_order_report');
		$result = $result->row();


		if (!empty($result)) {
			$data = array(
				'tbl_mto_order_report' => $this->input->post('actual_gap'),
			);
			$this->db->where('id', $result->id);
			$this->db->update('tbl_mto_order_report', $data);


			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mto_material_usage');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mto_shortage_report');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_material_usage');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_shortage_items');

			$this->db->where('report_id', $this->input->post('report_id'));
			$this->db->delete('tbl_bpr_mts_shortage_report');

			$report_details = $this->Admin_model->get_uploaded_report_details();
			redirect('uploaded-report-review/' . $report_details->report_number);
		}
	}

	public function get_selected_line_details()
	{
		$this->db->where('id', $this->uri->segment(3));
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_line');
		return $result->row();
	}






	/*===================== Close AI Code ======================*/


	public function check_unique_site_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('site_name', $this->input->post('site_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_site')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_good_type_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('good_type_name', $this->input->post('good_type_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_good_type')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_designation_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('designation_name', $this->input->post('designation_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_designation')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_department_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('department_name', $this->input->post('department_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_department')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_item_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_name', $this->input->post('item_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_item')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}

	public function check_unique_unit_name()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('unit_name', $this->input->post('unit_name'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_unit')->row();
		if (!empty($res)) {
			echo '1';
		} else {
			echo "0";
		}
	}
	public function get_all_finish_goods()
	{
		$this->db->select('tbl_add_bom.*, tbl_item_management.item_no');
		$this->db->where('tbl_add_bom.status', '1');
		$this->db->where('tbl_add_bom.is_deleted', '0');
		$this->db->order_by('tbl_add_bom.id', 'DESC');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_add_bom.finish_good_item_id');
		$result = $this->db->get('tbl_add_bom');
		return $result->result();
	}

	public function get_all_finish_good_item_description()
	{

		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('item_no', $this->input->post('finish_good_item_id'));
		$this->db->order_by('tbl_item_management.id', 'DESC');
		$result = $this->db->get('tbl_item_management');
		echo json_encode($result->result());
	}

	public function check_finish_good_item()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_no', $this->input->post('finish_good_item_id'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_item_management')->row();

		if (!empty($res->description) && (!empty($res->item_no))) {
			echo "0";
		} else if (empty($res->description) && (!empty($res->item_no))) {
			echo "1";
		} else {
			echo "2";
		}
	}

	public function check_unique_bom_item()
	{


		$finish_good_item_id = $this->input->post('finish_good_item_id');
		$result = $this->get_single_finish_good_item_id($finish_good_item_id);
		$id = $result->id;

		$this->db->where('is_deleted', '0');
		$this->db->where('finish_good_item_id', $id);
		$this->db->where('item_no_id', $this->input->post('item_id'));
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$res = $this->db->get('tbl_add_bom')->row();

		if (!empty($res)) {
			echo "1";
		} else {
			echo "0";
		}
	}

	public function get_single_finish_good_item_id($finish_good_item_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('item_no', $finish_good_item_id);
		$result = $this->db->get('tbl_item_management');
		return $result->row();
	}
	public function insert_bom_tree($node, $parent_id = null, $finish_good_item_id = null)
	{
		// If this is the root node (level 0 or null), set finish_good_item_id
		if ($node['level'] == 0 || $node['level'] === null) {
			$finish_good_item_id = $node['item_id'];
		}
		
	
		$data = [
			'finish_good_item_id'   => $finish_good_item_id,
			'item_no_id'            => $node['item_id'],
			'item_desc_id'          => $node['description'],
			'item_level'            => $node['level'],
			'revision'              => $node['revision'],
			'item_type_id'          => $node['status'],
			'item_status'           => $node['status'],
			'uom_id'                => $node['unit_id'],
			'qty'                   => $node['quantity'],
			'parent_id'             => $parent_id,
			'created_on'            => date('Y-m-d H:i:s'),
		];
		$this->db->insert('tbl_add_bom', $data);
		$current_id = $this->db->insert_id();

		// Recursively insert children
		if (!empty($node['children'])) {
			foreach ($node['children'] as $child) {
				$this->insert_bom_tree($child, $current_id, $finish_good_item_id);
			}
		}
	}


	/*============================== Generate MTO Report ==============================*/
	public function set_bpr_mto_shortage_report()
	{
		self::$allocated_inventory = []; // Initialize for MTO
		error_log("set_bpr_mto_shortage_report: Starting, Allocated Inventory Count: " . count(self::$allocated_inventory));
		$report_id = $this->input->post('report_id');
		$report_number = $this->input->post('report_number');
		$now = date('Y-m-d H:i:s');

		// Fetch all orders for this report
		$orders = $this->db
			->where(['report_id' => $report_id, 'is_deleted' => '0', 'status' => '1'])
			->order_by('order_type', 'ASC')
			->get('tbl_mto_order_report')->result();

		if (empty($orders)) return 0;

		// --- Caching BOM and Inventory ---
		$fg_ids = array_unique(array_map(fn($o) => $o->ff_part_no_id, $orders));
		$bom_cache = [];
		$inv_cache = [];

		// Cache BOMs
		$visited = [];
		foreach ($fg_ids as $fg_id) {
			$bom_fg_id = $this->get_bom_fg_id($fg_id);
			if (empty($bom_fg_id)) {
				error_log("set_bpr_mto_shortage_report: No BOM found for fg_id=$fg_id");
				continue;
			}
			$level1_bom = $this->get_fg_bom_material($fg_id, null, $bom_fg_id);
			$bom_cache[$fg_id] = $level1_bom;
			error_log("set_bpr_mto_shortage_report: Cached fg_id=$fg_id, Level 1 Items: " . count($level1_bom));

			foreach ($level1_bom as $bom) {
				$this->cache_bom_by_parent_id($bom->item_no_id, $bom->finish_good_item_id, $bom->id, $bom_cache, $visited);
			}
		}

		// Cache inventory
		$inv_rows = $this->db->where(['report_id' => $report_id, 'is_deleted' => '0', 'status' => '1'])->get('tbl_inventory_report')->result();
		foreach ($inv_rows as $row) {
			$inv_cache[$row->item_id] = $row;
		}

		foreach ($orders as $order) {
			if ($order->net_pending_order_quantity > 0) {
				$rejection_qty = $this->get_item_rejected_quantity($order->ff_part_no_id, $report_id, $bom_cache, $inv_cache);
				$receiving_qty = $this->get_item_receiving_quantity($order->ff_part_no_id, $report_id, $bom_cache, $inv_cache);

				// Plan Quantity: Validate with total_on_hand and subassemblies
				$plan_qty = $this->calculate_plan_quantity($order->ff_part_no_id, $report_id, $order->net_pending_order_quantity, $bom_cache, $inv_cache);

				// Full Kit Quantity: Constrained by total_on_hand
				$full_qty = $this->calculate_full_kit_quantity($order->ff_part_no_id, $report_id, $order->net_pending_order_quantity, $bom_cache, $inv_cache, true);
				$full_qty = min($full_qty, $order->net_pending_order_quantity);

				$pending_quantity = '0'; // Adjust as needed

				$shortage_items = $this->get_mto_shortage_items_data($order->ff_part_no_id, $report_id, $order->net_pending_order_quantity, $bom_cache, $inv_cache);
				$air_cleaner_qty = $this->get_air_cleaner_on_hand_qty($order->ff_part_no_id, $report_id);
				$kit_assy_qty = $this->get_kit_assy_on_hand_qty($order->ff_part_no_id, $report_id);

				$remark = $this->get_bom_status($order->ff_part_no_id);

				$data = [
					'report_id'                 => $order->report_id,
					'report_number'             => $report_number,
					'sales_order_number'        => $order->sales_order_number,
					'category_code'             => $order->category_code,
					'ff_part_no'                => $order->ff_part_no,
					'ff_part_no_id'             => $order->ff_part_no_id,
					'ff_part_description'       => $order->ff_part_description,
					'customer_part_no'          => $order->customer_part_no,
					'need_by_date'              => $order->need_by_date,
					'order_quantity'            => $order->order_quantity,
					'pending_order_quantity'    => $order->pending_order_quantity,
					'plant_on_hand_quantity'    => $order->plant_on_hand_quantity,
					'priority_mark'				=> $order->order_type,
					'full_qty'                  => $full_qty,
					'plan_qty'                  => $plan_qty,
					'pending_qty_after_plan'    => $pending_quantity,
					'air_cleaner_on_hand'       => $air_cleaner_qty,
					'kit_assy_on_hand'          => $kit_assy_qty,
					'rejection_qty'             => '0',
					'receiving_work_order_qty'  => '0',
					'created_on'                => $now,
					'remark'                    => $remark,
				];
				$this->db->insert('tbl_bpr_mto_shortage_report', $data);
				$shortage_report_id = $this->db->insert_id();

				// Batch insert shortage items
				if (!empty($shortage_items)) {
					$batch = [];
					foreach ($shortage_items as $item) {
						$batch[] = [
							'report_id'           => $order->report_id,
							'report_type'         => 'MTO',
							'shortage_report_id'  => $shortage_report_id,
							'material_code'       => $item['material_code'],
							'required_quantity'   => $item['required_quantity'],
							'total_on_hand_qty'   => $item['total_on_hand_qty'],
							'balance_on_hand_qty' => $item['balance_on_hand_qty'],
							'receiving_qty'       => $item['receiving_qty'],
							'short_quantity'      => $item['short_quantity'],
							'source_first'        => $item['source_first'],
							'source_first_id'     => $item['source_first_id'],
							'source_two'          => $item['source_two'],
							'source_two_id'       => $item['source_two_id'],
							'created_on'          => $now,
						];
					}
					$this->db->insert_batch('tbl_bpr_mts_shortage_items', $batch);
				}


				$material_usage_items = $this->track_material_usage($order->ff_part_no_id, $report_id, $order->net_pending_order_quantity, $bom_cache, $inv_cache);
				if (!empty($material_usage_items)) {
					$usage_batch = [];
					foreach ($material_usage_items as $item) {
						$usage_batch[] = [
							'report_id'          	=> $order->report_id,
							'fg_id'          		=> $item['fg_id'],
							'level'      			=> $item['level'],
							'item'      			=> $item['item'],
							'description'      		=> $item['description'],
							'type'      			=> $item['type'],
							'uom'      				=> $item['uom'],
							'consum_qty'      		=> $item['consum_qty'],
							'required_qty'      	=> $item['required_qty'],
							'on_hand_qty'      		=> $item['on_hand_qty'],
							'balance_qty'      		=> $item['balance_qty'],
							'shortage_qty'      	=> $item['shortage_qty'],
							'created_on'         	=> $now,
						];
					}
					$this->db->insert_batch('tbl_bpr_mto_material_usage', $usage_batch);
				}
			}
		}
		error_log("set_bpr_mto_shortage_report: Completed, Allocated Inventory Count: " . count(self::$allocated_inventory));
		return $report_number;
	}

	public function get_bom_status($fg_id)
	{
		$this->db->select('status');
		$this->db->where('finish_good_item_id', $fg_id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$result = $this->db->get('tbl_add_bom');
		$result = $result->result();
		$status = '';
		if (empty($result)) {
			$status = 'BOM Not Available';
		}
		return $status;
	}

	private function calculate_plan_quantity($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null, &$visited = [])
	{
		error_log("calculate_plan_quantity: Start fg_id=$fg_id, order_qty=$order_qty");

		// Cycle detection
		if (isset($visited[$fg_id])) {
			error_log("calculate_plan_quantity: Cycle detected for fg_id=$fg_id");
			return PHP_INT_MAX;
		}
		$visited[$fg_id] = true;

		$bom = $bom_cache[$fg_id] ?? [];
		$is_subassembly = !empty($bom);

		// Get inventory for the current item. For Plan Qty, we only use on_hand.
		$inv_result = $inv_cache[$fg_id] ?? $this->get_material_inventory_data($fg_id, $report_id);
		$item_on_hand_stock = (float)($inv_result->on_hand ?? 0);

		// If it's a raw material (not a subassembly), its producibility is just its stock.
		if (!$is_subassembly) {
			unset($visited[$fg_id]); // Clear visited status for other paths
			return $item_on_hand_stock;
		}

		// If it IS a subassembly, we find the bottleneck from its children.
		$producible_from_children = PHP_INT_MAX;
		foreach ($bom as $material) {
			$child_id = $material->item_no_id ?? null;
			if (empty($child_id)) continue;

			$required_per_parent = (float)($material->qty ?? 0);
			if ($required_per_parent <= 0) return 0; // Invalid BOM

			// Recursively find how many of the child item are available (from its stock + its children)
			$total_child_available = $this->calculate_plan_quantity($child_id, $report_id, PHP_INT_MAX, $bom_cache, $inv_cache, $visited);

			// How many parent units can be made from this one child's total availability
			$possible_parent_units = floor($total_child_available / $required_per_parent);

			// The true number of producible parents is limited by the child with the worst shortage.
			$producible_from_children = min($producible_from_children, $possible_parent_units);
		}

		$producible_from_children = ($producible_from_children === PHP_INT_MAX) ? 0 : $producible_from_children;

		// Total available for this FG = its own stock + what can be built from its children.
		$total_producible = $item_on_hand_stock + $producible_from_children;

		unset($visited[$fg_id]); // Clear visited status for other paths
		error_log("calculate_plan_quantity: End fg_id=$fg_id, OnHand=$item_on_hand_stock, ProducibleFromChildren=$producible_from_children, Total=$total_producible");

		// Return total producible, capped by the order quantity at the top level only.
		return (int)$total_producible;
	}

	private function calculate_full_kit_quantity($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null, $allocate_inventory = false, &$visited = [])
	{
		error_log("calculate_full_kit_quantity: Start fg_id=$fg_id, order_qty=$order_qty, allocate=$allocate_inventory");

		// Cycle detection
		if (isset($visited[$fg_id])) {
			error_log("calculate_full_kit_quantity: Cycle detected for fg_id=$fg_id");
			return PHP_INT_MAX;
		}
		$visited[$fg_id] = true;

		$bom = $bom_cache[$fg_id] ?? [];
		$is_subassembly = !empty($bom);

		// Get available inventory for the current item. For Full Kit, we use on_hand - receiving - allocated.
		$inv_result = $inv_cache[$fg_id] ?? $this->get_material_inventory_data($fg_id, $report_id);
		$on_hand = (float)($inv_result->on_hand ?? 0);
		$receiving = (float)($inv_result->receiving ?? 0);
		$allocated = (float)(self::$allocated_inventory[$fg_id] ?? 0);
		$item_available_stock = max(0, $on_hand - $receiving - $allocated);

		// If it's a raw material (not a subassembly), its producibility is just its available stock.
		if (!$is_subassembly) {
			unset($visited[$fg_id]); // Clear visited status for other paths
			return $item_available_stock;
		}

		// If it IS a subassembly, we find the bottleneck from its children.
		$producible_from_children = PHP_INT_MAX;
		foreach ($bom as $material) {
			$child_id = $material->item_no_id ?? null;
			if (empty($child_id)) continue;

			$required_per_parent = (float)($material->qty ?? 0);
			if ($required_per_parent <= 0) return 0; // Invalid BOM

			// Recursively find how many of the child item are available (from its stock + its children)
			$total_child_available = $this->calculate_full_kit_quantity($child_id, $report_id, PHP_INT_MAX, $bom_cache, $inv_cache, false, $visited);

			// How many parent units can be made from this one child's total availability
			$possible_parent_units = floor($total_child_available / $required_per_parent);

			// The true number of producible parents is limited by the child with the worst shortage.
			$producible_from_children = min($producible_from_children, $possible_parent_units);
		}

		$producible_from_children = ($producible_from_children === PHP_INT_MAX) ? 0 : $producible_from_children;

		// Total available for this FG = its own stock + what can be built from its children.
		$total_producible = $item_available_stock + $producible_from_children;

		// The final quantity is the total producible, capped by the original order quantity.
		$final_qty = min($total_producible, $order_qty);

		// If allocation is requested (top-level MTO call), consume the inventory.
		if ($allocate_inventory && $final_qty > 0) {
			$this->allocate_inventory_for_production($fg_id, $final_qty, $bom_cache, $inv_cache, $report_id);
		}

		unset($visited[$fg_id]); // Clear visited status for other paths
		error_log("calculate_full_kit_quantity: End fg_id=$fg_id, AvailableStock=$item_available_stock, ProducibleFromChildren=$producible_from_children, Total=$total_producible, FinalCappedQty=$final_qty");

		return (int)$final_qty;
	}

	/**
	 * New helper function to recursively allocate inventory AFTER the final quantity has been determined.
	 */
	private function allocate_inventory_for_production($item_id, $qty_to_produce, $bom_cache, $inv_cache, $report_id)
	{
		if ($qty_to_produce <= 0) return;

		// How much can be fulfilled from this item's own stock?
		$inv_result = $inv_cache[$item_id] ?? $this->get_material_inventory_data($item_id, $report_id);
		$on_hand = (float)($inv_result->on_hand ?? 0);
		$receiving = (float)($inv_result->receiving ?? 0);
		$allocated = (float)(self::$allocated_inventory[$item_id] ?? 0);
		$item_available_stock = max(0, $on_hand - $receiving - $allocated);

		$consumed_from_stock = min($qty_to_produce, $item_available_stock);

		// Allocate what was consumed from stock
		if ($consumed_from_stock > 0) {
			self::$allocated_inventory[$item_id] = $allocated + $consumed_from_stock;
			error_log("ALLOCATE: item_id=$item_id, consumed_from_stock=$consumed_from_stock, new_total_allocated=" . self::$allocated_inventory[$item_id]);
		}

		// How much do we still need to produce from children?
		$shortfall = $qty_to_produce - $consumed_from_stock;

		if ($shortfall > 0) {
			$bom = $bom_cache[$item_id] ?? [];
			foreach ($bom as $material) {
				$child_id = $material->item_no_id ?? null;
				if (empty($child_id)) continue;

				$required_per_parent = (float)($material->qty ?? 0);
				if ($required_per_parent <= 0) continue;

				// Recursively allocate the required amount for the children
				$this->allocate_inventory_for_production($child_id, $shortfall * $required_per_parent, $bom_cache, $inv_cache, $report_id);
			}
		}
	}


	private function get_raw_material_requirements($parent_id, $quantity_needed, &$requirements, $bom_cache, &$visited)
	{
		// **FIX**: Check for infinite loops in the BOM data.
		if (isset($visited[$parent_id])) {
			error_log("get_raw_material_requirements: Cycle detected for parent_id=$parent_id");
			return;
		}
		$visited[$parent_id] = true;

		if (!isset($bom_cache[$parent_id])) {
			return; // Stop if no BOM exists for this parent
		}

		foreach ($bom_cache[$parent_id] as $material) {
			$child_id = $material->item_no_id ?? null;
			if (empty($child_id)) continue;

			$child_req_qty = (float)($material->qty ?? 0);
			if ($child_req_qty <= 0) continue;

			$total_child_qty_needed = $quantity_needed * $child_req_qty;

			if ($this->is_subassembly($child_id)) {
				// If the child is a subassembly, recurse further down.
				$this->get_raw_material_requirements($child_id, $total_child_qty_needed, $requirements, $bom_cache, $visited);
			} else {
				// If it's a raw material, add its total required quantity to the list.
				if (!isset($requirements[$child_id])) {
					$requirements[$child_id] = 0;
				}
				$requirements[$child_id] += $total_child_qty_needed;
			}
		}
		// **FIX**: Unset the visited flag for the current parent to allow it to be visited via other paths.
		unset($visited[$parent_id]);
	}



	public function get_mto_shortage_items_data($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null)
	{
		error_log("get_mto_shortage_items_data: Start fg_id=$fg_id, order_qty=$order_qty, Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");

		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);
		// echo "<pre>";
		// print_r($fg_bom_material);
		$shortage_items = [];
		if (!empty($fg_bom_material) && $order_qty > 0) {
			foreach ($fg_bom_material as $fg_material) {
				if ($fg_material->item_type_id != '1') {
					$item_no = isset($fg_material->item_no_id) ? $fg_material->item_no_id : null;
					if (empty($item_no)) {
						continue;
					}
					$required_qty_per_fg = isset($fg_material->qty) ? (float)$fg_material->qty : 1;
					$required_qty = $required_qty_per_fg * $order_qty;
					// echo "<pre>";
					// echo $item_no;
					// echo "<br>";
					// echo $required_qty;
					// echo "<br>";
					$this->collect_mto_shortage_items(
						$item_no,
						$report_id,
						$required_qty,
						$shortage_items,
						$bom_cache,
						$inv_cache,
						$fg_material->item_level ?? null,
						$fg_material->parent_id ?? null
					);
				}
			}
		}

		error_log("get_mto_shortage_items_data: End, Shortage Items Count: " . count($shortage_items) . ", Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");
		return $shortage_items;
	}

	private function collect_mto_shortage_items($item_id, $report_id, $required_qty, &$shortage_items, $bom_cache = null, $inv_cache = null, $level = null, $parent_id = null, $visited = [], $depth = 0)
	{
		error_log("collect_mto_shortage_items: item_id=$item_id, depth=$depth, required_qty=$required_qty, level=" . ($level ?? 'null') . ", parent_id=" . ($parent_id ?? 'null') . ", Allocated: " . (isset(self::$allocated_inventory[$item_id]) ? self::$allocated_inventory[$item_id] : 0) . ", Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");

		if (isset($visited[$item_id])) {
			error_log("collect_mto_shortage_items: Cycle detected for item_id=$item_id");
			return;
		}
		$visited[$item_id] = true;

		if ($depth > 10) {
			error_log("collect_mto_shortage_items: Max recursion depth reached for item_id=$item_id");
			return;
		}

		$inv_result = $inv_cache && isset($inv_cache[$item_id])
			? $inv_cache[$item_id]
			: $this->get_material_inventory_data($item_id, $report_id);

		$on_hand = !empty($inv_result) ? (float)$inv_result->on_hand : 0;
		$receiving = !empty($inv_result) ? (float)$inv_result->receiving : 0;
		$intransit = !empty($inv_result) ? (float)$inv_result->intransit : 0;
		$allocated = isset(self::$allocated_inventory[$item_id]) ? self::$allocated_inventory[$item_id] : 0;
		$total_available = max(0, $on_hand + $intransit - $allocated);
		error_log("collect_mto_shortage_items: item_id=$item_id, on_hand=$on_hand, intransit=$intransit, allocated=$allocated, available=$total_available, required=$required_qty");

		$shortfall = max(0, $required_qty - $total_available);
		$consumed = min($required_qty, $total_available); // Amount actually used from available inventory
		error_log("collect_mto_shortage_items: item_id=$item_id, shortfall=$shortfall, consumed=$consumed");

		// Update allocated inventory for this item
		if ($consumed > 0) {
			self::$allocated_inventory[$item_id] = isset(self::$allocated_inventory[$item_id]) ?
				self::$allocated_inventory[$item_id] + $consumed : $consumed;
			error_log("collect_mto_shortage_items: Allocated item_id=$item_id, consumed=$consumed, total_allocated=" . self::$allocated_inventory[$item_id]);
		}

		$is_subassembly = $bom_cache && isset($bom_cache[$item_id]) && count($bom_cache[$item_id]) > 0;

		if ($is_subassembly) {
			$sub_bom = $bom_cache[$item_id];
			foreach ($sub_bom as $sub_material) {
				$sub_item_no = isset($sub_material->item_no_id) ? $sub_material->item_no_id : null;
				if (empty($sub_item_no)) {
					continue;
				}
				$sub_required_qty = isset($sub_material->qty) ? ((float)$sub_material->qty * $shortfall) : $shortfall;
				if ($sub_required_qty <= 0) {
					continue;
				}
				$next_level = isset($sub_material->item_level) ? $sub_material->item_level : ($level !== null ? $level + 1 : null);
				$next_parent_id = isset($sub_material->parent_id) ? $sub_material->parent_id : $item_id;
				error_log("collect_mto_shortage_items: item_id=$item_id, proceeding to sub_item_no=$sub_item_no, sub_required_qty=$sub_required_qty, next_level=$next_level, next_parent_id=$next_parent_id");
				$this->collect_mto_shortage_items(
					$sub_item_no,
					$report_id,
					$sub_required_qty,
					$shortage_items,
					$bom_cache,
					$inv_cache,
					$next_level,
					$next_parent_id,
					$visited,
					$depth + 1
				);
			}
		} else {
			if ($shortfall > 0) {
				$material_code = $item_id;
				$material_source_first = $this->get_material_supplier_details($material_code, '1');
				$material_source_two = $this->get_material_supplier_details($material_code, '2');

				$source_first_name = !empty($material_source_first) ? $material_source_first->supplier_name : '';
				$source_first_id = !empty($material_source_first) ? $material_source_first->supplier_1 : '';
				$source_second_name = !empty($material_source_two) ? $material_source_two->supplier_name : '';
				$source_second_id = !empty($material_source_two) ? $material_source_two->supplier_2 : '';

				$shortage_items[] = [
					'material_code' => $material_code,
					'required_quantity' => $required_qty,
					'total_on_hand_qty' => $on_hand,
					'balance_on_hand_qty' => $total_available,
					'receiving_qty' => $receiving,
					'short_quantity' => $shortfall,
					'source_first' => $source_first_name,
					'source_first_id' => $source_first_id,
					'source_two' => $source_second_name,
					'source_two_id' => $source_second_id,
					'level' => $level,
					'parent_id' => $parent_id,
				];
				error_log("collect_mto_shortage_items: Added shortage for item_id=$item_id, shortfall=$shortfall, level=" . ($level ?? 'null') . ", parent_id=" . ($parent_id ?? 'null') . ", Shortage Items Count: " . count($shortage_items));
			}
		}

		error_log("collect_mto_shortage_items: Exit item_id=$item_id, Memory: " . (memory_get_usage() / 1024 / 1024) . " MB");
	}
	public function get_generated_bpr_mto_report_data_paginated($report_number, $start, $length)
	{
		// Fetch main report data
		$this->db->select('tbl_bpr_mto_shortage_report.*');
		$this->db->where('report_number', $report_number);
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$this->db->limit($length, $start);
		$query = $this->db->get('tbl_bpr_mto_shortage_report');
		$report_data = $query->result();

		// Fetch all shortage parts for the reports in this page
		$report_ids = array_column((array)$report_data, 'id');
		$shortage_parts = [];
		if (!empty($report_ids)) {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_item_management.item_no, tbl_item_management.description');
			$this->db->where_in('tbl_bpr_mts_shortage_items.shortage_report_id', $report_ids);
			$this->db->where('tbl_bpr_mts_shortage_items.status', '1');
			$this->db->where('tbl_bpr_mts_shortage_items.report_type', 'MTO');
			$this->db->where('tbl_bpr_mts_shortage_items.is_deleted', '0');
			$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
			$query = $this->db->get('tbl_bpr_mts_shortage_items');
			$shortage_results = $query->result();

			// Group shortage parts by shortage_report_id
			foreach ($shortage_results as $sp) {
				$shortage_parts[$sp->shortage_report_id][] = $sp;
			}
		}

		// Attach shortage parts to each report
		foreach ($report_data as $report) {
			$report->shortage_parts = isset($shortage_parts[$report->id]) ? $shortage_parts[$report->id] : [];
		}

		return $report_data;
	}

	public function get_generated_bpr_mto_report_data_count($report_number)
	{
		$this->db->where('report_number', $report_number);
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		return $this->db->count_all_results('tbl_bpr_mto_shortage_report');
	}
	// New Code With New Logic

	public function track_material_usage($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null)
	{
		error_log("track_material_usage: Start fg_id=$fg_id, order_qty=$order_qty");

		// Fetch BOM data from cache or database
		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);

		$material_usage_data = [];
		if (!empty($fg_bom_material) && $order_qty > 0) {
			foreach ($fg_bom_material as $fg_material) {
				if ($fg_material->item_type_id != '1') { // Assuming '1' is Finished Good
					$item_no = $fg_material->item_no_id ?? null;
					if (empty($item_no)) {
						continue;
					}
					$consum_qty = (float)($fg_material->qty ?? 1);
					if ($consum_qty <= 0) {
						continue;
					}
					$required_qty = $consum_qty * $order_qty;
					if ($required_qty <= 0) {
						continue;
					}

					$this->collect_material_usage(
						$fg_id,
						$item_no,
						$report_id,
						$required_qty,
						$consum_qty,
						$material_usage_data,
						$bom_cache,
						$inv_cache,
						$fg_material->item_level ?? null,
						$fg_material->parent_id ?? null
					);
				}
			}
		}

		error_log("track_material_usage: End, Material Usage Count: " . count($material_usage_data));
		return $material_usage_data;
	}

	private function collect_material_usage($fg_id, $item_id, $report_id, $required_qty, $consum_qty, &$material_usage_data, $bom_cache, $inv_cache, $level = null, $parent_id = null, $visited = [], $depth = 0, $parent_was_fulfilled = false)
	{
		error_log("collect_material_usage: item_id=$item_id, required_qty=$required_qty, parent_was_fulfilled=$parent_was_fulfilled");

		// Prevent infinite recursion
		if (isset($visited[$item_id])) {
			error_log("Cycle detected for item_id=$item_id");
			return;
		}
		$visited[$item_id] = true;

		if ($depth > 10) { // Max recursion depth
			error_log("Max recursion depth reached for item_id=$item_id");
			return;
		}

		// If parent was fulfilled, this level's requirement is 0
		$effective_required_qty = $parent_was_fulfilled ? 0 : $required_qty;

		// Fetch inventory and material details
		$inv_result = $inv_cache[$item_id] ?? $this->get_material_inventory_data($item_id, $report_id);
		$material_details = $this->get_material_details($item_id, $fg_id);

		$on_hand = (float)($inv_result->on_hand ?? 0);
		// Use fg_id to namespace the allocated inventory key
		$allocated_key = "{$fg_id}_{$item_id}";
		$allocated = (float)(self::$allocated_inventory[$allocated_key] ?? 0);
		$total_available = max(0, $on_hand - $allocated);

		// KEY CHANGE: Calculate consumption and update allocated inventory with namespaced key
		$consumed = min($total_available, $effective_required_qty);
		if ($consumed > 0) {
			self::$allocated_inventory[$allocated_key] = $allocated + $consumed;
			error_log("collect_material_usage: Allocated item_id=$item_id (key=$allocated_key), consumed=$consumed, new_total_allocated=" . self::$allocated_inventory[$allocated_key]);
		}

		// Calculate balance and shortage based on the effective required quantity
		$balance_qty = max(0, $total_available - $effective_required_qty);
		$shortage_qty = min(0, $total_available - $effective_required_qty);

		// This is the shortfall that determines the requirement for the next level
		$shortfall_for_children = max(0, $effective_required_qty - $total_available);

		error_log("item_id=$item_id, available=$total_available, effective_required=$effective_required_qty, shortfall_for_children=$shortfall_for_children");

		// Record material usage for the current item
		$material_usage_data[] = [
			'fg_id' => $fg_id,
			'level' => $level,
			'item' => $item_id,
			'description' => $material_details['description'] ?? 'N/A',
			'type' => $material_details['type'] ?? 'N/A',
			'uom' => $material_details['uom'] ?? 'Nos',
			'consum_qty' => $consum_qty,
			'required_qty' => $effective_required_qty, // Use the effective quantity
			'on_hand_qty' => $on_hand,
			'balance_qty' => $balance_qty,
			'shortage_qty' => $shortage_qty
		];

		// Always process sub-components if they exist
		$is_subassembly = !empty($bom_cache[$item_id]);
		if ($is_subassembly) {
			// Determine if the next level should have a zero requirement
			$next_level_is_fulfilled = $parent_was_fulfilled || ($shortfall_for_children == 0);

			$sub_bom = $bom_cache[$item_id];
			foreach ($sub_bom as $sub_material) {
				$sub_item_no = $sub_material->item_no_id ?? null;
				if (empty($sub_item_no)) continue;

				$sub_consum_qty = (float)($sub_material->qty ?? 1);
				if ($sub_consum_qty <= 0) continue;

				// Calculate next level's requirement based on the current level's shortfall
				$sub_required_qty = $sub_consum_qty * $shortfall_for_children;

				$next_level = $sub_material->item_level ?? ($level !== null ? $level + 1 : 1);
				$next_parent_id = $sub_material->parent_id ?? $item_id;

				$this->collect_material_usage(
					$fg_id,
					$sub_item_no,
					$report_id,
					$sub_required_qty,
					$sub_consum_qty,
					$material_usage_data,
					$bom_cache,
					$inv_cache,
					$next_level,
					$next_parent_id,
					$visited,
					$depth + 1,
					$next_level_is_fulfilled // Pass fulfillment status to children
				);
			}
		}
	}

	// Working Code
	/*public function track_material_usage($fg_id, $report_id, $order_qty, $bom_cache = null, $inv_cache = null) {
		error_log("track_material_usage: Start fg_id=$fg_id, order_qty=$order_qty");

		// Fetch BOM data from cache or database
		$fg_bom_material = $bom_cache && isset($bom_cache[$fg_id])
			? $bom_cache[$fg_id]
			: $this->get_fg_bom_material($fg_id);

		$material_usage_data = [];
		if (!empty($fg_bom_material) && $order_qty > 0) {
			foreach ($fg_bom_material as $fg_material) {
				if ($fg_material->item_type_id != '1') { // Assuming '1' is Finished Good
					$item_no = $fg_material->item_no_id ?? null;
					if (empty($item_no)) {
						error_log("track_material_usage: Skipping item with empty item_no_id");
						continue;
					}
					$consum_qty = (float)($fg_material->qty ?? 1);
					if ($fg_material->qty === null) {
						error_log("track_material_usage: Fallback consum_qty=1 for item_no=$item_no due to null qty");
					}
					if ($consum_qty <= 0) {
						error_log("track_material_usage: Skipping item_no=$item_no with invalid consum_qty=$consum_qty");
						continue;
					}
					$required_qty = $consum_qty * $order_qty;
					if ($required_qty <= 0 && $order_qty > 0 && $consum_qty <= 0) {
						$required_qty = $order_qty;
						error_log("track_material_usage: Fallback required_qty=$required_qty due to invalid consum_qty");
					}
					if ($required_qty <= 0) {
						error_log("track_material_usage: Skipping item_no=$item_no with required_qty=$required_qty");
						continue;
					}

					$this->collect_material_usage(
						$fg_id,
						$item_no,
						$report_id,
						$required_qty,
						$consum_qty,
						$material_usage_data,
						$bom_cache,
						$inv_cache,
						$fg_material->item_level ?? null,
						$fg_material->parent_id ?? null
					);
				}
			}
		}

		error_log("track_material_usage: End, Material Usage Count: " . count($material_usage_data));
		return $material_usage_data;
	}

	private function collect_material_usage($fg_id, $item_id, $report_id, $required_qty, $consum_qty, &$material_usage_data, $bom_cache, $inv_cache, $level = null, $parent_id = null, $visited = [], $depth = 0, $parent_was_fulfilled = false) {
		error_log("collect_material_usage: item_id=$item_id, required_qty=$required_qty, parent_was_fulfilled=$parent_was_fulfilled");

		// Prevent infinite recursion
		if (isset($visited[$item_id])) {
			error_log("Cycle detected for item_id=$item_id");
			return;
		}
		$visited[$item_id] = true;

		if ($depth > 10) { // Max recursion depth
			error_log("Max recursion depth reached for item_id=$item_id");
			return;
		}

		// If parent was fulfilled, this level's requirement is 0
		$effective_required_qty = $parent_was_fulfilled ? 0 : $required_qty;

		// Fetch inventory and material details
		$inv_result = $inv_cache[$item_id] ?? $this->get_material_inventory_data($item_id, $report_id);
		$material_details = $this->get_material_details($item_id, $fg_id);

		$on_hand = (float)($inv_result->on_hand ?? 0);
		$allocated = (float)(self::$allocated_inventory[$item_id] ?? 0);
		$total_available = max(0, $on_hand - $allocated);

		// Calculate balance and shortage based on the effective required quantity
		$balance_qty = max(0, $total_available - $effective_required_qty);
		$shortage_qty = min(0, $total_available - $effective_required_qty);
		
		// This is the shortfall that determines the requirement for the next level
		$shortfall_for_children = max(0, $effective_required_qty - $total_available);

		error_log("item_id=$item_id, available=$total_available, effective_required=$effective_required_qty, shortfall_for_children=$shortfall_for_children");

		// Record material usage for the current item
		$material_usage_data[] = [
			'fg_id' => $fg_id,
			'level' => $level,
			'item' => $item_id,
			'description' => $material_details['description'] ?? 'N/A',
			'type' => $material_details['type'] ?? 'N/A',
			'uom' => $material_details['uom'] ?? 'Nos',
			'consum_qty' => $consum_qty,
			'required_qty' => $effective_required_qty, // Use the effective quantity
			'on_hand_qty' => $on_hand,
			'balance_qty' => $balance_qty,
			'shortage_qty' => $shortage_qty,
			'shortfall_for_children' => $shortfall_for_children // Added for transparency
		];

		// Always process sub-components if they exist
		$is_subassembly = !empty($bom_cache[$item_id]);
		if ($is_subassembly) {
			// Determine if the next level should have a zero requirement
			$next_level_is_fulfilled = $parent_was_fulfilled || ($shortfall_for_children == 0);

			$sub_bom = $bom_cache[$item_id];
			foreach ($sub_bom as $sub_material) {
				$sub_item_no = $sub_material->item_no_id ?? null;
				if (empty($sub_item_no)) continue;

				$sub_consum_qty = (float)($sub_material->qty ?? 1);
				if ($sub_consum_qty <= 0) continue;

				// Calculate next level's requirement based on the current level's shortfall
				$sub_required_qty = $sub_consum_qty * $shortfall_for_children;

				$next_level = $sub_material->item_level ?? ($level !== null ? $level + 1 : 1);
				$next_parent_id = $sub_material->parent_id ?? $item_id;

				$this->collect_material_usage(
					$fg_id,
					$sub_item_no,
					$report_id,
					$sub_required_qty,
					$sub_consum_qty,
					$material_usage_data,
					$bom_cache,
					$inv_cache,
					$next_level,
					$next_parent_id,
					$visited,
					$depth + 1,
					$next_level_is_fulfilled // Pass fulfillment status to children
				);
			}
		}
	}*/

	public function get_material_usage_report($item_id, $report_id)
	{
		$this->db->select('tbl_bpr_mts_material_usage.*,tbl_item_management.item_no,tbl_item_management.description');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_material_usage.item', 'left');
		$this->db->where('tbl_bpr_mts_material_usage.fg_id', $item_id);
		$this->db->where('tbl_bpr_mts_material_usage.report_id', $report_id);
		$query = $this->db->get('tbl_bpr_mts_material_usage');
		return $query->result();
	}
	public function get_mto_material_usage_report($item_id, $report_id)
	{
		$this->db->select('tbl_bpr_mto_material_usage.*,tbl_item_management.item_no,tbl_item_management.description');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mto_material_usage.item', 'left');
		$this->db->where('tbl_bpr_mto_material_usage.fg_id', $item_id);
		$this->db->where('tbl_bpr_mto_material_usage.report_id', $report_id);
		$query = $this->db->get('tbl_bpr_mto_material_usage');
		return $query->result();
	}

	public function get_vendor_id($supplier_name)
	{
		$this->db->select('id');
		$this->db->where('supplier_name', $supplier_name);
		$query = $this->db->get('tbl_supplier_management');
		$result = $query->row();

		if (empty($result)) {
			$data = array(
				'supplier_name' => $supplier_name,
				'created_on'    => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_supplier_management', $data);
			return $this->db->insert_id();
		} else {
			return $result->id;
		}
	}

	public function get_shortage_item_data($search, $length, $start)
	{
		$this->db->distinct();
		$this->db->select('
			tbl_bpr_mts_shortage_items.*,
			tbl_report.report_number,
			tbl_report.created_on as report_created_on,
			tbl_item_management.item_no,
			tbl_item_management.description as item_description,
			tbl_work_order.work_order_no,
			tbl_work_order.shift_id as wo_shift_id,
			tbl_work_order_items.date as wo_date,
			tbl_work_order_items.issue_qty as wo_issue_qty,
			tbl_work_order_items.job_order_no as wo_job_order_no,
			tbl_work_order_items.production_qty as wo_production_qty,
			tbl_work_order_items.tag_qty as wo_tag_qty,
			tbl_work_order_items.production_status as wo_production_status,
			tbl_work_order_items.planner_remark as wo_planner_remark,
			tbl_work_order_items.store_remark as wo_store_remark,
			tbl_work_order_items.production_remark as wo_production_remark,
			tbl_work_order_items.plan_qty as wo_plan_qty,
			tbl_shift.name as shift_name,
			tbl_shift.from as shift_from,
			tbl_shift.to as shift_to
		');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_bpr_mts_shortage_items.report_id');
		$this->db->join('tbl_work_order', 'tbl_work_order.id = tbl_bpr_mts_shortage_items.work_order_id', 'left');
		$this->db->join('tbl_shift', 'tbl_shift.id = tbl_work_order.shift_id', 'left');
		$this->db->join('tbl_work_order_items', 'tbl_work_order_items.id = tbl_bpr_mts_shortage_items.work_order_item_id', 'left');

		if ($this->input->post('filter_report') != "") {
			$this->db->where('tbl_report.report_number', $this->input->post('filter_report'));
		}
		if ($this->input->post('filter_work_order') != "") {
			$this->db->where('tbl_work_order.id', $this->input->post('filter_work_order'));
		}
		if ($this->input->post('filter_shift') != "") {
			$this->db->where('tbl_work_order.shift_id', $this->input->post('filter_shift'));
		}
		if ($this->input->post('filter_date') != "") {
			$this->db->where('tbl_work_order.date', date('Y-m-d', strtotime($this->input->post('filter_date'))));
		}
		if ($this->input->post('filter_line') != "") {
		}

		if ($search != "") {
			$this->db->group_start();
			$this->db->like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.created_on', $search);
			$this->db->or_like('tbl_item_management.item_no', $search);
			$this->db->or_like('tbl_item_management.description', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.created_on', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.report_type', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.required_quantity', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.total_on_hand_qty', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.balance_on_hand_qty', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.receiving_qty', $search);
			$this->db->or_like('tbl_bpr_mts_shortage_items.short_quantity', $search);
			$this->db->or_like('tbl_work_order.work_order_no', $search);
			$this->db->or_like('tbl_work_order_items.date', $search);
			$this->db->or_like('tbl_work_order_items.issue_qty', $search);
			$this->db->or_like('tbl_work_order_items.job_order_no', $search);
			$this->db->or_like('tbl_work_order_items.production_qty', $search);
			$this->db->or_like('tbl_work_order_items.tag_qty', $search);
			$this->db->or_like('tbl_work_order_items.production_status', $search);
			$this->db->or_like('tbl_work_order_items.planner_remark', $search);
			$this->db->or_like('tbl_work_order_items.store_remark', $search);
			$this->db->or_like('tbl_work_order_items.production_remark', $search);
			$this->db->or_like('tbl_shift.name', $search);
			$this->db->or_like('tbl_shift.from', $search);
			$this->db->or_like('tbl_shift.to', $search);
			$this->db->group_end();
		}

		$this->db->where('tbl_report.is_deleted', '0');
		$this->db->where('tbl_bpr_mts_shortage_items.is_deleted', '0');
		$this->db->where('tbl_item_management.is_deleted', '0');
		$this->db->group_by('tbl_bpr_mts_shortage_items.id');
		$this->db->order_by('tbl_bpr_mts_shortage_items.id', 'ASC');

		if ($length != "" && $length > "0" && $start >= 0) {
			$this->db->limit($length, $start);
		}

		$result = $this->db->get('tbl_bpr_mts_shortage_items');
		return $result->result();
	}
	
	

	public function get_shortage_item_details($shortage_items_tbl_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $shortage_items_tbl_id);
		$query = $this->db->get('tbl_bpr_mts_shortage_items');
		return $query->row();
	}

	public function get_work_order_items($id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_work_order');
		return $query->result();
	}

	public function get_work_order($line_id, $shift_id, $date)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('line_id', $line_id);
		$this->db->where('shift_id', $shift_id);
		$this->db->where('date', date('Y-m-d', strtotime($date)));
		$query = $this->db->get('tbl_work_order');
		return $query->row();
	}

	public function get_item_work_order($material_code, $shortage_items_tbl_id)
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('shortage_items_tbl_id', $shortage_items_tbl_id);
		$this->db->where('material_code', $material_code);
		$query = $this->db->get('tbl_work_order_items');
		return $query->row();
	}

	public function set_work_order()
	{
		//echo '<pre>'; print_r($_POST); exit;
		$line_id = $this->input->post('line_id');
		$shift_id = $this->input->post('shift_id');
		$date = $this->input->post('date');


		$wo_exist = $this->get_work_order($line_id, $shift_id, $date);

		if (!empty($wo_exist)) {
			$work_order_id = $wo_exist->id;
			$line_id = $wo_exist->line_id;
			$shift_id = $wo_exist->shift_id;
			$date = $wo_exist->date;
		} else {
			$data = array(
				'line_id'		=>	$line_id,
				'shift_id'		=>	$shift_id,
				'date'			=>	date('Y-m-d', strtotime($date)),
				'created_on'	=>	date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_work_order', $data);
			$work_order_id = $this->db->insert_id();

			$no_data = array(
				'work_order_no'	=>	str_pad($work_order_id, 6, '0', STR_PAD_LEFT)
			);
			$this->db->where('id', $work_order_id);
			$this->db->update('tbl_work_order', $no_data);
		}

		$items = $this->input->post('items') != "" && is_array($this->input->post('items')) && !empty($this->input->post('items')) ? $this->input->post('items') : [];
		if (!empty($items)) {
			for ($i = 0; $i < count($items); $i++) {
				$this->set_work_order_item($line_id, $work_order_id, $items[$i]);
			}
		}

		return '1';
	}

	public function set_work_order_item($line_id, $work_order_id, $item)
	{
		$is_log = '0';
		$shortage_item = $this->get_shortage_item_details($item['shortage_items_tbl_id']);
		if (!empty($shortage_item)) {
			$exist = $this->get_item_work_order($shortage_item->material_code, $shortage_item->id);
			if (!empty($exist)) {
				$item_data = [];

				if ($work_order_id != $exist->work_order_id) {
					$item_data['work_order_id'] = $work_order_id;
				}
				if ($line_id != $exist->line_id) {
					$item_data['line_id'] = $line_id;
				}
				if ($item['assigned_shift'] != $exist->assigned_shift) {
					$item_data['assigned_shift'] = $item['assigned_shift'];
				}
				if (date('Y-m-d', strtotime($item['date'])) != $exist->date) {
					$item_data['date'] = date('Y-m-d', strtotime($item['date']));
				}

				if ($item['issue_qty'] != $exist->issue_qty) {
					$item_data['issue_qty'] = $item['issue_qty'];
				}
				if ($item['job_order_no'] != $exist->job_order_no) {
					$item_data['job_order_no'] = $item['job_order_no'];
				}
				if ($item['production_qty'] != $exist->production_qty) {
					$item_data['production_qty'] = $item['production_qty'];
				}
				if ($item['tag_qty'] != $exist->tag_qty) {
					$item_data['tag_qty'] = $item['tag_qty'];
				}
				if ($item['production_status'] != $exist->production_status) {
					$item_data['production_status'] = $item['production_status'];
				}
				if ($item['planner_remark'] != $exist->planner_remark) {
					$item_data['planner_remark'] = $item['planner_remark'];
				}
				if ($item['store_remark'] != $exist->store_remark) {
					$item_data['store_remark'] = $item['store_remark'];
				}
				if ($item['production_remark'] != $exist->production_remark) {
					$item_data['production_remark'] = $item['production_remark'];
				}
				if ($item['plan_qty'] != $exist->plan_qty) {
					$item_data['plan_qty'] = $item['plan_qty'];
				}

				if (!empty($item_data)) {
					$this->db->where('id', $exist->id);
					$this->db->update('tbl_work_order_items', $item_data);
					$is_log = '1';

					$log_type = '0';
					$description = 'Work Order Details Updated On ' . date('d M, Y h:i A');
				}

				$work_order_item_id = $exist->id;

				$old_issue_qty = $exist->issue_qty;
				$old_job_order_no = $exist->job_order_no;
				$old_production_qty = $exist->production_qty;
				$old_tag_qty = $exist->tag_qty;
				$old_production_status = $exist->production_status;
				$old_planner_remark = $exist->planner_remark;
				$old_store_remark = $exist->store_remark;
				$old_production_remark = $exist->production_remark;
			} else {
				$item_data = array(
					'work_order_id'			=>	$work_order_id,
					'line_id'				=>	$line_id,
					'assigned_shift'		=>	$item['assigned_shift'],
					'date'					=>	date('Y-m-d', strtotime($item['date'])),

					'material_code'			=>	$shortage_item->material_code,
					'shortage_items_tbl_id'	=>	$shortage_item->id,
					'report_id'				=>	$shortage_item->report_id,
					'report_type'			=>	$shortage_item->report_type,

					'plan_qty'				=>	$item['plan_qty'],
					'issue_qty'				=>	$item['issue_qty'],
					'job_order_no'			=>	$item['job_order_no'],
					'production_qty'		=>	$item['production_qty'],
					'tag_qty'				=>	$item['tag_qty'],
					'production_status'		=>	$item['production_status'],
					'planner_remark'		=>	$item['planner_remark'],
					'store_remark'			=>	$item['store_remark'],
					'production_remark'		=>	$item['production_remark'],

					'created_on'			=>	date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_work_order_items', $item_data);
				$work_order_item_id = $this->db->insert_id();
				$is_log = '1';

				$old_issue_qty = null;
				$old_job_order_no = null;
				$old_production_qty = null;
				$old_tag_qty = null;
				$old_production_status = null;
				$old_planner_remark = null;
				$old_store_remark = null;
				$old_production_remark = null;

				$log_type = '0';
				$description = 'New Work Order Generated On ' . date('d M, Y h:i A');
			}

			if ($is_log == "1") {
				$log_data = array(
					'type'					=>	$log_type,
					'description'			=>	$description,

					'work_order_id'			=>	$work_order_id,
					'work_order_item_id'	=>	$work_order_item_id,
					'line_id'				=>	$line_id,
					'assigned_shift'		=>	$item['assigned_shift'],
					'date'					=>	date('Y-m-d', strtotime($item['date'])),

					'material_code'			=>	$shortage_item->material_code,
					'shortage_items_tbl_id'	=>	$shortage_item->id,
					'report_id'				=>	$shortage_item->report_id,
					'report_type'			=>	$shortage_item->report_type,

					'issue_qty'				=>	$item['issue_qty'],
					'job_order_no'			=>	$item['job_order_no'],
					'production_qty'		=>	$item['production_qty'],
					'tag_qty'				=>	$item['tag_qty'],
					'production_status'		=>	$item['production_status'],
					'planner_remark'		=>	$item['planner_remark'],
					'store_remark'			=>	$item['store_remark'],
					'production_remark'		=>	$item['production_remark'],

					'old_issue_qty'			=>	$old_issue_qty,
					'old_job_order_no'		=>	$old_job_order_no,
					'old_production_qty'	=>	$old_production_qty,
					'old_tag_qty'			=>	$old_tag_qty,
					'old_production_status'	=>	$old_production_status,
					'old_planner_remark'	=>	$old_planner_remark,
					'old_store_remark'		=>	$old_store_remark,
					'old_production_remark'	=>	$old_production_remark,

					'created_on'			=>	date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_work_order_items_history', $log_data);
			}

			$parent_data = array(
				'work_order_id'			=>	$work_order_id,
				'work_order_item_id'	=>	$work_order_item_id
			);
			if($item['report_type'] == 'MTO'){
				$this->db->where('id', $shortage_item->id);
				$this->db->update('tbl_bpr_mto_shortage_report', $parent_data);
			}else if($item['report_type'] == 'MTS'){
				$this->db->where('id', $shortage_item->id);
				$this->db->update('tbl_bpr_mts_shortage_report', $parent_data);
			}
			

			return '1';
		} else {
			return '0';
		}
	}
	public function get_generated_shortage_summary_data_paginated($report_number, $start, $length)
	{
		$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_report.report_number, SUM(tbl_bpr_mts_shortage_items.short_quantity) as total_short_quantity, tbl_item_management.item_no, tbl_item_management.description as item_description');
		$this->db->where('tbl_report.report_number', $report_number);
		$this->db->join('tbl_report', 'tbl_report.id = tbl_bpr_mts_shortage_items.report_id');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
		$this->db->group_by('tbl_bpr_mts_shortage_items.material_code', 'tbl_bpr_mts_shortage_items.report_type');
		$this->db->limit($length, $start);
		$query = $this->db->get('tbl_bpr_mts_shortage_items');
		return $query->result();
	}

	public function get_generated_shortage_summary_data_count($report_number)
	{
		$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_report.report_number, SUM(tbl_bpr_mts_shortage_items.short_quantity) as total_short_quantity, tbl_item_management.item_no, tbl_item_management.description as item_description');
		$this->db->where('tbl_report.report_number', $report_number);
		$this->db->join('tbl_report', 'tbl_report.id = tbl_bpr_mts_shortage_items.report_id');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_items.material_code');
		$this->db->group_by('tbl_bpr_mts_shortage_items.material_code', 'tbl_bpr_mts_shortage_items.report_type');
		$query = $this->db->get('tbl_bpr_mts_shortage_items');
		return $query->num_rows();
	}
	public function get_item_supplier_one_data($report_id, $material_code)
	{
		$this->db->select('tbl_item_management.*, tbl_supplier_management.supplier_name');
		$this->db->where('tbl_item_management.id', $material_code);
		$this->db->join('tbl_supplier_management', 'tbl_supplier_management.id = tbl_item_management.supplier_1');
		$query = $this->db->get('tbl_item_management');
		$query = $query->row();
		if (!empty($query)) {
			$this->db->where('report_id', $report_id);
			$this->db->where('item_id', $material_code);
			$this->db->where('vendor_id', $query->supplier_1);
			$result = $this->db->get('tbl_trigger_report')->row();
			if (!empty($result)) {
				$query->trigger = $result->asn_qty;

				return $query;
			} else {
				$query->trigger = '0';
				return $query;
			}
		}
	}
	public function get_item_supplier_two_data($report_id, $material_code)
	{
		$this->db->select('tbl_item_management.*, tbl_supplier_management.supplier_name');
		$this->db->where('tbl_item_management.id', $material_code);
		$this->db->join('tbl_supplier_management', 'tbl_supplier_management.id = tbl_item_management.supplier_2');
		$query = $this->db->get('tbl_item_management');
		$query = $query->row();
		if (!empty($query)) {
			$this->db->where('report_id', $report_id);
			$this->db->where('item_id', $material_code);
			$this->db->where('vendor_id', $query->supplier_2);
			$result = $this->db->get('tbl_trigger_report')->row();
			if (!empty($result)) {
				$query->trigger = $result->asn_qty;

				return $query;
			} else {
				$query->trigger = '0';
				return $query;
			}
		}
	}
	public function get_item_supplier_three_data($report_id, $material_code)
	{
		$this->db->select('tbl_item_management.*, tbl_supplier_management.supplier_name');
		$this->db->where('tbl_item_management.id', $material_code);
		$this->db->join('tbl_supplier_management', 'tbl_supplier_management.id = tbl_item_management.supplier_3');
		$query = $this->db->get('tbl_item_management');
		$query = $query->row();
		if (!empty($query)) {
			$this->db->where('report_id', $report_id);
			$this->db->where('item_id', $material_code);
			$this->db->where('vendor_id', $query->supplier_3);
			$result = $this->db->get('tbl_trigger_report')->row();
			if (!empty($result)) {
				$query->trigger = $result->asn_qty;

				return $query;
			} else {
				$query->trigger = '0';
				return $query;
			}
		}
	}
	public function get_for_shortage_fg_details($report_id, $material_code, $report_type)
	{
		if ($report_type == 'MTS') {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_bpr_mts_shortage_report.ffpl_item_number');
			$this->db->where('tbl_bpr_mts_shortage_items.report_id', $report_id);
			$this->db->where('tbl_bpr_mts_shortage_items.material_code', $material_code);
			$this->db->where('tbl_bpr_mts_shortage_report.plan_qty >', '0');
			$this->db->join('tbl_bpr_mts_shortage_report', 'tbl_bpr_mts_shortage_report.id = tbl_bpr_mts_shortage_items.shortage_report_id');
			$result = $this->db->get('tbl_bpr_mts_shortage_items')->result();
			return $result;
		} else if ($report_type == 'MTO') {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_bpr_mto_shortage_report.ff_part_no as ffpl_item_number');
			$this->db->where('tbl_bpr_mts_shortage_items.report_id', $report_id);
			$this->db->where('tbl_bpr_mts_shortage_items.material_code', $material_code);
			$this->db->where('tbl_bpr_mto_shortage_report.plan_qty >', '0');
			$this->db->join('tbl_bpr_mto_shortage_report', 'tbl_bpr_mto_shortage_report.id = tbl_bpr_mts_shortage_items.shortage_report_id');
			$result = $this->db->get('tbl_bpr_mts_shortage_items')->result();
			return $result;
		}
	}
	public function get_work_order_item_details($report_id, $material_code, $report_type, $filter_line = null)
	{
	  
		if ($report_type == 'MTS') {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_bpr_mts_shortage_report.ffpl_item_number,tbl_bpr_mts_shortage_report.priority_mark, tbl_bpr_mts_shortage_report.customer_item_number, tbl_bpr_mts_shortage_report.full_qty, tbl_bpr_mts_shortage_report.plan_qty, tbl_bpr_mts_shortage_report.gap_qty, tbl_part_master.cycle_time1, tbl_part_master.change_over_time1, tbl_part_master.line_name_hsg_id');
			$this->db->where('tbl_bpr_mts_shortage_items.report_id', $report_id);
			$this->db->where('tbl_bpr_mts_shortage_items.material_code', $material_code);
			$this->db->where('tbl_part_master.line_name_hsg_id', $filter_line);
			$this->db->where('tbl_bpr_mts_shortage_report.plan_qty >', '0');
			$this->db->join('tbl_bpr_mts_shortage_report', 'tbl_bpr_mts_shortage_report.id = tbl_bpr_mts_shortage_items.shortage_report_id');
			$this->db->join('tbl_part_master', 'tbl_part_master.air_cleaner_part_id = tbl_bpr_mts_shortage_items.material_code');
			$result = $this->db->get('tbl_bpr_mts_shortage_items')->row();
		
			return $result;
		} else if ($report_type == 'MTO') {
			$this->db->select('tbl_bpr_mts_shortage_items.*, tbl_bpr_mto_shortage_report.customer_part_no as customer_item_number,tbl_bpr_mto_shortage_report.priority_mark, tbl_bpr_mto_shortage_report.ff_part_no as ffpl_item_number, tbl_bpr_mto_shortage_report.full_qty, tbl_bpr_mto_shortage_report.plan_qty,, tbl_bpr_mto_shortage_report.order_quantity as gap_qty, tbl_part_master.cycle_time1, tbl_part_master.change_over_time1, tbl_part_master.line_name_hsg_id');
			$this->db->where('tbl_bpr_mts_shortage_items.report_id', $report_id);
			$this->db->where('tbl_bpr_mts_shortage_items.material_code', $material_code);
			$this->db->where('tbl_part_master.line_name_hsg_id', $filter_line);
			$this->db->where('tbl_bpr_mto_shortage_report.plan_qty >', '0');
			$this->db->join('tbl_bpr_mto_shortage_report', 'tbl_bpr_mto_shortage_report.id = tbl_bpr_mts_shortage_items.shortage_report_id');
			$this->db->join('tbl_part_master', 'tbl_part_master.air_cleaner_part_id = tbl_bpr_mts_shortage_items.material_code');
			$result = $this->db->get('tbl_bpr_mts_shortage_items')->row();
		
			return $result;
		}
	}
	public function get_production_time_by_line_and_shift($line_id, $shift_id)
	{
		if (empty($line_id) || empty($shift_id)) {
			return 0; // Default value if filters are not set
		}

		$this->db->from('tbl_shift_wise_line_production_time');
		$this->db->where('shift_id', $shift_id);
		$this->db->where('line_id', $line_id);

		$query = $this->db->get();
		$result = $query->row();

		if ($result && !empty($result->production_time)) {
			return $result->production_time;
		}

		return 0; // Return a default value if no specific time is found
	}
	
	
	public function get_shortage_fg_item_data($search, $length, $start)
	{
		$this->db->distinct();
		$this->db->select('
			tbl_bpr_mto_shortage_report.*,
			tbl_report.report_number,
			tbl_report.created_on as report_created_on,
			tbl_item_management.item_no,
			tbl_item_management.description as item_description,
			tbl_work_order.work_order_no,
			tbl_work_order.shift_id as wo_shift_id,
			tbl_work_order_items.date as wo_date,
			tbl_work_order_items.issue_qty as wo_issue_qty,
			tbl_work_order_items.job_order_no as wo_job_order_no,
			tbl_work_order_items.production_qty as wo_production_qty,
			tbl_work_order_items.tag_qty as wo_tag_qty,
			tbl_work_order_items.production_status as wo_production_status,
			tbl_work_order_items.planner_remark as wo_planner_remark,
			tbl_work_order_items.store_remark as wo_store_remark,
			tbl_work_order_items.production_remark as wo_production_remark,
			tbl_work_order_items.plan_qty as wo_plan_qty,
			tbl_shift.name as shift_name,
			tbl_shift.from as shift_from,
			tbl_shift.to as shift_to,
			tbl_part_master.cycle_time1, tbl_part_master.change_over_time1, tbl_part_master.line_name_hsg_id
		');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mto_shortage_report.ff_part_no_id');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_bpr_mto_shortage_report.report_id');
		$this->db->join('tbl_work_order', 'tbl_work_order.id = tbl_bpr_mto_shortage_report.work_order_id', 'left');
		$this->db->join('tbl_shift', 'tbl_shift.id = tbl_work_order.shift_id', 'left');
		$this->db->join('tbl_work_order_items', 'tbl_work_order_items.id = tbl_bpr_mto_shortage_report.work_order_item_id', 'left');
		$this->db->join('tbl_part_master', 'tbl_part_master.fg_id = tbl_bpr_mto_shortage_report.ff_part_no_id');

		if ($this->input->post('filter_report') != "") {
			$this->db->where('tbl_report.report_number', $this->input->post('filter_report'));
		}
		if ($this->input->post('filter_work_order') != "") {
			$this->db->where('tbl_work_order.id', $this->input->post('filter_work_order'));
		}
		if ($this->input->post('filter_shift') != "") {
			$this->db->where('tbl_work_order.shift_id', $this->input->post('filter_shift'));
		}
		if ($this->input->post('filter_date') != "") {
			$this->db->where('tbl_work_order.date', date('Y-m-d', strtotime($this->input->post('filter_date'))));
		}
		if ($this->input->post('filter_line') != "") {
		    $this->db->where('tbl_part_master.line_name_hsg_id', $this->input->post('filter_line'));
		}
		
		$this->db->where('tbl_bpr_mto_shortage_report.plan_qty >', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.created_on', $search);
			$this->db->or_like('tbl_item_management.item_no', $search);
			$this->db->or_like('tbl_item_management.description', $search);
			$this->db->or_like('tbl_work_order.work_order_no', $search);
			$this->db->or_like('tbl_work_order_items.date', $search);
			$this->db->or_like('tbl_work_order_items.issue_qty', $search);
			$this->db->or_like('tbl_work_order_items.job_order_no', $search);
			$this->db->or_like('tbl_work_order_items.production_qty', $search);
			$this->db->or_like('tbl_work_order_items.tag_qty', $search);
			$this->db->or_like('tbl_work_order_items.production_status', $search);
			$this->db->or_like('tbl_work_order_items.planner_remark', $search);
			$this->db->or_like('tbl_work_order_items.store_remark', $search);
			$this->db->or_like('tbl_work_order_items.production_remark', $search);
			$this->db->or_like('tbl_shift.name', $search);
			$this->db->or_like('tbl_shift.from', $search);
			$this->db->or_like('tbl_shift.to', $search);
			$this->db->group_end();
		}

		$this->db->where('tbl_report.is_deleted', '0');
		$this->db->where('tbl_bpr_mto_shortage_report.is_deleted', '0');
		$this->db->where('tbl_item_management.is_deleted', '0');
		$this->db->group_by('tbl_bpr_mto_shortage_report.ff_part_no_id');
		$this->db->order_by('tbl_bpr_mto_shortage_report.id', 'ASC');

		if ($length != "" && $length > "0" && $start >= 0) {
			$this->db->limit($length, $start);
		}

		$mto_result = $this->db->get('tbl_bpr_mto_shortage_report')->result();

		if(!empty($mto_result)){
			foreach($mto_result as $mto_results){
				$mto_results->report_type = 'MTO';
			}
		}


		$this->db->select('
			tbl_bpr_mts_shortage_report.*, tbl_bpr_mts_shortage_report.ffpl_item_number as ff_part_no, tbl_bpr_mts_shortage_report.customer_item_number as customer_part_no,
			tbl_report.report_number,
			tbl_report.created_on as report_created_on,
			tbl_item_management.item_no,
			tbl_item_management.description as item_description,
			tbl_work_order.work_order_no,
			tbl_work_order.shift_id as wo_shift_id,
			tbl_work_order_items.date as wo_date,
			tbl_work_order_items.issue_qty as wo_issue_qty,
			tbl_work_order_items.job_order_no as wo_job_order_no,
			tbl_work_order_items.production_qty as wo_production_qty,
			tbl_work_order_items.tag_qty as wo_tag_qty,
			tbl_work_order_items.production_status as wo_production_status,
			tbl_work_order_items.planner_remark as wo_planner_remark,
			tbl_work_order_items.store_remark as wo_store_remark,
			tbl_work_order_items.production_remark as wo_production_remark,
			tbl_work_order_items.plan_qty as wo_plan_qty,
			tbl_shift.name as shift_name,
			tbl_shift.from as shift_from,
			tbl_shift.to as shift_to,
			tbl_part_master.cycle_time1, tbl_part_master.change_over_time1, tbl_part_master.line_name_hsg_id
		');
		$this->db->join('tbl_item_management', 'tbl_item_management.id = tbl_bpr_mts_shortage_report.ffpl_item_id');
		$this->db->join('tbl_report', 'tbl_report.id = tbl_bpr_mts_shortage_report.report_id');
		$this->db->join('tbl_work_order', 'tbl_work_order.id = tbl_bpr_mts_shortage_report.work_order_id', 'left');
		$this->db->join('tbl_shift', 'tbl_shift.id = tbl_work_order.shift_id', 'left');
		$this->db->join('tbl_work_order_items', 'tbl_work_order_items.id = tbl_bpr_mts_shortage_report.work_order_item_id', 'left');
		$this->db->join('tbl_part_master', 'tbl_part_master.fg_id = tbl_bpr_mts_shortage_report.ffpl_item_id');

		if ($this->input->post('filter_report') != "") {
			$this->db->where('tbl_report.report_number', $this->input->post('filter_report'));
		}
		if ($this->input->post('filter_work_order') != "") {
			$this->db->where('tbl_work_order.id', $this->input->post('filter_work_order'));
		}
		if ($this->input->post('filter_shift') != "") {
			$this->db->where('tbl_work_order.shift_id', $this->input->post('filter_shift'));
		}
		if ($this->input->post('filter_date') != "") {
			$this->db->where('tbl_work_order.date', date('Y-m-d', strtotime($this->input->post('filter_date'))));
		}
		if ($this->input->post('filter_line') != "") {
		    $this->db->where('tbl_part_master.line_name_hsg_id', $this->input->post('filter_line'));
		}
		
		$this->db->where('tbl_bpr_mts_shortage_report.plan_qty >', '0');

		if ($search != "") {
			$this->db->group_start();
			$this->db->like('tbl_report.report_number', $search);
			$this->db->or_like('tbl_report.created_on', $search);
			$this->db->or_like('tbl_item_management.item_no', $search);
			$this->db->or_like('tbl_item_management.description', $search);
			$this->db->or_like('tbl_work_order.work_order_no', $search);
			$this->db->or_like('tbl_work_order_items.date', $search);
			$this->db->or_like('tbl_work_order_items.issue_qty', $search);
			$this->db->or_like('tbl_work_order_items.job_order_no', $search);
			$this->db->or_like('tbl_work_order_items.production_qty', $search);
			$this->db->or_like('tbl_work_order_items.tag_qty', $search);
			$this->db->or_like('tbl_work_order_items.production_status', $search);
			$this->db->or_like('tbl_work_order_items.planner_remark', $search);
			$this->db->or_like('tbl_work_order_items.store_remark', $search);
			$this->db->or_like('tbl_work_order_items.production_remark', $search);
			$this->db->or_like('tbl_shift.name', $search);
			$this->db->or_like('tbl_shift.from', $search);
			$this->db->or_like('tbl_shift.to', $search);
			$this->db->group_end();
		}

		$this->db->where('tbl_report.is_deleted', '0');
		$this->db->where('tbl_bpr_mts_shortage_report.is_deleted', '0');
		$this->db->where('tbl_item_management.is_deleted', '0');
		$this->db->group_by('tbl_bpr_mts_shortage_report.ffpl_item_id');
		$this->db->order_by('tbl_bpr_mts_shortage_report.id', 'ASC');

		if ($length != "" && $length > "0" && $start >= 0) {
			$this->db->limit($length, $start);
		}

		$mts_result = $this->db->get('tbl_bpr_mts_shortage_report')->result();
		if(!empty($mts_result)){
			foreach($mts_result as $mts_results){
				$mts_results->report_type = 'MTS';
			}
		}

		return array_merge($mto_result, $mts_result);
		
	}
}
