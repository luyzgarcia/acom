<?php 

class ArquivoEnviado extends AppModel {
	public $name = 'ArquivoEnviado';
	public $belongsTo = array(
				'enviou' => array(
					'className' => 'User',
					'foreingKey' => 'enviou_id'
				),
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
	    $this->data[$this->alias]['enviou_id'] = AuthComponent::user('id');
		$this->data[$this->alias]['is_new'] = 1;
	  }
	  else {
	  	//on update
	    #$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
	  }
	}	
} 