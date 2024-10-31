<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Illuminate\Http\Request;

class PostYoutubeController extends Controller
{
    public function index()
    {
        return view('content.postYoutube.create');
    }
    public function authenticate()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('youtube.callback'));
        $client->addScope('https://www.googleapis.com/auth/youtube.upload');
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // Redirect ke halaman otorisasi Google
        return redirect()->away($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('youtube.callback'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        $client->setAccessToken($token);

        session(['youtube_access_token' => $token]);

        return redirect('/youtube');
    }

    public function upload(Request $request)
    {
        // Validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,avi,mov|max:204800' // Max 200MB file size
        ]);

        // Simpan video sementara di storage
        $filePath = $request->file('video')->store('videos', 'public');

        $client = new Client();
        $client->setAccessToken(session('youtube_access_token'));

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }

        $youtube = new YouTube($client);

        // Buat objek video dan masukkan metadata dari form
        $video = new YouTube\Video();
        $videoSnippet = new YouTube\VideoSnippet();
        $videoSnippet->setTitle($request->title);
        $videoSnippet->setDescription($request->description);
        $video->setSnippet($videoSnippet);

        $videoStatus = new YouTube\VideoStatus();
        $videoStatus->setPrivacyStatus('public'); // Bisa juga 'private' atau 'unlisted'
        $video->setStatus($videoStatus);

        // Upload video
        $filePath = storage_path('app/public/' . $filePath); // Ambil path lengkap dari video
        $response = $youtube->videos->insert('snippet,status', $video, [
            'data' => file_get_contents($filePath),
            'mimeType' => 'video/*',
            'uploadType' => 'multipart'
        ]);

        // Hapus file sementara setelah upload
        unlink($filePath);

        return response()->json($response);
    }
}
