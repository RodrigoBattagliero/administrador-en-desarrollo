<?php 

namespace Core\Model\DBAbstractModel;

abstract class DBAbstractModel {
	
	/**
	* 
	* @var string Conexion a la BD
	*/
	private $dbConex = null;

	/**
	* @var string Servidor de BD
	*/
	private static $dbHost = 'localhost';

	/**
	* @var string Usuario de BD
	*/
	private static  $dbUser = 'root';

	/**
	* @var string Contraseña de BD
	*/
	private static $dbPass = 'rodrigo';

	/**
	* @var string Nombre de la BD
	*/
	private static $dbName = 'newadmin';

	/**
	* @var string Consulta qeu se ejecutara
	*/	
	protected $dbQuery;

	/**
	* @var array Filas devueltas de la consulta
	*/
	protected $dbRows = array();

	/**
	* Funcion abstracta para ser redefinida.
	*
	* Guardara las filas obtenidas de la consulta de la valiable $bdRows
	*
	* @return void
	*/
	abstract protected function get();

	/**
	* Funcion abstracta para ser redefinida.
	*
	* Guardara los datos en la BD.
	*
	* @return void
	*/
	abstract protected function set();

	/**
	* Funcion abstracta para ser redefinida.
	*
	* Guardara los datos en la BD.
	*
	* @return void
	*/
	abstract protected function edit();

	/**
	* Funcion abstracta para ser redefinida.
	*
	* Guardara los datos en la BD.
	*
	* @return void
	*/
	abstract protected function delete();

	/**
	* Abre una nueva conexion
	*
	* Setea la variable $dbConex con una nueva conexion.
	*
	* @return void
	*/
	private function openConnection(){
		$this->dbConex = new \mysqli(
				self::$dbHost,
				self::$dbUser,
				self::$dbPass,
				self::$dbName
			);
	}

	/**
	* Setea la conexion
	*
	* Si la conexion no esta abierta, crea una nueva.
	*
	* @return void
	*/
	private function setConnection(){
		if($this->dbConex === null) $this->openConnection();
	}

	/**
	* Cierra la conexion
	*
	* @return void
	*/
	private function closeConnection(){
		if($this->dbConex === null) $this->dbConex->close();
	}

	/**
	* Ejecuta una consulta simple de tipo INSERT, UPDATE, DELETE.
	*
	* La consulta que ejecuta se debe almacenar previamente en $dbQuery
	*
	* @return boolean
	*/
	protected function singleQuery(){
		$this->setConnection();
		$ok = $this->dbConex->query($this->dbQuery);
		$this->closeConnection();
		echo $this->dbQuery;
		return $ok;
	}

	
	/**
	* Ejecuta una consulta de tipo SELECT
	*
	* La consulta que ejecuta se debe almacenar previamente en $dbQuery.
	* El resultado se almacena en $dbRows
	*
	* @return void
	*/
	protected function rowsFromQuery(){
		$this->setConnection();
		$result = $this->dbConex->query($this->dbQuery);
		if($result->num_rows > 0){
			while($row = $result->fetch_object()){
				$this->dbRows[] = $row;
			}
			$result->free();
		}
	}
}
?>