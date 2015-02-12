<?php

class FileUploadsController extends AppController {
	public $components = array('Session', 'ProizAuxiliar');
	public $uses = array(
		'User',
		'FileUpload',
		'ArquivoEnviado'
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
	
	public function enviar_arquivo_cliente() {
		#debug($this->request);
		#exit;
		
		App::uses('File', 'Utility');
		App::uses('CakeNumber', 'Utility');
		
		$dir = WWW_ROOT.'temp'.DS;
			
		$arquivo = new File($dir.$this->request->data['ArquivoEnviado']['arquivo_id'].'-'.$this->request->data['ArquivoEnviado']['arquivo_name']);
				
		$info = $arquivo->info();
		
		//Lê as informaçoes referente o arquivo temporario!
		$this->request->data['ArquivoEnviado']['arquivo_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->request->data['ArquivoEnviado']['arquivo_name']);
		$this->request->data['ArquivoEnviado']['arquivo_type'] = $info['mime'];
		$this->request->data['ArquivoEnviado']['arquivo_size'] = CakeNumber::toReadableSize($info['filesize']);
		$this->request->data['ArquivoEnviado']['arquivo_dir'] = WWW_ROOT.'files'.DS.'arquivo_enviado'.DS;
		$this->request->data['ArquivoEnviado']['arquivo'] = $info['basename'];
		//debug($this->request->data);
		//exit;
		$this->ArquivoEnviado->create();
		if($this->ArquivoEnviado->save($this->request->data)) {
			
			//Busca o registro salvo
			$salvado = $this->ArquivoEnviado->read(null, $this->ArquivoEnviado->id);
			//Define a pasta de destino - Files/file_uplpoad/id/
			$dir_destino = WWW_ROOT.'files'.DS.'arquivo_enviado'.DS.$salvado['ArquivoEnviado']['id'];
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
									"arquivo_id" => $salvado['ArquivoEnviado']['id'],
									"arquivo_size" => $salvado['ArquivoEnviado']['arquivo_size'],
						  			"arquivo_name" => $salvado['ArquivoEnviado']['arquivo_name'],
						  			"arquivo_type" => $salvado['ArquivoEnviado']['arquivo_type'],
						  			"arquivo_dir" => $salvado['ArquivoEnviado']['arquivo_dir'],
						  			"arquivo_destino" => $salvado['destino']['nome_completo'],
						  			"arquivo_created" => $salvado['ArquivoEnviado']['created']
									);
					echo json_encode($resposta);
			}else{
				$this->Session->setFlash(__('Seu arquivo foi enviado para o cliente!'), 'default', array('class' => 'message'), 'sucesso');
					$this->redirect(array(
						'controller' => 'FileUploads',
						'action' => 'index'
					));
			}
			unset($this->request->data['ArquivoEnviado']);
		}else {
			$this->Session->setFlash(__('Houve algum erro ao enviar o arquivo para o cliente!'), 'default', array('class' => 'message'), 'erro-atualizar');
				$this->redirect(array(
				    'controller' => 'FileUploads',
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
		#debug($this->data['FileUpload']['arquivo']['tmp_name']);
		#debug($this->data['FileUpload']['arquivo']['name']);
		#debug($this->data['FileUpload']['arquivo']['size']);
		
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
			
			if(array_key_exists('FileUpload',$this->data)) {
				$arquivo = new File($this->data['FileUpload']['arquivo']['tmp_name']);
			    $arquivo->copy($dir.$up_id.'-'.$this->data['FileUpload']['arquivo']['name']);
				$resposta = array("arquivo_id" => $up_id,
							  "arquivo_name" => $this->data['FileUpload']['arquivo']['name']);
			}else {
				$arquivo = new File($this->data['ArquivoEnviado']['arquivo']['tmp_name']);
				$arquivo->copy($dir.$up_id.'-'.$this->data['ArquivoEnviado']['arquivo']['name']);
				$resposta = array("arquivo_id" => $up_id,
							  "arquivo_name" => $this->data['ArquivoEnviado']['arquivo']['name']);
			}			
			$arquivo->close();
			
			echo json_encode($resposta);
			
			exit;
		}
	}
	
	public function upload() {
		
		App::uses('File', 'Utility');
		App::uses('CakeNumber', 'Utility');
		
		$dir = WWW_ROOT.'temp'.DS;
			
		$arquivo = new File($dir.$this->request->data['FileUpload']['arquivo_id'].'-'.$this->request->data['FileUpload']['arquivo_name']);
				
		$info = $arquivo->info();
		
		//Lê as informaçoes referente o arquivo temporario!
		$this->request->data['FileUpload']['arquivo_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->request->data['FileUpload']['arquivo_name']);
		$this->request->data['FileUpload']['arquivo_type'] = $info['mime'];
		$this->request->data['FileUpload']['arquivo_size'] = CakeNumber::toReadableSize($info['filesize']);
		$this->request->data['FileUpload']['arquivo_dir'] = WWW_ROOT.'files'.DS.'file_upload'.DS;
		$this->request->data['FileUpload']['arquivo'] = $info['basename'];
		
		
		if(!is_null($this->request->data['FileUpload'])) {
			$this->FileUpload->create();
			if($this->FileUpload->save($this->request->data)) {
				//Busca o registro salvo
				$salvado = $this->FileUpload->read(null, $this->FileUpload->id);
				//Define a pasta de destino - Files/file_uplpoad/id/
				$dir_destino = WWW_ROOT.'files'.DS.'file_upload'.DS.$salvado['FileUpload']['id'];
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
				
				//Se a requisição for ajax ele retorna uma lista com as informações do registro
				if ($this->request->is('ajax')) {
					$this->autoRender = FALSE;
					$resposta = array(
									"arquivo_id" => $salvado['FileUpload']['id'],
									"arquivo_size" => $salvado['FileUpload']['arquivo_size'],
						  			"arquivo_name" => $salvado['FileUpload']['arquivo_name'],
						  			"arquivo_type" => $salvado['FileUpload']['arquivo_type'],
						  			"arquivo_dir" => $salvado['FileUpload']['arquivo_dir'],
						  			"arquivo_created" => $salvado['FileUpload']['created']
									);
					echo json_encode($resposta);
				}else {
					$this->Session->setFlash(__('O arquivo foi enviado!'));
					$this->redirect('index');
				}
				unset($this->request->data['FileUpload']);
			}else {
				$this->Session->setFlash(__('Houve algum erro!'));
			}
			}else {
				$this->Session->setFlash(__('Você não selecionou nennhum arquivo!'));
				$this->redirect('index');
			}
		#$this->render('index');
	}
	
	public function excluir_arquivo_enviado($id) {
		  
    	try {
			$this->ArquivoEnviado->id = $id;
			$this->ArquivoEnviado->delete();
			
			$this->Session->setFlash(__('O arquivo foi excluido!'), 'default', array('class' => 'message'), 'sucesso');
			$this->redirect(array(
				'controller' => 'FileUploads',
				'action' => 'index'
			));
		
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao excluir o arquivo, tente novamente ou entre em contato com o suporte!'), 'default', array('class' => 'message'), 'erro-atualizar');
        	$this->redirect(array(
				    'controller' => 'FileUpload',
				    'action' => 'index'));
        }
	}
	
	public function download_arquivo($id) {
		
		$this->FileUpload->id = $id;  
    	$this->FileUpload->read();
		try {
			$this->viewClass = 'Media';
	        // Download app/outside_webroot_dir/example.zip
	        $params = array(
	            'id'        => $this->FileUpload->data['FileUpload']['arquivo'],
	            'name'      => $this->FileUpload->data['FileUpload']['arquivo_name'],
	            'download'  => true,
	            'path'      => ROOT . DS . 'files' . DS . 'file_upload' . DS  . $id . DS
	        );
	        $this->set($params);
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'), 'default', array('class' => 'message'), 'erro-atualizar');
        	$this->redirect(array(
				    'controller' => 'FileUpload',
				    'action' => 'index'));
        }
	}
	
	public function download_arquivo_recebido($id) {
		
		$this->ArquivoEnviado->id = $id;  
    	$this->ArquivoEnviado->read();
		
		//Seta 0 para campo is_new
		
		
		#if($this->ChamadoResposta->data['ChamadoResposta']['anexo'])
		try {
			$this->viewClass = 'Media';
	        // Download app/outside_webroot_dir/example.zip
	        $params = array(
	            'id'        => $this->ArquivoEnviado->data['ArquivoEnviado']['arquivo'],
	            'name'      => $this->ArquivoEnviado->data['ArquivoEnviado']['arquivo_name'],
	            'download'  => true,
	            'path'      => ROOT . DS . 'files' . DS . 'arquivo_enviado' . DS  . $id . DS
	        );
	        $this->set($params);
			$this->ArquivoEnviado->set('is_new', 0);
			$this->ArquivoEnviado->save();
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'), 'default', array('class' => 'message'), 'erro-atualizar');
        	$this->redirect(array(
				    'controller' => 'FileUpload',
				    'action' => 'index'));
        }
	}	
	
	public function beforeFilter() {
		
	}
	
	public function beforeRender() {
		if(AuthComponent::user('role') === 'admin') {
			$arquivos_enviados = $this->ArquivoEnviado->find('all',array('conditions' => array('ArquivoEnviado.enviou_id' => AuthComponent::user('id')),'order' => array('ArquivoEnviado.id'=>'desc')));
		}else{		
			$arquivos_enviados = $this->FileUpload->find('all',array('conditions' => array('FileUpload.user_id' => AuthComponent::user('id')),'order' => array('FileUpload.id'=>'desc')));
			$arquivos_recebidos = $this->ArquivoEnviado->find('all',array('conditions' => array('ArquivoEnviado.destino_id' => AuthComponent::user('id')),'order' => array('ArquivoEnviado.id'=>'desc')));
			$this->set('arquivos_recebidos', $arquivos_recebidos);
		}
		$this->set('arquivos_enviados', $arquivos_enviados);
	}
	
}
