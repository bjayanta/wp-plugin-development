# WP Plugin Development

## Setup

  - Plugin name: Our Word Filter Plugin
  - Description: Repace a list of words.
  - version: 1.0
  - Author: Jayanta Biswas
  - Author URI: http://jayanta.me
  
## Restrict direct access

```php
if(! defined('ABSPATH')) exit; // Exit if accessed directly
```

## Create menu

```php
class OurWordFilterPlugin {
    function __construct() {
        add_action('admin_menu', [$this, 'ourMenu']);
    }

    function ourMenu() {
        // Create main menu
        add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], 'dashicons-smiley', 100);
		
        // Create submenu page
        add_submenu_page('ourwordfilter', 'Word To Filter', 'Words List', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage']);
        add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
    }
	
    function wordFilterPage() { ?>
        Hello world.
    <?php }

    function optionsSubPage() { ?>
        Hello world from the option page.
    <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();
```

## Noticeable

| Function name | Description |
| ------------- | ----------- |
| add_action | When specific events occur. In this case 'admin_menu' |
| add_menu_page | To create main menu |
| add_submenu_page | To create submenu |