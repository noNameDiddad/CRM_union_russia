<?php

namespace App\Helpers;

use MongoDB\Laravel\Eloquent\Model;
use Str;

class FormatterHelper
{
    public static function getShortOutput(Model $instance, $shortOutput): string
    {
        $values = Str::of($shortOutput)
            ->matchAll('/\{(.*?)\}/');

        $editedData = [];
        foreach ($values as $value) {
            $editedData[$value] = $instance[Str::slug($value)];
        }

        $shortOutput = Str::remove(['{', '}'], $shortOutput);

        return strtr($shortOutput, $editedData);

    }
}