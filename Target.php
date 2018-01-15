<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\Yii2\DingTalk\Log;

use iPaya\DingTalk\Client;
use Yii;

class Target extends \yii\log\Target
{
    /**
     * @var string 钉钉机器人 Access Token
     */
    public $accessToken;
    public $title = '程序日志';

    /**
     * @inheritDoc
     */
    public function export()
    {
        $text = implode("\n", array_map([$this, 'formatMessage'], $this->messages)) . "\n";
        $markdown = "```\n{$text}\n```";
        $markdown = mb_convert_encoding($markdown, Yii::$app->charset);

        $robot = (new Client())->robot()->configure($this->accessToken);
        $robot->sendMarkdown($this->title, $markdown);
    }
}
