<?php 
	echo $this->Less->css('formularios');
	echo $this->Less->css('arquivo');
	echo $this->Html->script('arquivo'); 
	
	
	echo $this->Html->script('fileupload/jquery.ui.widget');
	echo $this->Html->script('fileupload/jquery.iframe-transport');
	echo $this->Html->script('fileupload/jquery.fileupload'); 
?>

<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo para cliente</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_fileupload" class="form_arquivo ">			
			<?php echo $this->Form->create('Arquivo', array('id'=>'FileUploadUploadForm','type'=>'file', 'url'=>array('controller'=> 'Arquivos', 'action'=>'enviar_arquivo'))) ?>
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
				<?php if(AuthComponent::user('role') === 'admin') { ?>
				<div class="entrada_dados">
					<?php echo $this->Form->input('destino_id', array('type' => 'select', 'label' => 'Para quem  ',
					        'options' => $options,'required'=>true)) ?>
				</div>
				
				<?php } ?>
				<?php echo $this->Form->input('arquivo_id', array('id'=>'FileUploadArquivoId','type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_name', array('id'=> 'FileUploadArquivoName','type'=>'hidden')) ?>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('descricao', array('required' => true)) ?>
				</div>
				<div class="btn_enviar">
					<?php echo $this->Form->submit('Enviar',array('disabled')); ?>
				</div>
		</div>
	</div>
	
</div>

<!--
<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_arquivo" class="form_arquivo ">
			
			<?php echo $this->Form->create('Arquivo', array('id'=>'FileUploadUploadForm','type'=>'file','url'=>array('controller'=> 'Arquivos', 'action'=>'enviar_arquivo'))) ?>
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
				<?php if(AuthComponent::user('role') === 'admin') { ?>
				<div class="entrada_dados">
					<?php echo $this->Form->input('destino_id', array('type' => 'select', 'label' => 'Para quem  ',
					        'options' => $options,'required'=>true)) ?>
				</div>
				
				<?php } ?>
				<?php echo $this->Form->input('arquivo_id', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_name', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_size', array('type'=>'hidden')) ?>
				<?php echo $this->Form->input('arquivo_type', array('type'=>'hidden')) ?>
				
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('descricao', array('required' => true)) ?>
				</div>
				<div class="btn_enviar">
					<?php echo $this->Form->submit('Enviar',array('options' => array('disabled' => TRUE))); ?>
				</div>
		</div>
	</div>
</div>-->
<?php if(AuthComponent::user('role') !== 'admin') { ?>
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
				<tr class="item" id="<?php echo $item['Arquivo']['id'] ?>">
					<td class="pdf"><?php echo $item['Arquivo']['arquivo_name'] ?> </td>
					<td><?php echo $item['Arquivo']['arquivo_size']; ?></td>
					<td><?php echo $item['Arquivo']['arquivo_type'] ?></td>
					<td><?php echo $item['Arquivo']['created'] ?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'Arquivos','action'=>'download_arquivo', $item['Arquivo']['id'])) ?>
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
				<tr class="item" id="<?php echo $item['Arquivo']['id'] ?>">
					<td class="pdf"><?php echo $item['Arquivo']['arquivo_name'] ?> </td>
					<td><?php echo $item['Arquivo']['arquivo_size']; ?></td>
					<td><?php echo $item['Arquivo']['arquivo_type'] ?></td>
					<td><?php echo $item['Arquivo']['created'] ?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'Arquivos','action'=>'download_arquivo', $item['Arquivo']['id'])) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>
 
<?php } ?>


<!-- Enviar arquivo para cliente 

<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo para cliente</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="formulario_fileupload" class="form_arquivo ">			
			<?php echo $this->Form->create('Arquivo', array('id'=>'FileUploadUploadForm','type'=>'file', 'url'=>array('controller'=> 'Arquivos', 'action'=>'enviar_arquivo'))) ?>
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
					<?php echo $this->Form->submit('Enviar',array('disabled')); ?>
				</div>
		</div>
	</div>
	
</div>
-->
<?php if(AuthComponent::user('role') === 'admin') { ?>
<!-- Arquivo enviados para os clientes -->
<div class="janela janela_100">
	<div class="titulo_janela">
		<span>Meus arquivos enviados para clientes</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div id="tabela_registros" class="tabela">
		<table>
			<thead>
				<th style="width:28%;">Nome</th>
				<th style="width:15%;">Tamanho</th>
				<th style="width:15%;">Tipo</th>
				<th style="width:17%;">Para</th>
				<th style="width:20%;">Enviado</th>
				<th style="width:2.5%;">&nbsp;</th>
				<th style="width:2.5%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($arquivos_enviados as $item) { ?>
				<tr class="item" id="<?php echo $item['Arquivo']['id'] ?>">
					<?php $this->Geral->titulo_tooltip($item['Arquivo']['arquivo_name']) ?>
					<td><?php echo $item['Arquivo']['arquivo_size']; ?></td>
					<td><?php echo $item['Arquivo']['arquivo_type'] ?></td>
					<td><?php echo $item['destino']['nome_completo'] ?></td>
					<td><?php echo $this->Geral->formatar_data_envio($item['Arquivo']['created'])?></td>
					<td class="btn_baixar">
						<?php echo $this->Html->link('', array('controller'=>'Arquivos','action'=>'download_arquivo', $item['Arquivo']['id'])) ?>
					</td>
					<td>
						<?php echo $this->Html->link('X', array('controller'=>'Arquivos','action'=>'excluir_arquivo_enviado', $item['Arquivo']['id'])) ?>
					</td>
				</tr>
			<?php }	?>
			</tbody>
		</table>
	</div>
</div>
<? } ?>
