<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home Class
 *
 * @author marc
 *
 */
class User_model extends MY_Model
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
	
	// -----------------------------------------------------------------------
	
	/**
	 * insert method
	 *
	 * @access public
	 */
	function insert( $data )
	{
		// Insert
		$this->db->insert( 'my_table', $data );
		
		log_message( 'debug', $this->db->last_query() );
		
		if( $this->db->affected_rows() != 1 ) {
			$this->set_error( $this->db->_error_message() );
			
			return FALSE;
		}
		
		return TRUE;
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
		$this->db->where( 'id', $id );
		
		$query = $this->db->get( 'my_table' );
				
		log_app( $this->db->last_query() );
		
		if ( $query->num_rows() > 0 ) {
			$data = $query->row_array();
			
			return $data;
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
				SQL_CALC_FOUND_ROWS cuo_id as col0,
				cuo_nombre as col1,
				count(clientes.id) as col2,
				cuo_cuota as col3,
				cuo_velocidad_subida as col4,
				cuo_velocidad_bajada as col5
		
				FROM (`cuotas`)
				
				LEFT JOIN `clientes` ON `clientes`.`cuotas_id` = `cuotas`.`cuo_id`
				
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
			$query .= " AND (cuo_nombre LIKE '%" . $this->db->escape_like_str( $sSearch ) . "%'" .
				") ";
		}
		
		$query .= '
				GROUP BY cuo_id 
		';

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
		if( $iDisplayStart !== FALSE && $iDisplayLength != '-1' ) {
			$query .= " LIMIT ";
			$query .= $this->db->escape_str($iDisplayStart);
			$query .= ", ";
			$query .= $this->db->escape_str($iDisplayLength);
		}

		// Select Data
		$rResult = $this->db->query( $query );
		
		if( $this->db->_error_number() ) {
			$this->set_error( $this->db->_error_message() );
			
			log_app( $this->db->_error_message() );
		}
		
		log_app($this->db->last_query());

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->get( 'cuotas' )->num_rows();

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