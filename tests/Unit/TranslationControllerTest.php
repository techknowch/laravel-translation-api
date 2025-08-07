<?php

namespace Tests\Unit;

use App\Http\Controllers\TranslationController;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Tests\TestCase;

class TranslationControllerTest extends TestCase
{
    public function testIndex()
    {
        $language = Language::factory()->create();
        Translation::factory()->create(['language_id' => $language->id]);
        $response = $this->getJson('/api/translations');
        $response->assertStatus(200)->assertJsonCount(1);
    }

    public function testStore()
    {
        $language = Language::factory()->create();
        $data = ['key' => 'test', 'content' => 'Test', 'language_id' => $language->id];
        $response = $this->postJson('/api/translations', $data);
        $response->assertStatus(201)->assertJson($data);
    }
}
