$(document).ready(function () {
    
   $('#OrcamentoCreateForm').submit(function(e) {
       if (!$("#OrcamentoCreateForm input:checkbox:checked").length > 0) {
           alert('Selecione pelo menos um projeto para enviar o orçamento');
           return false;
       }
       
   });
   $('.check_projetos').click(function() {
       //Pega o id do projeto de briefing
       var id_projeto = $(this).val();       
       //Verifica se ele esta selecionando ou desmarcando
       if($(this).is(':checked')) {
           $.ajax({
                type: 'POST',
                dataType : 'json',
                url:'/BriefingProjetos/consultar',
                data: {id: id_projeto},
                success: function ( res ) {
                    console.log(res );
                    monta_formulario(res);
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.log('deu erro');   
                }
            });
       }else {
           //Se ele esta desmarcando ele remove os itens do formulario
           $('#objeto_item_'+id_projeto).remove();
       }
   })
});


function monta_formulario(objeto) {
    
    var chave = Date.now();
    
    var container = document.createElement('div');
    container.id = 'objeto_item_'+objeto['id'];
    container.className = 'orcamento_item';
    
    var titulo = document.createElement('h3');
    titulo.innerHTML = objeto['titulo'];
        
    var entrada_dados = document.createElement('div');
    container.className = 'entrada_dados';
    //Detalhe do Item
    var label_detalhe = document.createElement('label');
    label_detalhe.for = 'OrcamentoItemDetalhe'+chave;
    label_detalhe.innerHTML = 'Detalhe do projeto:';
    
    var detalhe = document.createElement('textarea');
    detalhe.id = 'OrcamentoItemDetalhe'+chave;
    detalhe.name = 'data[OrcamentoItem]['+chave+'][detalhe]';
    detalhe.required = 'required';
    //Prazo para desenvolvimento
    var label_prazo = document.createElement('label');
    label_prazo.for = 'OrcamentoItemPrazo'+chave;
    label_prazo.innerHTML = 'Detalhe do projeto:';
    
    var prazo = document.createElement('input');
    prazo.id = 'OrcamentoItemPrazoDesenvolvimento'+chave;
    prazo.setAttribute("type", "number");
    prazo.setAttribute("name", 'data[OrcamentoItem]['+chave+'][prazo_desenvolvimento]');
    prazo.setAttribute("min", objeto['prazo_minimo']);
    prazo.setAttribute("step", 1);
    prazo.setAttribute("value", objeto['prazo_minimo']);
    
    var prazo_minimo = document.createElement('span');
    prazo_minimo.innerHTML = 'Mínimo de '+objeto['prazo_minimo']+' dias';
    prazo_minimo.className = 'tempo_minimo';
    
    //Quantidade 
    var label_quantidade = document.createElement('label');
    label_quantidade.for = 'OrcamentoItemQuantidade'+chave;
    label_quantidade.innerHTML = 'Quantidade:';
    
    var quantidade = document.createElement('input');
    quantidade.id = 'OrcamentoItemQuantidade'+chave;
    quantidade.setAttribute("type", "number");
    quantidade.setAttribute("name", 'data[OrcamentoItem]['+chave+'][quantidade]');
    quantidade.setAttribute("min", 1);
    quantidade.setAttribute("step", 1);
    quantidade.setAttribute("value", 1);
    
    var projeto = document.createElement('input');
    projeto.id = 'OrcamentoItemBriefingProjeto'+chave;
    projeto.setAttribute("type", "hidden");
    projeto.setAttribute("name", 'data[OrcamentoItem]['+chave+'][briefing_projeto_id]');
    projeto.setAttribute("value", objeto['id']);
    
    
    entrada_dados.appendChild(label_detalhe);
    entrada_dados.appendChild(detalhe);
    
    entrada_dados.appendChild(label_prazo);
    entrada_dados.appendChild(prazo);
    entrada_dados.appendChild(prazo_minimo);
    
    entrada_dados.appendChild(label_quantidade);
    entrada_dados.appendChild(quantidade);
    
    entrada_dados.appendChild(projeto);
    
    container.appendChild(titulo);
    container.appendChild(entrada_dados);
    $('#orcamento_items_wrapper').append(container);
} 
