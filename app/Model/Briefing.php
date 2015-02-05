<?php 
/**
 * Status de um Briefing
 * ENV - Enviado - Foi respondido e enviado pelo cliente
 * SAV - Salvado - O cliente iniciou o briefing mas nao completou, ira terminar depois 
 * 
 */
class Briefing extends AppModel {
	public $name = 'Briefing';
	public $hasMany = 'BriefingResposta';
	public $belongsTo = array(
				'User', 
				'BriefingProjeto');
	
	
	function beforeSave($options = array())
	{
	  if(empty($this->data[$this->alias]['id'])) {
	    $this->data[$this->alias]['user_id'] = AuthComponent::user('id');		
	  }
	  else {
	    #$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
	  }
	}
	
}

