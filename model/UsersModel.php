<?php 
require_once 'Model.php';

class UsersModel extends Model {

	public function __construct(){

		$this->table = 'users';
		$this->where = ' 1';

		$this->fields = ' id, name, last_name, email ';

		$this->validation = array(
				'id' => 'integer',
				'name' => 'string',
				'last_name' => 'string',
				'email' => 'email'
			);

		$this->order = ' name DESC ';

	}
}

?>