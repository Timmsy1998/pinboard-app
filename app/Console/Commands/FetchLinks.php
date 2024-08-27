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
        $links = $xpath->query('//a[contains(@class, "bookmark_title")]');

        $tagsToFilter = ['laravel', 'vue', 'vue.js', 'php', 'api'];

        foreach ($links as $link) {
            $url = $link->getAttribute('href');
            $title = $link->nodeValue;
            $tags = $link->getAttribute('tags');
            $comments = $link->getAttribute('description');

            // Check if the link has any of the specified tags
            $linkTags = explode(' ', $tags);
            $hasValidTag = false;
            foreach ($linkTags as $tag) {
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
                    ['title' => $title, 'tags' => $tags, 'comments' => $comments, 'is_valid' => $isValid]
                );
            }
        }

        $this->info('Links fetched and saved successfully.');
    }

    private function checkUrl($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') !== false;
    }
}
