<?php
/**
 * Status dos Chamados
 * ABE - Aberto
 * FEC - Fechado
 * 
 */ 

class OrcamentoItem extends AppModel {
	public $name = 'OrcamentoItem';
	public $belongsTo = array('Orcamento', 'BriefingProjeto');
	
	
	public function beforeSave($options = array()) {

	}
	
}