<?php

  $descriptions = Array(
    'limit_col_count' => "Limits the column count to 10 to prevent visual issues in the legacy UI.",
    'show_system_tables' => "Toggles visibility of databases relating to the ones used by MySQL like performance_schema, information_schema, and mysql.",
    'sudo_mode' => "This flag is no longer used in this version of v0ltureDB.<br /><i>Any changes set to this flag will not effect anything.</i>",
    'view_switcher' => "Dropdown view switcher between databases and users. <b>Experimental</b>",
    'login_update_check' => "Allows checking for updates after a successful login.",
    'updates_allowed' => "Allows for updates to be checked and installed.",
    'updates_config' => "Allows for the configuration to be updated whenever an update has been installed.",
    'global_update_notice' => "Allows whether or not the notice of a new update is shown at the top of pages.",
    'enable_idle_timeout' => "Enable timeout after 10 minutes of inactivity in the application."
  );

  $keys = Array(
    '1' => "limit_col_count",
    '2' => "show_system_tables",
    '3' => "view_switcher",
    '4' => "login_update_check",
    '5' => "updates_allowed",
    '6' => "updates_config",
    '7' => "global_update_notice",
    '8' => "enable_idle_timeout",
  );

  $defaults = Array(
    'limit_col_count' => "false",
    'show_system_tables' => "true",
    'view_switcher' => "false",
    'login_update_check' => "true",
    'updates_allowed' => "true",
    'updates_config' => "true",
    'global_update_notice' => "true",
    'enable_idle_timeout' => "false",
  );

?>
