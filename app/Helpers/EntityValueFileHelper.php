<?php

namespace App\Helpers;

use App\Enums\FieldTypeEnum;
use App\Models\EntityFieldFixedValue;
use App\Models\User;
use App\Repositories\EntityFieldRepository;
use App\Services\EntityValueService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class EntityValueFileHelper
{
    public static function addFile($file): ?string
    {
        $date = Carbon::now();
        $date->setTimezone('Europe/Moscow');
        $timeInMilliseconds = $date->valueOf();
        $timeInDays = ceil($timeInMilliseconds / 1000 / 60 / 60 / 24);

        $path = null;
        if (method_exists($file, 'getClientOriginalName')) {
            $fileName = $timeInMilliseconds . '_' . $file->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('/files/' . $timeInDays, $file, $fileName);
        } else {
            $path = $file;
        }

        return $path;
    }
}
