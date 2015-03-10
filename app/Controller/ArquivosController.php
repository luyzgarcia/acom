<?php

class ArquivosController extends AppController {
	public $components = array('Session', 'ProizAuxiliar');
	public $uses = array(
		'User',
		'Arquivo'
	);
	
	public function isAuthorized($user) {
	    if (parent::isAuthorized($user)) {
	        return true;
	    }
		return false;
	}
	
	public function index() {
		$usuarios = $this->User->find('all',array('conditions' => array('User.role !=' => 'admin','User.status' => 1),'order' => array('User.id'=>'desc')));
		$options = array();
		foreach ($usuarios as $key => $value) {
			$options[$value['User']['id']] = $value['User']['nome_completo'];
		}
		$this->set(compact('options'));
	}	
	
	public function enviar_arquivo() {
		#debug($this->request);
		#exit;
		
		App::uses('File', 'Utility');
		App::uses('CakeNumber', 'Utility');
		
		$dir = WWW_ROOT.'temp'.DS;
			
		$arquivo = new File($dir.$this->request->data['Arquivo']['arquivo_id'].'-'.$this->request->data['Arquivo']['arquivo_name']);
				
		$info = $arquivo->info();
		
		//Lê as informaçoes referente o arquivo temporario!
		$this->request->data['Arquivo']['arquivo_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->request->data['Arquivo']['arquivo_name']);
		$this->request->data['Arquivo']['arquivo_type'] = $info['mime'];
		$this->request->data['Arquivo']['arquivo_size'] = CakeNumber::toReadableSize($info['filesize']);
		$this->request->data['Arquivo']['arquivo_dir'] = WWW_ROOT.'files'.DS.'arquivo_enviado'.DS;
		$this->request->data['Arquivo']['arquivo'] = $info['basename'];
		//debug($this->request->data);
		//exit;
		$this->Arquivo->create();
		if($this->Arquivo->save($this->request->data)) {
			
			//Busca o registro salvo
			$salvado = $this->Arquivo->read(null, $this->Arquivo->id);
			//Define a pasta de destino - Files/file_uplpoad/id/
			$dir_destino = WWW_ROOT.'files'.DS.'arquivo'.DS.$salvado['Arquivo']['id'];
			App::uses('Folder', 'Utility');
			
			//Cria uma pasta com o id do registro
			$folder = new Folder();
			if (!is_dir($dir_destino)){
				$folder->create($dir_destino);
			}
			//Pega o arquivo na pasta temporaria e copia para a pasta interna do sistema dentro da pasta com id do registros
			$arquivo->copy($dir_destino.DS.$info['basename']);
			//Deleta o arquivo original da pasta temp
			$arquivo->delete();
			
			if ($this->request->is('ajax')) {
					$this->autoRender = FALSE;
					$resposta = array(
									"arquivo_id" => $salvado['Arquivo']['id'],
									"arquivo_size" => $salvado['Arquivo']['arquivo_size'],
						  			"arquivo_name" => $salvado['Arquivo']['arquivo_name'],
						  			"arquivo_type" => $salvado['Arquivo']['arquivo_type'],
						  			"arquivo_dir" => $salvado['Arquivo']['arquivo_dir'],
						  			"arquivo_destino" => $salvado['destino']['nome_completo'],
						  			"arquivo_created" => $salvado['Arquivo']['created']
									);
					echo json_encode($resposta);
			}else{
				$this->Session->setFlash(__('Seu arquivo foi enviado para o cliente!'), 'default', array('class' => 'message'), 'sucesso');
					$this->redirect(array(
						'controller' => 'Arquivos',
						'action' => 'index'
					));
			}
			unset($this->request->data['Arquivo']);
		}else {
			$this->Session->setFlash(__('Houve algum erro ao enviar o arquivo para o cliente!'), 'default', array('class' => 'message'), 'erro-atualizar');
				$this->redirect(array(
				    'controller' => 'Arquivos',
				    'action' => 'index'));
		}			
	}
	
	/**
	 * Método chamado quando o usuario adiciona um arquivo no input do formulario
	 * Ele faz o upload do arquivo para uma pasta temporaria (webroot/file_uploads/temp) 
	 * Quando o usuario concluir de enviar o arquivo e der um submit no formulario, ele
	 * ira mover esse arquivo para a pasta final e apagar o arquivo da pasta temp
	 */	
	public function upload_temp() {
		$this->layout = 'ajax';
		
		if(is_null($this->data) || empty($this->data)) {
				
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'Erro ao enviar arquivo, lembra tamanho máximo para envio é de 512Mb.', 'code' => 1337)));
			exit;
			
		}else {
			$dir = WWW_ROOT.'temp'.DS;
			App::uses('Folder', 'Utility');
			$folder = new Folder();
			if (!is_dir($dir)){
				$folder->create($dir);
			}
					
			$up_id = uniqid();
			
			App::uses('File', 'Utility');
			
			if(array_key_exists('Arquivo',$this->data)) {
				$arquivo = new File($this->data['Arquivo']['arquivo']['tmp_name']);
			    $arquivo->copy($dir.$up_id.'-'.$this->data['Arquivo']['arquivo']['name']);
				$resposta = array("arquivo_id" => $up_id,
							  "arquivo_name" => $this->data['Arquivo']['arquivo']['name']);
			}			
			$arquivo->close();
			
			echo json_encode($resposta);
			
			exit;
		}
	}
	public function excluir_arquivo($id) {
		#debug('entrouuuu');
		#debug($id); 
		
		#$this->FileUpload->id = $id;
    	#$this->FileUpload->read();
    	try {
			$this->Arquivo->id = $id;
			$this->Arquivo->delete();
			if($this->RequestHandler->isAjax()) {
				echo json_encode(array("status" => 'success'));
			}else {
				$this->Session->setFlash(__('O arquivo foi excluido!'), 'default', array('class' => 'message'), 'sucesso');
				$this->redirect(array(
					'controller' => 'Arquivos',
					'action' => 'index'
				));
			}

		
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao excluir o arquivo, tente novamente ou entre em contato com o suporte!'), 'default', array('class' => 'message'), 'erro-atualizar');
        	$this->redirect(array(
				    'controller' => 'Arquivos',
				    'action' => 'index'));
        }
	}

	
	public function download_arquivo($id) {
		
		$this->Arquivo->id = $id;  
    	$this->Arquivo->read();
		
		try {
			$this->viewClass = 'Media';
	        // Download app/outside_webroot_dir/example.zip
	        $params = array(
	            'id'        => $this->Arquivo->data['Arquivo']['arquivo'],
	            'name'      => $this->Arquivo->data['Arquivo']['arquivo_name'],
	            'download'  => true,
	            'path'      => ROOT . DS . 'files' . DS . 'arquivo' . DS  . $id . DS
	        );
	        $this->set($params);
			$this->Arquivo->set('is_new', 0);
			$this->Arquivo->save();
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'), 'default', array('class' => 'message'), 'erro-atualizar');
        	$this->redirect(array(
				    'controller' => 'Arquivos',
				    'action' => 'index'));
        }
	}	

	public function detalhe_arquivo(){
		$this->Arquivo->id = $this->request->data['id'];
    	$this->set('detalhe_arquivo', $this->Arquivo->read());
		
		if($this->RequestHandler->isAjax()) {
			$this->viewClass = 'Tools.Ajax';
		}
	}
	
	public function beforeFilter() {
		
	}
	
	public function beforeRender() {
		if(AuthComponent::user('role') === 'admin') {
			$arquivos_enviados = $this->Arquivo->find('all',array('conditions' => array('Arquivo.user_id' => AuthComponent::user('id')),'order' => array('Arquivo.created'=>'desc')));
		}else{		
			$arquivos_enviados = $this->Arquivo->find('all',array('conditions' => array('Arquivo.user_id' => AuthComponent::user('id')),'order' => array('Arquivo.id'=>'desc')));
			$arquivos_recebidos = $this->Arquivo->find('all',array('conditions' => array('Arquivo.destino_id' => AuthComponent::user('id')),'order' => array('Arquivo.id'=>'desc')));
			$this->set('arquivos_recebidos', $arquivos_recebidos);
		}
		$this->set('arquivos_enviados', $arquivos_enviados);
	}
	
}
