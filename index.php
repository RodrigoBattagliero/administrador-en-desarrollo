<?php
include 'model/users_model.php';

$user = new UsersModel();

$user->get();
$us = array(
	'name' => 'Rodrigo',
	'last_name' => 'Battagliero'
	);
//$user->set($us);
$user->get();
?>