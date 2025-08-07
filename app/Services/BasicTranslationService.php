<?php

namespace App\Services;

use App\Models\Translation;
use App\Models\Language;

class BasicTranslationService
{
    private array $defaultMappings = [
        'en' => [
            'Hello' => 'ہیلو', // Urdu
            'Goodbye' => 'خدا حافظ', // Urdu
            'Hello' => 'Hola', // Spanish (example)
            'Goodbye' => 'Adiós', // Spanish (example)
            'Hello' => 'Bonjour', // French (example)
            'Goodbye' => 'Au revoir', // French (example)
        ],
        'fr' => [
            'Hello' => 'Bonjour',
            'Goodbye' => 'Au revoir',
            'Hello' => 'ہیلو', // Urdu
            'Goodbye' => 'الوداع', // Urdu
            'Hello' => 'Hola', // Spanish (example)
            'Goodbye' => 'Adiós', // Spanish (example)
            'Hello' => 'Bonjour', // French
            'Goodbye' => 'Au revoir', // French
        ],
        'es' => [
            'Hello' => 'Hola',
            'Goodbye' => 'Adiós',
            'Hello' => 'ہیلو', // Urdu
            'Goodbye' => 'الوداع', // Urdu
            'Hello' => 'Bonjour', // French (example)
            'Goodbye' => 'Au revoir', // French (example)
        ],
    ];

    public function translate(string $text, string $fromLocale, string $toLocale): string
    {
        if ($fromLocale === $toLocale) {
            return $text;
        }

        // Check database for existing translation
        $toLanguageId = Language::where('code', $toLocale)->first()->id ?? null;
        if ($toLanguageId) {
            $translation = Translation::where('original_content', $text)
                ->where('language_id', $toLanguageId)
                ->first();

            if ($translation) {
                return $translation->content;
            }
        }

        // Fall back to default mappings
        $fromMappings = $this->defaultMappings[$fromLocale] ?? [];
        return $fromMappings[$text] ?? $text; // Return default or original if no match
    }
}