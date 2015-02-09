<?php 

class User extends AppModel {
	public $name = 'User';
	public $actsAs = array(
		'Upload.Upload' => array(
			'img_perfil' => array (
				'rootDir' => '',
				'path' => 'files{DS}{model}{DS}{field}{DS}',
				'fields' => array(
					'dir' => 'img_perfil_dir'				
				)				
			)
		)
	);
	public $validate = array(
		'username' => array (
			'uniqueUserNameRule' => array(
				'rule' => 'isUnique',
				'message' => 'Nome de usuário já cadastrado'
			),
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
	
	public function afterSave($created, $options = array()) {
		//updating authentication session
        App::uses('CakeSession', 'Model/Datasource');
        CakeSession::write('Auth',$this->findById(AuthComponent::user('id')));

        return true;
	}
} 