<?php

class ChamadoAnexo extends AppModel {
	public $name = 'ChamadoAnexo';
	public $belongsTo = array(
		'Chamado' => array(
			'className' => 'Chamado',
			'foreignKey' => 'foreign_id'
		) 
	);
	#public $actsAs = array('Polymorphic');
	
	
}
