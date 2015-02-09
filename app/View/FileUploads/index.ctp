<?php 
	echo $this->Less->css('formularios');
	echo $this->Less->css('file_upload');
	echo $this->Html->script('file_upload'); 
	
	
	echo $this->Html->script('fileupload/jquery.ui.widget');
	echo $this->Html->script('fileupload/jquery.iframe-transport');
	echo $this->Html->script('fileupload/jquery.fileupload'); 
?>




<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_fileupload" class="form_arquivo ">
			
			<?php echo $this->Form->create('FileUpload', array('type'=>'file', 'action'=>'upload')) ?>
				<div class="enviando_arquivo" data-content="0%">
					<p>do envio concluído</p>
					<p id="cancel_novo">Enviar outro arquivo</p>
				</div>				
			<div class="input_arquivo">
					<?php echo $this->Form->input('arquivo', array(
						'type' => 'file', 
						'data-content'=>'Arraste o arquivo ou clique para escolher',
						'label' => false)) ?>
				</div>
				<?php echo $this->Form->input('arquivo_id', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_name', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_size', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_type', array('type'=>'hidden')) ?>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('descricao', array('required' => true)) ?>
				</div>
				<div class="btn_enviar">
					<!--<a href="#" class="botao_vermelho cancel">Cancelar Envio</a>-->
					<?php echo $this->Form->submit('Enviar',array('disabled' => '')); ?>
				</div>
		</div>
	</div>
	
</div>
<!-- Listagem dos arquivos enviados -->
<div class="janela">
	<div class="titulo_janela">
		<span>Meus arquivos enviados</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div id="tabela_registros" class="tabela" style="height: 400px">
		<table>
			<thead>
				<th style="width:40%;">Nome</th>
				<th style="width:17%;">Tamanho</th>
				<th style="width:20%;">Tipo</th>
				<th style="width:20%;">Criação</th>
				<th style="width:5%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($arquivos_enviados as $item) { ?>
				<tr class="item" id="<?php echo $item['FileUpload']['id'] ?>">
					<td class="pdf"><?php echo $item['FileUpload']['arquivo_name'] ?> </td>
					<td><?php echo $item['FileUpload']['arquivo_size']; ?></td>
					<td><?php echo $item['FileUpload']['arquivo_type'] ?></td>
					<td><?php echo $item['FileUpload']['created'] ?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'FileUploads','action'=>'download_arquivo', $item['FileUpload']['id'])) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>