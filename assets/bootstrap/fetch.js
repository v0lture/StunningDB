function fetchDatabases() {
    var db_xhr = new XMLHttpRequest();
    $("#error").hide();
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
                $("#tables-loading-btn").attr("href", "javascript:loadDb('"+dbname+"')");
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
