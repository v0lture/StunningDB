<?php

  $descriptions = Array(
    'limit_col_count' => "Limits the column count to 10 to prevent visual issues in the legacy UI.",
    'show_system_tables' => "Toggles visibility of databases relating to the ones used by MySQL like performance_schema, information_schema, and mysql.",
    'settings_gui' => "Toggles the settings gui instead of the table editor when opening the settings database and table.",
    'sudo_mode' => "This flag is no longer used in this version of v0ltureDB.<br /><i>Any changes set to this flag will not effect anything.</i>",
    'view_switcher' => "Dropdown view switcher between databases and users. <b>Experimental</b>",
    'login_update_check' => "Allows checking for updates after a successful login.",
    'updates_allowed' => "Allows for updates to be checked and installed.",
    'updates_config' => "Allows for the configuration to be updated whenever an update has been installed.",
    'global_update_notice' => "Allows whether or not the notice of a new update is shown at the top of pages.",
  );

  $keys = Array(
    '1' => "limit_col_count",
    '2' => "show_system_tables",
    '3' => "settings_gui",
    '4' => "view_switcher",
    '5' => "login_update_check",
    '6' => "updates_allowed",
    '7' => "updates_config",
    '8' => "global_update_notice",
  );

  $defaults = Array(
    'limit_col_count' => "false",
    'show_system_tables' => "true",
    'settings_gui' => "true",
    'view_switcher' => "false",
    'login_update_check' => "true",
    'updates_allowed' => "true",
    'updates_config' => "true",
    'global_update_notice' => "true",
  );

?>
