<?php

class ChamadosController extends AppController {
	public $components = array('ProizAuxiliar');
	public $helpers = array('Chamado');
	
	public function index() {
		if($this->RequestHandler->isAjax()) {
			$this->viewClass = 'Tools.Ajax';
		}
	}
	
	public function visualizar($id) {
		#$this->Session->setFlash(__('Visualizar chamado!'), 'default' ,array('class'=>'notification'));
		$this->Chamado->id = $id;  
    	$this->set('chamado_detalhe', $this->Chamado->read());
		
    	$this->Chamado->set('nova_resposta', false);
		$this->Chamado->save();
		
		$this->render('index');
	}
	
	public function novo_chamado() {
		#debug ($this->request->data);
		#exit;
		#if($this->request->is('Post')) {			
			$this->Chamado->create();
			if($this->Chamado->saveAll($this->request->data)) {
				$salvado = $this->Chamado->read(null, $this->Chamado->id);
				if ($this->request->is('ajax')) {
					App::uses('CakeTime', 'Utility');
					$retorno = array(
					
					);
					echo json_encode(array(
									'id' => $salvado['Chamado']['id'],
									'status' =>  $this->ProizAuxiliar->formata_status($salvado['Chamado']['status']),
									'departamento_destino' => $this->ProizAuxiliar->formataDepartamentoDestino($salvado['Chamado']['departamento_destino']),
									'modified' => CakeTime::format($salvado['Chamado']['modified'],'%d-%m-%Y')
									));
					exit;
				}
				$this->redirect('index');
			}else {
				if($this->request->is('ajax')) {
					header('HTTP/1.1 500 Internal Server Booboo');
		        	header('Content-Type: application/json; charset=UTF-8');
		        	die(json_encode(array('message' => 'Erro ao criar chamado, tente novamente!', 'code' => 1337)));
					exit;
				}
				$this->Session->setFlash(__('Houve algum erro no chamado!'));
			}
		#}	
	}
	
	public function encerrar_chamado_normal($id) {
		$this->Chamado->id = $id;  
    	$this->Chamado->read();
		$this->Chamado->set('status', 'FEC');
		$this->Chamado->save();
		
		if ($this->request->is('ajax')) {
			echo json_encode(array('status' => 'Fechado'));
			exit;
		}else {
			$this->redirect('index');
		}
	}
	
	public function encerrar_chamado() {
		$id = $this->request->data['id'];
		$this->Chamado->id = $id;  
    	$this->Chamado->read();
		$this->Chamado->set('status', 'FEC');
		$this->Chamado->save();
		
		if ($this->request->is('ajax')) {
			echo json_encode(array('status' => 'Fechado'));
			exit;
		}else {
			$this->redirect('index');
		}
	}
	
	public function download_anexo($id) {
		
		$this->Chamado->id = $id;  
    	$this->Chamado->read();
		try {
			$this->viewClass = 'Media';
			
	        $params = array(
	            'id'        => $this->Chamado->data['Chamado']['anexo'],
	            'name'      => $this->Chamado->data['Chamado']['anexo'],
	            'download'  => true,
	            'path'      => WEBROOT_DIR . DS . 'files' . DS . 'chamado' . DS . 'anexo' . DS . $id . DS
	        );
		  }catch(NotFoundException $e) {
	        $this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'));
        	$this->redirect(array(
				    'controller' => 'Chamados',
				    'action' => 'visualizar', $this->request->data['Chamado']['id'] ));
			
        }
		  $this->set($params);
	}
	
	
	public function beforeRender() {
		$this->set('chamados', $this->Chamado->find('all', array('conditions' => array('Chamado.user_id' => AuthComponent::user('id')),'order' => array('Chamado.id'=>'desc'))));
	}
	
}
