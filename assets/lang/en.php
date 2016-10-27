<?php

  $version = "0.0.1.12";

  $systemdbs = Array(
    "1" => "mysql",
    "2" => "performance_schema",
    "3" => "information_schema",
    "4" => "sys",
  );

  $lang = Array(

    // modal
    'modal_error_title' => "Failed to complete operation.",
    'modal_error_dismiss' => "Okay",
    'modal_error_action' => "Check that you have the required previliges and the server is online. Also check that all required fields are filled.",
    'modal_error_response' => "Server responed with: ",
    'modal_error_src' => "Source of error: ",

    'modal_warn_action' => "This warning should not effect the operation performed unless an error occurs after this event.",
    'modal_warn_response' => "Server warning: ",
    'modal_warn_src' => "Source of warning: ",
    'modal_warn_title' => "Warning.",

    'modal_query_title' => "Run Query",
    'modal_query_info' => "Runs a query on the currently authenticated user.",
    'modal_query_running' => "Running query...",
    'modal_query_failed' => "Query failed",
    'modal_query_success' => "Query OK",
    'modal_query_field' => "Query",
    'modal_query_btn' => "Run Query",

    // Navbar
    'navbar_current_db' => "Current DB",
    'navbar_drop_db' => "Drop Database",
    'navbar_mng_tbl' => "Manage Tables",
    'navbar_switch_user' => "Switch User",
    'navbar_logout' => "Log Out",
    'navbar_settings' => "Settings",
    'navbar_title_user' => "User",
    'navbar_title_app' => "App",
    'navbar_app' => "v0ltureDB",

    // Buttons
    'btn_refresh' => "Refresh",
    'btn_rst_popovers' => "Reset Popovers",
    'btn_loading' => "...",
    'btn_temp_show_all' => "Temporarily show all",
    'btn_disable' => "Disable",
    'btn_enable' => "Enable",
    'btn_close' => "Close",
    'btn_rst' => "Reset",

    // auth
    'auth_blank' => "Fields cannot be blank.",
    'auth_blank_ctx' => "Check all of the fields and try submitting again.",
    'auth_invalid' => "Invalid credentials",
    'auth_invalid_ctx' => "Check for any capitalization and spelling errors and try again.",
    'auth_reauth' => "Reauthentication needed to continue",
    'auth_reauth_ctx' => "In order to proceed with the action, you need to login.",
    'auth_username' => "Username",
    'auth_password' => "Password",
    'auth_host' => "Host Address",

    // databases
    'db_create' => "New Database",
    'db_create_popover' => "Create",
    'db_create_popover_ph' => "Database Name",
    'db_creating_popover' => "Creating...",
    'db_drop' => "Drop Database",

    // Tables (as in data)
    'tbl_view' => "View",
    'tbl_drop' => "Drop",
    'tbl_new' => "New",
    'tbl_in_prefix' => "Tables in ",
    // Set to blank to use column name
    'tbl_popover_entire_value' => "Entire value",
    'tbl_na' => "N/A",
    'tbl_key' => "<span class='material-icons'>vpn_key</span>",

    // Tables
    'tblh_name' => "Name",
    'tblh_opt' => "Actions",
    'tblh_count' => "#",
    'tblh_rows' => "Rows",

    // MySQL msgs
    'mysql_empty_result' => "There were no rows with the query",
    'mysql_too_many_columns' => "There are too many columns in the current table to show without possible text overflow from the view.",
    'mysql_no_primary_key' => "The table has no primary key.",

    // Editor modal
    'editor_title' => "Edit row",
    'editor_save_changes' => "Update",
    'editor_new_title' => "New row",
    'editor_new' => "Insert",
    'editor_norow_title' => "Cannot edit the selected row as it does not exist.",
    'editor_norow_msg' => "You can try closing the prompt and attempting to edit the row again.",
    'editor_nokey_title' => "Cannot edit the selected row as it does not have a primary key.",
    'editor_nokey_msg' => "A primary key is needed to load and submit changes to the table.",

    // Configuration
    'db_view_config_db'         => "<span class='label label-danger'>v0ltureDB</span>",
    'config_db_name'            => "v0lturedb_config",
    'config_table_name'         => "config",

    'config_toggle_true' => "On",
    'config_toggle_false' => "Off",

    'config_gui_msg' => "You can disable this view by disabling the <code>settings_gui</code> flag and refreshing the view.",

    'config_enable_gui' => 'Enable Settings GUI',
    'config_disable_gui' => 'Disable',
    'config_gui_title' => 'Configuration GUI',

    'config_gui_update' => 'Update Configuration',

    // v0ltureDB
    'app_system_hidden_title' => "Cannot load tables due to configuration.",
    'app_system_hidden_msg' => "The flag <code>show_system_tables</code> is currently disabled which disallows this database to be loaded.",

    // Create tables
    'createtbl_db_info' => "Inserting table into ",
    'createtbl_db_name' => "Database name: ",

    // updates
    'updates_available' => "A new update is available",
    'updates_available_hide' => "Click Update to view information about the update",
    'updates_available_sub' => "Download via GitHub",

    'updates_unavailable' => "Couldn't check for updates",
    'updates_unavailable_sub' => "The version checking service may be offline, please try again later.",

    'updates_none' => "Looking good.",
    'updates_none_sub' => "Your version is up to date.",

    'updates_disabled' => "Updates are disabled",
    'updates_disabled_sub' => "Enable the flag <code>updates_allowed</code> or update your configuration to enable update support.",

    'updates_invalid' => "Configuration is invalid",
    'updates_invalid_sub' => "Update your configuration or reset it and try again.",
  );

?>
