# Custom CSS

## Code

```php
$mainPageHook = add_menu_page( 
    string $page_title, 
    string $menu_title, 
    string $capability, 
    string $menu_slug, 
    callable $callback = '', 
    string $icon_url = '', 
    int|float $position = null);
add_action("load-{$mainPageHook}", [$this, 'mainPageAssets']);

function mainPageAssets() {
    wp_enqueue_style('filterAdminCSS', plugin_dir_url(__FILE__) . 'styles.css');
}
```

## Noticeable

| Function name | Description |
| ------------- | ----------- |
| load-{$mainPageHook} | Load when the hook execute |
| wp_enqueue_style | Add stylesheet |
