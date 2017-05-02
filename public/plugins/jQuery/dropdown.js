$("#departamento").change(function(event){
  $.get("municipio/"+event.target.value+"",function(response,departamento){
    for(i=0; i<response.length; i++){
      $("#municipio").append("<option value='"+response[i].id+"'> "+response[i].nombre+"</option>");
    }
  });
});
