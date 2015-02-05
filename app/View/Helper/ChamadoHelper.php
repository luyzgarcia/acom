<?php

App::uses('AppHelper', 'View/Helper');

class ChamadoHelper extends AppHelper {
	
	/*
	  * Status dos Chamados
	 * ABE - Aberto
	 * FEC - Fechado
	 */
	public function formataStatus($status) {
		switch ($status) {
			case 'ABE':
				echo 'Aberto';
				break;
			case 'FEC';
				echo 'Fechado';
				break;
			default:
				echo 'Indefinido';
		}
	}
	
	/*
	  * Departamentos dos Chamados
	 * 'COM' => 'Comercial',
	 * 'SUP' => 'Suporte', 
	 * 'ATE' => 'Atendimento',
	 * 'OUT' => 'Outro'
	 */
	public function formataDepartamentoDestino($departamento) {
		switch ($departamento) {
			case 'COM':
				echo 'Comercial';
				break;
			case 'SUP';
				echo 'Suporte';
				break;
			case 'ATE';
				echo 'Atendimento';
				break;
			case 'OUT';
				echo 'Outro';
				break;
			default:
				echo 'Indefinido';
		}
	}
	
}
	