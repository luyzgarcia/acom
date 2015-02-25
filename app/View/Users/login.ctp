<?php

	echo $this->Less->css('botoes');
	echo $this->Html->script('login');

?>

<div class="fundo_azul">
	<div class="wrapper_login">
		<div class="login_proiz">
			<?php echo $this->Html->image('logo_acom_4.png',array('Alt'=>'ACOM')); ?>
			<ul>
				<li>Um jeito simples e rápido de estar perto da sua agência Proiz.</li>
				<li>1 Um jeito simples e rápido de estar perto da sua agência Proiz.</li>
				<li>3 Um jeito simples e rápido de estar perto da sua agência Proiz.</li>
			</ul>
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
		
		<!--
		<div class="salvar_proiz">
			<div class="button">
				<a id="download_proiz" href="#" onclick="AddFavLnk()" class="btn_verde">Download</a>		
			</div>
			<div class="texto">
				<h4>Acelere as coisas!</h4>
				<h5>Baixe o inicializador para sua área de trabalho e acesse o Acom com mais facilidade.</h5>
			</div>		
		</div>
		-->
		<div class="copyright">
			<?php echo $this->Html->image('logo_proiz.png'); ?>
			<p class="padrao_cinza_4">Copyright 2015 Proiz comunicação integrada - Todos os direitos reservados</p>
		</div>
	</div>
</span>