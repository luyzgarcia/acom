<?php

App::uses('Component', 'Controller');
class ProizAuxiliarComponent extends Component
{
	public function formata_status($status) {
		switch ($status) {
			case 'ABE':
				return 'Aberto';
				break;
			case 'FEC';
				return 'Fechado';
				break;
			default:
				return 'Indefinido';
		}
	}
	
	public function formataDepartamentoDestino($departamento) {
		switch ($departamento) {
			case 'COM':
				return 'Comercial';
				break;
			case 'SUP';
				return 'Suporte';
				break;
			case 'ATE';
				return 'Atendimento';
				break;
			case 'OUT';
				return 'Outro';
				break;
			default:
				return 'Indefinido';
		}
	}
		
}
	