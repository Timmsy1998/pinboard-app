<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch links from Pinboard and save to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL verification for testing purposes
        ])->get('https://pinboard.in/u:alasdairw?per_page=120');
        $html = $response->body();

        // Parse the HTML and extract the links
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        $bookmarkNodes = $xpath->query('//div[contains(@class, "bookmark")]');

        $tagsToFilter = ['laravel', 'vue', 'vue.js', 'php', 'api'];

        foreach ($bookmarkNodes as $bookmarkNode) {
            $urlNode = $xpath->query('.//a[contains(@class, "bookmark_title")]', $bookmarkNode)->item(0);
            $url = $urlNode ? $urlNode->getAttribute('href') : null;
            $title = $urlNode ? $urlNode->nodeValue : null;
            $tagsNode = $xpath->query('.//a[contains(@class, "tag")]', $bookmarkNode);
            $tags = [];
            foreach ($tagsNode as $tagNode) {
                $tags[] = $tagNode->nodeValue;
            }
            $commentsNode = $xpath->query('.//div[contains(@class, "description")]', $bookmarkNode)->item(0);
            $comments = $commentsNode ? $commentsNode->nodeValue : null;

            // Check if the link has any of the specified tags
            $hasValidTag = false;
            foreach ($tags as $tag) {
                if (in_array($tag, $tagsToFilter)) {
                    $hasValidTag = true;
                    break;
                }
            }

            if ($hasValidTag) {
                // Check if the URL is valid/live
                $isValid = $this->checkUrl($url);

                // Save to database
                Link::updateOrCreate(
                    ['url' => $url],
                    ['title' => $title, 'tags' => implode(' ', $tags), 'comments' => $comments, 'is_valid' => $isValid]
                );
            }

            $this->info('Links fetched and saved successfully.');
        }
    }

    private function checkUrl($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') !== false;
    }
}
