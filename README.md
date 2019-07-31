# ZoltanLaca/EmailReader

> EmailReader provides fluent IMAP search API over the `barbushin/php-imap` package.

## Requirements

 - PHP 7.1.3 or higher
 - PHP extensions:
   - `iconv`
   - `imap`
   - `mbstring`

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
    ->get(true);

var_dump($emails);
```

## Install

### `composer.json`

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

## Classes

### Credentials: `\ZoltanLaca\EmailReader\Contracts\Credentials::interface`

 - `getMailbox(): \PhpImap\Mailbox`
 
#### Implementations

##### Imap: `\ZoltanLaca\EmailReader\Credentials\Imap::class`
 
 - `__construct(string $host, string $username, string $password, int $port = 993, string $encrypt = 'ssl', string $folder = null, string $encoding = 'UTF-8')`
 - `setAttachmentsPath(string $path): self`
 - `setTimeout(int $timeout): self`
 - `getMailbox(): \PhpImap\Mailbox`

### Reader: `\ZoltanLaca\EmailReader\EmailReader::class`

 - `__construct(\ZoltanLaca\EmailReader\Contracts\Credentials $credentials)`
 - `getFolder(string $path = null): \ZoltanLaca\EmailReader\Folder`
 - `getFolders(): \ZoltanLaca\EmailReader\Folder[]`
 - `getEmails(\ZoltanLaca\EmailReader\Folder $folder = null, bool $markAsSeen = false): \PhpImap\IncomingMail[]`
 - `searchEmails(\ZoltanLaca\EmailReader\Folder $folder = null): \ZoltanLaca\EmailReader\Search`

### Search: `\ZoltanLaca\EmailReader\Search::class`

 - `__construct(\PhpImap\Mailbox $mailbox, \ZoltanLaca\EmailReader\Folder $folder)`
 - `pushCriteria(\ZoltanLaca\EmailReader\Criteria\Criteria $criteria): self`
 - `get(bool $markAsSeen = false): \PhpImap\IncomingMail[])`

#### Available Criteria

| Fluent method                       | IMAP filter        | Description                                                                               |
| :---------------------------------- | :----------------- | :---------------------------------------------------------------------------------------- |
| - default -                         | ALL                | return all messages matching the rest of the criteria                                     |
| `answered(bool $answered = true)`   | ANSWERED           | match messages with the \\ANSWERED flag set                                               |
| `unanswered()`                      | UNANSWERED         | match messages that have not been answered                                                |
| `deleted(bool $deleted = true)`     | DELETED            | match deleted messages                                                                    |
| `undeleted()`                       | UNDELETED          | match messages that are not deleted                                                       |
| `flagged(bool $flagged = true)`     | FLAGGED            | match messages with the \\FLAGGED (sometimes referred to as Important or Urgent) flag set |
| `unflagged()`                       | UNFLAGGED          | match messages that are not flagged                                                       |
| `new()`                             | NEW                | match new messages                                                                        |
| `old()`                             | OLD                | match old messages                                                                        |
| `recent()`                          | RECENT             | match messages with the \\RECENT flag set                                                 |
| `seen(bool $seen = true)`           | SEEN               | match messages that have been read (the \\SEEN flag is set)                               |
| `unseen()`                          | UNSEEN             | match messages which have not been read yet                                               |
| `before(DateTimeInterface $before)` | BEFORE "date"      | match messages with Date: before "date                                                    |
| `on(DateTimeInterface $on)`         | ON "date"          | match messages with Date: matching "date                                                  |
| `since(DateTimeInterface $since)`   | SINCE "date"       | match messages with Date: after "date                                                     |
| `from(string $from)`                | FROM "string"      | match messages with "string" in the From: field                                           |
| `to(string $to)`                    | TO "string"        | match messages with "string" in the To:                                                   |
| `bcc(string $bcc)`                  | BCC "string"       | match messages with "string" in the Bcc: field                                            |
| `cc(string $cc)`                    | CC "string"        | match messages with "string" in the Cc: field                                             |
| `subject(string $subject)`          | SUBJECT "string"   | match messages with "string" in the Subject:                                              |
| `body(string $body)`                | BODY "string"      | match messages with "string" in the body of the message                                   |
| `text(string $text)`                | TEXT "string"      | match messages with text "string                                                          |
| `keyword(string $keyword)`          | KEYWORD "string"   | match messages with "string" as a keyword                                                 |
| `unkeyword(string $unkeyword)`      | UNKEYWORD "string" | match messages that do not have the keyword "string                                       |
