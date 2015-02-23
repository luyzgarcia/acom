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
		<?php $this->Html->meta('icon', $this->Html->url('/favicon.png')); ?>
	</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('fonts');
		echo $this->Less->css('botoes');
		echo $this->Less->css('padrao_fontes');
		echo $this->Less->css('application');
		#echo $this->Html->script('jquery-2.1.3.min.js');
		echo $this->Html->script('jquery.maskedinput.min.js');
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
				<?php if(AuthComponent::user('img_perfil')) {
					echo $this->Html->image('/files/user/img_perfil'.DS.AuthComponent::user('img_perfil_dir').DS.AuthComponent::user('img_perfil'));
				}else { 
					echo $this->Html->image('proiz.png'); 
				} ?>
			</span>
			<span class="user_name padrao_azul_2">
				<?php echo AuthComponent::user('nome_completo') ?>
			</span>
			<span class="user_perfil">
				<?php echo AuthComponent::user('role') ?>
			</span>
		</div>
		<?php #debug($this->params['controller']) ?>
		<div class="menu">
			<ul>
				<li data-title="Clique para voltar à página principal do Acom" class='padrao_azul_2 <?php echo strcasecmp($this->params['controller'] ,'Dashboards') == 0 ? 'ativo' : '' ?>'><?php echo $this->Html->link('Principal',  array('controller'=>'Dashboards', 'action'=>'index')); ?></li>
				<li data-title="Área para troca de arquivos com a Proiz" class='padrao_azul_2 <?php echo $this->params['controller'] == 'FileUploads' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Transferencia de arquivos', array('controller'=>'FileUploads', 'action'=>'index'), array("aboutFlag"=>"(?i:index)")); ?></li>
				<li data-title="Utilize esta área para detalhar os projetos e peças que a Proiz deve criar para você" class='padrao_azul_2 <?php echo strcasecmp($this->params['controller'] ,'Briefings') == 0 ? 'ativo' : '' ?>'><?php echo $this->Html->link('Briefings', array('controller'=>'Briefings', 'action'=>'index')); ?></li>
				<li data-title="Aqui você pode abrir chamados e entrar em contato com agência" class='padrao_azul_2 <?php echo $this->params['controller'] == 'Chamados' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Chamados', array('controller'=>'Chamados', 'action'=>'index')); ?></li>
				<li data-title="Aqui você pode abrir solicitar um orçamento" class='padrao_azul_2 <?php echo $this->params['controller'] == 'Orcamentos' ? 'ativo' : '' ?>'><?php echo $this->Html->link('Solicitar orçamentos', array('controller'=>'Orcamentos', 'action'=>'index')); ?></li>
				<?php if(AuthComponent::user('role') === 'admin') { ?>
					<li data-title="Confira os briefings recebidos dos clientes" class='padrao_azul_2 <?php echo strcasecmp($this->params['controller'] ,'BriefingProjetos') == 0 ? 'ativo' : '' ?>'><?php echo $this->Html->link('Gerenciar Briefings', array('controller'=>'BriefingProjetos', 'action'=>'index')); ?></li>
					<li data-title="Gerencie os usuários do sistema" class='padrao_azul_2 <?php echo strcasecmp($this->params['controller'] ,'Users') == 0 ? 'ativo' : '' ?>'><?php echo $this->Html->link('Gerenciar Usuários', array('controller'=>'Users', 'action'=>'index')); ?></li>
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
		<div class="mensagens">
			<?php if($this->Session->check('Message.sucesso')) { ?>
			<div class="sucesso">
				<?php echo $this->Html->image('icon_sucesso.png'); ?>
				<?php echo $this->Session->flash('sucesso'); ?>
				<a href="#" id="bt_message_ok" class="botao_verde_padrao_1">OK</a>
			</div>
			<?php } ?>
			<?php if($this->Session->check('Message.erro')) { ?>
			<div class="erro-atualizar">
				<?php echo $this->Html->image('icon_erro.png'); ?>
				<?php echo $this->Session->flash('erro'); ?>
			</div>
			<?php } ?>
			<?php if($this->Session->check('Message.erro-atualizar')) {?>
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
