<?php
/**
 * Status dos Chamados
 * ABE - Aberto
 * FEC - Fechado
 * 
 */ 

class Orcamento extends AppModel {
	public $name = 'Orcamento';
	public $belongsTo = 'User';
	public $hasMany = 'OrcamentoItem';
	
	
	public function beforeSave($options = array()) {
		if(empty($this->data[$this->alias]['id'])) {
		  	//On create
		  	$this->data[$this->alias]['user_id'] = 'ENV';
		    $this->data[$this->alias]['user_id'] = AuthComponent::user('id');		
		  }
		  else {
		  	//on update
		    #$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
		  }
	}
	
}