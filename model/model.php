<?php 
require_once 'db_abstract_model.php';

class Model extends DBAbstractModel {

	/**
	*
	*/
	protected $table;
	// Variable para WHERE de consultas
	protected $where;
	// Campos de la tabla
	protected $fields;
	// validaciones para los tipos de datos de los campos
	protected $validation;
	// Campo para ordenar por defecto
	protected $order;

	public function get($where_data = array()){
		$this->_set_where($where_data);
		$this->db_query =
			' SELECT '.$this->fields.
			' FROM '.$this->table.
			' WHERE '.$this->where.
			' ORDER BY '.$this->order;
		$this->get_results_from_query();
	}

	public function set($data = array()){
		$data = $this->_set_set($data);
		$this->db_query = 
			' INSERT INTO '
			.$this->table. '('.$data[0].')'.
			' VALUES('
			.$data[1].
			' )';
		return $this->execute_single_query();
	}

	public function edit($data = array()){
		$update = $this->_set_update($data = array());
		$this->db_query = 
			' UPDATE '.$this->table.
			' SET ' . $update .
			' WHERE ' . $this->where;
		return $this->execute_single_query();
	}

	public function delete($where_data = array()){
		$this->_set_where($where_data);
		$this->db_query = 
			'DELETE FROM '.$this->table.
			' WHERE '.$this->where;
		return $this->execute_single_query();

	}

	// definir variable $where para ejecutar
	private function _set_where($data = array()){
		$this->where = ' 1';
		foreach($data as $key => $value)
			$this->where .= ' AND '.$key.' = '.$value.'';
	}

	private function _set_update($data = array()){
		$update = '';
		// cantidad de elementos/campos en el array
		$lenght = count($data);		
		foreach ($data as $key => $value) {
			$i++;
			$update .= ' '.$key . ' = ' . '\''.$value.'\'';

			// Si el elemento actual no es el ultimo agrego AND porque hay mas datos para la consulta.
			if(current($data) != end($data))
				$update .= ' AND ';
		}
		return $update;
	}

	private function _set_set($data = array()){
		$set  = array('','');
		foreach ($data as $key => $value) {
			$set[0] .= $key;
			$set[1] .= '\''.$value.'\' ';
			if(current($data) != end($data)){
				$set[0] .= ', ';
				$set[1] .= ', ';
			}
		}
		return $set;
	}

}

?>