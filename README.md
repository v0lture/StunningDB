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

## Changelogs
Changelogs are labeled as release.beta.alpha.nightly.

### 0.0.1.7
:wrench: Improved ways of adding new flags to be a bit easier

:bulb: Added Update Configuration option which will update your config to support any new flags without wiping your old changes

### 0.0.1.6
:bulb: Added settings menu that replaces the old version broken by the UI changes

:x: Removed sudo_mode flag

:wrench: Changed the default value of limit_col_count to false, set settings_gui to true

:boom: Fixed a bug where direct settings database and table caused the settings menu not to load.

:boom: Updated Readme with more instructions!

### 0.0.1.5
:bulb: Redesigned the entire UI with Material Design in mind

:boom: Added another config flag 'show_system_tables' which toggles visibility of the system related tables like *MySQL*, *performance_schema*, *information_schema*.

:one: Simplified majority of view/edit functions into one page to minimize amount of page switching

:boom: Changed add button behavior from adding a new row to just opening the FAB menu

:boom: Fixed bug where setting `show_system_tables` to `false` broke the database view on the side.
