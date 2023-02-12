# Custom Menu Icon

** Method 1: Convert SVG icon to binary format **

1. Open Google Chrome dev tool
2. Type btoa(`YOUR-SVG-CODE`) and hit enter 

```php
add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktZnVubmVsIiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGQ9Ik0xLjUgMS41QS41LjUgMCAwIDEgMiAxaDEyYS41LjUgMCAwIDEgLjUuNXYyYS41LjUgMCAwIDEtLjEyOC4zMzRMMTAgOC42OTJWMTMuNWEuNS41IDAgMCAxLS4zNDIuNDc0bC0zIDFBLjUuNSAwIDAgMSA2IDE0LjVWOC42OTJMMS42MjggMy44MzRBLjUuNSAwIDAgMSAxLjUgMy41di0yem0xIC41djEuMzA4bDQuMzcyIDQuODU4QS41LjUgMCAwIDEgNyA4LjV2NS4zMDZsMi0uNjY2VjguNWEuNS41IDAgMCAxIC4xMjgtLjMzNEwxMy41IDMuMzA4VjJoLTExeiIvPgo8L3N2Zz4=', 100);
```


** Method 2: Use SVG icon directly **

Icon size 20 X 20

```php
add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], plugin_dir_url(__FILE__) . 'filter.svg', 100);
```