<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users_model Class
 *
 * @author marc
 *
 */
class Users_model extends MY_Model
{
	/**
	 * Constructor method
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * get method
	 *
	 * @access public
	 */
	function get()
	{	
		$this->db->order_by( 'name', 'ASC' );
		
		$result = $this->db->get( 'my_table' );
		
		return $result->result_array();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * update method
	 *
	 * @access public
	 */
	function update( $id, $data )
	{
		$this->db->where( 'id', $id );
		
		if( ! $this->db->count_all_results( 'my_table' ) ) {
			$this->set_error( 'Record not found.' );
			
			return FALSE;
		}
		
		$this->db->where( 'id', $id );
		$this->db->update( 'my_table', $data );
		
		log_message( 'debug', $this->db->last_query() );
		
		return TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * delete method
	 *
	 * @access public
	 */
	function delete( $id )
	{
		$this->db->where( 'id', $id );
		
		if( ! $this->db->count_all_results( 'my_table' ) ) {
			$this->set_error( 'Record not found.' );
			
			return FALSE;
		}
		
		$this->db->where( 'id', $id );
		$this->db->delete( 'my_table' );
		
		log_message( 'debug', $this->db->last_query() );
		
		if( $this->db->affected_rows() != 1) {
			$this->set_error( $this->db->_error_message() );
			
			return FALSE;
		}
		
		return TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * get_by_id method
	 *
	 * @access public
	 */
	function get_by_id( $id )
	{
		$user = $this->ion_auth->user( $id )->row_array();
				
		if( $user['id'] ) {
			return $user;
		}
		
		return FALSE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * getTable method
	 *
	 * Para la lista de registros
	 *
	 * @access public
	 */
	function get_table()
	{
		$query = 'SELECT
				SQL_CALC_FOUND_ROWS id as col0,
				username as col1,
				email as col2
		
				FROM (`users`)
				
				WHERE 1=1 
				';

		$iDisplayStart	= $this->input->get_post( 'iDisplayStart', true );
		$iDisplayLength	= $this->input->get_post( 'iDisplayLength', true );
		$iSortCol_0		= $this->input->get_post( 'iSortCol_0', true );
		$iSortingCols	= $this->input->get_post( 'iSortingCols', true );
		$sSearch		= $this->input->get_post( 'sSearch', true );
		$sEcho			= $this->input->get_post( 'sEcho', true );
		
		// Busqueda
		if(isset($sSearch) && !empty($sSearch)) {
			$query .= " AND (username LIKE '%" . $this->db->escape_like_str( $sSearch ) . "%'" .
				") ";
		}

		// Ordering
		if( isset( $iSortCol_0 ) ) {
			for( $i = 0; $i < intval( $iSortingCols ); $i ++ ) {
				$iSortCol = $this->input->get_post( 'iSortCol_'.$i, true );
				$bSortable = $this->input->get_post( 'bSortable_'.intval( $iSortCol ), true );
				$sSortDir = $this->input->get_post( 'sSortDir_'.$i, true );

				if( $bSortable == 'true' ) {
					$query .= ' ORDER BY ';
					$query .= 'col' . intval( $this->db->escape_str( $iSortCol ) );
					$query .= ' ' . $this->db->escape_str( $sSortDir );
				}
			}
		}
		
		// Paging
		/*if( $iDisplayStart !== FALSE && $iDisplayLength != '-1' ) {
			$query .= " LIMIT ";
			$query .= $this->db->escape_str($iDisplayStart);
			$query .= ", ";
			$query .= $this->db->escape_str($iDisplayLength);
		}*/

		// Select Data
		$rResult = $this->db->query( $query );
		
		/*if( $this->db->_error_number() ) {
			$this->set_error( $this->db->_error_message() );
			
			log_app( $this->db->_error_message() );
		}*/
		
		//log_app($this->db->last_query());

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->get( 'users' )->num_rows();

		// Output
		$output = array(
				'sEcho'					=> intval( $sEcho ),
				'iTotalRecords'			=> $iTotal,
				'iTotalDisplayRecords'	=> $iFilteredTotal,
				'aaData'				=> array()
		);
		
		if( $rResult !== FALSE ) {
			foreach( $rResult->result_array() as $aRow ) {
				$row = array();
	
				foreach( $aRow as $col=>$value ) {
					$row[] = $value;
				}
	
				$output['aaData'][] = $row;
			}
		} else {
			$output['errorMsg'] = $this->get_error();
		}
		
		return $output;
	}
	
}