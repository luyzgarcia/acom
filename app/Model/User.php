<?php 

class User extends AppModel {
	public $name = 'User';
	public $validate = array(
		'username' => array (
			'required' => array (
				'rule' => array ('notEmpty'),
				'message' => 'O nome de usúario deve ser preenchido'
			)
		),
		'password' => array (
			'required' => array (
				'rule' => array ('notEmpty'),
				'message' => 'A senha não pode ser em branco'
			)
		)	
	);
	
	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
} 