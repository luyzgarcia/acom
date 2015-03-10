<?php foreach ($clientes as $key => $value) { ?>
<div class="notificacoes">
		<div class="janela">
			<div class="titulo_janela">
				<span><?php echo $value['User']['nome_completo'] ?></span>
				<div class="titulo_bt_func">
					<span class="btn_minimizar"></span>
				</div>
			</div>
			<div id="tabela_registros" class="tabela">
				<table>
					<tbody>
						<tr>
							<td>
								<span class="numero">X</span>
								Arquivos novos
							</td>
							<td style="text-align: right;">
								<?php echo $this->Html->link('Ver', array('controller' => 'PainelClientes', 'action' =>'detalhe_cliente', $value['User']['id']), array('class'=>'botao_verde_padrao_1')); ?>
							</td>
						</tr>
						<tr>
							<td>
								<span class="numero">X</span>
								Chamados em aberto
							</td>
							<td style="text-align: right;">
								<?php echo $this->Html->link('Ver', array('controller' => 'PainelClientes', 'action' =>'detalhe_cliente', $value['User']['id']), array('class'=>'botao_verde_padrao_1')); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php } ?>