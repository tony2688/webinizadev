<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiChatQualityTest extends TestCase
{
    public function test_planes_reply_fallback_is_actionable()
    {
        Http::fake(fn() => Http::response([], 502));
        $res = $this->postJson('/api/ai-chat', ['prompt' => 'planes']);
        $res->assertStatus(200);
        $res->assertJsonStructure(['reply']);
        $this->assertStringContainsString('Landing', $res['reply']);
        $this->assertStringContainsString('Portfolio', $res['reply']);
    }

    public function test_contact_reply_uses_site_contacts()
    {
        Http::fake(fn() => Http::response([], 502));
        $res = $this->postJson('/api/ai-chat', ['prompt' => 'contacto']);
        $res->assertStatus(200);
        $this->assertStringContainsString('+54', $res['reply']);
        $this->assertStringContainsString('info@webinizadev.com', $res['reply']);
    }

    public function test_identity_reply_is_correct()
    {
        Http::fake(fn() => Http::response([], 502));
        $res = $this->postJson('/api/ai-chat', ['prompt' => 'sos una ia']);
        $res->assertStatus(200);
        $this->assertStringContainsString('WebinizaDev', $res['reply']);
    }

    public function test_out_of_domain_is_refusal()
    {
        Http::fake(fn() => Http::response([], 502));
        $res = $this->postJson('/api/ai-chat', ['prompt' => 'qué es un gato']);
        $res->assertStatus(200);
        $this->assertStringContainsString('Solo puedo', $res['reply']);
    }
}

