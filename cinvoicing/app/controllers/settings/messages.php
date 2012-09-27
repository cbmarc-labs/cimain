<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->output->enable_profiler();
		
		if(!logged_in())
			redirect('auth');
		
		$this->load->library(array('xml_db', 'table'));
		$this->load->helper(array('form', 'myurl'));
		
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
						date('Y-m-d H:i:s',strtotime($message['date'])),
						$message['login'],
						$message['section'],
						$message['type'],
						$message['message']
						);
			}
		}
		
		$this->data['table'] = $this->table->generate();
		
		$this->_load_view('index_view');
		
	}
	
	public function delete()
	{
		$result = $this->xml_db->create('messages');
		
		if(!$result)
			set_error($this->xml_db->get_error(), TRUE);
		else
			set_success(lang('xml_db_item_deleted'), TRUE);
		
		redirect_current_controller();
	}
	
}