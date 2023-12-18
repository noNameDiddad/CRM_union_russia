<?php

namespace App\Helpers;

use App\Enums\FieldTypeEnum;
use App\Models\Entity;
use App\Models\EntityFieldFixedValue;
use App\Models\EntityValue;
use App\Models\User;
use App\Repositories\EntityFieldRepository;
use App\Repositories\EntityValueRepository;
use App\Services\EntityValueService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class EntityValueFileHelper
{
    private mixed $repository;

    public function __construct($table)
    {
        $this->repository = new EntityValueRepository($table);
    }
    public static function addFileToStorage($file): false|string
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

    public static function removeDir($dir): ?bool
    {
        return Storage::disk('public')->deleteDirectory('/files/' . $dir);
    }

    public static function removeFileFromStorage($filePath): ?bool
    {
        return Storage::disk('public')->delete($filePath);
    }

    public static function replaceInStorage($data, $resolvedData, $entityValue): ?array
    {
        if (isset($data['_method'])) {
            if (isset($data['_deletedFile'])) {
                $keys = array_keys($resolvedData);
                array_shift($keys); // убираем 'entity_id'
                for ($i = 0; $i < count($keys); $i++) {
                    if (isset(array_values($entityValue)[0][$keys[$i]])) {
                        $files = array_values($entityValue)[0][$keys[$i]];
                        for ($j = 0; $j < count($files); $j++) {
                            if ($files[$j] == $data['_deletedFile']) {
                                $files[$j] = $resolvedData[$keys[$i]][0];
                            }
                        }
                        $resolvedData[$keys[$i]] = $files;
                    }
                }
                EntityValueFileHelper::removeFileFromStorage($data['_deletedFile']);
            } else {
                $keys = array_keys($resolvedData);
                array_shift($keys); // убираем 'entity_id'
                for ($i = 0; $i < count($keys); $i++) {
                    if (isset(array_values($entityValue)[0][$keys[$i]])) {
                        $files = array_values($entityValue)[0][$keys[$i]];
                        foreach ($files as $file) {
                            EntityValueFileHelper::removeFileFromStorage($file);
                        }
                    }
                }
            }
        }

        return $resolvedData;
    }

    public static function fileList($dir): ?array
    {
        return Storage::disk('public')->allFiles($dir);
    }

    public function deleteFile($request, $entity, $entity_value)
    {
        $deletedFile = $request->input('_deletedFile');
        $this->removeFileFromStorage($deletedFile);
        dump($deletedFile); //file name
        $deletedField = $request->input('_deletedField');
        dump($deletedField); //field name

        $entityValue = $this->repository->allByEntity($entity)->where('_id', $entity_value)->toArray();
        $data = array_values($entityValue)[0][$deletedField];
        dump($data);
        $key = array_search($deletedFile, $data);
        dump($key);
        array_splice($data, $key, 1);

        $this->repository->update([$deletedField => $data], $entity_value);
        dd($data);
    }

    public static function getOriginalName($file): string {
        $xmlFile = pathinfo($file);
        if (str_contains($xmlFile['basename'], '_')) {
            $parseName = explode('_', $xmlFile['basename']);
            array_shift($parseName);
            $result = implode('_', $parseName);
        } else {
            $result = $xmlFile['basename'];
        }
        return $result;
    }

    public static function fileRecordModification(Entity $entity, string $recordId, string $field, ?string $oldFile, ?string $newFile): EntityValue
    {
        $entity_table = "table_" . $entity->hash;
        $service = new EntityValueService($entity_table);
        $data = array_values($service->getRecord($entity, $recordId))[0][$field];

        // add_file
        if(!$oldFile && $newFile) {
            $data[] = $newFile;
        }
        //delete_file
        if($oldFile && !$newFile) {
            $key = array_search($oldFile, $data);
            array_splice($data, $key, 1);
        }
        //update_file
        if($oldFile && $newFile) {
            $key = array_search($oldFile, $data);
            $data= array_replace($data, [$key => $newFile]);
        }

        return $service->updateFile([$field => $data], $recordId);
    }
}

