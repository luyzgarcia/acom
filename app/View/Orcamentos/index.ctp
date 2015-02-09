<?php
	echo $this->Less->css('formularios');
	echo $this->Less->css('briefing_projetos');
	#echo $this->Html->script('briefing_projetos');
	echo $this->Html->script('orcamentos');
	#echo $this->Html->script('ckeditor/ckeditor', false);
	#echo $this->Html->script('ckeditor/adapters/jquery');
	#echo $this->Html->script('tinymce/tinymce.min');
	#echo $this->Html->script('tinymce/jquery.tinymce.min');    
?>

<?php #debug($briefingprojeto); ?>

<div class="janela janela_100">
	<div class="titulo_janela">
		<span></span><p class="padrao_cinza_3">Soliciar orçamento</p>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="briefing_projetos ocultar">
		<div class="div_30">
			<p>Precisa de algum projeto ou serviço para sua marca? Utilize esta área para solicitar um orçamento.</p> 
		</div>
		
		<div class="div_70">
			<p>Preencha o formulário abaixo com as informações do(s) projeto(s) ou serviço(s) que você precisa.</p>
			
			<div id="formulario_briefing_projeto" class="form_arquivo">
				<?php echo $this->Form->create('Orcamento', array('controller'=>'Orcamento', 'action'=> 'create','inputDefaults' => array('div' => false))) ?>
				<div class="entrada_dados">
					<label>Selecione os projetos e serviços</label>
					
					<?php foreach($lista_briefingprojetos as $key => $value) { ?>
						<input type="checkbox" class='check_projetos' name="projetos_briefing" value=<?php echo $value['BriefingProjeto']['id'] ?>><?php echo $value['BriefingProjeto']['titulo'] ?>	
					<?php } ?>
				</div>
				<div id="orcamento_items_wrapper">
					
				</div>
				<div class="btn_enviar">
					<?php echo $this->Html->link('Cancelar', array('controller'=>'Dashboards','action'=>'index')); ?>
					<!--<?php echo $this->Html->link('Salvar e continuar depois', array(), array('id'=>'btn_salvar_briefing')); ?> -->
					<?php echo $this->Form->submit('Enviar', array('div'=>false)); ?>			
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<!-- Listagem dos chamados cadastrados -->
<div class="janela">
	<div class="titulo_janela">
		<span>Chamandos enviados</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="tabela" style="height: 400px">
		<table id="tabela_registros_chamados">
			<thead>
				<th style="width:20%;">Estado</th>
				<th style="width:20%;">Enviado para</th>
				<th style="width:25%;">Enviado em</th>
				<th style="width:35%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($orcamentos as $item) { ?>
				<tr class="item">
					<td class="status"><?php echo $this->Chamado->formataStatus($item['Orcamento']['status']); ?> </td>
					<td>Atendimento</td>
					<td><?php echo $this->Time->format($item['Orcamento']['created'],'%d-%m-%Y'); ?></td>
					<td>
						<?php if($item['Orcamento']['status'] == 'ABE')  {
								echo $this->Html->link('Encerrar', array('controller'=>'Orcamentos', 'action' => 'continuar_chamado'), array('id'=>$item['Orcamento']['id'], 'class' => 'btn_vermelho link_encerrar_chamado')); 
							}	
						?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>
