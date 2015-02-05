<?php 

class ChamadoResposta extends AppModel {
	public $name = 'ChamadoResposta';
	public $belongsTo = array('Chamado');
	public $actsAs = array(
		'Upload.Upload' => array(
			'anexo' => array (
				'fields' => array(
					'dir' => 'anexo_dir'
				)
			)
		)
	);
	
	public function beforeSave($options = array()) {
		$this->data['ChamadoResposta']['user_id'] = AuthComponent::user('id');
	}
	
	public function afterSave($created, $options = array()) {
		/*Apos salvar uma nova resposta do chamado ele atualiza o campo nova_resposta na tabela do chamdo
		 * para assim saber que tem uma nova resposta daquele chamado.*/
		
		$this->Chamado->id = $this->data['ChamadoResposta']['chamado_id'];  
    	$this->Chamado->read();
		$this->Chamado->set('nova_resposta', true);
		$this->Chamado->save();
		
		#debug($this->data);
		#debug($this->data['ChamadoResposta']['chamado_id']);
		#exit();
		
	}
		
}