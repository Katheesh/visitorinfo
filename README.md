# Visitor Info

### This package has been developed by identifying website visitors using their IP addresses. 
#### [We will never use your visitor IP addresses, or share your data with anyone else who might.](https://gitleaf.com/privacy-policy)
#### Package developed by S.Katheeskumar
<img src="https://gitleaf.com/img/quote.png"/>
<hr/>

## Installation

#### Install using composer
```bash
# install it via composer
composer require katheesh/visitorinfo

```
<hr>

#### [GitLeaf](https://gitleaf.com/) Officially uses `VisitorInfo` for their user identifying module.

## Usage

#### php

```php

require_once __DIR__ . '/vendor/autoload.php';

use VisitorInfo\GetInfo;

$info = new GetInfo;


    // get IP and geographical information about your client
echo $info->getGeoInfo();

    // get service provider information about your client
echo $info->getProviderInfo();

     // get hosting provider information about your client
echo $info->getHostingInfo();



```


## License

This project is licensed under the terms of the
[@Katheesh](https://katheesh.gitleaf.com/).