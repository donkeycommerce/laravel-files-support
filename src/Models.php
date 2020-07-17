<?php

namespace DonkeyCommerce\Support\Files;

use DonkeyCommerce\Support\Files\Contracts\ResourceContract;

class Models extends Resource implements ResourceContract
{
    /**
     * @inheritedDoc
     */
    protected static $folder = 'Models';

    /**
     * @inheritedDoc
     */
    public static function all(): array
    {
        $files = array_merge(
            scandir(app_path()),
            static::hasFolder() ? scandir(app_path(static::$folder)) : []
        );

        return static::getPhpFiles($files);
    }
    
    /**
     * Get model name from controller.
     * If controller is PostController, model will be Post
     *
     * @return void
     */
    final protected function deduce($from = 'controller', $class)
    {
        $model = Str::replaceFirst(
            $from, 
            '', 
            Str::lower(
                class_basename($controller)
            )
        );

        if (class_exists(static::getNamespace() . '\\' . ucfirst($model))) {
            return static::getNamespace() . '\\' . ucfirst($model);
        } else {
            return null;
        }
    }

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
     * Get namespace for models.
     * 
     * @author Daniele Tulone <danieletulone.work@gmail.com>
     *
     * @return void
     */
    public static function getNamespace()
    {
        return static::hasFolder() 
               ? app()->getNamespace() . '\\' . static::$folder 
               : app()->getNamespace();
    }
}