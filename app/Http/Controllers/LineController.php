<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use Ycs77\LaravelLineBot\ActionBuilder;
use Ycs77\LaravelLineBot\Contracts\Response;
use Ycs77\LaravelLineBot\Facades\LineBot;
use Ycs77\LaravelLineBot\LineBotService;
use Ycs77\LaravelLineBot\Message\TemplateBuilder;
use Ycs77\LaravelLineBot\QuickReplyBuilder;

class LineController extends Controller
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
            LineBot::setEvent($event);

            if ($event instanceof TextMessage) {
                switch ($event->getText()) {
                    case '嘿':
                        LineBot::text('嘿嘿嘿！！')
                            ->quickReply(function (QuickReplyBuilder $action) {
                                $action->message('你好');
                                $action->message('選單');
                                $action->message('確認');
                                $action->message('輪播');
                                $action->message('輪播圖片');
                            })
                            ->reply();
                        break;

                    case '你好':
                        LineBot::text('嗨~~')->reply();
                        break;

                    case '選單':
                        LineBot::template('這是我的選單', function (TemplateBuilder $template) {
                            $template->button(
                                '選單',
                                '請選擇',
                                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
                                function (ActionBuilder $action) {
                                    $action->message('購買');
                                    $action->message('加到購物車');
                                    // $action
                                    $action->url('瀏覽 Laravel 網站', 'https://laravel.com/');
                                }
                            );
                        })->reply();
                        break;

                    case '購買':
                        LineBot::text('購買成功！')->reply();
                        break;

                    case '加到購物車':
                        LineBot::text('加到購物車成功！')->reply();
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
                        $this->fallback($event);
                }
            } else {
                $this->fallback($event);
            }
        }
    }

    public function newReplyApi()
    {
        $events = [];

        LineBot::routes($events, function () {
            LineBot::on()->text('哈囉', function () {
                LineBot::text('你好')->reply();
            });

            LineBot::on()->text('我叫 {name}', function ($name) {
                LineBot::text("你好 $name")->reply();
            });

            LineBot::on()->audio(function ($audio) {
                LineBot::text('text')->reply();
            });

            LineBot::on()->video(function ($video) {
                LineBot::text('text')->reply();
            });

            LineBot::on()->join(function () {
                LineBot::text('text')->reply();
            });

            LineBot::on()->fallback(function () {
                LineBot::text('不要吵！！')->reply();
            });
        });
    }

    public function test(Request $request)
    {
        if ($text = $request->input('text')) {
            $matchText = 'My name is {name}';
            $pattern = '/^' . preg_replace('/\{((?:(?!\d+,?\d+?)\w)+?)\}/', '(?<$1>.*)', $matchText) . ' ?$/miu';
            $regexMatched = (bool) preg_match($pattern, $text, $matches);

            if ($regexMatched) {
                $parameterNames = $this->compileParameterNames($matchText);
                $parameters = $this->getParameters($matches, $parameterNames);
            }
        }

        return view('test', [
            'text' => $text,
            'matches' => $matches ?? null,
            'parameters' => $parameters ?? null,
            'parameterNames' => $parameterNames ?? null,
        ]);
    }

    /**
     * Get the parameters.
     *
     * @param  array  $matches
     * @param  array  $names
     * @return array
     */
    protected function getParameters(array $matches, array $names)
    {
        return array_intersect_key($matches, array_flip($names));
    }

    /**
     * Get the parameter names for the route.
     *
     * @param  mixed  $value
     * @return array
     */
    protected function compileParameterNames($value)
    {
        preg_match_all('/\{((?:(?!\d+,?\d+?)\w)+?)\}/', $value, $matches);

        return array_map(function ($m) {
            return trim($m, '?');
        }, $matches[1]);
    }

    protected function fallback($event)
    {
        LineBot::text('不要吵！！')->reply();
    }
}
