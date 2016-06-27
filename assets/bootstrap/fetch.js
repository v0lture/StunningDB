function tableInit() {
  // Simply initalizates popovers and sortable when data is not loaded by an XHR request.
  Sortable.init();
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();

  $('[data-toggle="popover"]').popover('hide');
}

$("[data-toggle='popover']").on('show.bs.popover', function () {
  $('[data-toggle="tooltip"]').tooltip();
  console.info("Popover shown.");
});

function fetchDatabases(hideerr = false) {
    var db_xhr = new XMLHttpRequest();
    if(hideerr == true) {
      $("#error").hide();
    }
    $("#db-loading").show();
    $("#db-loading-btn").button('loading');
    db_xhr.onreadystatechange = function(){
        if(db_xhr.readyState == 4) {
            $("#db-loading").hide();
            if(db_xhr.status != 200) {
                $("#error").show();
                $("#error > h4").text("Failed updating database(s)...");
                $("#error > p").html("Database fetch resulted an error.<br />Try again later.");
                $("#db-loading-btn").button('reset');
            } else {
                $("#db-xhr").html(db_xhr.responseText);
                $("#db-loading-btn").button('reset');
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
                $("#error").show();
                $("#error > h4").text("Failed fetching tables");
                $("#error > p").html("Could not fetch tables from database '"+dbname+"' a "+db_xhr.status+" error occurred.<br />Try again later or check your user permissions.");
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
    $('[data-toggle="popver"]').popover('hide');
    $('.popover.fade.right').css( "display", "none", "important");

    console.info("[v0ltureDB] Trying to load table "+tbl+" at database "+db+"...");

    // Hide any errors if applicable, show navigation bar, and toggle refresh button state
    $("#error").hide();
    $("#main-loading").show();
    $("#main-loading-btn").button('loading');

    db_xhr.onreadystatechange = function(){
        if(db_xhr.readyState == 4) {
            $("#main-loading").hide();
            if(db_xhr.status != 200) {
                $("#error").show();
                $("#error > h4").text("Failed fetching table data...");
                $("#error > p").html("Double check you have the SELECT privilage to view the data on the table.<br />Try again later.");
                $("#main-loading-btn").button('reset');
                $("#main-loading-btn").attr("href", "javascript:fetchTableData('"+db+"', '"+tbl+"', '"+bypass+"');");
                console.error("[v0ltureDB] Failed fetching table!");
            } else {
                $("#main-xhr").html(db_xhr.responseText);
                $("#main-loading-btn").button('reset');
                $("#main-loading-btn").attr("href", "javascript:fetchTableData('"+db+"', '"+tbl+"', '"+bypass+"');");
                console.info("[v0ltureDB] Table fetched.");
                Sortable.init();
                tableInit();
            }
        }
    }
    db_xhr.open("GET", "assets/page_rsc/table_data.php?db="+db+"&tbl="+tbl, true);
    db_xhr.send();
}
