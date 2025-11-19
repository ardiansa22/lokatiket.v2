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
        $response = Http::post('https://dianadevi239.app.n8n.cloud/webhook/5b01e659-4fae-48d9-bd9b-bd5db50d3b22', [
            'message' => $request->input('message'),
            'session_id' => $request->input('session_id') ?? session()->getId(),
        ]);

        return $response->json();
    }
}
