<?php
/**
 * Status dos Chamados
 * ABE - Aberto
 * FEC - Fechado
 * 
 */ 

class Chamado extends AppModel {
	public $name = 'Chamado';
	public $belongsTo = 'User';
	public $hasMany = 'ChamadoRespostas';
	public $actsAs = array(
		'Upload.Upload' => array(
			'anexo' => array (
				'fields' => array(
					'dir' => 'anexo_dir'
				)
			)
		)
	);
	/*public $validate = array(
		'pergunta' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'A pergunta deve ser preenchida'
			)
		)
	);
	*/
	
	public function beforeSave($options = array()) {
		$this->data['Chamado']['user_id'] = AuthComponent::user('id');		
		if(!isset($this->data['Chamado']['id'])) {
			$this->data['Chamado']['status'] = 'ABE';
		}
	}
	
}