<?php 

$router->post('/twitter/subscribe/chatbot', 'SubscriptionController@subscribeToChatBot');
$router->post('twitter/subscribe/channel', 'SubscriptionController@subscribeToChannel');
$router->post('twitter/subscribers/message', 'SubscriptionController@sendMessageToSubscribers');
