# v0ltureDB
A web app for managing MySQL databases without a desktop application by v0lture Programming.

# this software is not complete and is missing major features currently!
It is not recommended to use unless you want to give feedback this early but if you want to actively use the software please wait until an official release.

## Installation

After downloading the repository extract the contents to the intended location you want to run it from.

For example `/var/www/html/v0lturedb/`.

### Requirements
v0ltureDB has been tested with PHP version `5.5` and `7` however it is expected to work with the version inbetween those.

It has also been tested with MySQL version `5.6.12` but is expected to work with most versions around that.

### Configuration Requirements
In order to use the configuration the user currently logged in as must have the `CREATE` and `INSERT` privilege in order to initialize the database and tables. This is only required to run once unless the database or table have been dropped.

Afterwards, as long as the user has the `SELECT` privilege the configuration will be applied.

## Updating
As of `v0.0.1.9` there is now version checking. This does **not** install updates for you.

To install the latest update, redownload the master branch and extract again in the current installation folder.

It is recommended that you backup your current installation in case an update breaks a feature or is not supported by your server.

## Changelogs
Changelogs are labeled as release.beta.alpha.nightly.

### 0.0.1.12
:bulb: Added idle timeout flag, redirects back to the login page after 10 minutes of inactivity.

:boom: Changed warning modal to a message that appears above the breadcrumb.

:x: Removed ability to hide table view

### 0.0.1.11
:boom: Fixed scrolling issue in user dropdown from long usernames/hostnames

:boom: Fixed footer colors in modals not being correct

:boom: Removed unused '...' in navbar as it served no purpose

### 0.0.1.10
:wrench: Fixes bug with `v0.0.1.9` where if v0ltureDB was using the latest version it would still show an update prompt.

:bulb: Added view for when the version checking service is unavailable.

### 0.0.1.9
:bulb: Added 3 new flags `login_update_check` for checking updates at login, `updates_config` which updates the configuration whenever a new update has been installed, `updates_allowed` for disabling/enabling support for updating, and `global_update_notice` to toggle the visibility of the notice of any future updates.

:bulb: Added updates view in settings (requires `settings_gui` to be enabled)

:bulb: Added v0ltureDB's new logo in the navigation bar

:wrench: Some minor text and styling changes

**this version update checking is supported but not update installation**

### 0.0.1.8
:wrench: Fixed the information page being broken since v0.0.1.5

:one: Unified all the css elements into one singular css file for easier theming

:bulb: Added another system database under the `show_system_tables` flag

:wrench: Some visual changes in the readme

### 0.0.1.7
:wrench: Improved ways of adding new flags to be a bit easier

:bulb: Added Update Configuration option which will update your config to support any new flags without wiping your old changes

### 0.0.1.6
:bulb: Added settings menu that replaces the old version broken by the UI changes

:x: Removed sudo_mode flag

:wrench: Changed the default value of `limit_col_count` to `false`, set `settings_gui` to `true`

:boom: Fixed a bug where direct settings database and table caused the settings menu not to load.

:boom: Updated Readme with more instructions!

### 0.0.1.5
:bulb: Redesigned the entire UI with Material Design in mind

:boom: Added another config flag `show_system_tables` which toggles visibility of the system related tables like **MySQL**, **performance_schema**, **information_schema**, and **sys**.

:one: Simplified majority of view/edit functions into one page to minimize amount of page switching

:boom: Changed add button behavior from adding a new row to just opening the FAB menu

:boom: Fixed bug where setting `show_system_tables` to `false` broke the database view on the side.
