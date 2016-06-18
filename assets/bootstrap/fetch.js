function fetchDatabases() {
    var db_xhr = new XMLHttpRequest();
    $("#error").hide();
    $("#sidebar-loading").show();
    $("#sidebar-loading-btn").button('loading');
    db_xhr.onreadystatechange = function(){
        if(db_xhr.readyState == 4) {
            $("#sidebar-loading").hide();
            if(db_xhr.status != 200) {
                $("#error").show();
                $("#error > h4").text("Failed updating database(s)...");
                $("#error > p").html("Database fetch resulted in an HTTP error "+db_xhr.status+".<br />Try again.");
                $("#sidebar-loading-btn").button('reset');
            } else {
                $("#sidebar-xhr").html(db_xhr.responseText);
                $("#sidebar-loading-btn").button('reset');
            }
        }
    }
    db_xhr.open("GET", "assets/page_rsc/databases.php", true);
    db_xhr.send();
}

function loadDb(dbname) {
    var db_xhr = new XMLHttpRequest();
    $("#error").hide();
    $("#main-loading").show();
    $("#main-loading-btn").button('loading');
    db_xhr.onreadystatechange = function(){
        if(db_xhr.readyState == 4) {
            $("#main-loading").hide();
            if(db_xhr.status != 200) {
                $("#error").show();
                $("#error > h4").text("Failed fetching tables");
                $("#error > p").html("Could not fetch tables from database '"+dbname+"' a "+db_xhr.status+" error occurred.<br />Try again later or check your user permissions.");
                $("#main-loading-btn").button('reset');
            } else {
                $("#main-xhr").html(db_xhr.responseText);
                $("#main-loading-btn").button('reset');
                $("#main-loading-btn").attr("href", "javascript:loadDb('"+dbname+"')");
                Sortable.init();
            }
        }
    }
    db_xhr.open("GET", "assets/page_rsc/tables.php?db="+dbname, true);
    db_xhr.send();
}