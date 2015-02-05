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

<div class="janela janela_100">
	<div class="titulo_janela">
		<span>  </span><p class="padrao_cinza_3">Projetos de Briefing > </p> <p class='texto_verde'><?php echo $briefingprojeto['BriefingProjeto']['titulo'] ?></p>
		<div class="titulo_bt_func">
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	<div class="briefing_projetos">
		<div class="div_30">
			<p>Aqui você pode visualiar seu briefing enviado:</p> 
			<p class='texto_verde'><?php echo $briefingprojeto['BriefingProjeto']['titulo'] ?></p>
			<p><?php echo $this->Html->link('Voltar', array('controller'=>'Briefings','action'=>'index'), array('class'=>'botao_voltar_2')); ?></p>
		</div>
		
		<div class="div_70">
			<p>Responda as perguntas abaixo e nos ajude a conhecer os propósitos do projeto que será desenvolvido.</p>
			
			<div id="formulario_briefing_projeto" class="form_arquivo">
				<?php echo $this->Form->create('Briefing', array('#' => array('div' => false))) ?>
				
				<div class="entrada_dados ">
					<?php echo $this->Form->input('nome_projeto', array('required' => true, 'disabled', 'label' => '1) Qual o nome do projeto?', 'class' =>'disabled')) ?>
				</div>
				<?php foreach($briefingprojeto['BriefingResposta'] as $key => $value ) { ?>
					<div class="entrada_dados desativado">
						<label>
							<?php echo ($key+2).')'.$value['pergunta'] ?>
						</label>
						<?php echo $this->Form->input('BriefingResposta.'.$key.'.resposta', array('disabled','label' => false, 'class' =>'disabled')) ?>
					</div>
				<?php } ?>
			</div>
			
		</div>
		
	</div>
</div>
