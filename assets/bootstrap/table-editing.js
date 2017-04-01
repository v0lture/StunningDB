// open init
function initWrap(){
  tableInit();
  Materialize.toast('Select the database you want to create a table under by clicking the edit button.', 10000);
  Materialize.toast('Afterwards, name your new table and begin adding rows.', 10000);
}

// var
var coli = 0;
var prefix = "<input type='hidden' id='";
var suffix = "'></input>";

function impromptuPrompt(title, formID, text) {
  // open modal and set title
  $("#impromptu").modal('open');
  $("#impromptu > .modal-content > h4").html(title);
  $("#impromptu > .modal-content > #blank-error").hide();
  // set callback
  $("#impromptuCallback").attr("onclick", "handleImpromptuCB('"+title+"', '"+formID+"', "+text+")");

  // debug
  console.log("[impromptuPrompt]: Prompting for '"+title+"'\r\nEditing field: #"+formID+"\r\nHas a text field to update? "+text);
}

// handle Impromptu callback
function handleImpromptuCB(title, formID, hasText) {
  var v = $("#impromptuData").val();

  if(v == "") {
    $("#impromptu > .modal-content > #blank-error").show();
  } else {
    $("#impromptu > .modal-content > #blank-error").hide();


    // set 
    $("#"+formID).val(v);
    if(hasText == true) {
      $("#txt-"+formID).text(v);
    }

    // debug
    console.log("[impromptuCallback]: Responding to a callback for '"+title+"' and updating #"+formID+" and text #txt-"+formID+" with value "+v);

    // clean up
    $("#impromptu").modal('close');
    $("#impromptuData").val("");

  }
}

// delete col
function dropCol(id) {
  if(confirm("Are you sure you want to delete this column?")) {
    // drop form
    $("#col-"+id).remove();
    $("#tbl-col-"+id).remove();
  }
}

// add new col
function newCol() {
  var params = "";
  var suf = "";
  // hide data
  $("#new_col_data").slideUp();
  // grab data
  var n = $("#new_col_name").val();
  var t = $("#new_col_type").val();
  var l = $("#new_col_length").val();
  var ai = $("#new_col_ai").is(":checked");
  var pri = $("#new_col_primary").is(":checked");
  var uni = $("#new_col_unique").is(":checked");
  var isnull = $("#new_col_null").is(":checked");

  console.log("#"+coli+"'s data: \r\nname: "+n+" \r\ntype: "+t+"("+l+") \r\nai: "+ai+" \r\npri: "+pri+" \r\nuni: "+uni);
  $("#new_col_data").slideDown();

  // add. param.
  if(ai == true) {
    params = params + "AUTO_INCREMENT ";
  }

  if(isnull == true) {
    params = params + "NULL ";
  } else {
    params = params + "NOT NULL ";
  }

  if(pri == true) {
    suf = suf + "PRIMARY KEY(`"+n+"`), ";
  }

  if(uni == true) {
    suf = suf + "UNIQUE KEY (`"+n+"`), ";
  }

  // validate fields
  if(n == "" || t == "") {
    $("#newcol > .modal-content > .blank_error").slideDown();
    error = true;
  } else {
    $("#newcol > .modal-content > .blank_error").slideUp();
    error = false;
  }

  if(error == false){
    // add data into form
    $("#tabledata").append("<div id='col-"+coli+"'>"+prefix+"col_"+coli+"_name' name='col["+coli+"][name]' value='"+n+suffix+prefix+"col_"+coli+"_type' name='col["+coli+"][type]' value='"+t+suffix+prefix+"col_"+coli+"_length' name='col["+coli+"][length]' value='"+l+suffix+prefix+"col_"+coli+"_params' name='col["+coli+"][params]' value='"+params.slice(0,-1)+suffix+prefix+"col_"+coli+"suffix' name='col["+coli+"][suffix]' value='"+suf.slice(0,-2)+suffix+"</div>");

    // add data into table
    $("tbody").append("<tr id='tbl-col-"+coli+"'><td id='txt-col_"+coli+"_name' onclick='impromptuPrompt(\"Change column name\", \"col_"+coli+"_name\", true)'>"+n+"</td><td id='txt-col_"+coli+"_type' onclick='impromptuPrompt(\"Change column type\", \"col_"+coli+"_type\", true)'>"+t+"</td><td id='txt-col_"+coli+"_length' onclick='impromptuPrompt(\"Change column length\", \"col_"+coli+"_length\", true)'>"+l+"</td><td id='txt-col_"+coli+"_params' onclick='impromptuPrompt(\"Change column additional parameters\", \"col_"+coli+"_params\", true)'>"+params.slice(0,-1)+"</td><td id='txt-col_"+coli+"_suffix' onclick='impromptuPrompt(\"Change column suffix parameters\", \"col_"+coli+"_suffix\", true)'>"+suf.slice(0,-2)+"</td><td><a href='#' onclick='dropCol("+coli+")' class='btn-flat v0lture-action waves-effect waves-light'><i class='material-icons'>delete</i></tr>");

    coli++;
    // clean up and close
    $("#new_col_name").val("");
    $("#new_col_type").val("");
    $("#new_col_length").val("");

    $("#newcol").modal('close');
  }

}

// Handle submitting with Ajax
$("#tabledata").submit(function(e) {            
    submitCols();
    e.preventDefault();
});


// submit with ajax
function submitCols() {
    $.ajax({
        url: $("#tabledata").attr('action'),
        type: $("#tabledata").attr('method'),
        dataType: 'json',
        data: $("#tabledata").serialize(),
        success: function(data) {
            var d = $("#selected_db").val();
            var t = $("#table_name").val();
            window.location.href = "index.php?db="+d+"&tbl="+t;
        },
        error: function(xhr, err) {
            if(err == "error"){
                var resp = JSON.parse(xhr.responseText);
                $("#error-wrapper").html("<p class='error'><i class='material-icons left'>code</i> "+resp.query+"</p><p class='error'><i class='material-icons left'>hourglass_empty</i> "+resp.error);

                // toss to analyzer
                analyzeError(resp.error, resp.query);
            }
            console.warn(xhr);   
        }
    });
}

// analyze errors
function analyzeError(error, query){

    error = error.toLowerCase();

    // unknown database
    if(error.includes("unknown database")){
        impromptuPrompt('The database you choose does not exist &mdash; try another.', 'selected_db', true)
    }

    // YOU NEED AT LEAST ONE COLUMN TO SUBMIT A TABLE
    if(error.includes("you need at least one column to submit a table")){
        $("#newcol").modal('open');
        Materialize.toast('One column is required to submit a table', 1500);
    }

}

// and prevent navigation away
window.onbeforeunload = function(){
  return 'Are you sure you want to navigate away from this page? You will lose table configuration data.';
};