## Requirement

1. PHP >= 7.0.0
2. **[composer](https://getcomposer.org/)**
3. openssl 拓展
4. fileinfo 拓展（上传文件需要用到）
5. mbstring 拓展

> SDK 对所使用的框架并无特别要求

## Installation

```shell
composer require "mayunfeng/easy-feishu ^1.0" -vvv
```

## Usage

基本使用（以服务端为例）:

```php
<?php

use EasyFeishu\Foundation\Application;

$options = [
    'debug'               => false,
    'app_id'              => 'cli_xxxxxx',
    'app_secret'          => 'xxxxxxxxxxxxxxxxxxx',
    'encrypt_key'         => 'xxxxxx',
    'log'                 => [
        'file'  => __DIR__.'/../logs/'.date('Y-m-d').'.log',
        'level' => 'debug',
    ],
    // ...
];

$app = new Application($options);

$server = $app->server;
$departments = $app->contact->getDepartments();
```

## Integration

[Laravel 6 拓展包: mayunfeng/laravel-feishu](https://github.com/mayunf/laravel-feishu)

## License

MIT
