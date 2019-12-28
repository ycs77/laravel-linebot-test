<?php

use LINE\LINEBot\Event\MessageEvent\TextMessage;
use Ycs77\LaravelLineBot\Facades\LineBot;

LineBot::text('hello', function (TextMessage $event) {
    return $event->getText();
});

LineBot::text('你好', function () {
    return '你好！';
});
