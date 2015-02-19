<?php

class DashboardsController extends AppController {
	public $uses = array(
		'ArquivoEnviado'
	);
	#public $components = array('ProizAuxiliar');
	
	public function index() {
		if(AuthComponent::user('role') != 'admin') {
			
			$arquivos_recebidos = $this->ArquivoEnviado->find('count', array('conditions' => array('ArquivoEnviado.is_new' => 1, 'ArquivoEnviado.destino_id' => AuthComponent::user('id'))));
			#$arquivos_recebidos = $this->ArquivoEnviado->find('count', array('conditions' => array('ArquivoEnviado.is_new' => 1)));
			
			$notificacoes = array('arquivos_recebidos' => $arquivos_recebidos, 'chamados_respondidos'=>0);
			
			//$arquivos_enviados = $this->FileUpload->find('all',array('conditions' => array('FileUpload.user_id' => AuthComponent::user('id')),'order' => array('FileUpload.id'=>'desc')));
			//$arquivos_recebidos = $this->ArquivoEnviado->find('all',array('conditions' => array('ArquivoEnviado.destino_id' => AuthComponent::user('id')),'order' => array('ArquivoEnviado.id'=>'desc')));
			$this->set('notificacoes', $notificacoes);
		}
		//$this->Session->setFlash(__('adsfadsf'), 'default', array('class' => 'message'), 'sucesso');
		//$this->Session->setFlash(__('Erro'), 'default', array('class' => 'erro message'), 'erro-atualizar');				
	}
	
}