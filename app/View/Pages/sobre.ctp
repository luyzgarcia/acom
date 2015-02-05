<?php 
	echo $this->Less->css('sobre');
?>

<div class="pagina_sobre">
	<div class="titulo">
		<h1>Sobre</h1>
	</div>
	<div class="acom">
	<?php echo $this->Html->image('logo_acom.png', array('class' => 'logo_acom')) ?>
	
	<span>
		<p class="padrao_azul_1">ACOM é um aplicativo de acompanhamento de projetos e 
			atendimento a clientes desenvolvido pelo departamento de tecnologia da
			 agência Proiz de comunicação integrada.</p>
	</span>
	</div>
	<div class="versao">
		<?php echo $this->Html->image('versao.png') ?>
	</div>
	
	<span class="copyright">
		<p>© Copyright 2015 Proiz comunicação integrada, todos os direitos reservados.</p>
	</span>
</div>