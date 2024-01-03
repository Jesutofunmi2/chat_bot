<?php
namespace App\Channels;

use App\Channels\Providers\TwitterProvider;
use Exception;
use Illuminate\Support\Str;


class ChannelManager 
{
    public function resolve($channel)
    {
        $methodName = 'resolve' . ucfirst(Str::camel($channel));
        if (method_exists($this, $methodName)) {

            /** @var ChannelContract $provider */
            return call_user_func_array([$this, $methodName], []);
        }

        throw new Exception('Channel [' . $channel . '] not found');
    }

    public function resolveTwitter(): TwitterProvider
    {
        return new TwitterProvider();
    }

    public function defaultChannel()
    {
        return $this->resolve(config('custom.twitter'));
    }
}