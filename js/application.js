$(document).ready(function() {
    /************************************/
    /*Efeito clique botao superior direito painel*/
    /************************************/
    $('#menu_header').click(function(e) {
        $(this).children('div').toggle();
    });
    
    /*Para minimizar as janelas*/
   $('.janela .btn_minimizar').click(function(e) {
        //alert('hei');
        //$(this).closest('.janela').find('table').css('opacity','0');
        $(this).closest('.janela').find('.tabela').slideToggle(800);
        $(this).closest('.janela').find('.ocultar').slideToggle(800);
        
        //ARRUMAR - NÃO FUNCIONA
        if($(this).hasClass('janela_minimizado')) {
            $(this).removeClass('janela_minimizada');
        }else {
            $(this).addClass('janela_minimizada');
        }
    });
   
   
   /**Efeito nas janelas, para qndo o usuario ativa uma janela */
    $('.janela').click(function() {
       $('.janela').removeClass('ativa');
       $(this).addClass('ativa');
    });
    
    
    /*Pra ocultar as mensagens de erro*/
   $('#bt_message_ok').click(function(e) {
       e.preventDefault();
       $(this).parent('div').fadeOut(500);
       $(this).prev().remove();
       return false;
   })
   $('#bt_erro_atualizar').click(function(e) {
       e.preventDefault();
       location.reload();
   })
   
   
   /*Define todos os inputs do tipo tel como mask*/
   $("input[type='tel']").mask("(999) 9999-9999?9");
   
   
   /*Entrada de imagem, ele muda a imagem preview*/
   $('.show_preview').change(function(e) {
       input = this;
       if (input.files && input.files[0]) {
           console.log(input.files[0]);
           f = input.files[0];

           var ext = f.name.split('.').pop().toLowerCase();
           if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
               alert('Somente imagens são permitidas!');
               e.reset();
               e.unwrap();
               return false;
           }
           
           var reader = new FileReader();
           reader.onload = function (e) {
               $(input).parent().find('.preview_image').attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
        }
   });
   
   /*Efeito para diminuir o tamanho do avatar no rollover do mouse*/
    var scrollorama = $.scrollorama({
        blocks:'body'
    });
    /*
     #painel_esquerdo .info_user .img_avatar 
        -webkit-transform: scale(0.75);
        margin-bottom: -10px;
        margin-top: -10px;
        .animate('#title',{ duration: 300, property:'zoom', end: 8 })
     * */
    scrollorama
        .animate('.img_avatar',{duration:400, delay: 0, property:'zoom', end: 0.6 })
        .animate('.img_avatar',{duration:400, delay: 0, property:'margin-bottom', end: -20})
        .animate('.img_avatar',{duration:400, delay: 0, property:'margin-top', end: -40});
        
   
  /**/
   
});


$(document).ready(function() {
   $('.js-ajax').click(function() {
      
      link = $(this); 
      
      url = $(link).attr('href');
      console.log(url);
      
      $.ajax({
          type: "ajax",
          url: url,
          success: function(data) {
              console.log(data.content)
              $('#painel_conteudo').html(data.content);
              window.history.pushState({"pageTitle":''},"", url)
          }, 
          error: function(response) {
              alert('error');
          }
      })
      return false;
   });
   
});



