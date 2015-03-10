<?php

App::uses('AppHelper', 'View/Helper');

class GeralHelper extends AppHelper {
	
	public function titulo_tooltip($x)
	{
	  if(strlen($x)<=30)
	  {
	  	echo '<td class="pdf">'.$x.'</td>';
	  }
	  else
	  {
	    $y=substr($x,0,30) . '...';
		echo '<td class="pdf tooltip" data-title="'.$x.'">'.$y.'</td>';
	    
	  }
	}
	
	public function formatar_data_envio($data) {
		App::uses('CakeTime', 'Utility');	
			
		$agora = new DateTime('NOW');
		$d2= new DateTime($data);
		$intervalo = $agora->diff( $d2 );
		
		$retorno = '';
		
		if($intervalo->y > 1) {
			$retorno = 'A mais de um ano';
		}else{ 
			if($intervalo->d > 2) {
				$retorno = CakeTime::i18nFormat($data, '%d de %B');
			}else if($intervalo->d <= 2) {
				$retorno = 'Ontem';
				if($intervalo->d < 1) {
					if($intervalo->h > 1) {
							$retorno = 'Há '.$intervalo->h.' horas ';	
						}
					
					if($intervalo->h == 1) {
						$retorno = 'Há '.$intervalo->h.' hora ';
					}
					if($intervalo->h < 1) {
						$retorno = 'Há '.$intervalo->i.' minutos ';
					}	
				}	
			}
			
		}
		return $retorno;		
	}
	
}
	