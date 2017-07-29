$.fn.poshytip={defaults:null};
$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type: 'PUT'};



$(document).ready(function(){
  $(".set-guide-number").editable();

  $(".set-select-status").editable({
    source: [
      {value:"created", text: "Creado"},
      {value:"sent", text: "Enviado"},
      {value:"received", text: "Recibido"}
    ]
  });

});
