<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Models\EntityFieldFixedValue;

class FileField implements FieldResolverInterface
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function set($value): ?array
    {
        $date = Carbon::now();
        $date->setTimezone('Europe/Moscow');
        $timeInMilliseconds = $date->valueOf();
        $timeInDays = ceil($timeInMilliseconds / 1000 / 60 / 60 / 24);

        $paths = [];
        foreach ($value as $file) {
            $fileName = $timeInMilliseconds . '_' . $file->getClientOriginalName();

            $path = Storage::disk('public')->putFileAs('/files/' . $timeInDays, $file, $fileName);
            $paths[] = $path;
        }
        return $paths;
    }

    public function get($value, $field = null): ?array
    {
        $fileArr = [];
        foreach ($value as $file) {
            $xmlFile = pathinfo($file);
            $fileArr += [explode('_', $xmlFile['basename'])[1] => $file];
        }

        return $fileArr;
    }
}
