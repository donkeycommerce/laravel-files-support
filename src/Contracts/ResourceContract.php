<?php

namespace DanieleTulone\Support\Files\Contracts;

interface ResourceContract
{
    /**
     * Determinate if there is the folder for specific resource type.
     * 
     * @author Daniele Tulone <danieletulone.work@gmail.com>
     *
     * @return boolean
     */
    public static function hasFolder(): bool;

    /**
     * Get all files of current resource type.
     *
     * @author Daniele Tulone <danieletulone.work@gmail.com>
     * 
     * @return array
     */
    public static function all(): array;
}