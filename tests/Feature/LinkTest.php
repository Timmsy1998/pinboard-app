<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_link()
    {
        $link = Link::create([
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => true,
        ]);

        $this->assertDatabaseHas('links', [
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => true,
        ]);
    }
}
