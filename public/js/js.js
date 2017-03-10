$("#marca").change(function () {
   var token=$('#token').val(); 
      $.ajax({
               type: 'POST',
               url: "/telefono/dep_modelo",//aqui tu ruta
               dataType: 'json',//
               data: "elegido="+$(this).val(),
               headers:{'X-CSRF-TOKEN': token},
           })
           .done(function(data) {
                html = '<select class="form-control select2" id="modelo" name="lng_idmodelo">';
               for(datos in data)
                   {
                       html+='<option value="'+data[datos].id+'" name="lng_idmodelo">'+data[datos].str_modelo+'</option>';
                   }
                   html+='</select>';
                   $("#modelo").html("").append(html);
           })
           .fail(function(data) {
           }); 
   }); 

