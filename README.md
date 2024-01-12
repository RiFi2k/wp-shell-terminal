# WP Shell Terminal

## Description
WP Shell Terminal is a WordPress plugin designed to provide administrators with a convenient way to execute shell commands directly from the WordPress admin area. It features a terminal-like interface that allows for the input of commands and displays their output. The plugin is intended for use in controlled, secure environments due to the inherent risks associated with executing shell commands.

## Features
- Terminal interface within the WordPress admin area.
- Ability to execute shell commands as the PHP user.
- Session-based command history, maintaining a record of all executed commands and their outputs for the current session.
- Scrolling functionality in the terminal for better output visibility.
- Standard terminal styling for clear and user-friendly experience.

## Installation
1. Download the plugin from the repository.
2. Extract the `wp-shell-terminal` folder into your WordPress `wp-content/plugins` directory.
3. Navigate to your WordPress admin area and go to the Plugins page.
4. Locate 'WP Shell Terminal' in the plugin list and click 'Activate'.

## Usage
After activation, the plugin adds a new submenu item under 'Tools' in the WordPress admin dashboard:

- **Shell Terminal**: Located under 'Tools', this page hosts the terminal interface. It is accessible only to users with admin-level permissions.

To use the terminal:
1. Navigate to 'Tools' > 'Shell Terminal' in the WordPress admin dashboard.
2. Enter the desired shell command in the input field.
3. Click 'Run' to execute the command.
4. View the output in the text area above the input field.

## Security Notice
This plugin allows the execution of arbitrary shell commands, which can be dangerous and potentially harmful if misused. It is strongly recommended to use this plugin only in secure, controlled environments and ensure that only trusted users have admin access.

---

**Note**: This plugin is developed with security considerations, but it is essential to understand the implications of allowing shell command executions in a web environment. Regular security audits and controlled access are highly recommended.

