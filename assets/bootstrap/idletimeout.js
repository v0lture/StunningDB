/*
*
* enabled on flag 'enable_idle_timeout'
* js script is only loaded when the flag is enabled
*
*/

// 600,000ms = 10 minutes
var timeoutLength = 600000;
var pretimeoutLength = 300000;

var timeoutTimer = setTimeout(runtimeout, timeoutLength);
var pretimeoutTimer = setTimeout(preruntimeout, pretimeoutLength);

$("body").keypress(function() {
  // reset timer whenever a key is pressed
  clearTimeout(timeoutTimer);
  timeoutTimer = setTimeout(runtimeout, timeoutLength);

  clearTimeout(pretimeoutTimer);
  pretimeoutTimer = setTimeout(preruntimeout, pretimeoutLength);

  $(".errorbar").slideUp();
});

function preruntimeout() {
  oh("You will be kicked out of your session in 5 minutes. Press any key to cancel and click this message to close.", "Timeout warning");
}

function runtimeout() {
  window.location = "auth.php?confirm=reauth";
}
