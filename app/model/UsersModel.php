<?php 
namespace App\Model\UsersModel;

use Core\Model\Model\Model as Model;

require_once '/var/www/AdminNew/administrador-en-desarrollo/core/model/model.php';

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