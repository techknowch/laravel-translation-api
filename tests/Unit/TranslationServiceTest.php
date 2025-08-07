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

    public function testTranslatePerformance()
    {
        $service = new BasicTranslationService();
        $start = microtime(true);
        for ($i = 0; $i < 1000; $i++) {
            $service->translate('Hello', 'en', 'ur');
        }
        $end = microtime(true);
        $this->assertLessThan(0.5, $end - $start); // < 500ms for 1000 calls
    }
}
