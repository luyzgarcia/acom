<?php
	echo $this->Less->css('formularios');
?>
<div class="janela janela_100">
	<div class="titulo_janela">
		<span>Usuários ACOM</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	
	<div class="tabela">
		<div id="tabela_registros" class="tabela" >
			<table>
				<thead>
					<th style="width:15%;">Nome</th>
					<th style="width:15%;">Nome de usuário</th>
					<th style="width:15%;">Telefone</th>
					<th style="width:15%;">email</th>
					<th style="width:10%;">Perfil</th>
					<th style="width:20%;">Criação</th>
					<th style="width:15%;">&nbsp;</th>
				</thead>
				<tbody>
					<?php foreach($usuarios as $item) { ?>
					<tr class="item">
						<td ><?php echo $item['User']['nome_completo']; ?></td>
						<td><?php echo $item['User']['username']; ?></td>
						<td><?php echo $item['User']['telefone']; ?></td>
						<td><?php echo $item['User']['email']; ?></td>
						<td><?php echo $item['User']['role']; ?></td>
						<td><?php echo $item['User']['created']; ?></td>
						<td>
							<?php echo $this->Html->link('Editar', array('controller' => 'Users', 'action' =>'editar', $item['User']['id']), array('class'=>'botao_verde_padrao_1')); ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="janela">
	<div class="titulo_janela">
		<span><?php echo !isset($this->data['User']['id']) ? 'Novo' : 'Editar'; ?> usuário</span>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="tabela">
		<div class="form_arquivo_2">
			<?php echo $this->Form->create('User', array('type'=>'file', 'action' => 'add')) ?>
				<?php echo $this->Form->hidden('id'); ?>
				<div class="entrada_dados">
					<?php echo $this->Form->input('nome_completo', array('required'=>true)) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('username', array('label'=>'Nome de usuário','required'=>true , 'autocomplete'=>'off')) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('password', array('label'=>'Senha','required'=>true, 'autocomplete'=>'off')) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('email', array('required'=>true)) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('telefone', array('type' => 'tel','required'=>true)) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('role', array('type' => 'select',
					        'options' => array(
					            'admin' => 'Administradores',
					            'supervisor' => 'Supervisor',
					        ),'required'=>true)) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('status', array('type' => 'select',
					        'options' => array(
					            '1' => 'Ativo',
					            '0' => 'Inativo',
					        ),'required'=>true)) ?>
				</div>
				<div class="entrada_dados">
					<?php echo $this->Form->input('endereco') ?>
				</div>
				
				<div class="descricao_arquivo entrada_dados entrada_imagem">
					<?php if(isset($this->data['User']['img_perfil'])) {
						echo $this->Html->image('/files/user/img_perfil'.DS.$this->data['User']['img_perfil_dir'].DS.$this->data['User']['img_perfil'],  array('class'=>'preview_image'));
					}else { 
						echo $this->Html->image('proiz.png', array('class'=>'preview_image')); 
					} ?>
					<?php echo $this->Form->input('img_perfil', array('class'=>'show_preview','type'=>'file','label'=>'Imagem perfil', 'div'=>false)) ?>
				</div>
				<div class="btn_enviar">
					<?php echo $this->Html->link('Cancelar', array('controller'=>'Users','action'=>'index')); ?>
					<?php echo $this->Form->submit('Salvar', array('div'=>false)); ?>		
				</div>
		</div>
	</div>
</div>
