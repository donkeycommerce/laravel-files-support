<?php

namespace DonkeyCommerce\Support\Files;

use DonkeyCommerce\Support\Files\Contracts\ResourceContract;

class Models extends Resource implements ResourceContract
{
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

        return static::getPhpFiles($files);
    }
}