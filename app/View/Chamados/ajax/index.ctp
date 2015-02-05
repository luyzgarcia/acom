<?php
	echo $this->Less->css('formularios');
?>
<div class="janela">
	<div class="titulo_janela">
		<span>Novo chamado</span>
		<div class="titulo_bt_func">
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	<div class="tabela">
		<div class="form_arquivo">
			<?php echo $this->Form->create('Chamado', array('type'=>'file', 'action'=>'novo_chamado')) ?>
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
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	<div class="tabela" style="height: 400px">
		<table>
			<thead>
				<th style="width:15%;">Código</th>
				<th style="width:20%;">Estado</th>
				<th style="width:20%;">Enviado para</th>
				<th style="width:25%;">Última resposta</th>
				<th style="width:35%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($chamados as $item) { ?>
				<tr class="item" id="<?php echo $item['Chamado']['id'] ?>">
					<td><?php echo $item['Chamado']['id'] ?> </td>
					<td><?php echo $this->Chamado->formataStatus($item['Chamado']['status']); ?> </td>
					<td><?php echo $this->Chamado->formataDepartamentoDestino($item['Chamado']['departamento_destino']); ?></td>
					<td><?php echo $item['Chamado']['modified'] ?></td>
					<td class="">
						<?php echo $this->Html->link('Encerrar', array('controller'=>'ChamadosController', 'action' => 'encerrarChamado', $item['Chamado']['id']), array( 'class' => 'btn_vermelho')) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>