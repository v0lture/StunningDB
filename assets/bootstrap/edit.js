function loadEditor(){
  $("#editorModal").modal('show');
  $('[data-toggle="popover"]').popover('hide');
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
