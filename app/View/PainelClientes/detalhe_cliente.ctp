<?php
	echo $this->Less->css('painel_cliente');
	echo $this->Html->script('painel_cliente');
	
?>
<?php #debug($cliente) ?>

<div class="janela janela_100">
	<div class="titulo_janela">
		<span>  </span><p class="padrao_cinza_3">Contas de clientes > <?php echo $cliente['User']['nome_completo'] ?> > </p> <p class='texto_verde'>Arquivos</p>
		<div class="titulo_bt_func">
			<span class="btn_minimizar"></span>
		</div>
	</div>
	<div class="painel_cliente ocultar ">
		<div class="div_30">
			<h3><?php echo $cliente['User']['nome_completo'] ?></h3>
			<b>Conta desde <? echo $cliente['User']['created'] ?></b>
			
			<div class='painel_cliente_menu'>
				<ul>
					<li>
						<a href="arquivos" class="ativo">Arquivos</a>
					</li>
					<li>
						<a href="briefings">Briefings</a>
					</li>
					<li>
						<a href="chamados">Chamados</a>
					</li>
				</ul>				
			</div>
			
		</div>
		
		<div class="div_70">
			<div class="painel_cliente_tabs">
				<div id="arquivos" class="painel_cliente_tab">
					<h3>Arquivos</h3>
					
					<select id="select_arquivos" class="select_cinza_padrao_1">
						<option value="enviados">Enviados pelo cliente para agência</option>
						<option value="recebidos">Enviados pela agência ao cliente</option>					
					</select>
					
					<div id="arquivos_enviados_recebidos" class="tabela_2">
						<table>
							<thead>
								<th style="width:4%;"></th>
								<th style="width:40%;">Nome</th>
								<th style="width:15%;">Tamanho</th>
								<th style="width:18%;">Tipo</th>
								<th style="width:20%;">Criação</th>
								<th style="width:5%;">&nbsp;</th>
							</thead>
							<tbody>
							<!-- Arquivos enviados da Agência para o cliente -->
							<?php foreach($cliente['Recebidos'] as $item) { ?>
								<tr class="enviados item file_upload_<?php echo $item['id'] ?>" id="<?php echo $item['id'] ?>">
									<td><?php echo $this->Html->image('icon_arquivo_min.png', array('alt'=>'ACOM')) ?></td>
									<?php $this->Geral->titulo_tooltip($item['arquivo_name']) ?>
									<td><?php echo $item['arquivo_size']; ?></td>
									<td><?php echo $item['arquivo_type'] ?></td>
									<td><?php echo $this->Geral->formatar_data_envio($item['created'])?></td>
									<td class="btn_baixar">
										<?php echo $this->Html->link('', array('controller'=>'FileUploads','action'=>'download_arquivo', $item['id'])) ?>
									</td>
								</tr>
							<?php }	?>
							<!-- Arquivos enviados do cliente para a agencia -->
							<?php foreach($cliente['Enviados'] as $item) { ?>
								<tr class="recebidos item" id="<?php echo $item['id'] ?>">
									<td><?php echo $this->Html->image('icon_arquivo_min.png', array('alt'=>'ACOM')) ?></td>
									<?php $this->Geral->titulo_tooltip($item['arquivo_name']) ?>
									<td><?php echo $item['arquivo_size']; ?></td>
									<td><?php echo $item['arquivo_type'] ?></td>
									<td><?php echo $this->Geral->formatar_data_envio($item['created'])?></td>
									<td class="btn_baixar">
										<?php echo $this->Html->link('', array('controller'=>'FileUploads','action'=>'download_arquivo', $item['id'])) ?>
									</td>
								</tr>
							<?php }	?>
							
							</tbody>
						</table>
					</div>
					<div id="detalhe_arquivo">
						
					</div>
					<!--<div class="detalhe_arquivo">
						<h4>Detalhes do item selecionado</h4>
						<div class="img_tamanho">
							<?php echo $this->Html->image('icon_arquivo_grande.png', array('alt'=>'ACOM')) ?>
							<p>390kb</p>
						</div>
						<div class="descricao">
							<h3>Nome do arquivo</h3>
							<p>Descrição do arquivo criada pelo cliente ao enviar. Aqui pode haver muito ou pouco texto,Descrição do arquivo criada pelo cliente ao enviar. Aqui pode haver muito ou pouco texto.Descrição do arquivo criada pelo cliente ao enviar. Aqui pode haver muito ou pouco texto.</p>
							<div class="detalhes">
								<p>Enviado em 01 de </p>
								<p>Criado por X</p>
							</div>
						</div>
						<div class="botoes">
							<?php echo $this->Html->link('Baixar', array('controller'=>'FileUploads','action'=>'download_arquivo', $item['id']),array('class'=>'botao_cinza_padrao_1')) ?>
							<?php echo $this->Html->link('Excluir', array('controller'=>'FileUploads','action'=>'excluir_arquivo_enviado', $item['id']) ,array('class'=>'botao_cinza_padrao_1')) ?>						
						</div>
					</div>-->
				</div>
				
				<div id="briefings" class="painel_cliente_tab">
					briefings
				</div>
				
				<div id="chamados" class="painel_cliente_tab">
					Chamados
				</div>
				
			</div>
		</div>
	</div>
</div>