<?php

class PainelClientesController extends AppController {
	public $uses = array(
		'User',
		'Arquivo',
		'Briefing',
		'FileUpload'
	);
	#public $components = array('ProizAuxiliar');
	
	public function index() {
		$this->set('clientes', $this->User->find('all',array('conditions' => array('User.role !=' => 'admin','User.status' => 1),'order' => array('User.id'=>'desc'))));
	}
	
	public function detalhe_cliente($id) {
		$this->User->id = $id;
		$this->User->read();
		
		$this->set('cliente', $this->User->data);
		
	}
	
}