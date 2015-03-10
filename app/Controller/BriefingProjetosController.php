<?php

class BriefingProjetosController extends AppController {
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('consultar');
	}
	
	public function index() {
		$this->set('lista_projetos', $this->BriefingProjeto->find('all',array('order' => array('BriefingProjeto.titulo'=>'desc'))));	
		
	}
	
	public function create() {
		if($this->request->is('Post')) {
			$this->BriefingProjeto->create();
			if($this->BriefingProjeto->saveAll($this->request->data)) {
				
				$this->Session->setFlash(__('Seu projeto de briefing foi criado, gerencie as perguntas baixo!'), 'default', array('class' => 'message'), 'sucesso');
				$this->redirect(array(
					'controller' => 'BriefingProjetos',
					'action' => 'editar_briefingprojeto',
					$this->BriefingProjeto->id	
				));
				
			}else {
				$this->Session->setFlash(__('Houve algum erro ao salvar o projeto!'), 'default', array('class' => 'message'), 'erro-atualizar');
				$this->redirect(array(
				    'controller' => 'BriefingProjetos',
				    'action' => 'index'));
			}
		}
	}
	
	public function editar_briefingprojeto($id) {
		
		$this->BriefingProjeto->id = $id;
		
		$this->set('briefingprojeto', $this->BriefingProjeto->read());
		$this->data = $this->BriefingProjeto->data;
		
	}
	
	public function update($id) {
		
		if($this->request->is('Post')) {
			
			#debug($this->request->data);
			#exit;
			
			$this->BriefingProjeto->read(null, $id);
			$this->BriefingProjeto->set($this->request->data);
			
			foreach($this->BriefingProjeto->data['ProjetoPergunta'] as $key => $value) {
				if($value['destroy'] == '1') {
					unset($this->BriefingProjeto->data['ProjetoPergunta'][$key]);
					if(isset($value['id'])){
						$this->BriefingProjeto->ProjetoPergunta->delete($value['id']);
					}
				}
			}
			
			
			
			#($this->BriefingProjeto->delete(array('ProjetoPergunta.destroy' => '1')));
			
			#$this->BriefingProjeto->read(null, $id);
			#$this->BriefingProjeto->set($this->request->data);
			#debug($this->BriefingProjeto->data);
			#exit;
			$this->BriefingProjeto->saveAll();
			$this->Session->setFlash(__('Projeto de briefing salvo com sucesso!'), 'default', array('class' => 'message'), 'sucesso');
			
			$this->set('briefingprojeto', $this->BriefingProjeto->read());
			$this->data = $this->BriefingProjeto->data;
			
			#if($this->BriefingProjeto->update($this->request->data)) {
			#}
		}else {
			$this->BriefingProjeto->id = $id;
		
			$this->set('briefingprojeto', $this->BriefingProjeto->read());
			$this->data = $this->BriefingProjeto->data;
		}
		#debug($this->request->data);
		#exit;
	}

	public function consultar() {
		#debug($this->request->data['id']);
		#exit;
		$id = $this->request->data['id'];
		$this->BriefingProjeto->id = $id;  
    	$this->BriefingProjeto->read();
		#debug($this->BriefingProjeto->data['BriefingProjeto']);
		echo json_encode($this->BriefingProjeto->data['BriefingProjeto']);
		exit;
	}


	
}
