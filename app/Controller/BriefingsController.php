<?php

#App::import('model','BriefingProjeto');

class BriefingsController extends AppController {
	public $uses = array(
		'Briefing',
		'BriefingProjeto'
	);
	
	public function index() {
		//$modelBriefingProjeto = new BriefingProjeto();
		$this->set('briefings_salvos', $this->Briefing->find('all',array('conditions' => array('Briefing.status'=>'SAV', 'Briefing.user_id' => AuthComponent::user('id')), 'order' => array('Briefing.created'=>'desc'))));
		$this->set('briefings_enviados', $this->Briefing->find('all',array('conditions' => array('Briefing.status'=>'ENV', 'Briefing.user_id' => AuthComponent::user('id')), 'order' => array('Briefing.created'=>'desc'))));
		$this->set('lista_briefingprojetos', $this->BriefingProjeto->find('all',array('order' => array('BriefingProjeto.titulo'=>'desc'), 'conditions' => array('BriefingProjeto.status'=>'ATV'))));
		
	}
	
	public function novo($id) {
		$this->BriefingProjeto->id = $id;
		
		$this->set('briefingprojeto', $this->BriefingProjeto->read());
	}
	
	public function create() {
		if($this->request->is('Post')) {
			#debug($this->request->data);
			
			#exit;
			$this->Briefing->create();
			#debug($this->request->data['Briefing']['status']);
			if(!isset($this->request->data['Briefing']['status'])) {
				#debug('entrou0');
				$this->request->data['Briefing']['status'] = 'ENV';
			}
			#exit;
			if($this->Briefing->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Briefing respondido com sucesso!'));
				$this->redirect(array(
				    'controller' => 'Briefings',
				    'action' => 'index'));
			}else {
				$this->Session->setFlash(__('Houve algum erro ao salvar o projeto!'));
				$this->redirect(array(
				    'controller' => 'Briefings',
				    'action' => 'novo'));
			}
			
		}
	}

	public function continuar_briefing($id) {
		$this->Briefing->id = $id;
		$this->Briefing->read();
		$this->data = $this->Briefing->data;
		#debug($this->Briefing->data);
		#exit;
		$this->set('briefingprojeto', $this->Briefing->data);
		
		#$this->render('Briefings/novo');		
	}
	public function ver_briefing($id) {
		$this->Briefing->id = $id;
		$this->Briefing->read();
		$this->data = $this->Briefing->data;
		#debug($this->Briefing->data);
		#exit;
		$this->set('briefingprojeto', $this->Briefing->data);
		
		#$this->render('Briefings/novo');		
	}
}

?>