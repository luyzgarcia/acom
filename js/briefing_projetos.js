$(document).ready(function() {
    /*tinymce.init({
        selector: ".tinymce"
    });
    */
   $('#adicionar_pergunta').click(function() {
       add_pergunta();
       return false;
   })
   $('.excluir_pergunta').click(function(e) {
       excluir_pergunta(this);
       return false;
   })
                                
});


function add_pergunta() {
    //Gera uma chave unica, eu uso a data pois nunca sera repitida.
    var chave = Date.now();
    
    var container = document.createElement('div');
    container.className = 'entrada_dados';
    
    var excluir = document.createElement('a');
    excluir.href = '#';
    excluir.className = 'excluir_pergunta';
    excluir.innerHTML = 'X';
    $(excluir).click(function(e) {
       excluir_pergunta(this);
       return false;
    })
    
    var label = document.createElement('label');
    label.for = 'BriefingProjetoExemplo'+chave;
    label.innerHTML = 'Pergunta';
    
    var destroy = document.createElement('input');
    destroy.setAttribute("type", "hidden");
    destroy.setAttribute("name", 'data[ProjetoPergunta]['+chave+'][destroy]');
    destroy.setAttribute("class", "destroy");
    destroy.setAttribute("value", "0");
    destroy.value = '0';
    
    var input = document.createElement('textarea');
    input.id = 'BriefingProjetoExemplo'+chave;
    input.required = 'required';
    input.className = 'ckeditor'
    input.name = 'data[ProjetoPergunta]['+chave+'][titulo]';
    
    container.appendChild(excluir);
    container.appendChild(label);
    container.appendChild(destroy);
    container.appendChild(input);
    
    $('#perguntas_briefing_projeto').append(container);
    //$('textarea#BriefingProjetoExemplo'+chave).tinymce({   
    //});
     $('textarea#BriefingProjetoExemplo'+chave).ckeditor();
    /*
   console.log(CKEDITOR.instances);
    CKEDITOR.appendTo(input.id);
    console.log(CKEDITOR.instances)
    for (instance in CKEDITOR.instances)
        CKEDITOR.instances[instance].updateElement();
    //CKEDITOR.inline('BriefingProjetoExemplo'+chave);
    */
    
}

function excluir_pergunta(e) {
   var div = $(e).parent('.entrada_dados');
   div.find('.destroy').val('1');
   div.fadeOut('slow');    
}
