<?php

namespace Tests\Unit;

use App\Services\BasicTranslationService;
use Tests\TestCase;

class TranslationServiceTest extends TestCase
{
    public function testTranslate()
    {
        $service = new BasicTranslationService();
        $this->assertEquals('ہیلو', $service->translate('Hello', 'en', 'ur'));
        $this->assertEquals('Hello', $service->translate('Hello', 'en', 'en'));
    }
}
