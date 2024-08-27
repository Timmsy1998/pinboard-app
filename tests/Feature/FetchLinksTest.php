<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class FetchLinksTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_fetches_and_saves_links()
    {
        Http::fake([
            'https://pinboard.in/u:alasdairw?per_page=120' => Http::response('<html><body><div class="bookmark"><a class="bookmark_title" href="https://example.com">Example Link</a><a class="tag">laravel</a><a class="tag">vue</a><div class="description">This is an example link.</div></div></body></html>', 200),
        ]);

        Artisan::call('app:fetch-links');

        $this->assertDatabaseHas('links', [
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => true,
        ]);
    }
}
