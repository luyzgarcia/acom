$(document).ready(function() {
    $("form input[type='file']").change(function(evt, data) {
        if(typeof this.files[0] != "undefined" && this.files[0] != null) {
            file_name = this.files[0].name;
            $(this).attr('data-content', file_name);
        } 
    });    
});


$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/FileUploads/upload';
    var xhr = null;
    var jqXHR = $("form input[type='file']").fileupload({
            url: url,
            dataType: 'json',
            maxNumberOfFiles: 1,
            getNumberOfFiles: function () { return 1 },       
            add: function (e, data) {
                //alert('funcao add');
                //console.log($("form input[type='file']"));
                //data.submit();
                $("#FileUploadUploadForm input[type='submit']").click(function() {
                    $('#formulario_fileupload').addClass('enviando');
                    $('#formulario_fileupload .enviando_arquivo').addClass('girando');
                    $('.btn_enviar .cancel').show();
                    xhr = data.submit();
                    return false;
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#formulario_fileupload .enviando_arquivo').attr('data-content',progress + '%');
                
                console.log(progress + '%');
            },
            error: function (e, textStatus, errorThrown){ 
                if (errorThrown === 'abort') {
                    alert('File Upload has been canceled');
                }else {
                    var obj = $.parseJSON(e.responseText);
                    alert(obj['message']);
                }
              $('#formulario_fileupload .enviando_arquivo').removeClass('girando');
              $('#formulario_fileupload').removeClass('enviando'); 
              $('.btn_enviar .cancel').hide();
            },
            complete: function (e, data) {
                /*$('#formulario_fileupload .enviando_arquivo').removeClass('girando');
                var obj = $.parseJSON(e.responseText);
                $('#FileUploadArquivoId').val(obj['arquivo_id']);
                $('#FileUploadArquivoName').val(obj['arquivo_name']);*/
               $("form input[type='file']").attr('data-content', 'Arraste o arquivo ou clique para escolher');
               $('#FileUploadUploadForm input[type="hidden"]').val("");
               $('#FileUploadUploadForm').trigger("reset");
               $('#formulario_fileupload').removeClass('enviando');
               $('.btn_enviar .cancel').hide(); 
               var obj = $.parseJSON(e.responseText);
               $('#tabela_registros table').append(
                   "<tr class='item'>\
                       <td class=''>"+obj['arquivo_name']+"</td>\
                       <td>"+obj['arquivo_size']+"</td>\
                       <td>"+obj['arquivo_type']+"</td>\
                       <td>"+obj['arquivo_created']+"</td>\
                       <td class='btn_baixar'>\
                           <a href='/FileUploads/download_arquivo/"+obj['arquivo_id']+"'></a>\
                       </td>\
                   </tr>");               
            }
         });
         
         $('.btn_enviar .cancel').click(function (e){
            if(xhr) {
                xhr.abort();
            }
            return false; 
         });
    
         $("#FileUploadUploadForm").submit(function() {
            return false; 
         });
         $('#cancel_novo').click(function() {
              $('#FileUploadUploadForm input[type="hidden"]').val("");
              $('#formulario_fileupload').removeClass('enviando');
          });
         
         /*Quando for enviar o formulario*/
         // $("#FileUploadUploadForm").submit(function() {
              /*if($("#FileUploadArquivoId").val() == ''){
                  alert('Você não selecionou nenhum arquivo.');
                  return false;
              }
             $.ajax({
                type: 'POST',
                url:'/fileuploads/upload',
                data: $('#FileUploadUploadForm').serialize(),
                success: function (res) {
                    $('#FileUploadUploadForm input[type="hidden"]').val("");
                    $('#FileUploadUploadForm').trigger("reset");
                    $('#formulario_fileupload').removeClass('enviando'); 
                    console.log(res);
                    var obj = $.parseJSON(res);
                    $('#tabela_registros table').append(
                        "<tr class='item'>\
                            <td class=''>"+obj['arquivo_name']+"</td>\
                            <td>"+obj['arquivo_size']+"</td>\
                            <td>"+obj['arquivo_type']+"</td>\
                            <td>"+obj['arquivo_created']+"</td>\
                            <td class='btn_baixar'>\
                                <a href='/FileUploads/download_arquivo/"+obj['arquivo_id']+"'></a>\
                            </td>\
                        </tr>");
                }
            });*/
         //    return false; 
         // });
          
          
          
});


/*
$(document).ready(function() {
    $("#FileUploadUploadForm").submit(function() {
        formdata.append("descricao", $('#FileUploadDescricao').val());
        var url = 'fileuploads/upload_temp';
        alert('vai por ajax');
        $.ajax({
            type: 'POST',
            url:url,
            data: formdata,
            processData: false,
            contentType: false,
            success: function (res) {
               alert('successs');   
            }
        });
          return false;
   });
});



$(document).ready(function() {
    formdata = new FormData();
    $("form input[type='file']").change(function(evt, data) {
        //alert(window.FileReader);
        file = this.files[0];
        reader = new FileReader();
        reader.readAsDataURL(file);
        formdata.append("arquivo", file);
        console.log(formdata);
    });
});
*/