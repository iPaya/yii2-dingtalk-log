# 钉钉日志报警

## 安装

使用 `composer` 安装

```bash
composer require --prefer-dist "ipaya/yii2-dingtalk-log:*"
```

## 使用方法

在配置文件中:

```php
<?php

return [
    // ...
    'components'=>[
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                // ...
                [
                    'class' => 'iPaya\DingTalk\Log\DingTalkTarget',
                    'levels' => ['error'],
                    'robot' => [
                        'accessToken' => '<你的钉钉聊天机器人 Access Token>'                        
                    ]
                ],
                // ...
            ],
        ],
    ]
    // ...
];
```

## 如何获取钉钉聊天机器人 Access Token

参见 [钉钉官方文档](https://open-doc.dingtalk.com/docs/doc.htm?treeId=257&articleId=105735&docType=1)

