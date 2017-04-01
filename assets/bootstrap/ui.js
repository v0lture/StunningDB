function ohno(response, src) {
  $("#errormodal").modal('open');

  $("#errorresponse").html(response);
  $("#errorsrc").html(src);

  console.error("[oh no] Something bad happened at "+src+". Response received was "+response);
}

function oh(response, src) {
  $(".errorbar").slideDown();
  $(".errorbar > p").html("<span><b>"+src+":</b></span><br />"+response);

  console.warn("[oh] Warning: "+src+" responded "+response);
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
  $("#txtprompt").modal('open');
  $("#txttitle").text(title);
  $("#txtfield").val($(field).val());
  $("#txtbtn").attr("onclick", "impromptuCallback('"+field+"')");
}

function impromptuCallback(field) {
  $("#txtprompt").modal('close');
  Materialize.toast('Value set.', 5000);
  $(field).val($("#txtfield").val());
}

function view(element) {
  if($(element).val() == "users") {
    // user view
    $("#db-refresh").hide();
    $("#users-new").show();
    fetchUsers();
  } else {
    // databases view
    $("#db-refresh").show();
    $("#users-new").hide();
    fetchDatabases();
  }
}

// handle popstate
window.addEventListener("popstate", function(e){
  var s = e.state;
  // If the browser goes back one, handle that and try to load it
  if(s != null && s.database != null && s.table != null) {
    fetchTableData(s.database, s.table);
  }

})
