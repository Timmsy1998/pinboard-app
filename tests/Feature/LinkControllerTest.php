<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LinkControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_all_links()
    {
        Link::factory()->create([
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => 1,
        ]);

        $response = $this->getJson('/api/links');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'url' => 'https://example.com',
                'title' => 'Example Link',
                'comments' => 'This is an example link.',
                'tags' => 'laravel vue',
                'is_valid' => 1,
            ]);
    }

    #[Test]
    public function it_filters_links_by_tags()
    {
        Link::factory()->create([
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => 1,
        ]);

        Link::factory()->create([
            'url' => 'https://another-example.com',
            'title' => 'Another Example Link',
            'comments' => 'This is another example link.',
            'tags' => 'php api',
            'is_valid' => 1,
        ]);

        $response = $this->getJson('/api/links?tags[]=laravel&tags[]=vue');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'url' => 'https://example.com',
                'title' => 'Example Link',
                'comments' => 'This is an example link.',
                'tags' => 'laravel vue',
                'is_valid' => 1,
            ]);
    }
}
