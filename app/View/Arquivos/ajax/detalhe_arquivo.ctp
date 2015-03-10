<div class="detalhe_arquivo">
	<h4>Detalhes do item selecionado</h4>
	<div class="img_tamanho">
		<?php echo $this->Html->image('icon_arquivo_grande.png', array('alt'=>'ACOM')) ?>
		<p><?php echo $detalhe_arquivo['Arquivo']['arquivo_size']; ?></p>
	</div>
	<div class="descricao">
		<h3><?php echo $detalhe_arquivo['Arquivo']['arquivo_name']; ?></h3>
		<p><?php echo $detalhe_arquivo['Arquivo']['descricao']; ?></p>
		<div class="detalhes">
			<p>Enviado em  <?php echo $this->Geral->formatar_data_envio($detalhe_arquivo['Arquivo']['created'])?></p>
			<p>Criado por <?php echo $detalhe_arquivo['User']['nome_completo']; ?></p>
		</div>
	</div>
	<div class="botoes">
		<?php echo $this->Html->link('Baixar', array('controller'=>'Arquivos','action'=>'download_arquivo', $detalhe_arquivo['Arquivo']['id']),array('class'=>'botao_cinza_padrao_1')) ?>
		<?php echo $this->Html->link('Excluir', array('controller'=>'Arquivos','action'=>'excluir_arquivo', $detalhe_arquivo['Arquivo']['id']) ,array('data-id'=>$detalhe_arquivo['Arquivo']['id'],'onclick'=> 'excluir_arquivo(this);return false;','class'=>'botao_cinza_padrao_1')) ?>		
	</div>
</div>