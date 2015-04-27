<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author marc
 *
 */
class Users extends MY_Controller
{
	/**
	 * Constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load( 'users' );
		$this->load->model( 'users_model' );
	}
	
	// -----------------------------------------------------------------------
	
	/**
	 * Index method
	 *
	 * @access public
	 */
	public function index()
	{
		$this->_load_view( 'index_view' );
	}

	// --------------------------------------------------------------------

	/**
	 * get_table method
	 *
	 * @access public
	 */
	public function get_table()
	{
		$result = $this->users_model->get_table();
			
		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( $result ) );
	}

	// --------------------------------------------------------------------

	/**
	 * Add method
	 *
	 * @access public
	 */
	public function add()
	{		
		$this->load->helper( array( 'form' ) );

		$this->_set_form_values();

		if( $this->input->post() ) {
			$this->_set_form_rules();

			if( $this->form_validation->run() ) {
				$data = $this->_get_form_values();
				
				$this->load->library( array( 'ion_auth' ) );
				
				$users_id = $this->ion_auth->register(
					$data['username'],
					$data['password'],
					'test@test.com'
				);
				
				print_r($users_id);die;

				/*if( $this->users_model->insert( $data ) === TRUE ) {
					set_success( 'Registro guardado correctamente.', TRUE );
					
					redirect( get_current_controller( 'add' ) );
				}

				set_error( $this->users_model->get_error() );*/
			}
		}

		$this->_load_view( 'edit_view' );
	}

	// --------------------------------------------------------------------

	/**
	 * Edit method
	 *
	 * Pantalla para la edicion, http://.../edit/?
	 *
	 * @access	public
	 */
	public function edit()
	{		
		$this->load->helper( array( 'form' ) );

		$id = $this->uri->rsegment( 3 );

		if( $id === FALSE ) {
			redirect( get_current_controller() );
		}
		
		$this->_set_form_values();

		if( $this->input->post( 'delete' ) ) {
			if( $this->users_model->delete( $id ) === TRUE ) {
				set_success( 'Registro borrado correctamente.', TRUE );
				
				redirect( get_current_controller() );
			}
				
			set_error( $this->users_model->get_error() );
		} elseif( $this->input->post() ) {
			$this->_set_form_rules();

			if( $this->form_validation->run() ) {
				$data = $this->_get_form_values();

				if( $this->users_model->update( $id, $data ) === FALSE ) {
					set_error( $this->users_model->get_error() );
				} else {					
					set_success( 'Registro modificado correctamente.' );
				}
			}
		} else {
			$data = $this->users_model->get_by_id( $id );

			if($data === FALSE) {
				//set_warning( "No se ha encontrado el registro.", TRUE );
				
				//redirect( get_current_controller() );
			}

			$this->_set_form_values( $data );
		}

		$this->_load_view( 'edit_view' );
	}

	// --------------------------------------------------------------------

	/**
	 * _get_post method
	 *
	 * Recoge los datos del formulario para anadir a la bbdd
	 *
	 * @access private
	 * @return array
	 */
	private function _get_form_values()
	{		
		$data['username']	= $this->input->post( 'username' );
		$data['password']	= $this->input->post( 'password' );
		
		return $data;
	}

	// --------------------------------------------------------------------

	/**
	 * _set_form_values method
	 *
	 * Rellena los valores de los campos del formulario
	 *
	 * @access private
	 * @param array
	 */
	private function _set_form_values( $data = array() )
	{
		// default values
		$this->data['field']['username']	= '';
		$this->data['field']['password']	= '';

		// values from post
		if( $this->input->post() ) {
			$this->data['field'] = array_merge( $this->data['field'], $this->input->post() );
		}
		
		// values from data
		$this->data['field'] = array_merge( $this->data['field'], $data );
	}

	// --------------------------------------------------------------------

	/**
	 * _set_form_rules method
	 *
	 * Comprueba que los datos recibidos del formulario sean correctos para
	 * la validacion.
	 *
	 * @access private
	 */
	private function _set_form_rules()
	{
		$this->load->library( array( 'form_validation' ) );
	
		$this->form_validation->set_rules(
				'username',
				lang( 'form_label_username' ),
				"trim|required|min_length[5]|max_length[50]"
		);
	}
}