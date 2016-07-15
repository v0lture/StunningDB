function loadEditor(db, tbl, key, keyvalue){
  $("#editorModal").openModal();

  if(db != undefined && tbl != undefined && key != undefined && keyvalue != undefined) {
    var editor_xhr = new XMLHttpRequest();
    $("#error").hide();
    editor_xhr.onreadystatechange = function(){
      if(editor_xhr.readyState == 4) {
        $("#editor-loading").hide();
        if(editor_xhr.status != 200) {
          ohno(inline_xhr.responseText, "JS 'loadEditor()' -> PHP 'PAGE_RSC/modal.php'");
        } else {
          $("#error").hide();
          $("#editor-xhr").html(editor_xhr.responseText);
          tableInit();
        }
      }
    }
    editor_xhr.open("GET", "assets/page_rsc/modal.php?do=edit&db="+db+"&tbl="+tbl+"&key="+key+"&keyvalue="+keyvalue, true);
    editor_xhr.send();
  } else {
    $("#editorModal").closeModal();
    ohno('Missing variables that are required to complete function.', "JS 'loadEditor()'");
  }
}

function loadInsert(db, tbl){

  $("#newModal").openModal();

  if(db != undefined && tbl != undefined) {
    var modal_xhr = new XMLHttpRequest();
    $("#error").hide();
    modal_xhr.onreadystatechange = function(){
      if(modal_xhr.readyState == 4) {

        if(modal_xhr.status != 200) {
          $("#newModal").closeModal();
          ohno(inline_xhr.responseText, "JS 'loadInsert()' -> PHP 'PAGE_RSC/modal.php'");
        } else {

          $("#new-xhr").html(modal_xhr.responseText);
          tableInit();

        }

      }
    }
    modal_xhr.open("GET", "assets/page_rsc/modal.php?do=insert&db="+db+"&tbl="+tbl, true);
    modal_xhr.send();
  } else {

    $("#newModal").closeModal();
    ohno('An active database and table are needed to insert a new row.', 'JS \'loadInsert()\'');

  }
}

function inlineChange(db, tbl, key, col, valid, keyvalue, custom = false) {

  $("#error").show();
  $("#error > h4").text("Changes are synchorizing...");
  $("#error > p").html("The changes you made are currently being submitted to the database.<br />"+key+", "+col+", "+valid);
  tableInit();

  if(key == "ERROR_KEY_IS_NOT_SET"){
    $("#error").show();
    $("#error > h4").text("Local changes could not be saved.");
    $("#error > p").html("A primary key is missing from the table thus changes could not be saved.<br /><small>Error occurred locally and no database contact occurred.</small>");

  } else if(key == "" || col == "" || valid == "") {
    $("#error").show();
    $("#error > h4").text("Function error");
    $("#error > p").html("Variables supplied with the function are blank which makes the required actions by the function impossible.<br /><small>Error occurred locally and no database contact occurred.</small>");

  } else {

    var inline_xhr = new XMLHttpRequest();
    $("#error").hide();
    inline_xhr.onreadystatechange = function(){
      if(inline_xhr.readyState == 4) {
        $("#db-loading").hide();
        if(inline_xhr.status != 200) {
          ohno(inline_xhr.responseText, "JS 'inlineChange()' -> PHP 'PAGE_RSC/inline.php'");
        } else {
          $("#error").show();
          $("#error > h4").text("Refresh to show recent changes.");
          $("#error > p").html("You have made changes from the inline edit prompt and those changes are currently not reflected.");
        }
      }
    }
    if(custom == false) {
      field = $("#"+valid).val();
    } else {
      field = custom;
    }
    inline_xhr.open("GET", "assets/page_rsc/inline.php?k="+key+"&kv="+keyvalue+"&t="+tbl+"&d="+db+"&v="+field+"&c="+col, true);
    inline_xhr.send();

  }
}

function newDB() {

  db = $("#createdbinline").val();

  var inline_xhr = new XMLHttpRequest();
  $("#error").hide();
  inline_xhr.onreadystatechange = function(){
    if(inline_xhr.readyState == 4) {

      if(inline_xhr.status != 200) {
        ohno(inline_xhr.responseText, "JS 'newDB()' -> PHP 'databases.php'");
      } else {
        $("#newdb").closeModal();
        Materialize.toast('Database "'+db+'" was created.', 5000, 'mdtst');
        fetchDatabases('true');
        tableInit();
      }
    }
  }

  inline_xhr.open("GET", "assets/page_rsc/databases.php?newdb="+db, true);
  inline_xhr.send();
}

function runQuery(usefield) {
  if(usefield == false) {
    $("#queryprompt").openModal();
    $("#queryrunning").hide();
    $("#queryresponse").hide();
    $("#queryaction").show();
    $("#queryfieldbox").show();
  } else {
    $("#queryaction").hide();
    $("#queryrunning").show();
    $("#queryfieldbox").hide();

    var queryxhr = new XMLHttpRequest();
    queryxhr.onreadystatechange = function(){
      if(queryxhr.readyState == 4) {
        $("#queryrunning").hide();
        $("#queryresponse").show();
        $("#queryresponsefailed").hide();
        $("#queryresponsesuccess").hide();
        $("#queryaction").show();
        $("#queryfieldbox").show();
        if(queryxhr.status != 200) {
          $("#queryresponsefailed").show();
          $("#queryresponsetext").html(queryxhr.responseText);
        } else {
          $("#queryresponsesuccess").show();
          $("#queryresponsetext").html(queryxhr.responseText);
        }
      }
    }

    queryxhr.open("POST", "assets/page_rsc/query.php", true);
    queryxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    queryxhr.send("query="+$("#queryfield").val());
  }
}
