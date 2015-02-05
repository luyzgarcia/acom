<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'ACOM - Agencia Proiz');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('fonts');
		echo $this->Less->css('botoes');
		echo $this->Less->css('padrao_fontes');
		echo $this->Less->css('application');
		#echo $this->Html->script('jquery-2.1.3.min.js');
		echo $this->Html->script('application');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');	
	?>
</head>
<body>
	<div id="container">
	<header>
		<div class="esquerda">
			<?php echo $this->Html->image('logo_acom_3.png', array('alt'=>'ACOM')) ?>
		</div>
		<div class="direita">
			<ul id="menu_header">
				<div>
					<!--<li><?php echo $this->Html->link('Meus dados', array('controller' => 'users', 'action'=>'index'), array('async'=>true)) ?></li>
					<li><?php echo $this->Html->link('Meus dados', array('controller' => 'users', 'action'=>'index'), array('class'=>'js-ajax')) ?>-->
					<li><a href="#">Relatar algum problema</a></li>
					<li><?php 
							if(AuthComponent::user()) {
								echo $this->Html->link('Sair', array('controller' => 'users', 'action' => 'logout'));
							}else {
								echo $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login'));
							}
						?>
					</li>
				</div>
			</ul>
			
		</div>
	</header>
	
	<div id="painel_esquerdo">
		<div class="info_user">
			<span class="img_avatar">
				<?php echo $this->Html->image('logo_proiz.png') ?>
			</span>
			<span class="user_name">
				<?php echo AuthComponent::user('username') ?>
			</span>
			<span class="user_perfil">
				<?php echo AuthComponent::user('role') ?>
			</span>
		</div>
		<div class="menu">
			<ul>
				<li class='padrao_azul_2 <?php echo $this->params['controller'] == 'Dashboards' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Principal',  array('controller'=>'Dashboards', 'action'=>'index')); ?></li>
				<li class='padrao_azul_2 <?php echo $this->params['controller'] == 'FileUploads' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Transferencia de arquivos', array('controller'=>'FileUploads', 'action'=>'index'), array("aboutFlag"=>"(?i:index)")); ?></li>
				<li class='padrao_azul_2 <?php echo $this->params['controller'] == 'Chamados' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Chamados', array('controller'=>'Chamados', 'action'=>'index')); ?></li>
				<li class='padrao_azul_2 <?php echo $this->params['controller'] == 'Briefings' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Briefings', array('controller'=>'Briefings', 'action'=>'index')); ?></li>
				<?php if(AuthComponent::user('role') === 'admin') { ?>
					<li class='padrao_azul_2 <?php echo $this->params['controller'] == 'BriefingProjetos' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Gerenciar Briefings', array('controller'=>'BriefingProjetos', 'action'=>'index')); ?></li>
				<?php } ?>
				<!--<li><a href="#">Contas publicitarias</a></li>-->
			</ul>	
		</div>
		<div class="acom_info">
			<?php echo $this->Html->image('logo_proiz_2.png') ?>
			<span>Copyright 2015 Proiz comunicação integrada - Todos os direitos reservados</span>
			<div class="links">
				<?php echo $this->Html->link('Sobre', array('controller'=>'pages','action' => 'display','sobre')); ?>
				<a href="#">Contato</a>
			</div>
		</div>
	</div>
	<div id="painel_conteudo">
		<br/>
		<div class="mensagens">
			<?php echo $this->Session->flash(); ?> 
			<?php if($this->Session->flash('sucesso')) { ?>
			<div class="sucesso">
				<?php echo $this->Html->image('icon_sucesso.png'); ?>
				<?php echo $this->Session->flash('sucesso'); ?>
				<a href="#" id="bt_message_ok" class="botao_verde_padrao_1">OK</a>
			</div>
			<?php } ?>
			<?php if($this->Session->flash('erro-atualizar')) {?>
			<div class="erro-atualizar">
				<?php echo $this->Html->image('icon_erro.png'); ?>
				<?php echo $this->Session->flash('erro-atualizar'); ?>
				<a href="#" id='bt_erro_atualizar' class="botao_verde_padrao_1">Atualizar</a>
			</div>
			<?php } ?>
		</div>
		<?php echo $this->fetch('content'); ?>
		
	</div>
	</div>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
