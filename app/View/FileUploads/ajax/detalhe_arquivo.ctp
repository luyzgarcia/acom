<div class="detalhe_arquivo">
	<h4>Detalhes do item selecionado</h4>
	<div class="img_tamanho">
		<?php echo $this->Html->image('icon_arquivo_grande.png', array('alt'=>'ACOM')) ?>
		<p><?php echo $detalhe_arquivo['FileUpload']['arquivo_size']; ?></p>
	</div>
	<div class="descricao">
		<h3><?php echo $detalhe_arquivo['FileUpload']['arquivo_name']; ?></h3>
		<p><?php echo $detalhe_arquivo['FileUpload']['descricao']; ?></p>
		<div class="detalhes">
			<p>Enviado em  <?php echo $this->Geral->formatar_data_envio($detalhe_arquivo['FileUpload']['created'])?></p>
			<p>Criado por <?php echo $detalhe_arquivo['User']['nome_completo']; ?></p>
		</div>
	</div>
	<div class="botoes">
		<?php echo $this->Html->link('Baixar', array('controller'=>'FileUploads','action'=>'download_arquivo', $detalhe_arquivo['FileUpload']['id']),array('class'=>'botao_cinza_padrao_1')) ?>
		<?php echo $this->Html->link('Excluir', array('controller'=>'FileUploads','action'=>'excluir_arquivo_enviado', $detalhe_arquivo['FileUpload']['id']) ,array('data-id'=>$detalhe_arquivo['FileUpload']['id'],'onclick'=> 'excluir_arquivo(this);return false;','class'=>'botao_cinza_padrao_1')) ?>		
	</div>
</div>