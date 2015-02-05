<div class="usuarios form">
	<?php echo $this->Form->create('User') ?>
		<fieldset>
			<legend>Cadastrar novo Usuário</legend>
			<?php 
				echo $this->Form->input('username');
				echo $this->Form->input('password');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Cadastrar')) ?>
</div>
