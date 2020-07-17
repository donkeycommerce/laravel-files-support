<?php

namespace DonkeyCommerce\Support\Files;

use DonkeyCommerce\Support\Files\Contracts\ResourceContract;

class Migrations extends Resource implements ResourceContract
{
    /**
     * @inheritedDoc
     */
    public static function hasFolder(): bool
    {
        try {
            scandir(database_path('migrations'));
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