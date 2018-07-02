<?php
namespace App\Traits;

/**
 *
 */
trait CreateSlug
{
    function CreateSlug($string)
    {
        $slug = str_replace(' ', '-', strtolower($string));
        return $slug;
    }
}
