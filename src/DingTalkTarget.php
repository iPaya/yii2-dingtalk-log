<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 */

namespace iPaya\DingTalk\Log;

use iPaya\DingTalk\Robot\Robot;
use Yii;
use yii\base\InvalidConfigException;
use yii\log\Target;

class DingTalkTarget extends Target
{
    /**
     * @var Robot
     */
    public $robot;
    public $title = '程序日志';

    public function init()
    {

        if (is_string($this->robot)) {
            $this->robot = Yii::$app->get($this->robot);
        } elseif (is_array($this->robot)) {
            if (!isset($this->robot['class'])) {
                $this->robot['class'] = Robot::className();
            }
            $this->robot = Yii::createObject($this->robot);
        }
        if (!$this->robot instanceof Robot) {
            throw new InvalidConfigException("DingTalkTarget::robot must be a Robot instance.");
        }

        parent::init();
    }

    /**
     * @inheritDoc
     */
    public function export()
    {
        $messages = array_map([$this, 'formatMessage'], $this->messages);
        $body = wordwrap(implode("\n", $messages), 70);
        $markdown = "```\n{$body}\n```";
        $this->robot->sendMarkdown($this->title, $markdown);
    }

}
