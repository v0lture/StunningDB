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

function updateNwTbl(db) {
  $("#newtable").attr("onclick", "newTable('"+db+"');");
  $("#bc-db").text(db);
  $("#bc-db").show();
}

function newtable_openprompt(field, select) {
  if($(select).val() == "DEFINED") {
    openPrompt("#"+field, 'Set default value');
  }
}

function openPrompt(field, title) {
  $("#txtbtn").attr("onclick", "impromptuCallback('"+field+"')");
  $("#txtprompt").openModal();
  $("#txttitle").text(title);
  $("#txtfield").val($(field).val());
  $("#txtbtn").attr("onclick", "impromptuCallback('"+field+"')");
}

function impromptuCallback(field) {
  $("#txtprompt").closeModal();
  Materialize.toast('Value set.', 5000);
  $(field).val($("#txtfield").val());
}

function view(element) {
  if($(element).val() == "users") {
    $("#db-refresh").hide();
    $("#users-new").show();
  } else {
    $("#db-refresh").show();
    $("#users-new").hide();
    fetchDatabases();
  }
}
