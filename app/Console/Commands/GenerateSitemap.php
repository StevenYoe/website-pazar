<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

// This command is used to automatically generate sitemap.xml
// The sitemap helps search engines index the main pages of the website
class GenerateSitemap extends Command
{
    // Defines the artisan command signature and a short description
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap';

    // The main function executed when the command is called
    public function handle()
    {
        // Create a sitemap object from the main website URL
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();
        
        // Add multilingual support to the main pages
        $pages = [
            '/',
            '/company',
            '/brand',
            '/products',
            '/recipes',
            '/careerinfo',
            '/vacancies'
        ];

        // For each main page, add Indonesian and English versions
        foreach ($pages as $page) {
            $url = Url::create(url($page))
                ->addAlternate(url($page) . '?lang=id', 'id')
                ->addAlternate(url($page) . '?lang=en', 'en');

            $sitemap->add($url);
        }

        // Save the sitemap to sitemap.xml in the public folder
        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated successfully.');
    }
}