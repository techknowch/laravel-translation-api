<?php

namespace App\Services;

class BasicTranslationService
{
    private array $translations = [
        'Hello' => 'ہیلو',
        'Goodbye' => 'الوداع',
        // Add more mappings as needed
    ];

    public function translate(string $text, string $fromLocale, string $toLocale): string
    {
        if ($fromLocale === 'en' && $toLocale === 'ur') {
            return $this->translations[$text] ?? $text; // Return mapped Urdu or original if not found
        }

        return $text;
    }
}