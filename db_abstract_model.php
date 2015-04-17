<?php 
class abstract DBAbstractModel {
	
	/*
	Variables de operacion a BD.
	*/
	private $db_conex = null;
	private $db_host = "";
	private $db_user = "";
	private $db_pass = "";
	protected $db_name = "";
	protected $db_query;
	protected $db_rows = array();

	/*
	 Metodos abstractos para ser definidos en clases hijas.
	 */

	// Traer objeto de clase donde se defina
	abstract protected function get();

	// Setear/guardar objeto de clase donde se defina
	abstract protected function set();

	// Editar objeto de clase donde se defina
	abstract protected function edit();

	// Borrar objeto de clase donde se defina
	abstract protected function delete();

	/*
	 Metodos generales. Los usan cualquier clase que herede.
	 */

	// Abrir conexion
	private function open_connection(){
		$this->conex = new mysqli(
			self::$db_host,
			self::$db_user,
			self::$db_pass,
			$this->db_name
			);
	}

	// Crear conexion
	private function set_connection(){
		if($this->db_conex === null) $this->open_connection();
	}

	// Cerrar conexion
	private function close_connection(){
		if($this->db_conex === null) $this->db_conex->close();
	}

	// Ejecutar consulta del tipo: INSERT, DELETE, UPDATE
	protected function execute_single_query(){
		$this->set_connection();
		$this->db_conex->query($this->DBquery);
		$this->close_connection();
	}

	// Ejecutar consulta del tipo: SELECT
	protected function get_results_from_query(){
		$this->set_connection();
		$result = $this->cone->query($this->db_query);
		while($this->db_rows[] = $result->fetch_object());
		$result->free();
	}
}
?>