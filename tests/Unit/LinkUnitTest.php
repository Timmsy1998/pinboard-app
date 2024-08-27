<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Link;

class LinkUnitTest extends TestCase
{
    public function test_it_can_create_a_link()
    {
        // Create a new Link instance
        $link = new Link([
            'url' => 'https://example.com',
            'title' => 'Example Link',
            'comments' => 'This is an example link.',
            'tags' => 'laravel vue',
            'is_valid' => true,
        ]);

        // Assert that the link attributes are set correctly
        $this->assertEquals('https://example.com', $link->url);
        $this->assertEquals('Example Link', $link->title);
        $this->assertEquals('This is an example link.', $link->comments);
        $this->assertEquals('laravel vue', $link->tags);
        $this->assertTrue($link->is_valid);
    }
}
