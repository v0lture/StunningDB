function loadEditor(db, tbl, key, keyvalue){
  $("#editorModal").modal('show');
  $('[data-toggle="popover"]').popover('hide');

  if(db != undefined && tbl != undefined && key != undefined && keyvalue != undefined) {
    var editor_xhr = new XMLHttpRequest();
    $("#error").hide();
    editor_xhr.onreadystatechange = function(){
      if(editor_xhr.readyState == 4) {
        $("#editor-loading").hide();
        if(editor_xhr.status != 200) {
          $("#error").show();
          $("#error > h4").text("Failed inserting new row");
          $("#error > p").html("A remote error occurred, check you have the <b>SELECT</b> privilage and the MySQL database is online and available.<br /><small>Error: </small>"+editor_xhr.responseText);
        } else {
          $("#error").hide();
          $("#editor-xhr").html(editor_xhr.responseText);
          $("#editor-loading").hide();
        }
      }
    }
    editor_xhr.open("GET", "assets/page_rsc/modal.php?do=edit&db="+db+"&tbl="+tbl+"&key="+key+"&keyvalue="+keyvalue, true);
    editor_xhr.send();
  } else {
    $("#editorModal").modal('hide');
    $("#error").show();
    $("#error > h4").text("Function was supplied incomplete variables");
    $("#error > p").html("The current function that tried to run was missing variables. <br /><small>function ran <b>loadInsert(db, tbl)</b> in <b>edit.js</b>.");
  }
}

function loadInsert(db, tbl){
  $("#newModal").modal('show');
  $('[data-toggle="popover"]').popover('hide');
  $("#new-loading").show();

  if(db != undefined && tbl != undefined) {
    var modal_xhr = new XMLHttpRequest();
    $("#error").hide();
    modal_xhr.onreadystatechange = function(){
      if(modal_xhr.readyState == 4) {
        $("#new-loading").hide();
        if(modal_xhr.status != 200) {
          $("#error").show();
          $("#error > h4").text("Failed inserting new row");
          $("#error > p").html("A remote error occurred, check you have the <b>INSERT</b> privilage and the MySQL database is online and available.<br /><small>Error: </small>"+modal_xhr.responseText);
        } else {
          $("#error").hide();
          $("#new-xhr").html(modal_xhr.responseText);
          $("#new-loading").hide();
        }
      }
    }
    modal_xhr.open("GET", "assets/page_rsc/modal.php?do=insert&db="+db+"&tbl="+tbl, true);
    modal_xhr.send();
  } else {
    $("#newModal").modal('hide');
    $("#error").show();
    $("#error > h4").text("Function was supplied incomplete variables");
    $("#error > p").html("The current function that tried to run was missing variables. <br /><small>function ran <b>loadInsert(db, tbl)</b> in <b>edit.js</b>.");
  }
}

function inlineChange(db, tbl, key, col, valid, keyvalue) {
  $("#inlineFormBtn").button('loading');
  $("#error").show();
  $("#error > h4").text("Changes are synchorizing...");
  $("#error > p").html("The changes you made are currently being submitted to the database.<br />"+key+", "+col+", "+valid);

  if(key == "ERROR_KEY_IS_NOT_SET"){
    $("#error").show();
    $("#error > h4").text("Local changes could not be saved.");
    $("#error > p").html("A primary key is missing from the table thus changes could not be saved.<br /><small>Error occurred locally and no database contact occurred.</small>");
    $("#inlineFormBtn").button('reset');
  } else if(key == "" || col == "" || valid == "") {
    $("#error").show();
    $("#error > h4").text("Function error");
    $("#error > p").html("Variables supplied with the function are blank which makes the required actions by the function impossible.<br /><small>Error occurred locally and no database contact occurred.</small>");
    $("#inlineFormBtn").button('reset');
  } else {

    var inline_xhr = new XMLHttpRequest();
    $("#error").hide();
    inline_xhr.onreadystatechange = function(){
      if(inline_xhr.readyState == 4) {
        $("#db-loading").hide();
        if(inline_xhr.status != 200) {
          $("#error").show();
          $("#error > h4").text("Failed synchorizing inline changes");
          $("#error > p").html("A remote error occurred, check you have the <b>UPDATE</b> privilage and the MySQL database is online and available.<br /><small>Error: </small>"+inline_xhr.responseText);
          $("#db-loading-btn").button('reset');
        } else {
          $("#error").show();
          $("#error > h4").text("Refresh to show recent changes.");
          $("#error > p").html("You have made changes from the inline edit prompt and those changes are currently not reflected.");
          $("#db-loading-btn").button('reset');
        }
      }
    }
    field = $("#"+valid).val();
    inline_xhr.open("GET", "assets/page_rsc/inline.php?k="+key+"&kv="+keyvalue+"&t="+tbl+"&d="+db+"&v="+field+"&c="+col, true);
    inline_xhr.send();

  }
}
