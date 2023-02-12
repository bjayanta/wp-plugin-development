# WP Default Form Settings

## Add Action

```php
add_action('admin_init', [$this, 'ourSettings']);
```

## Register the settings

```php
function ourSettings() {
    add_settings_section('replacement-text-section', null, null, 'word-filter-options');
    register_setting('replacementFileds', 'replacementText');
    add_settings_field('replacement-text', 'Filtered Text', [$this, 'replacementFiledHTML'], 'word-filter-options', 'replacement-text-section');
}

function replacementFiledHTML() { ?>
    <input type="text" name="replacementText" value="<?php echo esc_attr(get_option('replacementText', '***')); ?>">
    <p class="description">Leave blank to simply remove the filtered words.</p>
<?php }

function filterLogic($content) {
    $badWords = explode(',', get_option('plugin_words_to_filter'));
    $badWordsTrimmed = array_map('trim', $badWords);

    return str_ireplace($badWordsTrimmed, esc_html(get_option('replacementText', '****')), $content);
}
```

## Submenu page

```php
add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);

function optionsSubPage() { ?>
    <div class="wrap">
        <h1>Word Filter Options</h1>
        <form action="options.php" method="post">
            <?php 
                settings_errors(); // message
                settings_fields('replacementFileds');
                do_settings_sections('word-filter-options');
                submit_button();
            ?>
        </form>
    </div>
<?php }
```

## Noticeable

| Function name | Description |
| ------------- | ----------- |
| add_settings_section() | - |
| register_setting() | - |
| add_settings_field() | - |
| add_submenu_page() | - |
| settings_errors() | Show message |
| settings_fields() | Section of input fields |
| do_settings_sections() | - |
| submit_button() | Submit button |
