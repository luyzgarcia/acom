<?php
	echo $this->Less->css('botoes');
	echo $this->Less->css('briefing_projetos');
	echo $this->Html->script('briefing_projetos');
?>
<div class="janela janela_100">
	<div class="titulo_janela">
		<span>Projetos de briefing</span>
		<div class="titulo_bt_func">
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	<div class="briefing_projetos">
		<div class="div_30">
			<p>O briefing é um instrumento que a agência utiliza para entender as necessidades da sua empresa. <br/>
				Por isso, use esta área para detalhar os projetos que você precisa que a agência Proiz desenvolva.</p>
		</div>
		
		<div class="div_70">
			<p>Para começar, escolha o tipo de projeto que você pretende desenvolver:</p>
			<div class="wrapper_projetosbriefing">
				<?php foreach($lista_briefingprojetos as $key => $value) { ?>
					<div class="wrapper_item">
						<?php echo $this->Html->link(
							$value['BriefingProjeto']['titulo'], 
								array(
									'controller'=>'Briefings', 
									'action'=>'novo', 
									$value['BriefingProjeto']['id']
								), 
								array(
									'class'=>'item_projetobriefing'
								)
							); 
						?>
					</div>
				<?php } ?>
			</div>
		</div>
		
	</div>
	
</div>
<div class="janela janela">
	<div class="titulo_janela">
		<span>Briefings salvos</span>
	</div>
	<div class="tabela">
		<div id="tabela_registros" class="tabela" >
			<table>
				<tbody>
					<?php foreach($briefings_salvos as $item) { ?>
					<tr class="item">
						<td width="75%"><?php echo $item['Briefing']['nome_projeto']; ?></td>
						<td>
							<?php echo $this->Html->link('Continuar', array('controller' => 'Briefings', 'action' =>'continuar_briefing', $item['Briefing']['id']), array('class'=>'botao_verde_padrao_1')); ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="janela janela">
	<div class="titulo_janela">
		<span>Briefings enviados</span>
	</div>
	<div class="tabela">
		<div id="tabela_registros" class="tabela" >
			<table>
				<tbody>
					<?php foreach($briefings_enviados as $item) { ?>
					<tr class="item">
						<td width="85%"><?php echo $item['Briefing']['nome_projeto']; ?></td>
						<td>
							<?php echo $this->Html->link('Ver', array('controller' => 'Briefings', 'action' =>'ver_briefing', $item['Briefing']['id']), array('class'=>'botao_verde_padrao_1')); ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
