//Insertar Datos Ajax

function insertData(url,datos){
  $.ajax({
      url: url,
      cache: false,
      type: "POST",
      dataType:"text",
      data: datos,

      success: function(data){
        var obj = $.parseJSON(data);
        console.log(data);
        $('#alert').removeAttr('hidden');
        setTimeout(function() {
          $('#alert').hide();
        }, 1000);
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });
}


//Validate Registro Turno.

function regTurno(url,datos){
  $.ajax({
      url: url,
      cache: false,
      type: "POST",
      dataType:"text",
      data: datos,

      success: function(data){
        console.log(data);
        if (data == '0') {
          insert_reporte(data);
        }else{
          var obj = $.parseJSON(data);
          insert_reporte(obj[0].id_reporte);        
        }


      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });
}



