// UI effects
function dbOnly(state) {
  if(state == "hide") {

    $("#dataview").show();
    $("#dbview").attr("class", "col s3 grey darken-3 scrollbar");
    $("#dbview-visibility").show();

  } else if(state == "show") {

    $("#dataview").hide();
    $("#dbview").attr("class", "col s4 offset-s4 grey darken-3 scrollbar");
    $("#dbview-visibility").hide();
    Materialize.toast('Table view has been collapsed. <a href="javascript:dbOnly(\'hide\')" class="v-text-green">UNDO</a>', 5000, 'mdtst')

  }
}

function ohno(response, src) {
  $("#errormodal").openModal();

  $("#errorresponse").html(response);
  $("#errorsrc").html(src);

  console.error("[oh no] Something bad happened at "+src+". Response received was "+response);
}

function oh(response, src) {
  $("#warnmodal").openModal();

  $("#warnresponse").html(response);
  $("#warnsrc").html(src);

  console.warn("[oh] Hey there hot shot, watch out! "+src+" responded "+response);
}
