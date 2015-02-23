<?php
	echo $this->Less->css('dashboard');
?>
<div class="bem_vindo">
	<h2>
		<b>Seja bem-vindo ao ACOM,</b>
	</h2>
	<h3>o local de interação online com a sua agência Proiz.</h3>
</div> 
<br />
<br />
<?php if(AuthComponent::user('role') !== 'admin') { ?>
	<?php if($notificacoes['chamados_respondidos'] > 0 || $notificacoes['arquivos_recebidos'] > 0 ) { ?>
	<div class="notificacoes">
		<div class="janela">
			<div class="titulo_janela">
				<span>Você possui notificações</span>
				<div class="titulo_bt_func">
					<span class="btn_minimizar"></span>
				</div>
			</div>
			<div id="tabela_registros" class="tabela">
				<table>
					<tbody>
						<?php if($notificacoes['chamados_respondidos'] > 0) { ?>
						<tr>
							<td>
								<span class="numero"><?php echo $notificacoes['chamados_respondidos'] ?></span>
								Chamados respondidos
							</td>
						</tr>
						<?php } ?>
						<?php if($notificacoes['arquivos_recebidos'] > 0) {  ?>
						<tr>
							<td>
								<span class="numero"><?php echo $notificacoes['arquivos_recebidos'] ?></span>
								Arquivos recebidos
							</td>
							<td style="text-align: right;">
								<?php echo $this->Html->link('Ver', array('controller' => 'FileUploads', 'action' =>'index'), array('class'=>'botao_verde_padrao_1')); ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>