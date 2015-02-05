<?php

class ChamadoRespostasController extends AppController {
	
	public function nova_resposta() {
		if($this->request->is('Post')) {
			#debug($this->request->data);
			#exit();
			
			$this->ChamadoResposta->create();
			if($this->ChamadoResposta->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Resposta adicionada com sucesso!'));
				$this->redirect(array(
				    'controller' => 'Chamados',
				    'action' => 'visualizar', $this->request->data['ChamadoResposta']['chamado_id'] ));
			}else {
				$this->Session->setFlash(__('Houve algum erro no chamado!'));
				$this->redirect(array(
				    'controller' => 'Chamados',
				    'action' => 'index'));
			}
		}	
	}
	
	public function download_anexo($id) {
		
		$this->ChamadoResposta->id = $id;  
    	$this->ChamadoResposta->read();
		
		#debug($this->ChamadoResposta->data['ChamadoResposta']);
		#exit();
		
		#if($this->ChamadoResposta->data['ChamadoResposta']['anexo'])
		try {
			$this->viewClass = 'Media';
	        // Download app/outside_webroot_dir/example.zip
	        $params = array(
	            'id'        => $this->ChamadoResposta->data['ChamadoResposta']['anexo'],
	            'name'      => $this->ChamadoResposta->data['ChamadoResposta']['anexo'],
	            'download'  => true,
	            'path'      => WEBROOT_DIR . DS . 'files' . DS . 'chamado_resposta' . DS . 'anexo' . DS . $id . DS
	        );
	        $this->set($params);
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'));
        	$this->redirect(array(
				    'controller' => 'Chamados',
				    'action' => 'visualizar', $this->request->data['ChamadoResposta']['chamado_id'] ));
        }
	}
	
}
