<?php

/**
 * @OA\Info(
 *     title="Test",
 *     version="1.0.0",
 *     description="Twitter chat bot with atymic package",
 *     @OA\Contact(
 *         email="balogunsunday91@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Joseph Balogun",
 *         url="http://localhost:8000"
 *     )
 * )
 */

namespace App\Api\V1\Controllers;

use App\Channels\ChannelManager;
use App\Channels\Providers\BaseChannelProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class SubscriptionController extends Controller
{
    protected BaseChannelProvider $provider;
    public function __construct(Request $request)
    {
        $channelManager = new ChannelManager();
        if ($request->get('channel')) {
            $this->provider = $channelManager->resolve($request->get('channel'));
        } else {
            $this->provider = $channelManager->defaultChannel();
        }
    }
    /**
     * @OA\PathItem(
     *     path="/twitter/subscribe/chatbot",
     *     @OA\Get(
     *         summary="User subscribe to chat bot respond",
     *         description="Get a user id and post with the api",
     *       @OA\Response(
     *         response="200",
     *         description="User Subscribe to chat Successful",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ),
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *      @OA\Post(
     *         summary="Post user id to get user to subscribe to the chat bot",
     *         description="",
     *         @OA\Response(
     *         response="200",
     *         description="User Subscribe to channel Successful",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ), 
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *   
     * )
     */
    public function subscribeToChatBot(Request $request)
    {
        $userId = $request->header('user_id');

        if (is_null($userId)) {
            abort(400, 'user id is not provided');
        }
        try {
            $this->provider->subscribeToChatBot($userId);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'User subscribed to chat successfully'], 200);
    }


    /**
     * @OA\PathItem(
     *     path="/twitter/subscribe/channel",
     *      @OA\Get(
     *         summary="User subscribe to channel respond",
     *         description="Get a user id and post with the api",
     *       @OA\Response(
     *         response="200",
     *         description="User Subscribe to channel Successful",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ),
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *     @OA\Post(
     *         summary="Post user id to get user to subscribe to the chat bot",
     *         description="",
     *         @OA\Response(
     *         response="200",
     *         description="User Subscribe to channel Successful",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ), 
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *    
     * )
     */
    public function subscribeToChannel(Request $request)
    {
        $userId = $request->header('user_id');

        if (is_null($userId)) {
            abort(400, 'user id is not provided');
        }
        try {
            $this->provider->subscribeToChannel($userId);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'User subscribed to channel successfully'], 200);
    }


    /**
     * @OA\PathItem(
     *     path="/twitter/subscribers/message",
     *      @OA\Get(
     *         summary="Message sent",
     *         description="Get all user id and send message",
     *       @OA\Response(
     *         response="200",
     *         description="User Subscribe to channel Successful",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ),
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *     @OA\Post(
     *         summary="Message sent to user successfully",
     *         description="",
     *         @OA\Response(
     *         response="200",
     *         description="Message sent successfully",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="User Id Not Found",
     *     ), 
     *    @OA\Response(
     *         response="500",
     *         description="Something went wrong",
     *     ), 
     *     ),
     *    
     * )
     */
    public function sendMessageToSubscribers(Request $request)
    {
        $userId =json_decode($request->header('user_id'));

        if (count($userId) === 0) {
            abort(400, 'user id is not provided');
        }
        try {
            $this->provider->sendMessageToSubscribers($userId);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'Messages sent successfully'], 200);
    }
}
