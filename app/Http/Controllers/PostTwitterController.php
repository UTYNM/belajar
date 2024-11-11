<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;

class PostTwitterController extends Controller
{
    public function index()
    {
        return view('content.postX.create');
    }

    public function postTweet(Request $request)
    {
        // Retrieve credentials from the environment
        $consumerKey = env('TWITTER_CONSUMER_KEY');
        $consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $accessToken = env('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = env('TWITTER_ACCESS_TOKEN_SECRET');
        // Create a new TwitterOAuth instance
        $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        $connection->setApiVersion('2');
        // Retrieve the tweet text from the request
        $status = $request->input('tweet_text');
        // Check if a media file is uploaded
        $mediaIds = [];
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->getPathname();
            $mediaType = $request->file('media')->getMimeType();

            // Upload the media to Twitter
            $mediaUpload = $connection->upload('media/upload', ['media' => $mediaPath]);

            // Store media ID if upload is successful
            if (isset($mediaUpload->media_id_string)) {
                $mediaIds[] = $mediaUpload->media_id_string;
            }
        }

        // Post the tweet with or without media
        $parameters = ["text" => $status];
        if (!empty($mediaIds)) {
            $parameters['media_ids'] = implode(',', $mediaIds);
        }

        $result = $connection->post("tweets", $parameters);

        // Return the result (or handle errors as necessary)
        return response()->json($result);
    }
}
