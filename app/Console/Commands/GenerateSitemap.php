<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap';

    public function handle()
    {
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();
        
        // Add multilingual support to main pages
        $pages = [
            '/',
            '/company',
            '/brand',
            '/products',
            '/recipes',
            '/careerinfo',
            '/vacancies'
        ];

        foreach ($pages as $page) {
        $url = Url::create(url($page))
        ->addAlternate(url($page) . '?lang=id', 'id')
        ->addAlternate(url($page) . '?lang=en', 'en');

        $sitemap->add($url);
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated successfully.');
    }
}