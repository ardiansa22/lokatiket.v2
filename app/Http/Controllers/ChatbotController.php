<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        // menampilkan halaman khusus chatbot (jika ada)
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        // kirim pesan user ke webhook n8n
        $response = Http::post('https://ferianfellow.app.n8n.cloud/webhook/fecc2cae-0230-41c0-8c4c-1ba3d6b5e253', [
            'message' => $request->input('message'),
            'session_id' => $request->input('session_id') ?? session()->getId(),
        ]);

        return $response->json();
    }
}
