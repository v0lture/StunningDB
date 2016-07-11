<?php

  $systemdbs = Array(
    "1" => "mysql",
    "2" => "performance_schema",
    "3" => "information_schema",
  );

  $lang = Array(

    // modal
    'modal_error_title' => "Failed to complete operation.",
    'modal_error_dismiss' => "Okay",
    'modal_error_action' => "Check that you have the required previliges and the server is online. Also check that all required fields are filled.",
    'modal_error_response' => "Server responed with: ",
    'modal_error_src' => "Source of error: ",

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
    'auth_username' => "Username",
    'auth_password' => "Password",
    'auth_host' => "Host",

    // databases
    'db_create' => "New Database",
    'db_create_popover' => "Create",
    'db_create_popover_ph' => "Database Name",
    'db_creating_popover' => "Creating...",

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
    'mysql_empty_result' => "MySQL returned empty result",
    'mysql_empty_result_ctx' => "There were no rows with the query.",
    'mysql_too_many_columns' => "Too many columns",
    'mysql_too_many_columns_ctx' => "There are too many columns in the current table to show without possible text overflow from the view.",
    'mysql_no_primary_key' => "This table has no primary key.",
    'mysql_no_primary_key_ctx' => "You cannot edit/delete any rows until a primary key is set.",

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

    'config_db_edit_title'      => "You're editing v0ltureDB configuration!",
    'config_db_edit_msg'        => "You are editing the database that v0ltureDB relies on for features throughout v0ltureDB. Accidental destructive options may result in unwanted errors.",

    'config_db_edith_title'      => "Syntax",
    'config_db_edith_msg'        => "The values to be used when enabling/disabling features should be <span class='label label-primary'>true</span> and <span class='label label-primary'>false</span>. Anything else will cause unwanted errors.",

    'config_settings_gui_title'      => "Settings GUI is enabled",
    'config_settings_gui_msg'        => "You cannot edit any tables in the v0ltureDB config while the settings GUI is enabled.",

    'config_enable_gui' => 'Enable Settings GUI',
    'config_disable_gui' => 'Disable',
    'config_gui_title' => 'Configuration GUI',

    // v0ltureDB
    'app_system_hidden_title' => "Cannot load tables due to configuration.",
    'app_system_hidden_msg' => "The flag <code>show_system_tables</code> is currently disabled which disallows this database to be loaded.",

    // Create tables
    'createtbl_db_info' => "Inserting table into ",
    'createtbl_db_name' => "Database name: ",
  );

?>
