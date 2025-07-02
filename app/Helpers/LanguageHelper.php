<?php

namespace App\Helpers;

// This helper class provides language-related utilities for the application
class LanguageHelper
{
    /**
    * Generate hreflang meta tags for the current URL
    *
    * @return string HTML meta tags for alternate languages
    */
    public static function getHreflangTags()
    {
        // Get the current URL
        $currentUrl = url()->current();
        $tags = '';

        // Loop through all available locales and generate hreflang tags
        foreach (config('app.available_locales') as $locale => $language) {
            $tags .= '<link rel="alternate" hreflang="' . $locale . '"href="' . $currentUrl . '?lang=' . $locale . '">' . "\n";
        }

        // Add x-default hreflang for default language
        $tags .= '<link rel="alternate" hreflang="x-default" href="' . $currentUrl . '">' . "\n";

        // Return the generated tags as a string
        return $tags;
    }
}