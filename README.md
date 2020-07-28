# VINDecoder
A very basic VIN Decoder that requires alot of work! 
This requires a database for different manufacturers.

# Example
```php
        $v = new VINDecoder("WBAEB8401C6993273");
        $v->validate_check_digit();
```
