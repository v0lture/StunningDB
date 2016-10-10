function tableInit() {
  // Simply initalizates popovers and sortable when data is not loaded by an XHR request.
  Sortable.init();
  $('.collapsible').collapsible({
    accordion : false
  });
  $('.tooltipped').tooltip({delay: 50});
  Materialize.updateTextFields();
  $('select').material_select();
  $('ul.tabs').tabs();
}

function fetchDatabases(hideerr = false) {
    var db_xhr = new XMLHttpRequest();

    $("#db-loading").show();
    db_xhr.onreadystatechange = function(){
      if(db_xhr.readyState == 4) {
        $("#db-loading").hide();
        if(db_xhr.status != 200) {
          ohno(db_xhr.responseText, "JS 'fetchDatabases()' -> PHP 'PAGE_RSC/databases.php'");
        } else {
          $("#db-xhr").html(db_xhr.responseText);
          tableInit();
        }
      }
    }
    db_xhr.open("GET", "assets/page_rsc/databases.php", true);
    db_xhr.send();
}

function loadDb(dbname, compact) {
    var db_xhr = new XMLHttpRequest();
    $("#error").hide();
    $("#tables-loading").show();
    $("#tables-loading-btn").button('loading');
    $("#nav_db").text("Loading...");
    $("#nav_db_drop").attr("href", "#!");
    $("#nav_db_edit").attr("href", "#!");
    db_xhr.onreadystatechange = function(){
        if(db_xhr.readyState == 4) {
            $("#tables-loading").hide();
            if(db_xhr.status != 200) {

              ohno(db_xhr.responseText, "JS 'loadDb()' -> PHP 'PAGE_RSC/tables.php'");

              $("#tables-loading-btn").button('reset');
              $("#nav_db").text("Failed to load");
            } else {
              $("#tables-xhr").html(db_xhr.responseText);
              $("#tables-loading-btn").button('reset');
              $("#tables-loading-btn").attr("href", "javascript:loadDb('"+dbname+"', '"+compact+"')");
              $("#nav_db").text(dbname);
              $("#nav_db_drop").attr("href", "confirm.php?db="+dbname+"&action=drop");
              $("#nav_db_edit").attr("href", "confirm.php?db="+dbname+"&action=edit");
              Sortable.init();
            }
        }
    }
    db_xhr.open("GET", "assets/page_rsc/tables.php?db="+dbname+"&view="+compact, true);
    db_xhr.send();
}

function fetchTableData(db, tbl, bypass = "false") {
    var db_xhr = new XMLHttpRequest();

    // Destory old popovers and tooltips incase any were left open at load
    console.info("[v0ltureDB] Trying to load table "+tbl+" at database "+db+"...");

    // Hide any errors if applicable, show navigation bar, and toggle refresh button state
    $("#error").hide();
    $("#main-loading").show();
    $("#tableName").text("...");

    $("#bc-db").text(db);
    $("#bc-tbl").text("loading "+tbl);

    $("#bc-db").show();
    $("#bc-tbl").show();

    db_xhr.onreadystatechange = function(){
      if(db_xhr.readyState == 4) {
        $("#main-loading").hide();
        if(db_xhr.status != 200) {
          ohno(db_xhr.responseText, "JS 'fetchTableData()' -> PHP 'PAGE_RSC/table_data.php'");

          $("#main-loading-btn").attr("href", "javascript:fetchTableData('"+db+"', '"+tbl+"', '"+bypass+"');");
          console.error("[v0ltureDB] Failed fetching table!");
          $("#tableName").text("Unable to load table");
          $("#bc-tbl").text("failed loading "+tbl);
        } else {
          $("#bc-tbl").text(tbl);
          $("#main-xhr").html(db_xhr.responseText);

          $("#main-loading-btn").attr("href", "javascript:fetchTableData('"+db+"', '"+tbl+"', '"+bypass+"');");
          $("#newrow").attr("onclick", "loadInsert('"+db+"', '"+tbl+"')");
          console.info("[v0ltureDB] Table fetched.");
          Sortable.init();
          tableInit();
          $("#tableName").text(tbl);
        }
      }
    }
    db_xhr.open("GET", "assets/page_rsc/table_data.php?db="+db+"&tbl="+tbl, true);
    db_xhr.send();
}
