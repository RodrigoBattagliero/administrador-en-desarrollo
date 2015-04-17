<?php 
class abstract DBAbstractModel {
	
	// Variables de operacion a BD.
	private $conex;
	private $host = "";
	private $user = "";
	private $pass = "";
	protected $bdName = "";
	protected $query;
	protected $rows = array();


}
?>