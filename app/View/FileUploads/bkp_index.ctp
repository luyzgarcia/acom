<?php 
	echo $this->Less->css('formularios');
	echo $this->Html->script('file upload'); 
?>

<div class="janela">
	<div class="titulo_janela">
		<span>Enviar arquivo</span>
		<div class="titulo_bt_func">
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	
	<?php
	/*
		$data = $this->Js->get('#FileUploadUploadForm')->serializeForm(array('isForm' => true, 'inline'=>true));
		$this->Js->get('#FileUploadUploadForm')->event(
			'submit',
			$this->Js->request(
				array('action'=>'upload'),
				array(
					'update' => '',
					'data' => $data,
					'async' => true,
					'dataExpression'=>true,
					'method' => 'POST'
				)
			)
		);
	echo $this->Js->writeBuffer(); 
	*/
	?>
	
	<?php
		//cria um id unico
		$up_id = uniqid();
	?>
	<?php

$upload_progress_js = <<<UPJS

    jQuery(function($) {
    	$('#FileUploadUploadForm').submit(function(e) {
    		alert('vai enviar');	
    		$.ajax({
		          type: "ajax",
		          data: ''
		          url: url,
		          success: function(data) {
		              $('#painel_conteudo').html(data.content);
		              window.history.pushState({"pageTitle":''},"", url)
		          }, 
		          error: function(response) {
		              alert('error');
		          }
		      })
    		return false;
    	});
    	
      /*$('#FileUploadUploadForm').submit(function(e) {
		  	show_progress();
      });*/
 	});

function show_progress(){

		$('.submit').hide();	
		$('#upload_frame').show(); 

		function set() { 
            $('#upload_frame').attr('src','/progress_frame.php?up_id=$up_id'); 
        } 
        setTimeout(set);

}

UPJS;
?>
	
	<div class="tabela">
		<div class="form_arquivo">
			<?php $up_p_name = ini_get("session.upload_progress.name"); ?>
			
			<?php echo $this->Form->create('FileUpload', array('type'=>'file', 'action'=>'upload')) ?>
			<?php 
				$this->Form->unlockField($up_p_name); 
				echo $this->Form->hidden($up_p_name, array('value' => $up_id,'name' => $up_p_name,'id'=>'upload_progress_id','secure' => false));
			
			?>
				<div class="input_arquivo">
					<?php echo $this->Form->input('arquivo', array(
						'type' => 'file', 
						'data-content'=>'Arraste o arquivo ou clique para escolher',
						'label' => false)) ?>
				</div>
				<div class="descricao_arquivo">
					<?php echo $this->Form->input('descricao') ?>
				</div>
				<div class="btn_enviar">
					<?php echo $this->Form->end(__('Enviar')); ?>
				</div>
		</div>
	</div>
	<iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no" > </iframe>
	<?php $this->Js->buffer($upload_progress_js); ?>
	
	<?php  echo $this->Js->writeBuffer(); ?>
	
	
	
</div>

<!-- Listagem dos arquivos enviados -->
<div class="janela">
	<div class="titulo_janela">
		<span>Meus arquivos enviados</span>
		<div class="titulo_bt_func">
			<span class="btn_fechar"></span>
			<span class="btn_minimizar"></span>
			<span class="btn_atualizar"></span>
		</div>
	</div>
	<div class="tabela" style="height: 400px">
		<table>
			<thead>
				<th style="width:40%;">Nome</th>
				<th style="width:15%;">Tamanho</th>
				<th style="width:20%;">Tipo</th>
				<th style="width:20%;">Criação</th>
				<th style="width:5%;">&nbsp;</th>
			</thead>
			<tbody>
			<?php foreach($arquivos_enviados as $item) { ?>
				<tr class="item" id="<?php echo $item['FileUpload']['id'] ?>">
					<td class="pdf"><?php echo $item['FileUpload']['arquivo'] ?> </td>
					<td><?php echo $item['FileUpload']['arquivo_size'] ?> Kb</td>
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