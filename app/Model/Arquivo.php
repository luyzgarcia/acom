<?php 

class Arquivo extends AppModel {
	public $name = 'Arquivo';
	
	public $belongsTo = array(
				'User',
				'destino' => array(
					'className' => 'User',
					'foreignKey' => 'destino_id'
				));
	public $actsAs = array(
		'Upload.Upload' => array(
			'arquivo' => array (
				'fields' => array(
					'dir' => 'arquivo_dir',
					'type' => 'arquivo_type',
                    'size' => 'arquivo_size',
				)				
			)
		)
	);
	
	function beforeSave($options = array())
	{
	  if(empty($this->data[$this->alias]['id'])) {
	  	//On create
	    $this->data[$this->alias]['user_id'] = AuthComponent::user('id');		
	  }
	  else {
	  	//on update
	    #$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
	  }
	}
	
	/*public function upload($imagem = array(), $dir = 'file_uploads') {
		
		$this->data['FileUpload']['url_path'] = DS.$dir.DS;
		#debug($this->data['FileUpload']['url_path']);
		#exit();
			
		$dir = WWW_ROOT.$dir.DS;
		
		if(($imagem['error']!= 0) and ($imagem['size']==0)) {
			throw new NotImplementedException('Alguma coisa deu errado, o upload retornou erro '.$imagem['error'].' e tamanho '.$imagem['size']);
		}
		
		//Salva no arquivo o diretorio onde o arquivo será salvo
		
		
		$this->checa_dir($dir);
		$imagem = $this->checa_nome($imagem, $dir);
		$this->move_arquivos($imagem, $dir);
		return $imagem['name'];
	}
	 */
	
} 