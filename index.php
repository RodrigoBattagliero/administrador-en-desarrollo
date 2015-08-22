<?php
include 'app/model/UsersModel.php';
use App\Model\UsersModel\UsersModel;
$user = new UsersModel();

//$user->get();
$us = array(
	'name' => 'Rodrigo',
	'last_name' => 'Battagliero'
	);
//$user->set($us);
$user->get(array('name' => 'Rodrigo'));


//$startTime = microtime(true);
//echo "Tiempo de carga: ". microtime(true) - $startTime;
?>