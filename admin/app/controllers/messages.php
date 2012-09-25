<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
	
	private $header_data = array();
	private $content_data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->output->enable_profiler();
		
		if(!logged_in())
			redirect('auth');
		
		$this->load->library(array('xml_db', 'table', 'message'));
		$this->load->helper(array('message'));
		
		$this->header_data['title'] = "Application - Messages";
	}
	
	public function index()
	{
		$this->table->set_heading('date', 'login', 'section', 'type', 'message');
		$this->table->set_template(
				array('table_open'=>'<table class="table table-condensed table-hover" id="datatable_messages">'));
		
		$data = $this->xml_db->get('messages');
		
		if($data === FALSE)
		{
			set_error($this->xml_db->get_error());
		}
		else
		{
			foreach($data as $message)
			{
				$this->table->add_row(
						$message['date'],
						$message['login'],
						$message['section'],
						$message['type'],
						$message['message']
						);
			}
		}
		
		$this->content_data['table'] = $this->table->generate();
		
		$this->_load_view('messages/index_view');
		
	}
	
	public function delete()
	{
		$result = $this->xml_db->create('messages');
		
		if(!$result)
			set_error($this->xml_db->get_error(), TRUE);
		else
			set_success(lang('xml_db_item_deleted'), TRUE);
		
		redirect('messages');
	}
	
	private function _load_view($view)
	{
		$this->load->view('header_view', $this->header_data);
		$this->load->view($view, $this->content_data);
		$this->load->view('footer_view');		
	}
	
}