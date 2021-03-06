<?php

class FileUploadsController extends AppController {
	public $components = array('Session', 'ProizAuxiliar');
	
	public function index() {
		#$arquivos_enviados = $this->FileUpload->find('all');
		
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
		#debug($this->data['FileUpload']);
		#exit;
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
			$arquivo = new File($this->data['FileUpload']['arquivo']['tmp_name']);
			$arquivo->copy($dir.$up_id.'-'.$this->data['FileUpload']['arquivo']['name']);
			$arquivo->close();
			
			$resposta = array("arquivo_id" => $up_id,
							  "arquivo_name" => $this->data['FileUpload']['arquivo']['name']);
			
			echo json_encode($resposta);
			
			exit;
		}
	}
	
	public function upload() {
		/*$dir = WWW_ROOT.'temp'.DS;
		
		App::uses('File', 'Utility');
		
		$arquivo = new File($dir.$this->request->data['FileUpload']['arquivo_id'].'-'.$this->request->data['FileUpload']['arquivo_name']);
		
		$info = $arquivo->info();
		
		$arquivo->copy(WWW_ROOT.'files'.DS.'file_upload'.DS.'123'.DS.$this->request->data['FileUpload']['arquivo_id'].'-'.$this->request->data['FileUpload']['arquivo_name']);
		
		$this->request->data['FileUpload']['arquivo_name'] = $this->request->data['FileUpload']['arquivo_name'];
		$this->request->data['FileUpload']['arquivo_type'] = $info['mime'];
		$this->request->data['FileUpload']['arquivo_size'] = $info['filesize'];
		$this->request->data['FileUpload']['arquivo_dir'] = WWW_ROOT.'files'.DS.'file_upload'.DS;
		$this->request->data['FileUpload']['arquivo'] = $this->request->data['FileUpload']['arquivo_id'].'-'.$this->request->data['FileUpload']['arquivo_name'];
		*/
		
		if(is_null($this->data) || empty($this->data)) {
				
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'Erro ao enviar arquivo, lembra tamanho máximo para envio é de 512Mb.', 'code' => 1337)));
			exit;
			
		}else {
			
		}
		
		#App::uses('File', 'Utility');
		#App::uses('CakeNumber', 'Utility');
		
		//$dir = WWW_ROOT.'temp'.DS;
		
		#$arquivo = new File($this->data['FileUpload']['arquivo']['tmp_name']);
		#$arquivo->copy($dir.$up_id.'-'.$this->data['FileUpload']['arquivo']['name']);
			
		//$arquivo = new File($dir.$this->request->data['FileUpload']['arquivo_id'].'-'.$this->request->data['FileUpload']['arquivo_name']);
		#debug($this->data['FileUpload']);
		#$arquivo = new File($this->data['FileUpload']['arquivo']['tmp_name']);
						
		#$info = $arquivo->info();
		
		#debug($info);
		#exit;
		#$this->request->data['FileUpload']['arquivo_name'] = $this->request->data['FileUpload']['arquivo_name'];
		#$this->request->data['FileUpload']['arquivo_name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->request->data['FileUpload']['arquivo_name']);
		#$this->request->data['FileUpload']['arquivo_type'] = $info['mime'];
		#$this->request->data['FileUpload']['arquivo_size'] = CakeNumber::toReadableSize($info['filesize']);
		#$this->request->data['FileUpload']['arquivo_dir'] = WWW_ROOT.'files'.DS.'file_upload'.DS;
		#$this->request->data['FileUpload']['arquivo'] = $info['basename'];
		
		if(!is_null($this->request->data['FileUpload'])) {
			$this->FileUpload->create();
			if($this->FileUpload->save($this->request->data)) {
				$salvado = $this->FileUpload->read(null, $this->FileUpload->id);
				
				
				#$arquivo->copy($dir.$up_id.'-'.$this->data['FileUpload']['arquivo']['name']);
				
				#$dir_destino = WWW_ROOT.'files'.DS.'file_upload'.DS.$salvado['FileUpload']['id'];
				#App::uses('Folder', 'Utility');
				#$folder = new Folder();
				#if (!is_dir($dir_destino)){
			#		$folder->create($dir_destino);
				#}
				#$arquivo->copy($dir_destino.DS.$info['basename']);
				
				if ($this->request->is('ajax')) {
					$this->autoRender = FALSE;
					$resposta = array(
									"arquivo_id" => $salvado['FileUpload']['id'],
									"arquivo_size" => CakeNumber::toReadableSize($salvado['FileUpload']['arquivo_size']),
						  			"arquivo_name" => $salvado['FileUpload']['arquivo'],
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
	
	public function progress() {
		if ($this->request->is('ajax')) {
			$this->autoRender = FALSE;
			$unique_upload_id = $_POST['up_id'];
			$key = ini_get("session.upload_progress.prefix") . $unique_upload_id;
			if(isset($_SESSION[$key])){
				$upload_progress = $_SESSION[$key];
				$progress = round( ($upload_progress['bytes_processed'] / $upload_progress['content_length']) * 100, 0 );
				return $progress;
			}
			else{
				return "100";
			}
		}
	}
	
	public function download_arquivo($id) {
		
		$this->FileUpload->id = $id;  
    	$this->FileUpload->read();
		
		#debug($this->ChamadoResposta->data['ChamadoResposta']);
		#exit();
		
		#if($this->ChamadoResposta->data['ChamadoResposta']['anexo'])
		try {
			$this->viewClass = 'Media';
	        // Download app/outside_webroot_dir/example.zip
	        $params = array(
	            'id'        => $this->FileUpload->data['FileUpload']['arquivo'],
	            'name'      => preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->request->data['FileUpload']['arquivo']),
	            'download'  => true,
	            'path'      => WEBROOT_DIR . DS . 'files' . DS . 'file_upload' . DS.'arquivo'.DS  . $id . DS
	        );
	        $this->set($params);
        }catch(Exception $e) {
        	$this->Session->setFlash(__('Houve um erro ao solicar o arquivo, tente novamente ou entre em contato com o suporte!'));
        	$this->redirect(array(
				    'controller' => 'FileUpload',
				    'action' => 'index'));
        }
	}
	
	
	public function beforeFilter() {
		
	}
	
	public function beforeRender() {
		$arquivos_enviados = $this->FileUpload->find('all');
		$this->set('arquivos_enviados', $arquivos_enviados);
	}
	
}
