<?php 
namespace App\Channels;

interface ChannelContract 
{
    public function channelName();

    public function subscribeToChatBot($userId);

    public function subscribeToChannel($userId);

    public function sendMessageToSubscribers($userIds);
   
}