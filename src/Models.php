<?php

namespace DanieleTulone\Support\Files;

use DanieleTulone\Support\Files\Contracts\ResourceContract;
use Illuminate\Support\Str;

class Models implements ResourceContract
{
    /**
     * @inheritedDoc
     */
    protected static $folder = 'Models';

    /**
     * @inheritedDoc
     */
    public static function hasFolder(): bool
    {
        try {
            scandir(app_path('Models'));
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @inheritedDoc
     */
    public static function get(): array
    {
        $files = array_merge(
            scandir(app_path()),
            static::hasFolder() ? scandir(app_path(static::$folder)) : []
        );

        return array_values(array_filter($files, function($item) {
            if (in_array($item, ['.', '..']) || !Str::contains($item, '.php')) {
                return false;
            }
            
            return true;
        }));
    }
}