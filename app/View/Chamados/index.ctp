<?php
	echo $this->Less->css('formularios');
	echo $this->Less->css('chamado');
	echo $this->Html->script('chamados');
?>

<div class="detalhe_chamado">
	<?php if(isset($chamado_detalhe)) { ?>
		<div class="janela janela_100">
			<div class="titulo_janela">
				<span>Chamado #<?php echo $chamado_detalhe['Chamado']['id']; ?></span>
				<div class="titulo_bt_func">
					<span class="btn_minimizar"></span>
				</div>
			</div>
			<div class="chamado ocultar">
				<div class="pergunta">
					<div class="detalhe_usuario">
						<img src='<?php echo $this->webroot; ?>img/fundo_branco.png'>
						<span class="texto_azul"><?php echo $chamado_detalhe['User']['username'] ?></span>
						para
						<span class="texto_verde">
							<?php echo $this->Chamado->formataDepartamentoDestino($chamado_detalhe['Chamado']['departamento_destino']); ?>
						</span>
						<span class="enviado_em padrao_cinza_2">
							Enviando em 
							<?php echo $this->Time->format($chamado_detalhe['Chamado']['created'],'%d/%m/%Y às %H:%Mh'); ?>
						</span>
					</div>
					<div class="anexo">
							<?php if($chamado_detalhe['Chamado']['anexo']) {
								echo $this->Html->link($chamado_detalhe['Chamado']['anexo'], array('controller'=>'Chamados','action'=>'download_anexo', $chamado_detalhe['Chamado']['id']));
							 } ?>
						</div>
					<div class="desc_pergunta padrao_cinza_3">
						<?php echo $chamado_detalhe['Chamado']['pergunta'];?>
					</div>
				</div>
				<div class="respostas">
					<?php foreach($chamado_detalhe['ChamadoRespostas'] as $resposta)  { ?>
						<div class="resposta">
						<div class="detalhe_usuario">
							<img src='<?php echo $this->webroot; ?>img/fundo_branco.png'>
							<span class="texto_verde">
								<?php echo $this->Chamado->formataDepartamentoDestino($chamado_detalhe['Chamado']['departamento_destino']); ?>
							</span>
							<span class="enviado_em padrao_cinza_2">
								Enviando em 
								<?php echo $this->Time->format($resposta['created'],'%d/%m/%Y às %H:%Mh'); ?>
							</span>
						</div>
						<div class="anexo">
							<?php if($resposta['anexo']) {
								echo $this->Html->link($resposta['anexo'], array('controller'=>'ChamadoRespostas','action'=>'download_anexo', $resposta['id']));
								
							 } ?>
						</div>
						<div class="desc_resposta padrao_cinza_3">
							<?php echo $resposta['resposta'] ?>
						</div>
					</div>
						
					<?php } ?>
					
				</div>
				<?php if($chamado_detalhe['Chamado']['status'] != 'FEC') { ?>
				<div class="nova_resposta form_arquivo">
					<?php echo $this->Form->create('ChamadoResposta', array('type'=>'file', 'action'=>'nova_resposta')) ?>
						<?php echo $this->Form->input('chamado_id', array('type'=>'hidden','value'=>$chamado_detalhe['Chamado']['id'])) ?>
					<div class="descricao_arquivo">
						<?php echo $this->Form->input('resposta', array('type'=>'textarea', 'label'=>'Escreva uma mensagem')) ?>
					</div>
					<div class="descricao_arquivo">
						<?php echo $this->Form->input('anexo', array('type'=>'file','label'=>false)) ?>
					</div>
					
					<div class="btn_enviar">
						<?php echo $this->Form->end(__('Responder')); ?>
					</div>
					<div class="btn_encerrar_chamado">
						<?php echo $this->Html->link('Encerrar', 
							array('controller'=>'Chamados', 
								  'action' => 'encerrar_chamado_normal', 
								  $chamado_detalhe['Chamado']['id']),
								  array('class'=>'btn_verde')
								 ); ?>
					</div>
				</div>
				
				
				
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	
</div>

<div class="janela">
	<div class="titulo_janela">
		<span>Novo chamado</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="tabela">
		<div class="form_arquivo">
			<?php echo $this->Form->create('Chamado', array('type'=>'file', 'action'=>'novo_chamado')) ?>
				<div class="enviado_sucesso">
					<p>Seu chamado foi aberto com sucesso!</p>
					<a href="#">Abrir outro Chamado.</a>
				</div>
				<div class="janela_enviando girando">
					<p>Estamos abrindo seu chamado.</p>
				</div>
				<div class="descricao_arquivo">
					<p>Você pode abrir um novo chamado para falar com a Proiz e tirar dúvidas, enviar solicitações e fazer sugestões.</p>
				</div>
				<div class="descricao_arquivo inline">
					<?php echo $this->Form->input('departamento_destino', array(
						'type'=>'select', 
						'options' => array('COM' => 'Comercial','SUP' => 'Suporte', 'ATE' => 'Atendimento','OUT' => 'Outro'),
						'label'=>'Com qual departamento deseja falar?')) ?>
				</div>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('pergunta', array('type'=>'textarea', 'label'=>'Escreva uma mensagem')) ?>
				</div>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('anexo', array('type'=>'file','label'=>false)) ?>
				</div>
				<div class="btn_enviar">
					<?php echo $this->Form->end(__('Abrir chamado')); ?>
				</div>
		</div>
	</div>
</div>


<!-- Listagem dos chamados cadastrados -->
<div class="janela">
	<div class="titulo_janela">
		<span>Todos os chamados</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="tabela" style="height: 400px">
		<table id="tabela_registros_chamados">
			<thead>
				<th style="width:15%;">Código</th>
				<th style="width:20%;">Estado</th>
				<th style="width:20%;">Enviado para</th>
				<th style="width:25%;">Última resposta</th>
				<th style="width:35%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($chamados as $item) { ?>
				<tr class="item <?php echo $item['Chamado']['nova_resposta'] == 1 ? 'nova_resposta' : ''  ?>" id="<?php echo $item['Chamado']['id'] ?>">
					<td><?php echo $this->Html->link($item['Chamado']['id'], array('controller' => 'Chamados', 'action' => 'visualizar', $item['Chamado']['id']), array('class' => 'texto_azul link_detalhe_chamado')); ?> </td>
					<td class="status"><?php echo $this->Chamado->formataStatus($item['Chamado']['status']); ?> </td>
					<td><?php echo $this->Chamado->formataDepartamentoDestino($item['Chamado']['departamento_destino']); ?></td>
					<td><?php echo $this->Time->format($item['Chamado']['modified'],'%d-%m-%Y'); ?></td>
					<td>
						<?php if($item['Chamado']['status'] == 'ABE')  {
								echo $this->Html->link('Encerrar', array('controller'=>'Chamados', 'action' => 'encerrar_chamado'), array('id'=>$item['Chamado']['id'], 'class' => 'btn_vermelho link_encerrar_chamado')); 
							}	
						?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>