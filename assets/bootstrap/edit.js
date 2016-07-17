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

  tableInit();

  if(key == "ERROR_KEY_IS_NOT_SET"){

    ohno('Table has no primary key therefore you cannot edit the rows.', 'JS inlineChange()');

  } else if(key == "" || col == "" || valid == "") {

    ohno('Function is missing required variables. Check the function variables and try again.', 'JS -> inlineChange()');

  } else {

    var inline_xhr = new XMLHttpRequest();
    $("#error").hide();
    inline_xhr.onreadystatechange = function(){
      if(inline_xhr.readyState == 4) {
        $("#db-loading").hide();
        if(inline_xhr.status != 200) {
          ohno(inline_xhr.responseText, "JS 'inlineChange()' -> PHP 'PAGE_RSC/inline.php'");
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

function updateConfig(db, tbl, id, chck) {
  if($("#"+chck).prop('checked')) {
    Materialize.toast("Enabling...", 2500);
    inlineChange(db, tbl, "id", "val", "null", id, "true");
  } else {
    Materialize.toast('Disabling...', 2500);
    inlineChange(db, tbl, "id", "val", "null", id, "false");
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

function dropDB(database) {
  if(confirm('Are you sure you want to drop database '+database+'?')) {

    var queryxhr = new XMLHttpRequest();
    queryxhr.onreadystatechange = function(){
      if(queryxhr.readyState == 4) {

        if(queryxhr.status != 200) {
          ohno(queryxhr.responseText, 'JS dropDB("'+database+'") -> PHP page_rsc/query.php');
        } else {
          Materialize.toast('Database '+database+' was dropped.', 5000);
        }
      }
    }

    queryxhr.open("POST", "assets/page_rsc/query.php", true);
    queryxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    queryxhr.send("query=DROP DATABASE `"+database+"`");

  }
}
