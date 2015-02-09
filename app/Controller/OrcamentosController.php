<?php

class OrcamentosController extends AppController {
	public $uses = array(
		'Orcamento',
		'BriefingProjeto'
	);
	
	public function index() {
		$this->set('lista_briefingprojetos', $this->BriefingProjeto->find('all',array('order' => array('BriefingProjeto.titulo'=>'desc'), 'conditions' => array('BriefingProjeto.status'=>'ATV'))));
		$this->set('orcamentos', $this->Orcamento->find('all', array('conditions' => array('Orcamento.user_id' => AuthComponent::user('id')),'order' => array('Orcamento.id'=>'desc'))));
	}
	
	public function novo() {
		$this->set('lista_briefingprojetos', $this->BriefingProjeto->find('all',array('order' => array('BriefingProjeto.titulo'=>'desc'), 'conditions' => array('BriefingProjeto.status'=>'ATV'))));
	}
	
	public function create() {
		#debug($this->params['data']);
		#exit;
		
		if($this->request->is('Post')) {
			$this->Orcamento->create();
			if($this->Orcamento->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Seu orçamento criado com sucesso, você receberá um email assim que ele for analisado!'), 'default', array('class' => 'message'), 'sucesso');
				$this->redirect(array(
					'controller' => 'Orcamentos',
					'action' => 'index',
					$this->BriefingProjeto->id	
				));
			}else {
				$this->Session->setFlash(__('Houve algum erro ao enviar seu orçamento!'), 'default', array('class' => 'message'), 'erro-atualizar');
				$this->redirect(array(
				    'controller' => 'Orcamento',
				    'action' => 'index'));
			}
		}
		
		
		
	}
	
}