<?php
	echo $this->Less->css('formularios');
	echo $this->Less->css('briefing_projetos');
	echo $this->Html->script('briefing_projetos');
	echo $this->Html->script('ckeditor/ckeditor', false);
	echo $this->Html->script('ckeditor/adapters/jquery');
	#echo $this->Html->script('tinymce/tinymce.min');
	#echo $this->Html->script('tinymce/jquery.tinymce.min');    
?>

<?php #debug($briefingprojeto) ?>

<div class="janela janela_100">
	<div class="titulo_janela">
		<span>  </span><p class="padrao_cinza_3">Projetos de Briefing > </p> <p class='texto_verde'><?php echo $briefingprojeto['BriefingProjeto']['titulo'] ?></p>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="briefing_projetos ocultar">
		<div class="div_30">
			<p>Use a area ao lado para gerenciar as perguntas desse projeto de briefing.</p>
			<p><?php echo $this->Html->link('Voltar', array('controller'=>'BriefingProjetos','action'=>'index'), array('class'=>'botao_voltar_2')); ?></p>
		</div>
		
		<div class="div_70">
			<p>Gerencie as perguntas do briefing abaixo abaixo.</p>
			
			<div id="formulario_briefing_projeto" class="form_arquivo">
				<?php echo $this->Form->create('BriefingProjeto', array('controller'=>'BriefingProjeto', 'action'=> 'update','inputDefaults' => array('div' => false))) ?>
				
				<div class="entrada_dados">
					<?php echo $this->Form->input('status',array(
						'options' => array('ATV' => 'Ativo','INA' => 'Inativo' )), array('required' => true)) ?>
				</div>
				
				<div class="entrada_dados">
					<?php echo $this->Form->input('titulo', array('required' => true)) ?>
				</div>
				
				<div class="entrada_dados">
					<?php echo $this->Form->input('prazo_minimo', array('label'=> 'Prazo mínimo em dias úteis', 'required' => true, 'min' => 0, 'step' => 1)) ?>
				</div>
				
				<div class="entrada_dados">
					<?php echo $this->Form->input('descricao', array('label' => 'Descrição do tipo de projeto')) ?>
				</div>

				
				<div class="entrada_dados">
					<?php echo $this->Form->input('exemplos') ?>
				</div>
				
				<h2>Perguntas do Projeto de Briefing</h2>
				
				<div id="perguntas_briefing_projeto" class="form_arquivo">
				<?php foreach($this->data['ProjetoPergunta'] as $key => $value ) { ?>
					<div class="entrada_dados">
						<a href="#" class="excluir_pergunta">X</a>
						<?php echo $this->Form->hidden('ProjetoPergunta.'.$key.'.id', array('value'=>$value['id'])); ?>
						<?php echo $this->Form->hidden('ProjetoPergunta.'.$key.'.destroy', array('class'=>'destroy','value'=>'0')); ?>
						<?php echo $this->Form->label('Pergunta'); ?>
						<?php 
							echo $this->Form->textarea('ProjetoPergunta.'.$key.'.titulo', array('required'=> true,'value'=>$value['titulo'], 'class'=>'tinymce ckeditor'))  
						?> 
						
					</div>
				<?php } ?>
				</div>
				
				<a href="#" id="adicionar_pergunta">Nova pergunta</a>
								
				<div class="btn_enviar">
					<?php echo $this->Form->submit('Salvar'); ?>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
