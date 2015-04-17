<?php 
require_once 'db_abstract_model.php';

class UsersModel extends DBAbstractModel {

	// Nombre de la tabla
	private $table;
	// campos de tabla
	private $id;
	private $name;
	private $last_name;
	private $email;
	// Variable para WHERE de consultas
	private $where;
	// Campos y validaciones.
	private $fields;
	private $validation;
	// Campo para ordenar por defecto
	private $order;

	public function __construct(){

		$this->table = 'users';
		$this->id = null;
		$this->name = null;
		$this->last_name = null;
		$this->email = null;
		$this->where = ' 1';

		$this->fields = ' id, name, last_name, email ';

		$this->validation = array(
				'id' => 'integer',
				'name' => 'string',
				'last_name' 'string',
				'email' => 'email'
			);

		$this->order = ' name DESC ';

	}

	// definir variable $where para ejecutar
	private function _set_where($data = array()){
		$this->where = ' 1';
		foreach($data as $key => $value)
			$this->where .= ' AND '.$key.' = '.$value.'';
	}

	public function get($where_data = array()){
		$this->_set_where($where_data);
		$this->query =
			' SELECT '.$this->fields.
			' FROM '.$this->table.
			' WHERE '.$this->where.
			' ORDER BY '.$this->order.;
		$this->get_results_from_query();
	}

	public function set($data = array()){
		$values = ' ';
		foreach($data as $dato) 
			// Escapo comillas simples para consulta
			$values .= '\''.$dato.'\' ';
		$this->query = 
			' INSERT INTO '
			.$this->table.
			' VALUES('
			.$values.
			' )';
		return $this->execute_single_query();
	}

	public function edit($data = array()){
		$update = $this->_set_update($data = array());
		$this->query = 
			' UPDATE '.$this->table.
			' SET ' . $update .
			' WHERE ' . $this->where;
		return $this->execute_single_query();
	}

	public function delete($where_data = array()){
		$this->_set_where($where_data);
		$this->query = 
			'DELETE FROM '.$this->table.
			' WHERE '.$this->where;
		return $this->execute_single_query();

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




}

?>