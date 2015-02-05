<?php

	echo $this->Less->css('botoes');

?>


<div class="wrapper_login">
	<div class="login_proiz">
		<?php echo $this->Html->image('logo_acom_2.png',array('Alt'=>'ACOM')); ?>
	</div>
	<div class="usuarios login_form">
	<?php echo $this->Session->flash(); ?>
	
	<?php echo $this->Form->create('User', array('inputDefaults' => array())); ?>
		<?php 
			echo $this->Form->input('username', array('label'=>'Usuário'));
			echo $this->Form->input('password', array('label'=>'Senha'));
		?>
	
	<?php echo $this->Form->end(array('label'=>'Entrar','class'=>'btn_verde','div'=>'button')) ?>
	</div>
	<div class="copyright">
		<?php echo $this->Html->image('logo_proiz.png'); ?>
		<p class="padrao_cinza_4">Copyright 2015 Proiz comunicação integrada - Todos os direitos reservados</p>
	</div>

</div>