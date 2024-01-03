<?php

namespace App\Channels\Providers;

use Atymic\Twitter\Twitter as TwitterClient;
use Illuminate\Support\Facades\Http;


class TwitterProvider extends BaseChannelProvider
{
    public function channelName(): string
    {
        return 'twitter';
    }

    public function subscribeToChatBot($userId)
    {
        Http::withToken(config('custom.twitter.bearer_token'))
            ->post('https://api.twitter.com/2/direct_messages/events/new', [
                'event' => [
                    'type' => 'message_create',
                    'message_create' => [
                        'target' => [
                            'recipient_id' => $userId,
                        ],
                        'message_data' => [
                            'text' => 'Welcome to the chatbot!',
                        ],
                    ],
                ],
            ]);
    }

    public function subscribeToChannel($userId)
    {
        Http::withToken(config('custom.twitter.bearer_token'))
            ->post('https://api.twitter.com/2/direct_messages/events/new', [
                'event' => [
                    'type' => 'message_create',
                    'message_create' => [
                        'target' => [
                            'recipient_id' => $userId,
                        ],
                        'message_data' => [
                            'text' => 'You have been subscribed to channel ',
                        ],
                    ],
                ],
            ]);
    }

    public function sendMessageToSubscribers($subscribers)
    {
        $message = 'Hello, subscribers!';

        foreach ($subscribers as $subscriber) {
            Http::withToken(config('custom.twitter.bearer_token'))->post('https://api.twitter.com/2/direct_messages/events/new', [
                'event' => [
                    'type' => 'message_create',
                    'message_create' => [
                        'target' => [
                            'recipient_id' => $subscriber,
                        ],
                        'message_data' => [
                            'text' => $message,
                        ],
                    ],
                ],
            ]);
        }
    }
}
