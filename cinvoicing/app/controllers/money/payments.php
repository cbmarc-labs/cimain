<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Index Class
 * 
 * @author marc
 *
 */
class Payments extends MY_Controller {

	var $fields = array('description'=>'');
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('payments_model', 'model');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Index method
	 *
	 * @access public
	 */
	public function index()
	{
		$this->load->library(array('table'));
		$this->load->helper(array('form'));
				
		$this->table->set_heading('id', 'description');
		$this->table->set_template(array('table_open'=>
				'<table class="table table-condensed table-hover" id="datatable_payments">'));

		$data = $this->model->get_all();
		if($data !== FALSE)
		{
			foreach($data as $field)
			{
				$this->table->add_row(
						$field['id'],
						anchor(current_url().'/edit/'.$field['id'], $field['description']));
			}
		}
		else
		{
			set_error($this->model->get_error());
		}

		$this->data['table'] = $this->table->generate();
		$this->_load_view('index_view');
	}
	
	// --------------------------------------------------------------------

	/**
	 * Add method
	 *
	 * @access public
	 */	
	public function add()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		
		if($this->input->post('submit'))
		{
			$this->_set_form_rules();
			
			if($this->form_validation->run())
			{
				$data = $this->_get_post();
				if($this->model->insert($data) === TRUE)
				{
					set_success(lang('xml_db_item_saved'), TRUE);
					redirect(current_url());
				}
			
				set_error($this->model->get_error());
			}
		}
			
		$this->_set_form_values();
		$this->_load_view('edit_view');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Edit method
	 *
	 * @access	public
	 */
	public function edit()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form', 'myurl'));
		
		$id = $this->uri->rsegment(3);
				
		if($id === FALSE)
			redirect_current_controller();
		
		if($this->input->post('delete'))
		{
			if($this->model->delete($id) === TRUE)
			{
				set_success(lang('xml_db_item_deleted'), TRUE);
				redirect_current_controller();
			}
		
			// repopulate fields and show error
			$this->_set_form_values();
			set_error($this->model->get_error());
		}
		elseif($this->input->post())
		{
			$this->_set_form_rules();
			
			if($this->form_validation->run())
			{
				$data = $this->_get_post();				
				if($this->model->update($id, $data) === TRUE)
				{
					set_success(lang('xml_db_item_saved'));
				}
				else
				{
					set_error($this->model->get_error());
				}
			}
				
			$this->_set_form_values();
		}
		else
		{
			$data = $this->model->get_by_id($id);
			if($data === FALSE)
			{
				set_warning($this->model->get_error(), TRUE);
				redirect_current_controller();
			}
			
			$this->_set_form_values($data);
		}

		$this->_load_view('edit_view');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * delete method
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->load->helper(array('myurl'));
		
		if($this->input->post())
		{
			$ids = $this->input->post('ids');
			
			$values = explode(",", $ids);
			$it = 0;

			foreach($values as $id)
			{
				if($this->model->delete($id))
					$it ++;
			}

			if($it == count($values))
				set_success(lang('xml_db_item_deleted'), TRUE);
			else
				set_warning($it . '/' . count($values) . ' ' .
						lang('xml_db_item_deleted'), TRUE);
			
			redirect_current_controller();
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _get_post method
	 *
	 * @access private
	 * @return array
	 */
	private function _get_post()
	{
		$data = array();
		foreach($this->fields as $k=>$v)
		{
			if($this->input->post($k) !== FALSE)
				$data[$k] = $this->input->post($k);
		}
		
		return $data;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _set_form_values method
	 *
	 * @access private
	 * @param array
	 */
	private function _set_form_values($data = FALSE)
	{
		if($data === FALSE)
		{
			$data = $this->_get_post();
		
			foreach($this->fields as $k=>$v)
				if(!isset($data[$k]))
					$data[$k] = $this->fields[$k];
		}
		
		$this->data['field'] = $data;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _set_form_rules method
	 *
	 * @access private
	 */
	private function _set_form_rules()
	{
		$this->form_validation->set_rules(
				'description', lang('payments_form_description'),
				"trim|required|xss_clean|min_length[2]|max_length[25]");
	}
	
}