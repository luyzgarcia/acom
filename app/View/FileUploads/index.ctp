<?php 
	echo $this->Less->css('formularios');
	echo $this->Less->css('file_upload');
	echo $this->Html->script('file_upload'); 
	
	
	echo $this->Html->script('fileupload/jquery.ui.widget');
	echo $this->Html->script('fileupload/jquery.iframe-transport');
	echo $this->Html->script('fileupload/jquery.fileupload'); 
?>

<?php if(AuthComponent::user('role') !== 'admin') { ?>
<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_fileupload" class="form_arquivo ">
			
			<?php echo $this->Form->create('FileUpload', array('id'=>'FileUploadUploadForm','type'=>'file','url'=>array('controller'=> 'FileUploads', 'action'=>'upload'))) ?>
				<div class="enviando_arquivo" data-content="0%">
					<p>do envio concluído</p>
					<p id="cancel_novo">Enviar outro arquivo</p>
				</div>				
			<div class="input_arquivo">
					<?php echo $this->Form->input('arquivo', array(
						'type' => 'file', 
						'data-content'=>'Arraste o arquivo ou clique para escolher',
						'label' => false)) ?>
					<span class='input_area' data-content='Arraste o arquivo ou clique para escolher'></span>
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
					<?php echo $this->Form->submit('Enviar',array('options' => array('disabled' => TRUE))); ?>
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

<!-- Arquivos recebidos -->
<div class="janela">
	<div class="titulo_janela">
		<span>Meus arquivos recebidos</span>
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
				<th style="width:20%;">Enviado</th>
				<th style="width:5%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($arquivos_recebidos as $item) { ?>
				<tr class="item" id="<?php echo $item['ArquivoEnviado']['id'] ?>">
					<td class="pdf"><?php echo $item['ArquivoEnviado']['arquivo_name'] ?> </td>
					<td><?php echo $item['ArquivoEnviado']['arquivo_size']; ?></td>
					<td><?php echo $item['ArquivoEnviado']['arquivo_type'] ?></td>
					<td><?php echo $item['ArquivoEnviado']['created'] ?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'FileUploads','action'=>'download_arquivo_recebido', $item['ArquivoEnviado']['id'])) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>
 
<? } ?>

<?php #debug($options); ?>


<!-- Enviar arquivo para cliente -->
<?php if(AuthComponent::user('role') === 'admin') { ?>
<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo para cliente</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_fileupload" class="form_arquivo ">			
			<?php echo $this->Form->create('ArquivoEnviado', array('id'=>'FileUploadUploadForm','type'=>'file', 'url'=>array('controller'=> 'FileUploads', 'action'=>'enviar_arquivo_cliente'))) ?>
				<div class="enviando_arquivo" data-content="0%">
					<p>do envio concluído</p>
					<p id="cancel_novo">Enviar outro arquivo</p>
				</div>				
			<div class="input_arquivo">
					<?php echo $this->Form->input('arquivo', array(
						'type' => 'file', 
						'data-content'=>'Arraste o arquivo ou clique para escolher',
						'label' => false)) ?>
					<span class='input_area' data-content='Arraste o arquivo ou clique para escolher'></span>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('destino_id', array('type' => 'select', 'label' => 'Para quem  ',
					        'options' => $options,'required'=>true)) ?>
				</div>
				<?php echo $this->Form->input('arquivo_id', array('id'=>'FileUploadArquivoId','type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_name', array('id'=> 'FileUploadArquivoName','type'=>'hidden')) ?>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('descricao', array('required' => true)) ?>
				</div>
				<div class="btn_enviar">
					<!--<a href="#" class="botao_vermelho cancel">Cancelar Envio</a>-->
					<?php echo $this->Form->submit('Enviar',array('disabled')); ?>
				</div>
		</div>
	</div>
	
</div>


<!-- Arquivo enviados para os clientes -->
<div class="janela janela_100">
	<div class="titulo_janela">
		<span>Meus arquivos enviados para clientes</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div id="tabela_registros" class="tabela" style="height: 400px">
		<table>
			<thead>
				<th style="width:20%;">Nome</th>
				<th style="width:15%;">Tamanho</th>
				<th style="width:20%;">Tipo</th>
				<th style="width:20%;">Para</th>
				<th style="width:20%;">Criação</th>
				<th style="width:2.5%;">&nbsp;</th>
				<th style="width:2.5%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($arquivos_enviados as $item) { ?>
				
				<tr class="item" id="<?php echo $item['ArquivoEnviado']['id'] ?>">
					<td class="pdf"><?php echo $item['ArquivoEnviado']['arquivo_name'] ?> </td>
					<td><?php echo $item['ArquivoEnviado']['arquivo_size']; ?></td>
					<td><?php echo $item['ArquivoEnviado']['arquivo_type'] ?></td>
					<td><?php echo $item['destino']['nome_completo'] ?></td>
					<td><?php echo $item['ArquivoEnviado']['created'] ?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'FileUploads','action'=>'download_arquivo', $item['ArquivoEnviado']['id'])) ?>
					</td>
					<td>
						<?php echo $this->Html->link('X', array('controller'=>'FileUploads','action'=>'excluir_arquivo_enviado', $item['ArquivoEnviado']['id'])) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>
<? } ?>
