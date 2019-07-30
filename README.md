# Fortuity/EmailReader

> EmailReader provides fluent IMAP search API over the ```barbushin/php-imap``` package.

## Requirements

 - PHP 7.1.3 or higher
 - PHP extensions:
   - ```iconv```
   - ```imap```
   - ```mbstring```

## Example

```php
<?php

use ZoltanLaca\EmailReader\Credentials\Imap;
use ZoltanLaca\EmailReader\EmailReader;

require_once __DIR__ . '/vendor/autoload.php';

$credentials = new Imap('host', 'username', 'password', 993, 'ssl', 'Custom.Folder');
$reader = new EmailReader($credentials);
$emails = $reader
    ->searchEmails()
    ->subject('Subject name contains')
    ->since(new DateTimeImmutable('2019-07-01'))
    ->get();

var_dump($emails);
```

## Install

###```composer.json```

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:zoltanlaca/email-reader.git"
        }
    ],
    "require": {
        "zoltanlaca/email-reader": "^1"
    }
}
```
