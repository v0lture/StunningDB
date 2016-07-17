# v0ltureDB
A web app for managing MySQL databases without a desktop application by v0lture Programming.

# 0.0.1.6 Changelog
:bulb: Added settings menu that replaces the old version broken by the UI changes

:x: Removed sudo_mode flag

:wrench: Changed the default value of limit_col_count to false, set settings_gui to true

:boom: Fixed a bug where direct settings database and table caused the settings menu not to load.

# 0.0.1.5 Changelog
:bulb: Redesigned the entire UI with Material Design in mind

:boom: Added another config flag 'show_system_tables' which toggles visibility of the system related tables like *MySQL*, *performance_schema*, *information_schema*.

:one: Simplified majority of view/edit functions into one page to minimize amount of page switching

:boom: Changed add button behavior from adding a new row to just opening the FAB menu

:boom: Fixed bug where setting `show_system_tables` to `false` broke the database view on the side.
