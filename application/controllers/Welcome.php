<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->check_login();
	}
	public function check_login()
	{
		if ($this->session->userdata('id') != "") {
			redirect('index');
		}
	}
	public function index()
	{
		$this->load->view('admin/login');
	}
	public function login()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/login');
		} else {
			$user = $this->Admin_model->login();
			if ($user) {
				$this->session->set_flashdata('success', 'Login successfully !');
				redirect('index');
			} else {
				// $res = $this->Admin_model->check_email_exists();
				$res = $this->Admin_model->check_username_exists();
				if (!$res) {
					$this->session->set_flashdata('message', 'Invalid username !');
				} else {
					$this->session->set_flashdata('message', 'Invalid password !');
				}
				$this->load->view('admin/login');
			}
		}
	}
}
