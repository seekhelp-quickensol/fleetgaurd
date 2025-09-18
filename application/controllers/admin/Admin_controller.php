<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'vendor/autoload.php';
//require_once FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel'); // Load the Excel library
		$this->check_login();
	}

	public function check_login()
	{
		if ($this->session->userdata('id') == "") {
			$this->session->set_flashdata('message', 'Please login to continue');
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function delete()
	{
		$this->Admin_model->delete();
		$this->session->set_flashdata('message', 'Record deleted successfully !');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function inactive()
	{
		$this->Admin_model->inactive();
		$this->session->set_flashdata('success', 'Record inactivated successfully !');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function active()
	{
		$this->Admin_model->active();
		$this->session->set_flashdata('success', 'Record activated successfully !');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function enquiry()
	{
		$this->load->view("admin/enquiry");
	}
	public function index()
	{
		$this->load->view("admin/index");
	}
	public function master()
	{
		$this->load->view("admin/master");
	}
	public function tabs()
	{
		$this->load->view("admin/tabs");
	}

	public function add_customer()
	{
		$this->load->view("admin/add_customer");
	}
	public function add_user()
	{
		$this->form_validation->set_rules('first_name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_user_data();
			$data['department'] = $this->Admin_model->get_all_department_data();
			$data['designation'] = $this->Admin_model->get_all_designation_data();
			$this->load->view('admin/add_user', $data);
		} else {
			
			if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != "") {
				$profile_image = $this->handle_blog_image_upload('profile_image', 'admin_assets/images/profile_image');
			} else {
				$profile_image = $this->input->post('existing_profile_image');
			}
			$result = $this->Admin_model->set_user_data($profile_image);
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-user');
		}
	}
	private function handle_blog_image_upload($input_name, $upload_path)
	{
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($input_name)) {
			log_message('error', 'Image upload failed: ' . $this->upload->display_errors());
			return NULL;
		} else {
			return $this->upload->data('file_name');
		}
	}






	public function machine()
	{
		$this->load->view("admin/machine");
	}
	public function site()
	{

		$this->form_validation->set_rules("site_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_site();
			$this->load->view("admin/site", $data);
		} else {
			$result = $this->Admin_model->set_site();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('site');
		}
	}


	public function type_of_good()
	{
		$this->form_validation->set_rules("good_type_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_good_type();
			$this->load->view("admin/type_of_good", $data);
		} else {
			$result = $this->Admin_model->set_good_type();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('type-of-good');
		}
	}

	public function designation_management()
	{
		$this->form_validation->set_rules("designation_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_designation();
			$this->load->view("admin/designation_management", $data);
		} else {
			$result = $this->Admin_model->set_designation();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('designation-management');
		}
	}

	public function deparment_management()
	{
		$this->form_validation->set_rules("department_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_department();
			$this->load->view("admin/deparment_management", $data);
		} else {
			$result = $this->Admin_model->set_department();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('deparment-management');
		}
	}

	public function add_plant()
	{
		$this->form_validation->set_rules("plant_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_plant();
			$this->load->view("admin/add_plant", $data);
		} else {
			$result = $this->Admin_model->set_plant();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-plant');
		}
	}

	public function add_workshop()
	{
		$this->form_validation->set_rules("workshop_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_workshop();
			$this->load->view("admin/add_workshop", $data);
		} else {
			$result = $this->Admin_model->set_workshop();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-workshop');
		}
	}
	public function add_type_item()
	{
		$this->form_validation->set_rules("item_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_item();
			$this->load->view("admin/add_type_item", $data);
		} else {
			$result = $this->Admin_model->set_item();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-type-item');
		}
	}
	public function add_udm()
	{
		$this->form_validation->set_rules("unit_name", "Name is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_unit();
			$this->load->view("admin/add_udm", $data);
		} else {
			$result = $this->Admin_model->set_unit();
			if ($result == 1) {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-udm');
		}
	}



	public function bom_list()
	{
		$this->load->view("admin/bom_list");
	}


	public function create_report()
	{
		if ($this->input->post('upload_report') === 'upload_report') {

			// Start database transaction
			$this->db->trans_start();
			$file_paths = []; // Initialize here to be accessible in catch block

			try {
				// Validate file uploads based on the new requirements
				if ((empty($_FILES['order_report']['name']) && empty($_FILES['mto_order_report']['name'])) || empty($_FILES['inventory_report']['name']) || empty($_FILES['trigger_report']['name'])) {
					$error_message = 'Please ensure all required reports are uploaded. You must upload an Inventory Report, a Trigger Report, and at least one Order Report (MTS or MTO).';
					$this->session->set_flashdata('message', $error_message);
					redirect('create-report');
				}

				// Define upload paths and ensure directories exist
				$base_upload_path = './Uploads/';
				$order_upload_path = $base_upload_path . 'order_reports/';
				$inventory_upload_path = $base_upload_path . 'inventory_reports/';
				$mto_order_upload_path = $base_upload_path . 'mto_order_reports/';
				$trigger_upload_path = $base_upload_path . 'trigger_reports/';

				foreach ([$order_upload_path, $inventory_upload_path, $mto_order_upload_path, $trigger_upload_path] as $path) {
					if (!is_dir($path) && !mkdir($path, 0755, true)) {
						$this->session->set_flashdata('message', 'Failed to create upload directory.');
						redirect('create-report');
					}
				}

				// Upload configuration
				$current_timestamp = date('YmdHis');
				$upload_configs = [
					'order_report' => [
						'path' => $order_upload_path,
						'filename' => !empty($_FILES['order_report']['name']) ? $current_timestamp . '_order_' . basename($_FILES['order_report']['name']) : null,
					],
					'inventory_report' => [
						'path' => $inventory_upload_path,
						'filename' => !empty($_FILES['inventory_report']['name']) ? $current_timestamp . '_inventory_' . basename($_FILES['inventory_report']['name']) : null,
					],
					'mto_order_report' => [
						'path' => $mto_order_upload_path,
						'filename' => !empty($_FILES['mto_order_report']['name']) ? $current_timestamp . '_mto_order_' . basename($_FILES['mto_order_report']['name']) : null,
					],
					'trigger_report' => [
						'path' => $trigger_upload_path,
						'filename' => !empty($_FILES['trigger_report']['name']) ? $current_timestamp . '_trigger_' . basename($_FILES['trigger_report']['name']) : null,
					],
				];

				// File upload process
				foreach ($upload_configs as $field => $config) {
					// Skip if the file is not provided
					if (empty($_FILES[$field]['name'])) {
						$file_paths[$field] = null;
						$upload_configs[$field]['filename'] = null;
						continue;
					}

					$upload_config = [
						'upload_path' => $config['path'],
						'allowed_types' => '*',
						'encrypt_name' => false,
						'file_name' => $config['filename'],
						'max_size' => 10240, // 10MB limit
					];
					$this->upload->initialize($upload_config);

					if (!$this->upload->do_upload($field)) {
						$this->session->set_flashdata('message', $this->upload->display_errors('', ''));
						redirect('create-report');
					}

					$upload_data = $this->upload->data();
					$file_paths[$field] = $upload_data['full_path'];
					$upload_configs[$field]['filename'] = $upload_data['file_name'];
				}

				// Generate report number
				$report_count = $this->db->count_all('tbl_report') + 1;
				$report_number = sprintf("%04d", $report_count);

				// Insert report metadata
				$report_data = [
					'report_number' => $report_number,
					'order_report' => $upload_configs['order_report']['filename'],
					'inventory_report' => $upload_configs['inventory_report']['filename'],
					'mto_order_report' => $upload_configs['mto_order_report']['filename'],
					'trigger_report' => $upload_configs['trigger_report']['filename'], // Added trigger report
					'added_by' => $this->session->userdata('id'),
					'created_on' => date('Y-m-d H:i:s'),
				];
				$this->db->insert('tbl_report', $report_data);
				$report_id = $this->db->insert_id();

				// Expected headers definitions
				$expected_order_headers = [
					'Category',
					'Sub Line',
					'FFPL Item Number',
					'Ffpl Item Description',
					'Customer  Item Number',
					'Customer  Item Description',
					'Customer Name',
					'Pack Size',
					'Green Level',
					'Actual On Hand ',
					'Reservation',
					'Intransit',
					'Gap Qty',
					' Penetration in Percentage (%)',
					'Priority Mark',
					'Plant Onhand',
					'Open Job Order Qty',
					'Net Gap',
				];
				$expected_inventory_headers = [
					'Item',
					'Description',
					'UOM',
					'Item Type',
					'Product Group',
					'Item Category',
					'Item Class',
					'Item Location',
					'Cycle Count Class',
					'Revision',
					'FG',
					'RMA.FG',
					'REJECT_FG',
					'Intransit',
					'RND',
					'HOLD_IM',
					'DOM.IM',
					'DOM.COMPUTER SPARES, STATIONERY',
					'DOM.MAINTENANCE',
					'DOM.CHEMICALS',
					'DOM.ELEMENT',
					'DOM.FILTERS',
					'DOM.HARDWARE',
					'DOM.LABELS',
					'DOM.MISCELLANEOUS',
					'DOM.NON FERROUS',
					'DOM.OTHER',
					'DOM.PACKAGING',
					'DOM.PAINTS, THINNERS',
					'DOM.PAPER',
					'DOM.PLASTIC',
					'DOM.RUBBER',
					'DOM.STEEL',
					'DOM.NULL',
					'GFA.EXPORT',
					'GFA.CCPM',
					'Receiving',
					'REJECT_RM',
					'Scrap',
					'PROCESS REJ.SCRAP',
					'IMP.CHEMICALS',
					'IMP.ELEMENT',
					'IMP.FERROUS',
					'IMP.FILTERS',
					'IMP.IM',
					'IMP.MISCELLANEOUS',
					'IMP.NON FERROUS',
					'IMP.OTHER',
					'IMP.PAINTS, THINNERS',
					'IMP.PAPER',
					'IMP.PLASTIC',
					'IMP.RUBBER',
					'IMP.STEEL',
					'SHOP.RM',
					'SHOP.SA',
					'OSP',
					'Total Quantity',
					'Unit Cost',
					'Total Cost',
					'MAX.Quantity',
					'On Hand',
					'Production Line',
					'Trading Flag'
				];
				$expected_mto_order_headers = [
					'Sr No',
					'Organization Name',
					'Order Category',
					'Sales Order Number',
					'Version No',
					'Last Update Date',
					'IR Preparer Name',
					'Customer Name',
					'Line Entry date',
					'Customer Part No',
					'FF Part No',
					'Part Description',
					'Category Code',
					'Need By Date',
					'Order Quantity',
					'Pending Order Quantity',
					'Plant On-Hand Quantity',
					'Value',
					'Time Buffer Penetration',
					'Mfg Start Date',
					'Original Request Date',
					'Original Request Date',
					'Spike Order Resaon',
					'Open Job Order Qty',
					'Net Pending Order Quantity',
					''
				];
				$expected_trigger_headers = [ // Assumed headers for Trigger Report
					'Organization Name ',
					'Vendor Name ',
					'Vendor Site',
					'Item Code',
					'Item Description',
					'Release Date',
					'Buffer(%)',
					'Priority Mark',
					'Shipped Date',
					'Release Qty',
					'Asn Qty',
					'Difference',
					'Percentage'
				];

				// Process mto order report (if uploaded)
				if (!empty($file_paths['mto_order_report'])) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['mto_order_report']);
					// ... (rest of MTO processing logic remains the same)
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

					if ($highestColumnIndex < 25) {
						$this->session->set_flashdata('message', 'MTO Order report has fewer than 25 columns.');
						redirect('create-report');
					}
					$headerRow = $worksheet->rangeToArray('A11:Z11')[0];
					foreach ($headerRow as $index => $header) {
						if (isset($expected_mto_order_headers[$index])) {
							$header = trim((string)$header);
							$expectedHeader = trim($expected_mto_order_headers[$index]);
							if ($header !== $expectedHeader) {
								$this->session->set_flashdata('message', "Invalid header in MTO order report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
								redirect('create-report');
							}
						}
					}
					$batch_data = [];
					for ($row = 12; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:Z$row")[0];
						$ffpl_item_number = $rowData[10];
						$ffpl_item_description = $rowData[11];
						$ffpl_item_id = $this->Admin_model->get_item_id($ffpl_item_number, $ffpl_item_description);
						$batch_data[] = [
							'report_id' => $report_id,
							'organization_name' => $rowData[1] ?? null,
							'order_category' => $rowData[2] ?? null,
							'sales_order_number' => $rowData[3] ?? null,
							'version_no' => $rowData[4] ?? null,
							'last_update_date' => $rowData[5] ?? null,
							'ir_preparer_name' => $rowData[6] ?? null,
							'customer_name' => $rowData[7] ?? null,
							'line_entry_date' => $rowData[8] ?? null,
							'customer_part_no' => $rowData[9] ?? null,
							'ff_part_no' => $ffpl_item_number,
							'ff_part_no_id' => $ffpl_item_id,
							'ff_part_description' => $ffpl_item_description,
							'category_code' => $rowData[12] ?? null,
							'need_by_date' => $rowData[13] ?? null,
							'order_quantity' => $rowData[14] ?? null,
							'pending_order_quantity' => $rowData[15] ?? null,
							'plant_on_hand_quantity' => $rowData[16] ?? null,
							'value' => $rowData[17] ?? null,
							'time_buffer_penetration' => $rowData[18] ?? null,
							'mfg_start_date' => $rowData[19] ?? null,
							'original_request_date' => $rowData[20] ?? null,
							'original_request_dates' => $rowData[21] ?? null,
							'spike_order_resaon' => $rowData[22] ?? null,
							'open_job_order_qty' => $rowData[23] ?? null,
							'net_pending_order_quantity' => $rowData[24] ?? null,
							'order_type' => $rowData[25] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];
						if (count($batch_data) >= 1000) {
							$this->db->insert_batch('tbl_mto_order_report', $batch_data);
							$batch_data = [];
						}
					}
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_mto_order_report', $batch_data);
					}
					unset($spreadsheet);
				}

				// Process order report (if uploaded)
				if (!empty($file_paths['order_report'])) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['order_report']);
					// ... (rest of MTS Order processing logic remains the same)
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
					if ($highestColumnIndex < 17) {
						$this->session->set_flashdata('message', 'Order report has fewer than 17 columns.');
						redirect('create-report');
					}
					$headerRow = $worksheet->rangeToArray('A7:R7')[0];
					foreach ($headerRow as $index => $header) {
						if (isset($expected_order_headers[$index])) {
							$header = trim((string)$header);
							$expectedHeader = trim($expected_order_headers[$index]);
							if ($header !== $expectedHeader) {
								$this->session->set_flashdata('message', "Invalid header in order report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
								redirect('create-report');
							}
						}
					}
					$batch_data = [];
					for ($row = 10; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:R$row")[0];
						$ffpl_item_number = $rowData[2];
						$ffpl_item_description = $rowData[3];
						$ffpl_item_id = $this->Admin_model->get_item_id($ffpl_item_number, $ffpl_item_description);
						$batch_data[] = [
							'report_id' => $report_id,
							'category' => $rowData[0] ?? null,
							'sub_line' => $rowData[1] ?? null,
							'ffpl_item_number' => $ffpl_item_number,
							'ffpl_item_id' => $ffpl_item_id,
							'ffpl_item_description' => $ffpl_item_description,
							'customer_item_number' => $rowData[4] ?? null,
							'customer_item_description' => $rowData[5] ?? null,
							'customer_name' => $rowData[6] ?? null,
							'pack_size' => $rowData[7] ?? null,
							'green_level' => $rowData[8] ?? null,
							'actual_on_hand' => $rowData[9] ?? null,
							'reservation' => $rowData[10] ?? null,
							'intransit' => $rowData[11] ?? null,
							'gap_qty' => $rowData[12] ?? null,
							'penetration_in_percentage' => $rowData[13] ?? null,
							'priority_mark' => $rowData[14] ?? null,
							'plant_onhand' => $rowData[15] ?? null,
							'open_job_order_qty' => $rowData[16] ?? null,
							'actual_gap' => $rowData[17] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];
						if (count($batch_data) >= 1000) {
							$this->db->insert_batch('tbl_order_report', $batch_data);
							$batch_data = [];
						}
					}
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_order_report', $batch_data);
					}
					unset($spreadsheet);
				}

				// Process inventory report (required)
				if (!empty($file_paths['inventory_report'])) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['inventory_report']);
					// ... (rest of Inventory processing logic remains the same)
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
					if ($highestColumnIndex < 63) {
						$this->session->set_flashdata('message', 'Inventory report has fewer than 63 columns.');
						redirect('create-report');
					}
					$headerRow = $worksheet->rangeToArray('A10:BK10')[0];
					foreach ($headerRow as $index => $header) {
						if (isset($expected_inventory_headers[$index])) {
							$header = trim((string)$header);
							$expectedHeader = trim($expected_inventory_headers[$index]);
							if ($header !== $expectedHeader) {
								$this->session->set_flashdata('message', "Invalid header in inventory report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
								redirect('create-report');
							}
						}
					}
					$batch_data = [];
					for ($row = 11; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:BK$row")[0];
						$item_number = $rowData[0];
						$item_description = $rowData[1];
						$item_id = $this->Admin_model->get_item_id($item_number, $item_description);
						$batch_data[] = [
							'report_id' => $report_id,
							'item' => $item_number,
							'item_id' => $item_id,
							'description' => $item_description,
							'uom' => $rowData[2] ?? null,
							'item_type' => $rowData[3] ?? null,
							'product_group' => $rowData[4] ?? null,
							'item_category' => $rowData[5] ?? null,
							'item_class' => $rowData[6] ?? null,
							'item_location' => $rowData[7] ?? null,
							'cycle_count_class' => $rowData[8] ?? null,
							'revision' => $rowData[9] ?? null,
							'fg' => $rowData[10] ?? null,
							'rma_fg' => $rowData[11] ?? null,
							'reject_fg' => $rowData[12] ?? null,
							'intransit' => $rowData[13] ?? null,
							'rnd' => $rowData[14] ?? null,
							'hold_im' => $rowData[15] ?? null,
							'dom_im' => $rowData[16] ?? null,
							'dom_computer_spares_stationery' => $rowData[17] ?? null,
							'dom_maintenance' => $rowData[18] ?? null,
							'dom_chemicals' => $rowData[19] ?? null,
							'dom_element' => $rowData[20] ?? null,
							'dom_filters' => $rowData[21] ?? null,
							'dom_hardware' => $rowData[22] ?? null,
							'dom_labels' => $rowData[23] ?? null,
							'dom_miscellaneous' => $rowData[24] ?? null,
							'dom_non_ferrous' => $rowData[25] ?? null,
							'dom_other' => $rowData[26] ?? null,
							'dom_packaging' => $rowData[27] ?? null,
							'dom_paints_thinners' => $rowData[28] ?? null,
							'dom_paper' => $rowData[29] ?? null,
							'dom_plastic' => $rowData[30] ?? null,
							'dom_rubber' => $rowData[31] ?? null,
							'dom_steel' => $rowData[32] ?? null,
							'dom_null' => $rowData[33] ?? null,
							'gfa_export' => $rowData[34] ?? null,
							'gfa_ccpm' => $rowData[35] ?? null,
							'receiving' => $rowData[36] ?? null,
							'reject_rm' => $rowData[37] ?? null,
							'scrap' => $rowData[38] ?? null,
							'process_rej_scrap' => $rowData[39] ?? null,
							'imp_chemicals' => $rowData[40] ?? null,
							'imp_element' => $rowData[41] ?? null,
							'imp_ferrous' => $rowData[42] ?? null,
							'imp_filters' => $rowData[43] ?? null,
							'imp_im' => $rowData[44] ?? null,
							'imp_miscellaneous' => $rowData[45] ?? null,
							'imp_non_ferrous' => $rowData[46] ?? null,
							'imp_other' => $rowData[47] ?? null,
							'imp_paints_thinners' => $rowData[48] ?? null,
							'imp_paper' => $rowData[49] ?? null,
							'imp_plastic' => $rowData[50] ?? null,
							'imp_rubber' => $rowData[51] ?? null,
							'imp_steel' => $rowData[52] ?? null,
							'shop_rm' => $rowData[53] ?? null,
							'shop_sa' => $rowData[54] ?? null,
							'osp' => $rowData[55] ?? null,
							'total_quantity' => $rowData[56] ?? null,
							'unit_cost' => $rowData[57] ?? null,
							'total_cost' => $rowData[58] ?? null,
							'max_quantity' => $rowData[59] ?? null,
							'on_hand' => $rowData[60] ?? null,
							'production_line' => $rowData[61] ?? null,
							'trading_flag' => $rowData[62] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];
						if (count($batch_data) >= 1000) {
							$this->db->insert_batch('tbl_inventory_report', $batch_data);
							$batch_data = [];
						}
					}
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_inventory_report', $batch_data);
					}
					unset($spreadsheet);
				}

				// Process trigger report (required)
				if (!empty($file_paths['trigger_report'])) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['trigger_report']);
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					// Assuming headers are on row 1 and data starts on row 2
					$headerRow = $worksheet->rangeToArray('A9:M9')[0];
					foreach ($headerRow as $index => $header) {
						if (isset($expected_trigger_headers[$index])) {
							$header = trim((string)$header);
							$expectedHeader = trim($expected_trigger_headers[$index]);
							if ($header !== $expectedHeader) {
								$this->session->set_flashdata('message', "Invalid header in trigger report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
								redirect('create-report');
							}
						}
					}

					$batch_data = [];
					for ($row = 10; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:M$row")[0];

						$item_number = $rowData[3];
						$description = $rowData[4];
						$item_id = $this->Admin_model->get_item_id($item_number, $description);
						$vendor_id = $this->Admin_model->get_vendor_id($rowData[1]);
						$batch_data[] = [
							'report_id' => $report_id,
							'item_no' => $item_number,
							'item_id' => $item_id,
							'description' => $description,
							'organization_name ' => $rowData[0] ?? null,
							'vendor_name ' => $rowData[1] ?? null,
							'vendor_id ' => $vendor_id,
							'vendor_site' => $rowData[2] ?? null,
							'release_date' => $rowData[5] ?? null,
							'buffer' => $rowData[6] ?? null,
							'priority_mark' => $rowData[7] ?? null,
							'shipped_date' => $rowData[8] ?? null,
							'release_qty' => $rowData[9] ?? null,
							'asn_qty' => $rowData[10] ?? null,
							'difference' => $rowData[11] ?? null,
							'percentage' => $rowData[12] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];

						if (count($batch_data) >= 1000) {
							$this->db->insert_batch('tbl_trigger_report', $batch_data); // Assumes table name is tbl_trigger_report
							$batch_data = [];
						}
					}
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_trigger_report', $batch_data);
					}
					unset($spreadsheet);
				}

				// Complete transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === false) {
					throw new Exception('Database transaction failed.');
				}

				$this->session->set_flashdata('success', 'Files uploaded and data inserted successfully. Report Number: ' . $report_number);
				redirect('uploaded-report-review/' . $report_number);
			} catch (Exception $e) {
				// Rollback transaction
				$this->db->trans_rollback();

				// Delete uploaded files if any
				foreach ($file_paths as $path) {
					if ($path && file_exists($path)) {
						unlink($path);
					}
				}

				$this->session->set_flashdata('message', 'Error: ' . $e->getMessage());
				redirect('create-report');
			}
		}

		$this->load->view('admin/create_report');
	}

	/*public function create_report()
	{
		if ($this->input->post('upload_report') === 'upload_report') {

			// Start database transaction
			$this->db->trans_start();

			try {
				// Validate file uploads
				if (empty($_FILES['order_report']['name']) || empty($_FILES['inventory_report']['name'])) {
					$this->session->set_flashdata('message', 'Please upload both Order Report and Inventory Report files.');
					redirect('create-report');
					//throw new Exception('Please upload both Order Report and Inventory Report files.');
				}

				// Define upload paths and ensure directories exist
				$base_upload_path = './Uploads/';
				$order_upload_path = $base_upload_path . 'order_reports/';
				$inventory_upload_path = $base_upload_path . 'inventory_reports/';
				$mto_order_upload_path = $base_upload_path . 'mto_order_reports/';
				
				foreach ([$order_upload_path, $inventory_upload_path, $mto_order_upload_path] as $path) {
					if (!is_dir($path) && !mkdir($path, 0755, true)) {
						// throw new Exception('Failed to create upload directory.');
						$this->session->set_flashdata('message', 'Failed to create upload directory.');
						redirect('create-report');
					}
				}

				// Upload configuration
				$current_timestamp = date('YmdHis');
				$upload_configs = [
					'order_report' => [
						'path' => $order_upload_path,
						'filename' => $current_timestamp . '_order_' . basename($_FILES['order_report']['name']),
					],
					'inventory_report' => [
						'path' => $inventory_upload_path,
						'filename' => $current_timestamp . '_inventory_' . basename($_FILES['inventory_report']['name']),
					],
					'mto_order_report' => [
						'path' => $mto_order_upload_path,
						'filename' => $current_timestamp . '_mto_order_' . basename($_FILES['mto_order_report']['name']),
					],
				];

				// File upload
				$file_paths = [];
				foreach ($upload_configs as $field => $config) {
					$upload_config = [
						'upload_path' => $config['path'],
						'allowed_types' => '*',
						'encrypt_name' => false,
						'file_name' => $config['filename'],
						'max_size' => 10240, // 10MB limit
					];
					$this->upload->initialize($upload_config);
					
					if (!$this->upload->do_upload($field)) {
						//throw new Exception($this->upload->display_errors('', ''));
						$this->session->set_flashdata('message', $this->upload->display_errors('', ''));
						redirect('create-report');
					}
					
					$upload_data = $this->upload->data();
					$file_paths[$field] = $upload_data['full_path'];
					$upload_configs[$field]['filename'] = $upload_data['file_name'];
				}

				// Generate report number
				$report_count = $this->db->count_all('tbl_report') + 1;
				$report_number = sprintf("%04d", $report_count);

				// Insert report metadata
				$report_data = [
					'report_number' => $report_number,
					'order_report' => $upload_configs['order_report']['filename'],
					'inventory_report' => $upload_configs['inventory_report']['filename'],
					'mto_order_report' => $upload_configs['mto_order_report']['filename'],
					'added_by' => $this->session->userdata('id'),
					'created_on' => date('Y-m-d H:i:s'),
				];
				$this->db->insert('tbl_report', $report_data);
				$report_id = $this->db->insert_id();
				
				// Expected headers for order report (17 columns, A to Q)
				$expected_order_headers = [
					'Category', 'Sub Line', 'FFPL Item Number', 'Ffpl Item Description', 
					'Customer  Item Number', 'Customer  Item Description', 'Customer Name', 
					'Pack Size', 'Green Level', 'Actual On Hand ', 'Reservation', 
					'Intransit', 'Gap Qty', ' Penetration in Percentage (%)', 'Priority Mark', 
					'Plant Onhand', 'Open Job Order Qty','Net Gap',
				];

				// Expected headers for inventory report (63 columns, A to BK)
				$expected_inventory_headers = [
					'Item', 'Description', 'UOM', 'Item Type', 'Product Group', 
					'Item Category', 'Item Class', 'Item Location', 'Cycle Count Class', 
					'Revision', 'FG', 'RMA.FG', 'REJECT_FG', 'Intransit', 'RND', 
					'HOLD_IM', 'DOM.IM', 'DOM.COMPUTER SPARES, STATIONERY', 'DOM.MAINTENANCE', 
					'DOM.CHEMICALS', 'DOM.ELEMENT', 'DOM.FILTERS', 'DOM.HARDWARE', 
					'DOM.LABELS', 'DOM.MISCELLANEOUS', 'DOM.NON FERROUS', 'DOM.OTHER', 
					'DOM.PACKAGING', 'DOM.PAINTS, THINNERS', 'DOM.PAPER', 'DOM.PLASTIC', 
					'DOM.RUBBER', 'DOM.STEEL', 'DOM.NULL', 'GFA.EXPORT', 'GFA.CCPM', 
					'Receiving', 'REJECT_RM', 'Scrap', 'PROCESS REJ.SCRAP', 'IMP.CHEMICALS', 
					'IMP.ELEMENT', 'IMP.FERROUS', 'IMP.FILTERS', 'IMP.IM', 'IMP.MISCELLANEOUS', 
					'IMP.NON FERROUS', 'IMP.OTHER', 'IMP.PAINTS, THINNERS', 'IMP.PAPER', 
					'IMP.PLASTIC', 'IMP.RUBBER', 'IMP.STEEL', 'SHOP.RM', 'SHOP.SA', 'OSP', 
					'Total Quantity', 'Unit Cost', 'Total Cost', 'MAX.Quantity', 'On Hand', 
					'Production Line', 'Trading Flag'
				];

				$expected_mto_order_headers = [
					'Sr No', 'Organization Name', 'Order Category', 'Sales Order Number', 
					'Version No', 'Last Update Date', 'IR Preparer Name', 
					'Customer Name', 'Line Entry date', 'Customer Part No', 'FF Part No', 
					'Part Description', 'Category Code', 'Need By Date', 'Order Quantity', 
					'Pending Order Quantity', 'Plant On-Hand Quantity','Value','Time Buffer Penetration','Mfg Start Date','Original Request Date','Original Request Date','Spike Order Resaon','Open Job Order Qty','Net Pending Order Quantity',''
				];


				// Process mto order report
				if ($file_paths['mto_order_report']) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['mto_order_report']);
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

					// Validate column count (expecting 18 columns, A to R)
					if ($highestColumnIndex < 25) {
						//throw new Exception('Order report has fewer than 17 columns.');
						$this->session->set_flashdata('message', 'MTO Order report has fewer than 25 columns.');
						redirect('create-report');
					}

					// Validate headers in row 4
					$headerRow = $worksheet->rangeToArray('A11:Z11')[0]; // Read row 4 (A to Q)
					foreach ($headerRow as $index => $header) {
						$header = trim((string)$header);
						$expectedHeader = trim($expected_mto_order_headers[$index]);
						if ($header !== $expectedHeader) {
							$this->session->set_flashdata('message', "Invalid header in order report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
							redirect('create-report');
						}
					}

					// Validate that row 5 has data (not empty)
					$firstDataRow = $worksheet->rangeToArray('A12:Z12')[0];
					if (empty(array_filter($firstDataRow, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
						//throw new Exception('Order report data does not start at row 5 or row 5 is empty.');
						$this->session->set_flashdata('message', 'MTO Order report data does not start at row 12 or row 12 is empty.');
						redirect('create-report');
					}

					// Optionally: Check if rows 1-3 are empty or non-data
					// for ($row = 1; $row <= 3; $row++) {
					// 	$rowData = $worksheet->rangeToArray("A$row:Q$row")[0];
					// 	if (!empty(array_filter($rowData, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
					// 		// throw new Exception("Order report contains unexpected data in rows 1-3.");
					// 		$this->session->set_flashdata('message', 'Order report contains unexpected data in rows 1-3.');
					// 		redirect('create-report');
					// 	}
					// }

					$batch_data = [];
					$batch_size = 1000;
					
					for ($row = 12; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:Z$row")[0]; // 25 columns
						
						$ffpl_item_number = $rowData[10];
						$ffpl_item_description = $rowData[11];
						$ffpl_item_id = $this->Admin_model->get_item_id($ffpl_item_number, $ffpl_item_description);

						$batch_data[] = [
							'report_id' => $report_id,
							'organization_name' => $rowData[1] ?? null,
							'order_category' => $rowData[2] ?? null,
							'sales_order_number' => $rowData[3] ?? null,
							'version_no' => $rowData[4] ?? null,
							'last_update_date' => $rowData[5] ?? null,
							'ir_preparer_name' => $rowData[6] ?? null,
							'customer_name' => $rowData[7] ?? null,
							'line_entry_date' => $rowData[8] ?? null,
							'customer_part_no' => $rowData[9] ?? null,
							'ff_part_no' => $ffpl_item_number,
							'ff_part_no_id' => $ffpl_item_id,
							'ff_part_description' => $ffpl_item_description,
							'category_code' => $rowData[12] ?? null,
							'need_by_date' => $rowData[13] ?? null,
							'order_quantity' => $rowData[14] ?? null,
							'pending_order_quantity' => $rowData[15] ?? null,
							'plant_on_hand_quantity' => $rowData[16] ?? null,
							'value' => $rowData[17] ?? null,
							'time_buffer_penetration' => $rowData[18] ?? null,
							'mfg_start_date' => $rowData[19] ?? null,
							'original_request_date' => $rowData[20] ?? null,
							'original_request_dates' => $rowData[21] ?? null,
							'spike_order_resaon' => $rowData[22] ?? null,
							'open_job_order_qty' => $rowData[23] ?? null,
							'net_pending_order_quantity' => $rowData[24] ?? null,
							'order_type' => $rowData[25] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];
						
						if (count($batch_data) >= $batch_size) {
							$this->db->insert_batch('tbl_mto_order_report', $batch_data);
							$batch_data = [];
						}
					}
					
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_mto_order_report', $batch_data);
					}

					unset($spreadsheet);
				}

				// Process order report
				if ($file_paths['order_report']) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['order_report']);
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

					// Validate column count (expecting 18 columns, A to R)
					if ($highestColumnIndex < 17) {
						//throw new Exception('Order report has fewer than 17 columns.');
						$this->session->set_flashdata('message', 'Order report has fewer than 17 columns.');
						redirect('create-report');
					}

					// Validate headers in row 4
					$headerRow = $worksheet->rangeToArray('A7:R7')[0]; // Read row 4 (A to Q)
					foreach ($headerRow as $index => $header) {
						$header = trim((string)$header);
						$expectedHeader = trim($expected_order_headers[$index]);
						if ($header !== $expectedHeader) {
							$this->session->set_flashdata('message', "Invalid header in order report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
							redirect('create-report');
						}
					}

					// Validate that row 5 has data (not empty)
					$firstDataRow = $worksheet->rangeToArray('A10:R10')[0];
					if (empty(array_filter($firstDataRow, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
						//throw new Exception('Order report data does not start at row 5 or row 5 is empty.');
						$this->session->set_flashdata('message', 'Order report data does not start at row 5 or row 5 is empty.');
						redirect('create-report');
					}

					// Optionally: Check if rows 1-3 are empty or non-data
					// for ($row = 1; $row <= 3; $row++) {
					// 	$rowData = $worksheet->rangeToArray("A$row:Q$row")[0];
					// 	if (!empty(array_filter($rowData, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
					// 		// throw new Exception("Order report contains unexpected data in rows 1-3.");
					// 		$this->session->set_flashdata('message', 'Order report contains unexpected data in rows 1-3.');
					// 		redirect('create-report');
					// 	}
					// }

					$batch_data = [];
					$batch_size = 1000;
					
					for ($row = 10; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:R$row")[0]; // 17 columns
						
						$ffpl_item_number = $rowData[2];
						$ffpl_item_description = $rowData[3];
						$ffpl_item_id = $this->Admin_model->get_item_id($ffpl_item_number, $ffpl_item_description);

						$batch_data[] = [
							'report_id' => $report_id,
							'category' => $rowData[0] ?? null,
							'sub_line' => $rowData[1] ?? null,
							'ffpl_item_number' => $ffpl_item_number,
							'ffpl_item_id' => $ffpl_item_id,
							'ffpl_item_description' => $ffpl_item_description,
							'customer_item_number' => $rowData[4] ?? null,
							'customer_item_description' => $rowData[5] ?? null,
							'customer_name' => $rowData[6] ?? null,
							'pack_size' => $rowData[7] ?? null,
							'green_level' => $rowData[8] ?? null,
							'actual_on_hand' => $rowData[9] ?? null,
							'reservation' => $rowData[10] ?? null,
							'intransit' => $rowData[11] ?? null,
							'gap_qty' => $rowData[12] ?? null,
							'penetration_in_percentage' => $rowData[13] ?? null,
							'priority_mark' => $rowData[14] ?? null,
							'plant_onhand' => $rowData[15] ?? null,
							'open_job_order_qty' => $rowData[16] ?? null,
							'actual_gap' => $rowData[17] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];
						
						if (count($batch_data) >= $batch_size) {
							$this->db->insert_batch('tbl_order_report', $batch_data);
							$batch_data = [];
						}
					}
					
					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_order_report', $batch_data);
					}

					unset($spreadsheet);
				}

				// Process inventory report
				if ($file_paths['inventory_report']) {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_paths['inventory_report']);
					$worksheet = $spreadsheet->getActiveSheet();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

					// Validate column count (expecting 63 columns, A to BK)
					if ($highestColumnIndex < 63) {
						//throw new Exception('Inventory report has fewer than 63 columns.');
						$this->session->set_flashdata('message', 'Inventory report has fewer than 63 columns.');
						redirect('create-report');
					}

					// Validate headers in row 4
					$headerRow = $worksheet->rangeToArray('A10:BK10')[0]; // Read row 4 (A to BK)
					foreach ($headerRow as $index => $header) {
						$header = trim((string)$header);
						$expectedHeader = trim($expected_inventory_headers[$index]);
						if ($header !== $expectedHeader) {
							//throw new Exception("Invalid header in inventory report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
							$this->session->set_flashdata('message', "Invalid header in inventory report at column " . chr(65 + $index) . ". Expected '$expectedHeader', found '$header'.");
							redirect('create-report');
						}
					}

					// Validate that row 5 has data (not empty)
					$firstDataRow = $worksheet->rangeToArray('A11:BK11')[0];
					if (empty(array_filter($firstDataRow, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
						//throw new Exception('Inventory report data does not start at row 5 or row 5 is empty.');
						$this->session->set_flashdata('message', 'Inventory report data does not start at row 5 or row 5 is empty.');
						redirect('create-report');
					}

					// Optionally: Check if rows 1-3 are empty or non-data
					// for ($row = 1; $row <= 3; $row++) {
					// 	$rowData = $worksheet->rangeToArray("A$row:BK$row")[0];
					// 	if (!empty(array_filter($rowData, fn($value) => !is_null($value) && trim((string)$value) !== ''))) {
					// 		//throw new Exception("Inventory report contains unexpected data in rows 1-3.");
					// 		$this->session->set_flashdata('message', 'Inventory report contains unexpected data in rows 1-3.');
					// 		redirect('create-report');
					// 	}
					// }

					$batch_data = [];
					$batch_size = 1000;

					for ($row = 11; $row <= $highestRow; $row++) {
						$rowData = $worksheet->rangeToArray("A$row:BK$row")[0]; // 63 columns
						
						$item_number = $rowData[0];
						$item_description = $rowData[1];
						$item_id = $this->Admin_model->get_item_id($item_number, $item_description);

						$batch_data[] = [
							'report_id' => $report_id,
							'item' => $item_number,
							'item_id' => $item_id,
							'description' => $item_description,
							'uom' => $rowData[2] ?? null,
							'item_type' => $rowData[3] ?? null,
							'product_group' => $rowData[4] ?? null,
							'item_category' => $rowData[5] ?? null,
							'item_class' => $rowData[6] ?? null,
							'item_location' => $rowData[7] ?? null,
							'cycle_count_class' => $rowData[8] ?? null,
							'revision' => $rowData[9] ?? null,
							'fg' => $rowData[10] ?? null,
							'rma_fg' => $rowData[11] ?? null,
							'reject_fg' => $rowData[12] ?? null,
							'intransit' => $rowData[13] ?? null,
							'rnd' => $rowData[14] ?? null,
							'hold_im' => $rowData[15] ?? null,
							'dom_im' => $rowData[16] ?? null,
							'dom_computer_spares_stationery' => $rowData[17] ?? null,
							'dom_maintenance' => $rowData[18] ?? null,
							'dom_chemicals' => $rowData[19] ?? null,
							'dom_element' => $rowData[20] ?? null,
							'dom_filters' => $rowData[21] ?? null,
							'dom_hardware' => $rowData[22] ?? null,
							'dom_labels' => $rowData[23] ?? null,
							'dom_miscellaneous' => $rowData[24] ?? null,
							'dom_non_ferrous' => $rowData[25] ?? null,
							'dom_other' => $rowData[26] ?? null,
							'dom_packaging' => $rowData[27] ?? null,
							'dom_paints_thinners' => $rowData[28] ?? null,
							'dom_paper' => $rowData[29] ?? null,
							'dom_plastic' => $rowData[30] ?? null,
							'dom_rubber' => $rowData[31] ?? null,
							'dom_steel' => $rowData[32] ?? null,
							'dom_null' => $rowData[33] ?? null,
							'gfa_export' => $rowData[34] ?? null,
							'gfa_ccpm' => $rowData[35] ?? null,
							'receiving' => $rowData[36] ?? null,
							'reject_rm' => $rowData[37] ?? null,
							'scrap' => $rowData[38] ?? null,
							'process_rej_scrap' => $rowData[39] ?? null,
							'imp_chemicals' => $rowData[40] ?? null,
							'imp_element' => $rowData[41] ?? null,
							'imp_ferrous' => $rowData[42] ?? null,
							'imp_filters' => $rowData[43] ?? null,
							'imp_im' => $rowData[44] ?? null,
							'imp_miscellaneous' => $rowData[45] ?? null,
							'imp_non_ferrous' => $rowData[46] ?? null,
							'imp_other' => $rowData[47] ?? null,
							'imp_paints_thinners' => $rowData[48] ?? null,
							'imp_paper' => $rowData[49] ?? null,
							'imp_plastic' => $rowData[50] ?? null,
							'imp_rubber' => $rowData[51] ?? null,
							'imp_steel' => $rowData[52] ?? null,
							'shop_rm' => $rowData[53] ?? null,
							'shop_sa' => $rowData[54] ?? null,
							'osp' => $rowData[55] ?? null,
							'total_quantity' => $rowData[56] ?? null,
							'unit_cost' => $rowData[57] ?? null,
							'total_cost' => $rowData[58] ?? null,
							'max_quantity' => $rowData[59] ?? null,
							'on_hand' => $rowData[60] ?? null,
							'production_line' => $rowData[61] ?? null,
							'trading_flag' => $rowData[62] ?? null,
							'created_on' => date('Y-m-d H:i:s'),
						];

						if (count($batch_data) >= $batch_size) {
							$this->db->insert_batch('tbl_inventory_report', $batch_data);
							$batch_data = [];
						}
					}

					if (!empty($batch_data)) {
						$this->db->insert_batch('tbl_inventory_report', $batch_data);
					}

					unset($spreadsheet);
				}

				// Complete transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === false) {
					throw new Exception('Database transaction failed.');
				}

				$this->session->set_flashdata('success', 'Files uploaded and data inserted successfully. Report Number: ' . $report_number);
				redirect('uploaded-report-review/' . $report_number);
			} catch (Exception $e) {
				// Rollback transaction
				$this->db->trans_rollback();

				// Delete uploaded files if any
				foreach ($file_paths as $path) {
					if (file_exists($path)) {
						unlink($path);
					}
				}

				$this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
				redirect('create-report');
			}
		}

		$this->load->view('admin/create_report');
	}*/

	private static $allocated_inventory = [];

	public function uploaded_report_review()
	{
		if ($this->input->post('generate_shortage_report') == 'generate_shortage_report') {
			$report_details = $this->Admin_model->get_uploaded_report_details();

			// Apply the same validation logic as in create_report
			if ((empty($report_details->order_report) && empty($report_details->mto_order_report)) || empty($report_details->inventory_report) || empty($report_details->trigger_report)) {
				$error_message = 'Cannot generate shortage report. Required files are missing. Please re-upload with an Inventory Report, a Trigger Report, and at least one Order Report (MTS or MTO).';
				$this->session->set_flashdata('message', $error_message);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$mto_report_number = 0;
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
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		$data['report_details'] = $this->Admin_model->get_uploaded_report_details();
		$data['order_report'] = $this->Admin_model->get_uploaded_order_report_data();
		$data['inventory_report'] = $this->Admin_model->get_uploaded_inventory_report_data();
		$data['mto_order_report'] = $this->Admin_model->get_uploaded_mto_order_report_data();
		$data['trigger_report'] = $this->Admin_model->get_uploaded_trigger_report_data();
		$data['order_report_count'] = $this->Admin_model->get_uploaded_order_report_count();
		$data['inventory_report_count'] = $this->Admin_model->get_uploaded_inventory_report_count();
		$data['mto_order_report_count'] = $this->Admin_model->get_uploaded_mto_order_report_count();
		$data['trigger_report_count'] = $this->Admin_model->get_uploaded_trigger_report_count();
		$this->load->view("admin/uploaded_report_review", $data);
	}

	public function generated_report()
	{
		$this->load->view("admin/generated_report");
	}

	public function bom_review()
	{
		$this->load->view("admin/bom_review");
	}
	public function order_review()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details();
		$this->load->view("admin/order_review", $data);
	}
	public function mto_order_review()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details();
		$this->load->view("admin/mto_order_review", $data);
	}
	public function inventory_review()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details();
		$this->load->view("admin/inventory_review", $data);
	}
	public function trigger_report_review()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details();
		$this->load->view("admin/trigger_report_review", $data);
	}
	public function bpr_work_order()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details_single(isset($_GET['filter_report']) ? $_GET['filter_report'] : null);
		$data['lines'] = $this->Admin_model->get_all_lines();
		$data['shifts'] = $this->Admin_model->get_all_shifts();
		$data['selected_line'] = $this->Admin_model->get_selected_line_details();
		$this->load->view("admin/bpr_work_order", $data);
	}

	/*public function bpr_mts_shortage_report()
	{
		$data['report_details']	= $this->Admin_model->get_uploaded_report_details();
		$data['report_data'] = $this->Admin_model->get_generated_bpr_mtd_report_data();
		$this->load->view("admin/BPR_MTS_shortage_report", $data);
	}*/

	public function bpr_mts_shortage_report($report_number = null)
	{
		if ($this->input->post('change_plan_quantity') == 'submit') {
			$result = $this->Admin_model->set_changed_report_plan_quantity();
			if ($result == '1') {
				$this->session->set_flashdata('success', 'Plan quantity updated successfully.');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('message', 'Plan quantity not updated, please try again.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		// Pagination parameters
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$length = 10; // Records per page
		$start = ($page - 1) * $length;

		// Use the report_number from the URL segment if not passed as a parameter
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		// Fetch paginated data
		$data['report_details'] = $this->Admin_model->get_uploaded_report_details();
		$data['report_data'] = $this->Admin_model->get_generated_bpr_mtd_report_data_paginated($report_number, $start, $length);
		$total_records = $this->Admin_model->get_generated_bpr_mtd_report_data_count($report_number);

		// Pagination configuration
		$this->load->library('pagination');
		$config['base_url'] = base_url('bpr-mts-shortage-report/' . $report_number);
		$config['total_rows'] = $total_records;
		$config['per_page'] = $length;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 4;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['report_number'] = $report_number;
		$this->load->view('admin/BPR_MTS_shortage_report', $data);
	}

	public function report_list()
	{
		$this->load->view("admin/report_list");
	}


	public function todays_bpr_mts_report()
	{
		$this->load->view("admin/todays_bpr_mts_report");
	}
	public function todays_bpr_work_report()
	{
		$this->load->view("admin/todays_bpr_work_report");
	}
	public function bom_upload_history()
	{
		$this->load->view("admin/bom_upload_history");
	}

	public function add_line_master()
	{

		$this->form_validation->set_rules("plant_id", "Plant is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['plants'] = $this->Admin_model->get_all_plants();
			$data['workshops'] = $this->Admin_model->get_all_workshops();
			$data['single'] = $this->Admin_model->get_single_line();
			$data['shifts'] = $this->Admin_model->get_all_shifts();
			$this->load->view("admin/add_line_master", $data);
		} else {
			$result = $this->Admin_model->set_line();
			if ($result == '1') {
				$this->session->set_flashdata('success', 'Record added successfully !');
				redirect('add-line-master');
			} else if ($result == '0') {
				$this->session->set_flashdata('success', 'Record updated successfully !');
				redirect('add-line-master');
			} else {
				$this->session->set_flashdata('message', 'Failed to Add!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}


	public function add_part_master()
	{
		$this->form_validation->set_rules("finish_good_item_no", "Finish good item number is required", "required");
		if ($this->form_validation->run() === FALSE) {

			$data['single'] = $this->Admin_model->get_single_part_master();
			$data['lines'] = $this->Admin_model->get_all_lines();
			$data['finish_goods'] = $this->Admin_model->get_all_finish_goods();
			$this->load->view("admin/add_part_master", $data);
		} else {
			$result = $this->Admin_model->set_part_master();
			if ($result == '1') {
				$this->session->set_flashdata('success', 'Record added successfully !');
				redirect('add-part-master');
			} else if ($result == '0') {
				$this->session->set_flashdata('success', 'Record updated successfully !');
				redirect('add-part-master');
			} else {
				$this->session->set_flashdata('message', 'Failed to Add !');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function add_bom()
	{
		$this->form_validation->set_rules("finish_good_item_id", "Finish good item number is required", "required");
		if ($this->form_validation->run() === FALSE) {
			$data['item_numbers'] = $this->Admin_model->get_all_item_numbers();
			$data['fg_items'] = $this->Admin_model->get_all_fg_items();
			$data['item_types'] = $this->Admin_model->get_all_item_types();
			$data['uoms'] = $this->Admin_model->get_all_uom();
			$data['single'] = $this->Admin_model->get_single_bom_data();
			$this->load->view("admin/add_bom", $data);
		} else {
			$result = $this->Admin_model->set_bom_master();
			if ($result == '0') {
				$this->session->set_flashdata('success', 'Record added successfully !');
				redirect('add-bom');
			} else if ($result == '1') {
				$this->session->set_flashdata('success', 'Record updated successfully !');
				redirect('add-bom');
			} else {
				$this->session->set_flashdata('message', 'Failed to Add !');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function supplier()
	{

		$this->form_validation->set_rules('supplier_name', ' Name', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_supplier_data();
			$data['site'] = $this->Admin_model->get_all_site_data();
			$data['countries'] = $this->Admin_model->get_all_countries();
			$data['type_of_goods'] = $this->Admin_model->get_all_type_of_goods_data();
			$this->load->view('admin/supplier', $data);
		} else {
			$result = $this->Admin_model->set_supplier_data();
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('supplier');
		}
	}

	public function add_item()
	{

		$this->form_validation->set_rules('item_no', ' Item no is required', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_item_data();
			$data['supplier'] = $this->Admin_model->get_all_supplier_data();

			$this->load->view('admin/add_item', $data);
		} else {
			$result = $this->Admin_model->set_item_data();
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-item');
		}
	}

	public function add_fg()
	{
		$this->form_validation->set_rules('finish_good_item', ' Finish good item is required', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['single'] = $this->Admin_model->get_single_fg_data();
			$this->load->view("admin/add_fg", $data);
		} else {
			$result = $this->Admin_model->set_fg_data();
			if ($result == "0") {
				$this->session->set_flashdata('success', 'Record added successfully !');
			} else {
				$this->session->set_flashdata('success', 'Record updated successfully !');
			}
			redirect('add-fg');
		}
	}

	public function upload_bom()
	{
		if ($this->input->post('upload_file') == 'upload_file') {
			$data = array();
			if (isset($_FILES["fileName1"]["name"])) {
				$path = $_FILES["fileName1"]["tmp_name"];
				$uploadPath = FCPATH . 'upload/';
				$fileName = basename($_FILES["fileName1"]["name"]);
				$extension = pathinfo($fileName, PATHINFO_EXTENSION);
				$nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
				$targetFileName = $nameWithoutExtension . '_' . $this->session->userdata('admin_id') . '_' . $this->session->userdata('user_type') . '.' . $extension;
				$targetFilePath = $uploadPath . $targetFileName;
				if (file_exists($targetFilePath)) {
					unlink($targetFilePath);
				}
				if (move_uploaded_file($path, $targetFilePath)) {
					if ($extension == 'csv') {
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
					} elseif ($extension == 'xlsx') {
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
					} elseif ($extension == 'xls') {
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
					} else {
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($targetFilePath);
						$reader->setDelimiter("\t");
						$excelObj = $reader->load($targetFilePath);
						$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excelObj, 'Xls');
						$writer->save($targetFilePath);
						$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
					}
					$object = $reader->load($targetFilePath);
					$structuredData = [];
					$levelStack = [];
					$currentParent = null;
					$submaterials = [];
					foreach ($object->getWorksheetIterator() as $worksheet) {
						$highestRow = $worksheet->getHighestRow();
						for ($row = 2; $row <= $highestRow; $row++) {
							$level = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$item = $worksheet->getCellByColumnAndRow(2, $row)->getFormattedValue();
							$description = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$revision = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
							$type = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
							$status = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
							$uom = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
							$quantity = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

							if ($level === '' && $item === '') continue;
							$level = ($level === '' || $level === null) ? 0 : (int)$level;

							$node = [
								'level' => $level,
								'item_code' => $item,
								'item_id' => $this->Admin_model->get_item_id($item, $description),
								'description' => $description,
								'revision' => $revision,
								'type' => $type,
								'type_id' => $this->Admin_model->get_type_id($type),
								'status' => $status,
								'uom' => $uom,
								'unit_id' => $this->Admin_model->get_unit_id($uom),
								'quantity' => $quantity,
								'children' => []
							];

							// Place node in the correct parent
							if ($level == 0) {
								$structuredData[] = $node;
								$levelStack[0] = &$structuredData[count($structuredData) - 1];
							} else {
								// Parent is at level-1
								$parent = &$levelStack[$level - 1];
								$parent['children'][] = $node;
								$levelStack[$level] = &$parent['children'][count($parent['children']) - 1];
							}
							// Clean up deeper levels if any
							foreach (array_keys($levelStack) as $l) {
								if ($l > $level) unset($levelStack[$l]);
							}
						}
					}
					if ($currentParent !== null) {
					    
					   // $this->db->where('finish_good_item_id',$finish_good_item_id);
		      //          $this->db->delete('tbl_add_bom');

					    
					    
						$structuredData[] = [
							'parent_item' => $currentParent['item'],
							'parent_item_description' => $currentParent['description'] ?? '',
							'submaterial' => $submaterials
						];
					}
				
					if (!empty($structuredData)) {
						foreach ($structuredData as $rootNode) {
							$this->Admin_model->insert_bom_tree($rootNode, null);
						}
					}
						$this->session->set_flashdata("success", "BOM added successfully!");
						redirect('upload-bom');

					// $result = $this->Admin_model->set_bom_by_excel($structuredData);
					// if ($result == '1') {
					// 	$this->session->set_flashdata("success", "BOM added successfully!");
					// 	redirect('upload-bom');
					// } else {
					// 	$this->session->set_flashdata("message", "Sorry, BOM not added.");
					// 	redirect('upload-bom');
					// }
				}
			} else {
				$this->session->set_flashdata("message", "Sorry, No file uploaded.");
				redirect('upload-bom');
			}
		}
		$this->load->view("admin/upload_bom");
	}

	/*==================== OPEN AI =======================*/


	public function export_bpr_mts_shortage_report($report_number = null)
	{
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		$report_data = $this->Admin_model->get_generated_bpr_mtd_report_data_paginated($report_number, 0, PHP_INT_MAX);

		if (empty($report_data)) {
			show_error('No data available to export.', 404);
		}

		// Use PhpSpreadsheet directly
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()
			->setCreator("Fleet Gaurd")
			->setLastModifiedBy("Fleet Gaurd")
			->setTitle("BPR MTS Shortage Report")
			->setSubject("BPR MTS Shortage Report")
			->setDescription("Exported BPR MTS Shortage Report data");

		// First Sheet: Shortage Report
		$sheet1 = $spreadsheet->setActiveSheetIndex(0);
		$sheet1->setTitle('Shortage Report');

		$headers = [
			'SR NO',
			'Category',
			'Subline',
			'Item Number',
			'Customer Name',
			'Pack Size',
			'Green Level',
			'Reservation',
			'Intransit',
			'Gap Quantity',
			'Penetration %',
			'Priority Mark',
			'Plant Onhand',
			'Net Gap',
			'Full Quantity',
			'Plan Qty',
			'Pending Qty after Plan',
			'Status After Plan',
			'Air Cleaner On Hand',
			'Kit Assy On Hand',
			'Shortage Parts',
			'Description',
			'Short Quantity',
			'RM Rejection Qty',
			'Receiving Work Order Qty',
			'Source 1',
			'Source 2',
			'Source 3',
			'Remark'
		];

		$col = 'A';
		foreach ($headers as $header) {
			$sheet1->setCellValue($col . '1', $header);
			$col++;
		}

		$row = 2;
		$sr_no = 1;
		foreach ($report_data as $report_result) {
			$sheet1->setCellValue('A' . $row, $sr_no++);
			$sheet1->setCellValue('B' . $row, $report_result->category);
			$sheet1->setCellValue('C' . $row, $report_result->sub_line);
			$sheet1->setCellValue('D' . $row, $report_result->ffpl_item_number);
			$sheet1->setCellValue('E' . $row, $report_result->customer_name);
			$sheet1->setCellValue('F' . $row, $report_result->pack_size);
			$sheet1->setCellValue('G' . $row, $report_result->green_level);
			$sheet1->setCellValue('H' . $row, $report_result->reservation);
			$sheet1->setCellValue('I' . $row, $report_result->intransit);
			$sheet1->setCellValue('J' . $row, $report_result->gap_qty);
			$sheet1->setCellValue('K' . $row, $report_result->penetration_in_percentage);
			$sheet1->setCellValue('L' . $row, $report_result->priority_mark);
			$sheet1->setCellValue('M' . $row, $report_result->actual_on_hand);
			$sheet1->setCellValue('N' . $row, $report_result->actual_gap);
			$sheet1->setCellValue('O' . $row, $report_result->full_qty);
			$sheet1->setCellValue('P' . $row, $report_result->plan_qty);
			$sheet1->setCellValue('Q' . $row, $report_result->actual_gap - $report_result->plan_qty);
			$sheet1->setCellValue('R' . $row, $report_result->status_after_plan);
			$sheet1->setCellValue('S' . $row, $report_result->air_cleaner_on_hand);
			$sheet1->setCellValue('T' . $row, $report_result->kit_assy_on_hand);
			$sheet1->setCellValue('U' . $row, '');
			$sheet1->setCellValue('V' . $row, '');
			$sheet1->setCellValue('W' . $row, '');
			$sheet1->setCellValue('X' . $row, '');
			$sheet1->setCellValue('Y' . $row, '');
			$sheet1->setCellValue('Z' . $row, '');
			$sheet1->setCellValue('AA' . $row, '');
			$sheet1->setCellValue('AB' . $row, '');
			$sheet1->setCellValue('AC' . $row, $report_result->remark);
			$row++;

			// Shortage parts rows
			if (!empty($report_result->shortage_parts)) {
				foreach ($report_result->shortage_parts as $shortage_part_result) {
					$sheet1->setCellValue('A' . $row, '');
					$sheet1->setCellValue('B' . $row, '');
					$sheet1->setCellValue('C' . $row, '');
					$sheet1->setCellValue('D' . $row, $report_result->ffpl_item_number);
					$sheet1->setCellValue('E' . $row, '');
					$sheet1->setCellValue('F' . $row, '');
					$sheet1->setCellValue('G' . $row, '');
					$sheet1->setCellValue('H' . $row, '');
					$sheet1->setCellValue('I' . $row, '');
					$sheet1->setCellValue('J' . $row, '');
					$sheet1->setCellValue('K' . $row, '');
					$sheet1->setCellValue('L' . $row, $report_result->priority_mark);
					$sheet1->setCellValue('M' . $row, '');
					$sheet1->setCellValue('N' . $row, '');
					$sheet1->setCellValue('O' . $row, '');
					$sheet1->setCellValue('P' . $row, '');
					$sheet1->setCellValue('Q' . $row, '');
					$sheet1->setCellValue('R' . $row, '');
					$sheet1->setCellValue('S' . $row, '');
					$sheet1->setCellValue('T' . $row, '');
					$sheet1->setCellValue('U' . $row, $shortage_part_result->item_no);
					$sheet1->setCellValue('V' . $row, $shortage_part_result->description);
					$sheet1->setCellValue('W' . $row, $shortage_part_result->short_quantity);
					$sheet1->setCellValue('X' . $row, $shortage_part_result->source_first);
					$sheet1->setCellValue('Y' . $row, $shortage_part_result->source_two);
					$sheet1->setCellValue('Z' . $row, $shortage_part_result->source_three);
					$sheet1->setCellValue('AA' . $row, '');
					$sheet1->setCellValue('AB' . $row, '');
					$sheet1->setCellValue('AC' . $row, '');
					$row++;
				}
			}
		}

		// Second Sheet: Level wise Shortage report MTS
		$sheet2 = $spreadsheet->createSheet();
		$sheet2->setTitle('Level wise Shortage report MTS');

		$level_headers = [
			'Level',
			'Item',
			'Description',
			'Type',
			'UOM',
			'Comsum QTY',
			'Required QTY',
			'On hand Qty',
			'Balance Qty',
			'Shortages Qty'
		];

		$col = 'A';
		foreach ($level_headers as $header) {
			$sheet2->setCellValue($col . '1', $header);
			$col++;
		}

		$row = 2;
		$sr_no = 1;
		foreach ($report_data as $report_result) {
			$material_usage_report = $this->Admin_model->get_material_usage_report($report_result->ffpl_item_id, $report_result->report_id);


			$sheet2->setCellValue('A' . $row, '0');
			$sheet2->setCellValue('B' . $row, $report_result->ffpl_item_number);
			$sheet2->setCellValue('C' . $row, '');
			$sheet2->setCellValue('D' . $row, '');
			$sheet2->setCellValue('E' . $row, '');
			$sheet2->setCellValue('F' . $row, '');
			$sheet2->setCellValue('G' . $row, '');
			$sheet2->setCellValue('H' . $row, '');
			$sheet2->setCellValue('I' . $row, '');
			$sheet2->setCellValue('J' . $row, '');
			$row++;

			// Shortage parts rows for level-wise report
			if (!empty($material_usage_report)) {
				foreach ($material_usage_report as $material_usage_result) {
					$sheet2->setCellValue('A' . $row, $material_usage_result->level);
					$sheet2->setCellValue('B' . $row, $material_usage_result->item_no);
					$sheet2->setCellValue('C' . $row, $material_usage_result->description);
					$sheet2->setCellValue('D' . $row, $material_usage_result->type);
					$sheet2->setCellValue('E' . $row, $material_usage_result->uom);
					$sheet2->setCellValue('F' . $row, $material_usage_result->consum_qty);
					$sheet2->setCellValue('G' . $row, $material_usage_result->required_qty);
					$sheet2->setCellValue('H' . $row, $material_usage_result->on_hand_qty);
					$sheet2->setCellValue('I' . $row, $material_usage_result->balance_qty);
					$sheet2->setCellValue('J' . $row, $material_usage_result->shortage_qty);
					$row++;
				}
			}
		}

		// Auto-size columns for both sheets
		foreach (range('A', 'AC') as $col) {
			$sheet1->getColumnDimension($col)->setAutoSize(true);
		}
		foreach (range('A', 'J') as $col) {
			$sheet2->getColumnDimension($col)->setAutoSize(true);
		}

		// Set headers for Excel download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="BPR_MTS_Shortage_Report_' . $report_number . '_' . date('YmdHis') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		redirect('bpr-mts-shortage-report/' . $report_number);
		exit;
	}

	public function bpr_mto_shortage_report($report_number = null)
	{
		if ($this->input->post('change_plan_quantity') == 'submit') {
			$result = $this->Admin_model->set_mto_changed_report_plan_quantity();
			if ($result == '1') {
				$this->session->set_flashdata('success', 'Plan quantity updated successfully.');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('message', 'Plan quantity not updated, please try again.');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		// Pagination parameters
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$length = 10; // Records per page
		$start = ($page - 1) * $length;

		// Use the report_number from the URL segment if not passed as a parameter
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		// Fetch paginated data
		$data['report_details'] = $this->Admin_model->get_uploaded_report_details();
		$data['report_data'] = $this->Admin_model->get_generated_bpr_mto_report_data_paginated($report_number, $start, $length);
		$total_records = $this->Admin_model->get_generated_bpr_mto_report_data_count($report_number);

		// Pagination configuration
		$this->load->library('pagination');
		$config['base_url'] = base_url('bpr-mto-shortage-report/' . $report_number);
		$config['total_rows'] = $total_records;
		$config['per_page'] = $length;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 4;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['report_number'] = $report_number;
		$this->load->view('admin/BPR_MTO_shortage_report', $data);
	}




	public function export_bpr_mto_shortage_report($report_number = null)
	{
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		$report_data = $this->Admin_model->get_generated_bpr_mto_report_data_paginated($report_number, 0, PHP_INT_MAX);

		if (empty($report_data)) {
			show_error('No data available to export.', 404);
		}

		// Use PhpSpreadsheet directly
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()
			->setCreator("Fleet Gaurd")
			->setLastModifiedBy("Fleet Gaurd")
			->setTitle("BPR MTO Shortage Report")
			->setSubject("BPR MTO Shortage Report")
			->setDescription("Exported BPR MTO Shortage Report data");

		$sheet = $spreadsheet->setActiveSheetIndex(0);
		$sheet->setTitle('Shortage Report');

		$headers = [
			'SR NO',
			'Sales Order Number',
			'Category Code',
			'FF Part No',
			'Part Description',
			'Customer Part No',
			'Need By Date',
			'Order Quantity',
			'Pending Order Quantity',
			'Plant On-Hand Quantity',
			'Full Kit Quantity',
			'Plan Qty',
			'Pending Qty after Plan',
			'Air Cleaner On Hand',
			'Kit Assy On Hand',
			'Shortage Parts',
			'Description',
			'Short Quantity',
			'RM Rejection Qty',
			'Receiving Work Order Qty',
			'Source 1',
			'Source 2',
			'Source 3',
			'Remark'
		];

		$col = 'A';
		foreach ($headers as $header) {
			$sheet->setCellValue($col . '1', $header);
			$col++;
		}

		$row = 2;
		$sr_no = 1;
		foreach ($report_data as $report_result) {
			$sheet->setCellValue('A' . $row, $sr_no++);
			$sheet->setCellValue('B' . $row, $report_result->sales_order_number);
			$sheet->setCellValue('C' . $row, $report_result->category_code);
			$sheet->setCellValue('D' . $row, $report_result->ff_part_no);
			$sheet->setCellValue('E' . $row, $report_result->ff_part_description);
			$sheet->setCellValue('F' . $row, $report_result->customer_part_no);
			$sheet->setCellValue('G' . $row, $report_result->need_by_date);
			$sheet->setCellValue('H' . $row, $report_result->order_quantity);
			$sheet->setCellValue('I' . $row, $report_result->pending_order_quantity);
			$sheet->setCellValue('J' . $row, $report_result->plant_on_hand_quantity);
			$sheet->setCellValue('K' . $row, $report_result->full_qty);
			$sheet->setCellValue('L' . $row, $report_result->plan_qty);
			$sheet->setCellValue('M' . $row, $report_result->pending_qty_after_plan);
			$sheet->setCellValue('N' . $row, $report_result->air_cleaner_on_hand);
			$sheet->setCellValue('O' . $row, $report_result->kit_assy_on_hand);
			$sheet->setCellValue('P' . $row, '');
			$sheet->setCellValue('Q' . $row, '');
			$sheet->setCellValue('R' . $row, '');
			$sheet->setCellValue('S' . $row, '');
			$sheet->setCellValue('T' . $row, '');
			$sheet->setCellValue('U' . $row, '');
			$sheet->setCellValue('V' . $row, '');
			$sheet->setCellValue('W' . $row, '');
			$sheet->setCellValue('X' . $row, $report_result->remark);
			$row++;

			// Shortage parts rows
			if (!empty($report_result->shortage_parts)) {
				foreach ($report_result->shortage_parts as $shortage_part_result) {
					$sheet->setCellValue('A' . $row, '');
					$sheet->setCellValue('B' . $row, $report_result->sales_order_number);
					$sheet->setCellValue('C' . $row, '');
					$sheet->setCellValue('D' . $row, $report_result->ff_part_no);
					$sheet->setCellValue('E' . $row, '');
					$sheet->setCellValue('F' . $row, '');
					$sheet->setCellValue('G' . $row, '');
					$sheet->setCellValue('H' . $row, '');
					$sheet->setCellValue('I' . $row, '');
					$sheet->setCellValue('J' . $row, '');
					$sheet->setCellValue('K' . $row, '');
					$sheet->setCellValue('L' . $row, '');
					$sheet->setCellValue('M' . $row, '');
					$sheet->setCellValue('N' . $row, '');
					$sheet->setCellValue('O' . $row, '');
					$sheet->setCellValue('P' . $row, $shortage_part_result->item_no);
					$sheet->setCellValue('Q' . $row, $shortage_part_result->description);
					$sheet->setCellValue('R' . $row, $shortage_part_result->short_quantity);
					$sheet->setCellValue('S' . $row, '');
					$sheet->setCellValue('T' . $row, '');
					$sheet->setCellValue('U' . $row, $shortage_part_result->source_first);
					$sheet->setCellValue('V' . $row, $shortage_part_result->source_two);
					$sheet->setCellValue('W' . $row, '');
					$sheet->setCellValue('X' . $row, '');
					$row++;
				}
			}
		}

		// Second Sheet: Level wise Shortage report MTO
		$sheet2 = $spreadsheet->createSheet();
		$sheet2->setTitle('Level wise Shortage report MTO');

		$level_headers = [
			'Level',
			'Item',
			'Description',
			'Type',
			'UOM',
			'Comsum QTY',
			'Required QTY',
			'On hand Qty',
			'Balance Qty',
			'Shortages Qty'
		];

		$col = 'A';
		foreach ($level_headers as $header) {
			$sheet2->setCellValue($col . '1', $header);
			$col++;
		}

		$row = 2;
		$sr_no = 1;
		foreach ($report_data as $report_result) {
			$material_usage_report = $this->Admin_model->get_mto_material_usage_report($report_result->ff_part_no_id, $report_result->report_id);


			$sheet2->setCellValue('A' . $row, '0');
			$sheet2->setCellValue('B' . $row, $report_result->ff_part_no);
			$sheet2->setCellValue('C' . $row, '');
			$sheet2->setCellValue('D' . $row, '');
			$sheet2->setCellValue('E' . $row, '');
			$sheet2->setCellValue('F' . $row, '');
			$sheet2->setCellValue('G' . $row, '');
			$sheet2->setCellValue('H' . $row, '');
			$sheet2->setCellValue('I' . $row, '');
			$sheet2->setCellValue('J' . $row, '');
			$row++;

			// Shortage parts rows for level-wise report
			if (!empty($material_usage_report)) {
				foreach ($material_usage_report as $material_usage_result) {
					$sheet2->setCellValue('A' . $row, $material_usage_result->level);
					$sheet2->setCellValue('B' . $row, $material_usage_result->item_no);
					$sheet2->setCellValue('C' . $row, $material_usage_result->description);
					$sheet2->setCellValue('D' . $row, $material_usage_result->type);
					$sheet2->setCellValue('E' . $row, $material_usage_result->uom);
					$sheet2->setCellValue('F' . $row, $material_usage_result->consum_qty);
					$sheet2->setCellValue('G' . $row, $material_usage_result->required_qty);
					$sheet2->setCellValue('H' . $row, $material_usage_result->on_hand_qty);
					$sheet2->setCellValue('I' . $row, $material_usage_result->balance_qty);
					$sheet2->setCellValue('J' . $row, $material_usage_result->shortage_qty);
					$row++;
				}
			}
		}

		// Auto-size columns for both sheets
		foreach (range('A', 'X') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}
		foreach (range('A', 'J') as $col) {
			$sheet2->getColumnDimension($col)->setAutoSize(true);
		}

		// Set headers for Excel download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="BPR_MTO_Shortage_Report_' . $report_number . '_' . date('YmdHis') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		redirect('bpr-mto-shortage-report/' . $report_number);
		exit;
	}

	public function bpr_shortage_summary_report($report_number = null)
	{

		// Pagination parameters
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$length = 10; // Records per page
		$start = ($page - 1) * $length;

		// Use the report_number from the URL segment if not passed as a parameter
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		// Fetch paginated data
		$data['report_details'] = $this->Admin_model->get_uploaded_report_details();
		$data['report_data'] = $this->Admin_model->get_generated_shortage_summary_data_paginated($report_number, $start, $length);
		$total_records = $this->Admin_model->get_generated_shortage_summary_data_count($report_number);

		// Pagination configuration
		$this->load->library('pagination');
		$config['base_url'] = base_url('bpr-shortage-summary-report/' . $report_number);
		$config['total_rows'] = $total_records;
		$config['per_page'] = $length;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 4;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['report_number'] = $report_number;
		$this->load->view('admin/shortage_summary_report', $data);
	}

	public function export_bpr_shortage_summary_report($report_number = null)
	{
		$report_number = $report_number ?: $this->uri->segment(2);

		if (!$report_number) {
			show_error('Report number is required.', 400);
		}

		$report_data = $this->Admin_model->get_generated_shortage_summary_data_paginated($report_number, 0, PHP_INT_MAX);

		if (empty($report_data)) {
			show_error('No data available to export.', 404);
		}

		// Use PhpSpreadsheet directly
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()
			->setCreator("Fleet Gaurd")
			->setLastModifiedBy("Fleet Gaurd")
			->setTitle("BPR Shortage Summary Report")
			->setSubject("BPR Shortage Summary Report")
			->setDescription("Exported BPR Shortage Summary Report data");

		// First Sheet: Shortage Report
		$sheet1 = $spreadsheet->setActiveSheetIndex(0);
		$sheet1->setTitle('Shortage Report');

		$headers = [
			'SR NO',
			'Type Of BPR trigger',
			'Shortage Parts',
			'Description',
			'Sum of Short Qty',
			'Req for how many FG Partrs',
			'Req for how many FG Partrs (COUNT)',
			'Supplier Name 1',
			'Trigger for Supplier 1',
			'Supplier Name 2',
			'Trigger for Supplier 2',
			'Supplier Name 3',
			'Trigger for Supplier 3',
			'Total Trigger QTY'
		];

		$col = 'A';
		foreach ($headers as $header) {
			$sheet1->setCellValue($col . '1', $header);
			$col++;
		}

		$row = 2;
		$sr_no = 1;
		foreach ($report_data as $report_result) {
			$item_supplier_one_data = $this->Admin_model->get_item_supplier_one_data($report_result->report_id, $report_result->material_code);
			$item_supplier_two_data = $this->Admin_model->get_item_supplier_two_data($report_result->report_id, $report_result->material_code);
			$item_supplier_three_data = $this->Admin_model->get_item_supplier_three_data($report_result->report_id, $report_result->material_code);
			$shortage_fg = $this->Admin_model->get_for_shortage_fg_details($report_result->report_id, $report_result->material_code, $report_result->report_type);

			// Prepare the FG parts string
			$fg_parts = '';
			if (!empty($shortage_fg)) {
				$fg_items = array_map(function($fg) { return $fg->ffpl_item_number; }, $shortage_fg);
				$fg_parts = implode(', ', $fg_items);
			}

			// Prepare supplier data
			$supplier_one_name = !empty($item_supplier_one_data) ? $item_supplier_one_data->supplier_name : '-';
			$supplier_one_trigger = !empty($item_supplier_one_data) ? $item_supplier_one_data->trigger : '-';
			$supplier_two_name = !empty($item_supplier_two_data) ? $item_supplier_two_data->supplier_name : '-';
			$supplier_two_trigger = !empty($item_supplier_two_data) ? $item_supplier_two_data->trigger : '-';
			$supplier_three_name = !empty($item_supplier_three_data) ? $item_supplier_three_data->supplier_name : '-';
			$supplier_three_trigger = !empty($item_supplier_three_data) ? $item_supplier_three_data->trigger : '-';

			// Set cell values
			$sheet1->setCellValue('A' . $row, $sr_no++);
			$sheet1->setCellValue('B' . $row, $report_result->report_type);
			$sheet1->setCellValue('C' . $row, $report_result->item_no);
			$sheet1->setCellValue('D' . $row, $report_result->item_description);
			$sheet1->setCellValue('E' . $row, $report_result->total_short_quantity);
			$sheet1->setCellValue('F' . $row, $fg_parts);
			$sheet1->setCellValue('G' . $row, count($shortage_fg));
			$sheet1->setCellValue('H' . $row, $supplier_one_name);
			$sheet1->setCellValue('I' . $row, $supplier_one_trigger);
			$sheet1->setCellValue('J' . $row, $supplier_two_name);
			$sheet1->setCellValue('K' . $row, $supplier_two_trigger);
			$sheet1->setCellValue('L' . $row, $supplier_three_name);
			$sheet1->setCellValue('M' . $row, $supplier_three_trigger);
			$sheet1->setCellValue('N' . $row, ''); // Total Trigger QTY (unchanged, as it was empty in the original)
			$row++;
		}

		// Auto-size columns for both sheets
		foreach (range('A', 'AC') as $col) {
			$sheet1->getColumnDimension($col)->setAutoSize(true);
		}

		// Set headers for Excel download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="BPR_Shortage_Summary_Report_' . $report_number . '_' . date('YmdHis') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit; // Remove redirect to prevent issues with output
	}

	/*=================== CLOSE AI =======================*/
}
