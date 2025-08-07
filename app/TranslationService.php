<?php

namespace App;

interface TranslationService
{
    //
    public function translate(string $text, string $fromLocale, string $toLocale): string;
}
