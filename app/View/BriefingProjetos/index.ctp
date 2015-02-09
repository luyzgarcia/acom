<?php
	echo $this->Less->css('formularios');
	echo $this->Less->css('briefing_projetos');
	echo $this->Html->script('briefing_projetos');
?>
<div class="janela janela_100">
	<div class="titulo_janela">
		<span>Projetos de briefing</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="briefing_projetos ocultar">
		<div class="div_30">
			<p>Selecione um Projeto de briefing ao lado para gerenciar suas perguntas, ou utilize o formulario abaixo para criar um novo tipo de projeto de briefing.</p>
			
			<div id="formulario_briefing_projeto" class="form_arquivo">
				<?php echo $this->Form->create('BriefingProjeto', array('controller'=>'BriefingProjeto', 'action'=> 'create','inputDefaults' => array('div' => false))) ?>
				
				<div class="entrada_dados">
					<?php echo $this->Form->input('titulo', array('required' => true)) ?>
				</div>
				
				<div class="btn_enviar">
					<?php echo $this->Form->submit('Criar'); ?>
				</div>
			</div>
		</div>
		
		<div class="div_70">
			<p>Para gerenciar as perguntas do projeto de briefing selecione um projeto abaixo.</p>
			<div class="wrapper_projetosbriefing">
				<?php foreach($lista_projetos as $key => $value) { ?>
					<div class="wrapper_item">
						<?php echo $this->Html->link(
							$value['BriefingProjeto']['titulo'], 
								array(
									'controller'=>'BriefingProjetos', 
									'action'=>'update', 
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
