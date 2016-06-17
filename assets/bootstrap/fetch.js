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