<?php

namespace App\Helpers;

class LanguageHelper
{
    /**
    * Get hreflang meta tags for current URL
    *
    * @return string
    */
    public static function getHreflangTags()
    {
        $currentUrl = url()->current();
        $tags = '';

        foreach (config('app.available_locales') as $locale => $language) {
            $tags .= '<link rel="alternate" hreflang="' . $locale . '"href="' . $currentUrl . '?lang=' . $locale . '">' . "\n";
        }

        // Add x-default hreflang
        $tags .= '<link rel="alternate" hreflang="x-default" href="' . $currentUrl . '">' . "\n";

        return $tags;
    }
}