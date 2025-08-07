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
        ],
        'fr' => [
            'Hello' => 'Bonjour',
            'Goodbye' => 'Au revoir',
        ],
        'es' => [
            'Hello' => 'Hola',
            'Goodbye' => 'Adiós',
        ],
        'ur' => [
            'Hello' => 'ہیلو',
            'Goodbye' => 'خدا حافظ',
        ],
    ];

    public function translate(string $text, string $fromLocale, string $toLocale): string
    {
        if ($fromLocale === $toLocale) {
            return $text;
        }

        // Check database for existing translation
        $toLanguageId = Language::where('code', $toLocale)->first()?->id;
        if ($toLanguageId) {
            $translation = Translation::where('original_content', $text)
                ->where('language_id', $toLanguageId)
                ->first();

            if ($translation) {
                return $translation->content;
            }
        }

        // Fall back to default mappings
        $fromMappings = $this->defaultMappings[$toLocale] ?? [];
        return $this->translateFromMappings($text, $fromMappings);
    }

    private function translateFromMappings(string $text, array $mappings): string
    {
        return $mappings[$text] ?? $text; // Return default or original if no match
    }
}