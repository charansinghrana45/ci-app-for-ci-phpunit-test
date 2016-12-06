<?php

/**
 * @property CI_Upload $upload
 */
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['form', 'url']);
	}

	public function index()
	{
		$this->load->view('upload/upload_form', ['error' => ' ']);
	}

	public function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 100;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;

		$this->load->library('upload', $config);

		if (! $this->upload->do_upload('userfile'))
		{
			$error = ['error' => $this->upload->display_errors()];
			$this->load->view('upload/upload_form', $error);
		}
		else
		{
			$data = ['upload_data' => $this->upload->data()];
			$this->load->view('upload/upload_success', $data);
		}
	}
}