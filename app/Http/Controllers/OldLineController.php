<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\QuickReplyBuilder\ButtonBuilder\QuickReplyButtonBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use Ycs77\LaravelLineBot\ActionBuilder;
use Ycs77\LaravelLineBot\Contracts\Response;
use Ycs77\LaravelLineBot\Facades\LineBot;
use Ycs77\LaravelLineBot\LineBotService;
use Ycs77\LaravelLineBot\Message\TemplateBuilder;
use Ycs77\LaravelLineBot\QuickReplyBuilder;

class OldLineController extends Controller
{
    use LineBotService;

    public function webhook(Request $request, Response $response)
    {
        return $this->lineBotReply($request, $response);
    }

    protected function reply(array $events)
    {
        $bot = LineBot::base();

        foreach ($events as $event) {
            if ($event instanceof TextMessage) {
                switch ($event->getText()) {
                    case '嘿':
                        $quickReply = new QuickReplyMessageBuilder([
                            new QuickReplyButtonBuilder(
                                new MessageTemplateActionBuilder('你好', '你好')
                            ),
                            new QuickReplyButtonBuilder(
                                new MessageTemplateActionBuilder('選單', '選單')
                            ),
                            new QuickReplyButtonBuilder(
                                new MessageTemplateActionBuilder('確認', '確認')
                            ),
                            new QuickReplyButtonBuilder(
                                new MessageTemplateActionBuilder('輪播', '輪播')
                            ),
                            new QuickReplyButtonBuilder(
                                new MessageTemplateActionBuilder('輪播圖片', '輪播圖片')
                            )
                        ]);
                        $messageBuilder = new TextMessageBuilder('嘿嘿嘿！！', $quickReply);
                        $bot->replyMessage($event->getReplyToken(), $messageBuilder);
                        break;

                    case '你好':
                        $bot->replyText($event->getReplyToken(), '嗨~~');
                        break;

                    case '選單':
                        $buyAction = new MessageTemplateActionBuilder('購買', '購買');
                        $addToCartAction = new MessageTemplateActionBuilder('加到購物車', '加到購物車');
                        $viewDetailAction = new UriTemplateActionBuilder(
                            '瀏覽 Laravel 網站', 'https://laravel.com/'
                        );
                        $templateBuilder = new ButtonTemplateBuilder(
                            '選單',
                            '請選擇',
                            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                            [$buyAction, $addToCartAction, $viewDetailAction]
                        );
                        $messageBuilder = new TemplateMessageBuilder('這是我的選單', $templateBuilder);
                        $bot->replyMessage($event->getReplyToken(), $messageBuilder);
                        break;

                    case '購買':
                        $bot->replyText($event->getReplyToken(), '購買成功！');
                        break;

                    case '加到購物車':
                        $bot->replyText($event->getReplyToken(), '加到購物車成功！');
                        break;

                    case '確認':
                        $yesAction = new MessageTemplateActionBuilder('確定', '確定');
                        $noAction = new MessageTemplateActionBuilder('取消', '取消');
                        $templateBuilder = new ConfirmTemplateBuilder(
                            '你確定嗎?',
                            [$yesAction, $noAction]
                        );
                        $messageBuilder = new TemplateMessageBuilder('這是我的選單', $templateBuilder);
                        $bot->replyMessage($event->getReplyToken(), $messageBuilder);
                        break;

                    case '輪播':
                        $action = new MessageTemplateActionBuilder('你好', '你好');
                        $templateBuilder = new CarouselTemplateBuilder(
                            [
                                new CarouselColumnTemplateBuilder(
                                    '標題1',
                                    '簡介...',
                                    'https://images.unsplash.com/photo-1514477917009-389c76a86b68?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    [$action]
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '標題2',
                                    '簡介...',
                                    'https://images.unsplash.com/photo-1472190649224-495422e1b602?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    [$action]
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '標題3',
                                    '簡介...',
                                    'https://images.unsplash.com/photo-1505051508008-923feaf90180?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    [$action]
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '標題4',
                                    '簡介...',
                                    'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    [$action]
                                ),
                            ]
                        );
                        $messageBuilder = new TemplateMessageBuilder('這是我的選單', $templateBuilder);
                        $bot->replyMessage($event->getReplyToken(), $messageBuilder);
                        break;

                    case '輪播圖片':
                        $action = new MessageTemplateActionBuilder('你好', '你好');
                        $templateBuilder = new ImageCarouselTemplateBuilder(
                            [
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://images.unsplash.com/photo-1514477917009-389c76a86b68?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    $action
                                ),
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://images.unsplash.com/photo-1472190649224-495422e1b602?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    $action
                                ),
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://images.unsplash.com/photo-1505051508008-923feaf90180?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    $action
                                ),
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                    $action
                                ),
                            ]
                        );
                        $messageBuilder = new TemplateMessageBuilder('這是我的選單', $templateBuilder);
                        $bot->replyMessage($event->getReplyToken(), $messageBuilder);
                        break;

                    default:
                        $this->fallback($bot, $event);
                }
            } else {
                $this->fallback($bot, $event);
            }
        }
    }

    protected function fallback($bot, $event)
    {
        $bot->replyText($event->getReplyToken(), '不要吵！！');
    }
}
