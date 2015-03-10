$(document).ready(function() {
      $.ajax({
        //url: "http://www.proiz.com.br/noticias.json",
        url: 'http://proiz.com.br/noticias.json',
        success: function (data) {
            console.log(data);
            $('.carregando_noticias').fadeOut();
            for(var k in data) {
               //console.log(k, data[k]);
               var conteudo ='';
               conteudo = '\
                    <div class="publicacao_item">\
                            <h6>Publicado em '+data[k]['publicado']+'</h6>\
                                <div class="detalhe">\
                                    <img src="'+data[k]['imagem_url']+'" />\
                                <div class="descricao">\
                                    <p>'+data[k]['titulo']+'</p>\
                                    <a href="#">Leia mais</a>\
                                </div>      \
                            </div>\
                        </div>\
                ';
                //$(conteudo).hide();
                
                
                $(conteudo).hide().appendTo(".publicacoes_proiz").delay(500*k).fadeIn(1000);
               //$('.publicacoes_proiz').append(conteudo).fadeIn('slow');
               
               /*$('#tabela_registros table').append(
                        "<tr class='item'>\
                            <td class=''>"+obj['arquivo_name']+"</td>\
                            <td>"+obj['arquivo_size']+"</td>\
                            <td>"+obj['arquivo_type']+"</td>\
                            <td>"+obj['arquivo_created']+"</td>\
                            <td class='btn_baixar'>\
                                <a href='/FileUploads/download_arquivo/"+obj['arquivo_id']+"'></a>\
                            </td>\
                        </tr>");*/
            }
            //var obj = JSON.parse(data);
            //console.log(obj);
        }
      });
});