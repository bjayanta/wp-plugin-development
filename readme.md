# Submit and CSRF

## Check valid nonce and user permission

```php
if(wp_verify_nonce($_POST['ourNonce'], 'saveFilterWors') && current_user_can('manage_options')) {
    // Update code
} else {
    // Error code
}
```

## Update 'wp_options' table

```php
update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter']));
```

## Set CSRF Token

```php
wp_nonce_field('saveFilterWors', 'ourNonce')
```

## Noticeable

| Function name | Description |
| ------------- | ----------- |
| wp_verify_nonce() | To check valid nonce or not |
| current_user_can() | To check user has permission to perform that action or not |
| update_option() | To update or insert |
| wp_nonce_field() | Set CSRF token |
