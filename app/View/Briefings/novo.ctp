<?php
	echo $this->Less->css('formularios');
	echo $this->Less->css('briefing_projetos');
	echo $this->Html->script('briefing_projetos');
	echo $this->Html->script('briefings');
	echo $this->Html->script('ckeditor/ckeditor', false);
	echo $this->Html->script('ckeditor/adapters/jquery');
	#echo $this->Html->script('tinymce/tinymce.min');
	#echo $this->Html->script('tinymce/jquery.tinymce.min');    
?>

<?php #debug($briefingprojeto); ?>

<div class="janela janela_100">
	<div class="titulo_janela">
		<span>  </span><p class="padrao_cinza_3">Projetos de Briefing > </p> <p class='texto_verde'><?php echo $briefingprojeto['BriefingProjeto']['titulo'] ?></p>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="briefing_projetos ocultar">
		<div class="div_30">
			<p>Você escolheu preencher um briefing para um projeto de:</p> 
			<p class='texto_verde'><?php echo $briefingprojeto['BriefingProjeto']['titulo'] ?></p>
			<p><?php echo $this->Html->link('Voltar', array('controller'=>'Briefings','action'=>'index'), array('class'=>'botao_voltar_2')); ?></p>
		</div>
		
		<div class="div_70">
			<p>Responda as perguntas abaixo e nos ajude a conhecer os propósitos do projeto que será desenvolvido.</p>
			
			<div id="formulario_briefing_projeto" class="form_arquivo">
				<?php echo $this->Form->create('Briefing', array('controller'=>'Briefing', 'action'=> 'create','inputDefaults' => array('div' => false))) ?>
				<?php echo $this->Form->hidden('briefing_projeto_id',array('value'=>$briefingprojeto['BriefingProjeto']['id'])) ?>
				<div class="entrada_dados">
					<?php echo $this->Form->input('nome_projeto', array('required' => true, 'label' => '1) Qual o nome do projeto?')) ?>
				</div>
				<?php foreach($briefingprojeto['ProjetoPergunta'] as $key => $value ) { ?>
					<div class="entrada_dados">
						<label>
							<?php echo ($key+2).')'.$value['titulo'] ?>
						</label>
						<?php echo $this->Form->hidden('BriefingResposta.'.$key.'.pergunta', array('value' => $value['titulo'])) ?>
						<?php echo $this->Form->input('BriefingResposta.'.$key.'.resposta', array('label' => false)) ?>
					</div>
				<?php } ?>
				<div class="btn_enviar">
					<?php echo $this->Html->link('Cancelar', array('controller'=>'Briefings','action'=>'index')); ?>
					<?php echo $this->Html->link('Salvar e continuar depois', array(), array('id'=>'btn_salvar_briefing')); ?>
					<?php echo $this->Form->submit('Salvar', array('div'=>false)); ?>					
				</div>
			</div>
			
		</div>
		
	</div>
</div>
