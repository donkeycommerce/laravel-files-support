<?php

namespace DanieleTulone\Support\Files;

use Illuminate\Support\Str;

class Resource
{
    /**
     * Get only php files.
     *
     * @param array $files
     * @return array
     */
    protected static function getPhpFiles(array $files): array
    {
        return array_values(array_filter($files, function($item) {
            if (in_array($item, ['.', '..']) || !Str::contains($item, '.php')) {
                return false;
            }
            
            return true;
        }));
    }
}