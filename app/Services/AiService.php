<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiService
{
    /**
     * Generate narrative recommendation based on text prompt.
     *
     * @param string $prompt
     * @return string
     */
    public function generateRecommendation(string $prompt): string
    {
        $provider = config('services.ai_provider', 'gemini');

        if ($provider === 'openrouter') {
            return $this->callOpenRouter($prompt);
        }

        return $this->callGemini($prompt);
    }

    /**
     * Call Google Gemini API
     */
    protected function callGemini(string $prompt): string
    {
        $apiKey = config('services.gemini.key');
        $apiUrl = config('services.gemini.url', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent');

        if (empty($apiKey)) {
            Log::warning('Gemini API key is not configured.');
            return 'Error: Gemini API Key tidak dikonfigurasi di file .env Anda.';
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($apiUrl . '?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Gagal memproses respons dari Gemini AI.';
            }

            Log::error('Gemini API Error: ' . $response->body());
            return 'Error: Gagal menghubungi Gemini API. Code: ' . $response->status() . '. Detail: ' . $response->json('error.message', 'Unknown error');
        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            return 'Exception: Terjadi kesalahan saat memanggil Gemini API: ' . $e->getMessage();
        }
    }

    /**
     * Call OpenRouter API
     */
    protected function callOpenRouter(string $prompt): string
    {
        $apiKey = config('services.openrouter.key');
        $model = config('services.openrouter.model', 'google/gemini-2.5-flash');
        $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';

        if (empty($apiKey)) {
            Log::warning('OpenRouter API key is not configured.');
            return 'Error: OpenRouter API Key tidak dikonfigurasi di file .env Anda.';
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['choices'][0]['message']['content'] ?? 'Gagal memproses respons dari OpenRouter.';
            }

            Log::error('OpenRouter API Error: ' . $response->body());
            return 'Error: Gagal menghubungi OpenRouter API. Code: ' . $response->status() . '. Detail: ' . $response->json('error.message', 'Unknown error');
        } catch (\Exception $e) {
            Log::error('OpenRouter Service Exception: ' . $e->getMessage());
            return 'Exception: Terjadi kesalahan saat memanggil OpenRouter API: ' . $e->getMessage();
        }
    }
}
