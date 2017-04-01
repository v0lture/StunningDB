<?php

  // properties for loading a language
  $lang_properties = Array(
    'friendly' => "English US",
    'code' => "EN",
    'supports' => "0.0.3.2"
  );

  $lang = Array(

    // modal
    'modal_error_title' => "Failed to complete operation.",
    'modal_error_dismiss' => "Dismiss",
    'modal_error_action' => "Check that you have the required privileges and the server is online. Also check that all required fields are filled.",
    'modal_error_response' => "Server responded with: ",
    'modal_error_src' => "Source of error: ",

    'modal_warn_action' => "This warning should not affect the operation performed unless an error occurs after this event.",
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
    'modal_query_waiting' => "Waiting...",

    // Navbar
    'navbar_app' => "v0ltureDB",
    'navbar_logout' => "Log Out",
    'navbar_user_settings' => "Local Settings",
    'navbar_vdb_settings' => "vDB Settings",
    'navbar_info' => "Install info",


    // Buttons
    'btn_refresh' => "Refresh",
    'btn_rst_popovers' => "Reset Popovers",
    'btn_loading' => "...",
    'btn_temp_show_all' => "Temporarily show all",
    'btn_disable' => "Disable",
    'btn_enable' => "Enable",
    'btn_close' => "Close",
    'btn_rst' => "Reset",
    'btn_cancel' => "Cancel",
    'btn_continue' => "Continue",

    // auth
    'auth_blank' => "Fields cannot be blank.",
    'auth_blank_ctx' => "Check all of the fields and try submitting again.",
    'auth_invalid' => "Could not login to server",
    'auth_invalid_ctx' => "Check for any capitalization and spelling errors and try again.",
    'auth_reauth' => "Reauthentication needed to continue",
    'auth_reauth_ctx' => "In order to proceed with the action, you need to login.",
    'auth_username' => "Username",
    'auth_password' => "Password",
    'auth_host' => "Host Address",
    'auth_title' => "Log in to MySQL server",
    'auth_sub' => "Enter the credentials to access and manage the MySQL server",
    'auth_login' => "Login",
    'auth_nopass' => "This user account does not have a set password and this is very insecure for your server.",
    'auth_confirm_logout' => "Leaving already?",
    'auth_confirm_logout_ctx' => "Confirm that you want to log out of v0ltureDB below or hit cancel to return.",

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
    'tbl_key' => "<span class='material-icons' style='font-size: 12px;'>vpn_key</span>",

    // Tables
    'tblh_name' => "Name",
    'tblh_opt' => "Actions",
    'tblh_count' => "#",
    'tblh_rows' => "Rows",

    // MySQL msgs
    'mysql_empty_result' => "There were no rows with the query",
    'mysql_too_many_columns' => "There are too many columns in the current table to show without possible text overflow from the view.",
    'mysql_no_primary_key' => "The table has no primary key.",
    'mysql_tbl_error' => "Cannot load table in this database",
    "mysql_tbl_error_ctx" => "Failed to load table",
    'mysql_empty_result_t' => "No rows",

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

    // tooltips
    'tooltip_new' => "New...",
    'tooltip_run_query' => "Run query...",
    'tooltip_new_db' => "New database",
    'tooltip_new_tbl' => "New table",
    'tooltip_new_row' => "New row",

    // view switcher
    'view_db' => "Databases",
    'view_users' => "Users",

    // local page
    'local_language' => "Language",
    'local_current' => "Currently using ",
    'local_language_select' => "Use this language",
    'local_language_reset' => "Reset to original language",
    'local_language_reload' => "After setting a new language, reload the page to show the new language.",
    'local_themes' => "Themes",
    'local_themes_info' => "Pick a look and feel for v0ltureDB",
    'local_themes_reset' => "Restore original theme",
    'local_themes_pick' => "Pick this theme",
    'local_cfg' => "Installation",

    'themes' => Array(
      'db' => "v0ltureDB Default",
      'dark' => "Dark Mode",
      'matrix' => "Matrix",
    ),

    'installation_info' => Array(
      'compatibility' => "Server Compatibility",
      'compatibility_recheck' => "Recheck",
      'compatibility_success' => "Your server is compatible with v0ltureDB",
      'compatibility_failure' => "Your server is <b>not</b> compatible with v0ltureDB",
      'version' => "v0ltureDB Version",
      'version_prefix' => "You currently have <b>",
      'version_suffix' => "</b> installed.",
      'version_check' => "Check for updates",
      'server_version' => "MySQL Server Version",
      'server_version_noconn' => "You must be logged in first to view the server version.",
      'server_version_prefix' => "You are connected to a MySQL server running: ",
      'auth' => "Authenticated as",
      'auth_user_prefix' => "Username: ",
      'auth_user_suffix' => "",
      'auth_host_prefix' => "Host: ",
      'auth_host_suffix' => "",
      'auth_login' => "Log in",
      'auth_logout' => "Log out",
      'auth_none' => "Must be logged in to view who you are logged as",
    ),

    // new table
    'new_table' => Array(
      "selected_db" => "Selected database:",
      "new_name" => "Name of new table:",
      "new_col_t" => "Add a new column:",
      "clear" => "Reset the table:",
      "submit" => "Create the table:",

      "errors" => Array(
        "mustbenumeric" => "Length must be numeric",
        "invalidtype" => "Invalid type",
        "missing" => "Missing required data",
        "missingdb" => "Missing database and table names",
      ),

      "modals" => Array(

        "titles" => Array(
          "selected_db" => "Change selected database",
          "new_name" => "Set table name",
          "get_started" => "Get started with creating a new table",
          "new_col" => "Define a new column",
        ),

        "msg" => Array(
          "select_db" => "Select the database to create the new table under:",
          "name_table" => "Name your new table:",
        ),
        
        "fields" => Array(
          "value" => "Value",
          "blank" => "Field cannot be blank",
          "name" => "Column name",
          "type" => "Type",
          "length" => "Length",
          "add_parameters" => "Additional parameters",
        ),

        "btn" => Array(
          "save" => "Save",
          "name_tbl" => "Name Table",
          "select_db" => "Select Database",
          "cancel_init" => "Cancel initialization",
        ),
      ),

      "tooltips" => Array(
        "change" => "Change...",
        "new" => "New",
        "clear" => "Clear",
        "submit" => "Submit",
      ),

      "table" => Array(
        "name" => "Name",
        "type" => "Type",
        "length" => "Length",
        "params" => "Additional parameters",
        "actions" => "Actions",
        "suffix" => "Suffix parameters",
      ),

      "btn" => Array(
        "edit" => "Edit",
        "delete" => "Delete",
      ),

      "new_col" => Array(
        "add_params" => "ADDITIONAL PARAMETERS",
        "param_help" => Array(
          "auto_increment" => "For every new row, this field will increment by one unless explicitly specified.",
          "primary" => "Sets an index key to enable additional functions with individual rows such as editing, dropping, and more.<br />At least one <code>PRIMARY</code> field is required to edit your table's data.",
          "unique" => "Prevents duplicates of a value in this column.",
          "null" => "Make this column have no value",
        ),
      ),
    ),

    'users' => Array(
        'permission_denied' => "Feature disabled",
        'permission_denied_sub' => "Showing users has been disabled by the v0ltureDB Configuration &mdash; Set <code>show_users</code> to true to enable this feature."
    ),

  );

?>
