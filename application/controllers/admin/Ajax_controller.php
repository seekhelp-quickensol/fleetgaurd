<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_controller extends CI_Controller
{
  public function get_all_site_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_site_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['site_name'] = $print->site_name;



        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_site_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }


  public function get_all_good_type_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_good_type_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['good_type_name'] = $print->good_type_name;



        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_good_type_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }


  public function get_all_designation_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_designation_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['designation_name'] = $print->designation_name;



        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_designation_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }


  public function get_all_department_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_department_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['department_name'] = $print->department_name;



        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_department_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_plant_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_plant_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['plant_name'] = $print->plant_name;
        $sub_array['plant_code'] = $print->plant_code;



        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_plant_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_workshop_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_workshop_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['workshop_name'] = $print->workshop_name;




        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_workshop_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_item_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_item_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['item_name'] = $print->item_name;




        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_item_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_unit_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_unit_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['unit_name'] = $print->unit_name;




        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_unit_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }


  public function get_all_user_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_user_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['first_name'] = $print->first_name;
        $sub_array['middle_name'] = $print->middle_name;
        $sub_array['last_name'] = $print->last_name;
        $sub_array['employee_id'] = $print->employee_id;
        $sub_array['email'] = $print->email;
        if ($print->username != '') {
          $sub_array['username'] = $print->username;
        } else {
          $sub_array['username'] = '-';
        }

        $sub_array['department_id'] = $print->department_name;
        $sub_array['designation_id'] = $print->designation_name;
        $sub_array['profile_image'] = $print->profile_image;
        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_user_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_plant_codes()
  {
    $this->Admin_model->get_all_plant_codes();
  }

  public function get_all_line_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_line_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['plant_name'] = $print->plant_name;
        $sub_array['plant_code'] = $print->plant_code;
        $sub_array['workshop_name'] = $print->workshop_name;
        $sub_array['line_name'] = $print->line_name;
        $sub_array['line_code'] = $print->line_code;
        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_line_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function check_unique_line_name()
  {
    $this->Admin_model->check_unique_line_name();
  }

  public function check_unique_line_code()
  {
    $this->Admin_model->check_unique_line_code();
  }

  public function check_unique_plant_name()
  {
    $this->Admin_model->check_unique_plant_name();
  }

  public function check_unique_plant_code()
  {
    $this->Admin_model->check_unique_plant_code();
  }

  public function check_unique_workshop_name()
  {
    $this->Admin_model->check_unique_workshop_name();
  }

  public function get_all_line_names()
  {
    $this->Admin_model->get_all_line_names();
  }

  public function check_unique_finish_good_item_no()
  {
    $this->Admin_model->check_unique_finish_good_item_no();
  }

  public function check_unique_finish_good_description()
  {
    $this->Admin_model->check_unique_finish_good_description();
  }

  public function check_unique_air_cleaner_part_no()
  {
    $this->Admin_model->check_unique_air_cleaner_part_no();
  }

  public function check_unique_air_cleaner_part_description()
  {
    $this->Admin_model->check_unique_air_cleaner_part_description();
  }

  public function get_all_part_master_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_part_master_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['part_type'] = $print->part_type;
        $sub_array['finish_good_item_no'] = $print->finish_good_item_no;
        $sub_array['finish_good_description'] = $print->finish_good_description;
        $sub_array['air_cleaner_part_no'] = $print->air_cleaner_part_no;
        $sub_array['air_cleaner_part_description'] = $print->air_cleaner_part_description;
        $sub_array['line_name'] = $print->line_name;
        $sub_array['cycle_time1'] = $print->cycle_time1;
        $sub_array['change_over_time1'] = $print->change_over_time1;

        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_part_master_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_descriptions()
  {

    $this->Admin_model->get_all_descriptions();
  }

  public function check_unique_employee_id()
  {
    $employee_id = $this->input->post('employee_id');
    $id = $this->input->post('id');

    $this->db->where('employee_id', $employee_id);
    if (!empty($id)) {
      $this->db->where('id !=', $id);
    }
    $result = $this->db->get('tbl_user');

    echo $result->num_rows() > 0 ? 'exists' : 'unique';
  }

  public function check_unique_email()
  {
    $email = $this->input->post('email');
    $id = $this->input->post('id');

    $this->db->where('email', $email);
    if (!empty($id)) {
      $this->db->where('id !=', $id);
    }
    $result = $this->db->get('tbl_user');

    echo $result->num_rows() > 0 ? 'exists' : 'unique';
  }

  public function get_all_state()
  {
    $this->Admin_model->get_all_state();
  }
  public function get_all_cities()
  {
    $this->Admin_model->get_all_cities();
  }


  public function get_all_supplier_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_supplier_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['supplier_name'] = $print->supplier_name;
        $sub_array['site_id'] = $print->site_name;
        $sub_array['address_line1'] = $print->address_line1;
        $sub_array['address_line2'] = $print->address_line2;
        $sub_array['address_line3'] = $print->address_line3;
        $sub_array['city_id'] = $print->city_name;
        $sub_array['state_id'] = $print->state_name;
        $sub_array['country_id'] = $print->country_name;
        $sub_array['pin_code'] = $print->pin_code;
        $sub_array['type_of_good_id'] = $print->good_type_name;
        $sub_array['last_name'] = $print->last_name;
        $sub_array['first_name'] = $print->first_name;
        $sub_array['contact_no_1'] = $print->contact_no_1;
        $sub_array['contact_no_2'] = $print->contact_no_2;
        $sub_array['email'] = $print->email;
        $sub_array['email_1'] = $print->email_1;
        $sub_array['email_2'] = $print->email_2;
        $sub_array['email_3'] = $print->email_3;

        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_supplier_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }


  public function get_all_item_management_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_item_management_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['item_no'] = $print->item_no;
        $sub_array['description'] = $print->description;
        $sub_array['supplier_1'] = $print->one;
        $sub_array['supplier_1_sob'] = $print->supplier_1_sob;
        $sub_array['supplier_2'] = $print->two;
        $sub_array['supplier_2_sob'] = $print->supplier_2_sob;
        $sub_array['supplier_3'] = $print->three;
        $sub_array['supplier_3_sob'] = $print->supplier_3_sob;
        $sub_array['supplier_4'] = $print->four;
        $sub_array['supplier_4_sob'] = $print->supplier_4_sob;
        $sub_array['supplier_5'] = $print->five;
        $sub_array['supplier_5_sob'] = $print->supplier_5_sob;

        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_item_management_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }
  public function check_unique_item_no()
  {
    $item_no = $this->input->post('item_no');
    $id = $this->input->post('id');

    $this->db->where('item_no', $item_no);
    if (!empty($id)) {
      $this->db->where('id !=', $id);
    }
    $result = $this->db->get('tbl_item_management');

    echo $result->num_rows() > 0 ? 'exists' : 'unique';
  }


  public function get_all_bom_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_bom_list_ajax($start, $length, $search_value, $sorters);

    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $fg_code = $this->Admin_model->get_bom_fg_name($print->finish_good_item_id);

        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        if (!empty($fg_code)) {
          $sub_array['finish_good_item_id'] = $fg_code;
        } else {
          $sub_array['finish_good_item_id'] = $print->finish_good_item_id;
        }
        $sub_array['fg_item_description'] = $print->fg_item_description;

        $sub_array['item_no_id'] = $print->item_no;
        $sub_array['item_desc_id'] = $print->item_desc_id;

        $sub_array['item_level'] = $print->item_level;
        $sub_array['revision'] = $print->revision;
        $sub_array['item_type_id'] = $print->item_name;
        $sub_array['item_status'] = $print->item_status;
        $sub_array['uom_id'] = $print->unit_name;
        $sub_array['qty'] = $print->qty;


        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_bom_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function get_all_fg_list_ajax()
  {
    $page = $this->input->post('page');
    $size = $this->input->post('size');
    $sorters = $this->input->post('sorters');
    $filters = $this->input->post('filters');
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search');
    $search_value = $search['value'] ?? '';
    $length = max($length, 1);
    $document = $this->Admin_model->get_all_fg_list_ajax($start, $length, $search_value, $sorters);
    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $sub_array = array();
        $sub_array['sr_no'] = $offset++;
        $sub_array['id'] = $print->id;
        $sub_array['finish_good_item'] = $print->finish_good_item;
        $sub_array['item_description'] = $print->item_description;
        if ($print->status == "1") {
          $sub_array['status'] = 'active';
        } else {
          $sub_array['status'] = 'inactive';
        }
        $data[] = $sub_array;
      }
    }
    $total = $this->Admin_model->get_all_fg_list_ajax_count($search_value);
    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];
    echo json_encode($response);
    exit();
  }

  public function check_unique_finish_good_item()
  {
    $this->Admin_model->check_unique_finish_good_item();
  }

  public function check_unique_item_description()
  {
    $this->Admin_model->check_unique_item_description();
  }

  public function get_all_finish_good_item_descriptions()
  {

    $this->Admin_model->get_all_finish_good_item_descriptions();
  }

  public function get_all_order_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';
    $order_number = $this->input->post('order_number', TRUE);

    if (empty($order_number)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'order_number is required',
        'data' => []
      ]);
      exit();
    }

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_all_order_report_data_ajax($start, $length, $search_value, $sorters, $order_number);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['category'] = $print->category;
        $sub_array['sub_line'] = $print->sub_line;
        $sub_array['ffpl_item_number'] = $print->ffpl_item_number;
        $sub_array['ffpl_item_description'] = $print->ffpl_item_description;
        $sub_array['customer_item_number'] = $print->customer_item_number;
        $sub_array['customer_item_description'] = $print->customer_item_description;
        $sub_array['customer_name'] = $print->customer_name;
        $sub_array['pack_size'] = $print->pack_size;
        $sub_array['green_level'] = $print->green_level;
        $sub_array['actual_on_hand'] = $print->actual_on_hand;
        $sub_array['reservation'] = $print->reservation;
        $sub_array['intransit'] = $print->intransit;
        $sub_array['gap_qty'] = $print->gap_qty;
        $sub_array['penetration_in_percentage'] = $print->penetration_in_percentage;
        $sub_array['priority_mark'] = $print->priority_mark;
        $sub_array['plant_onhand'] = $print->plant_onhand;
        $sub_array['actual_gap'] = $print->actual_gap;

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_all_order_report_data_ajax_count($search_value, $order_number);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function get_all_mto_order_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';
    $order_number = $this->input->post('order_number', TRUE);

    if (empty($order_number)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'order_number is required',
        'data' => []
      ]);
      exit();
    }

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_all_mto_order_report_data_ajax($start, $length, $search_value, $sorters, $order_number);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['organization_name'] = $print->organization_name;
        $sub_array['order_category'] = $print->order_category;
        $sub_array['sales_order_number'] = $print->sales_order_number;
        $sub_array['version_no'] = $print->version_no;
        $sub_array['last_update_date'] = $print->last_update_date;
        $sub_array['ir_preparer_name'] = $print->ir_preparer_name;
        $sub_array['customer_name'] = $print->customer_name;
        $sub_array['line_entry_date'] = $print->line_entry_date;
        $sub_array['customer_part_no'] = $print->customer_part_no;
        $sub_array['ff_part_no'] = $print->ff_part_no;
        $sub_array['ff_part_description'] = $print->ff_part_description;
        $sub_array['category_code'] = $print->category_code;
        $sub_array['need_by_date'] = $print->need_by_date;
        $sub_array['order_quantity'] = $print->order_quantity;
        $sub_array['pending_order_quantity'] = $print->pending_order_quantity;
        $sub_array['plant_on_hand_quantity'] = $print->plant_on_hand_quantity;
        $sub_array['value'] = $print->value;
        $sub_array['time_buffer_penetration'] = $print->time_buffer_penetration;
        $sub_array['mfg_start_date'] = $print->mfg_start_date;
        $sub_array['original_request_date'] = $print->original_request_date;
        $sub_array['original_request_dates'] = $print->original_request_dates;
        $sub_array['spike_order_resaon'] = $print->spike_order_resaon;
        $sub_array['open_job_order_qty'] = $print->open_job_order_qty;
        $sub_array['net_pending_order_quantity'] = $print->net_pending_order_quantity;
        $sub_array['order_type'] = $print->order_type;

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_all_mto_order_report_data_ajax_count($search_value, $order_number);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function get_all_inventory_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';
    $order_number = $this->input->post('order_number', TRUE);

    if (empty($order_number)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'order_number is required',
        'data' => []
      ]);
      exit();
    }

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_all_inventory_report_data_ajax($start, $length, $search_value, $sorters, $order_number);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['item'] = $print->item;
        $sub_array['description'] = $print->description;
        $sub_array['scrap'] = $print->scrap;
        $sub_array['process_rej_scrap'] = $print->process_rej_scrap;
        $sub_array['shop_rm'] = $print->shop_rm;
        $sub_array['shop_sa'] = $print->shop_sa;
        $sub_array['osp'] = $print->osp;
        $sub_array['total_quantity'] = $print->total_quantity;
        $sub_array['unit_cost'] = $print->unit_cost;
        $sub_array['total_cost'] = $print->total_cost;
        $sub_array['max_quantity'] = $print->max_quantity;
        $sub_array['on_hand'] = $print->on_hand;
        $sub_array['production_line'] = $print->production_line;
        $sub_array['trading_flag'] = $print->trading_flag;

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_all_inventory_report_data_ajax_count($search_value, $order_number);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function get_all_trigger_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';
    $order_number = $this->input->post('order_number', TRUE);

    if (empty($order_number)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'order_number is required',
        'data' => []
      ]);
      exit();
    }

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_all_trigger_report_data_ajax($start, $length, $search_value, $sorters, $order_number);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['item_no'] = $print->item_no;
        $sub_array['description'] = $print->description;
        $sub_array['organization_name'] = $print->organization_name;
        $sub_array['vendor_name'] = $print->vendor_name;
        $sub_array['vendor_site'] = $print->vendor_site;
        $sub_array['release_date'] = $print->release_date;
        $sub_array['buffer'] = $print->buffer;
        $sub_array['priority_mark'] = $print->priority_mark;
        $sub_array['shipped_date'] = $print->shipped_date;
        $sub_array['release_qty'] = $print->release_qty;
        $sub_array['asn_qty'] = $print->asn_qty;
        $sub_array['difference'] = $print->difference;
        $sub_array['percentage'] = $print->percentage;

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_all_trigger_report_data_ajax_count($search_value, $order_number);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function check_unique_site_name()
  {
    $this->Admin_model->check_unique_site_name();
  }

  public function check_unique_good_type_name()
  {
    $this->Admin_model->check_unique_good_type_name();
  }

  public function check_unique_designation_name()
  {
    $this->Admin_model->check_unique_designation_name();
  }

  public function check_unique_department_name()
  {
    $this->Admin_model->check_unique_department_name();
  }

  public function check_unique_item_name()
  {
    $this->Admin_model->check_unique_item_name();
  }

  public function check_unique_unit_name()
  {
    $this->Admin_model->check_unique_unit_name();
  }
  public function get_all_finish_good_item_description()
  {
    $this->Admin_model->get_all_finish_good_item_description();
  }
  public function check_finish_good_item()
  {
    $this->Admin_model->check_finish_good_item();
  }
  public function get_finish_good_item_description()
  {
    $this->Admin_model->get_finish_good_item_description();
  }
  public function check_unique_bom_item()
  {
    $this->Admin_model->check_unique_bom_item();
  }
  public function get_all_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_all_report_data_ajax($start, $length, $search_value, $sorters);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['report_number'] = $print->report_number;
        $sub_array['date_time'] = date('d-m-Y h:i A', strtotime($print->created_on));
        $sub_array['order_report'] = 'View MTS Order';
        $sub_array['mto_order_report'] = 'View MTO Order';
        $sub_array['inventory_report'] = 'View Inventory';
        $sub_array['trigger_report'] = 'View Trigger Report';
        $sub_array['bpr_mto_report'] = 'View BPR MTO';
        $sub_array['bpr_mts_report'] = 'View BPR MTS';
        $sub_array['bpr_shortage_summary'] = 'BPR Shortage Summary';
        $sub_array['bpr_work_order'] = 'BPR Work Order Report';
        $sub_array['added_by'] = $print->first_name . ' ' . $print->middle_name . ' ' . $print->last_name;

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_all_report_data_ajax_count($search_value);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function get_today_report_data_ajax()
  {
    $page = $this->input->post('page', TRUE) ?: 1;
    $size = $this->input->post('size', TRUE) ?: 10;
    $sorters = $this->input->post('sorters', TRUE) ?: [];
    $filters = $this->input->post('filters', TRUE) ?: [];
    $draw = $this->input->post('draw', TRUE);
    $start = $this->input->post('start', TRUE) ?: 0;
    $length = $this->input->post('length', TRUE) ?: 10;
    $search = $this->input->post('search', TRUE);
    $search_value = isset($search['value']) ? $search['value'] : '';

    $length = max($length, 1);
    $start = ($page - 1) * $length;


    $document = $this->Admin_model->get_today_report_data_ajax($start, $length, $search_value, $sorters);

    $data = [];
    if (!empty($document)) {
      $offset = $start + 1;
      foreach ($document as $print) {
        $sub_array = [];
        $sub_array['sr_no'] = $offset++;
        $sub_array['added_by'] = $print->first_name . ' ' . $print->middle_name . ' ' . $print->last_name;
        $sub_array['report_number'] = $print->report_number;
        $sub_array['date'] = date('d M Y', strtotime($print->created_on));
        $sub_array['time'] = date('h:i A', strtotime($print->created_on));
        $sub_array['bpr_mts_report'] = 'View Report';

        $data[] = $sub_array;
      }
    }

    $total = $this->Admin_model->get_today_report_data_ajax_count($search_value);

    $response = [
      'last_page' => ($length > 0) ? ceil($total / $length) : 1,
      'data' => $data,
      'draw' => $draw,
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
    ];

    echo json_encode($response);
    exit();
  }

  public function get_shortage_item_data_ajax()
  {
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));
    $order = $this->input->post("order");
    $search = $this->input->post("search");
    $search = $search['value'];
    $col = 0;
    $dir = "";
    if (!empty($order)) {
      foreach ($order as $o) {
        $col = $o['column'];
        $dir = $o['dir'];
      }
    }
    if ($dir != "asc" && $dir != "desc") {
      $dir = "desc";
    }

    $document = $this->Admin_model->get_shortage_fg_item_data($search, $length, $start);
    //echo '<pre>'; print_r($document); exit;

    $shifts = $this->Admin_model->get_all_shifts();

    $data = array();
    if (!empty($document)) {
      $page = $start / $length + 1;
      $offset = ($page - 1) * $length + 1;
      foreach ($document as $print) {
        $options = '';
        if (!empty($shifts)) {
          foreach ($shifts as $row) {
            $options .= '<option value="' . $row->id . '"' . ($print->work_order_no != "" && $print->wo_shift_id == $row->id ? 'selected' : '') . '>' . $row->name . ' (' . date('h:i A', strtotime($row->from)) . ' to ' . date('h:i A', strtotime($row->to)) . ')</option>';
          }
        }


        

       

          $sub_array = array();
          $sub_array[] = $offset++ . '<input type="checkbox" class="select_row">';
          $sub_array[] = $print->work_order_no ?? '-';
          $sub_array[] = $print->report_type ?? '-';
          $sub_array[] = $print->priority_mark ?? '-';
          $sub_array[] = $print->ff_part_no ?? '-';
          $sub_array[] = $print->customer_part_no ?? '-';
          $sub_array[] = $print->cycle_time1 ?? '0';
          $sub_array[] = $print->change_over_time1 ?? '0';
          $sub_array[] = $print->gap_qty ?? '0';
          $sub_array[] = $print->full_qty ?? '0';
          if ($print->wo_plan_qty == '') {
            $sub_array[] = '<input class="form-control" type="text" id="plan_qty_' . $print->id . '" placeholder="Enter Plan Qty" value="' . ($print->plan_qty ?? '0') . '" disabled>';
          } else {
            $sub_array[] = '<input class="form-control" type="text" id="plan_qty_' . $print->id . '" placeholder="Enter Plan Qty" value="' . $print->wo_plan_qty . '" disabled>';
          }

          $sub_array[] = '<input type="hidden" id="shortage_items_tbl_id_' . $print->id . '" value="' . $print->id . '">
                                  <input type="hidden" id="line_id_' . $print->id . '" value="' . $print->id . '">
                                  <input class="form-control" type="number" id="issue_qty_' . $print->id . 'value="' . ($print->work_order_no != "" ? $print->wo_issue_qty : '') . '" disabled>';
          $sub_array[] = '<input class="form-control" type="text" id="order_no_' . $print->id . '' . ($print->work_order_no != "" ? $print->wo_job_order_no : '') . '" disabled>';
          $sub_array[] = '<input class="form-control" type="number" id="production_qty_' . $print->id . ' value="' . ($print->work_order_no != "" ? $print->wo_production_qty : '') . '" disabled>';
          $sub_array[] = '<input class="form-control" type="number" id="tag_qty_' . $print->id . '' . ($print->work_order_no != "" ? $print->wo_tag_qty : '') . '" disabled>';
          // $sub_array[] = '<input autocomplete="off" type="text" class="form-control singledatepickers" id="filter_date_' . $print->id . '" value="' . ($print->wo_date != "" ? date('d-m-Y', strtotime($print->wo_date)) : '') . '" placeholder="Select Date" disabled>';
          // $sub_array[] = '<select class="form-control js-example-basic-single" id="selected_shift_' . $print->id . '" style="width:100%" disabled>
          //                           <option value="">Select Shift</option>
          //                           ' . $options . '
          //                         </select>';
          $sub_array[] = '<select class="form-control js-example-basic-single" id="production_status_' . $print->id . '" style="width:100%" disabled>
                                    <option value="">Production</option>
                                    <option value="Pending" ' . ($print->work_order_no != "" && $print->wo_production_status == "Pending" ? 'selected' : '') . '>Pending</option>
                                    <option value="Completed" ' . ($print->work_order_no != "" && $print->wo_production_status == "Completed" ? 'selected' : '') . '>Completed</option>
                                    <option value="Running" ' . ($print->work_order_no != "" && $print->wo_production_status == "Running" ? 'selected' : '') . '>Running</option>
                                    <option value="Other" ' . ($print->work_order_no != "" && $print->wo_production_status == "Other" ? 'selected' : '') . '>Other</option>
                                  </select>';
          $sub_array[] = '<input class="form-control" type="text" id="planner_remark_' . $print->id . ' value="' . ($print->work_order_no != "" ? $print->wo_planner_remark : '') . '" disabled>';
          $sub_array[] = '<input class="form-control" type="text" id="store_remark_' . $print->id . 'value="' . ($print->work_order_no != "" ? $print->wo_store_remark : '') . '" disabled>';
          $sub_array[] = '<input class="form-control" type="text" id="production_remark_' . $print->id . ' value="' . ($print->work_order_no != "" ? $print->wo_production_remark : '') . '" disabled>';
          $sub_array[] = '<div class="action-buttons" style="display:none;">
                                    <button class="btn btn-sm btn-dark submit" title="Submit">
                                        <i class="bi bi-pencil"></i> Submit
                                    </button>
                                  </div>';

          $data[] = $sub_array;
      }
    }

    $TotalProducts = count($this->Admin_model->get_shortage_fg_item_data($search, '', ''));

    $output = array(
      "draw"         => $draw,
      "recordsTotal"     => $TotalProducts,
      "recordsFiltered"   => $TotalProducts,
      "data"         => $data
    );
    echo json_encode($output);
    exit();
  }

  public function set_work_order_ajax()
  {
    $result = $this->Admin_model->set_work_order();
    echo $result;
    exit;
  }
  public function get_production_time_ajax()
  {
    $this->load->model('admin/Admin_model');
    $line_id = $this->input->post('line_id');
    $shift_id = $this->input->post('shift_id');

    // Get the production time from the model
    $production_time = $this->Admin_model->get_production_time_by_line_and_shift($line_id, $shift_id);

    // Return the time as a JSON response
    echo json_encode(['production_time' => $production_time]);
  }

  public function check_unique_username()
  {
    $username = $this->input->post('username');
    $id = $this->input->post('id');

    $this->db->where('username', $username);
    if (!empty($id)) {
      $this->db->where('id !=', $id);
    }
    $result = $this->db->get('tbl_user');

    echo $result->num_rows() > 0 ? 'exists' : 'unique';
  }
}
