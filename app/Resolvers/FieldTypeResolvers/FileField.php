<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Helpers\EntityValueFileHelper;


class FileField implements FieldResolverInterface
{
    public function set($value): ?array
    {

        $paths = [];
        if(is_array($value)) {
            foreach ($value as $file) {
                $paths[] = EntityValueFileHelper::addFile($file);
            }
        } else {
            $paths[] = EntityValueFileHelper::addFile($value);
        }

        return $paths;
    }

    public function get($value, $field = null, $isFormatted = true): ?array
    {
        $fileArr = [];
        foreach ($value as $file) {
            $xmlFile = pathinfo($file);
            if (str_contains($xmlFile['basename'], '_')) {
                $parseName = explode('_', $xmlFile['basename']);
                array_shift($parseName);
                $fileArr += [implode('_', $parseName) => $file];
            } else {
                $fileArr += [$xmlFile['basename'] => $file];
            }

        }

        return $fileArr;
    }
}


