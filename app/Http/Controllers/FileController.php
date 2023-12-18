<?php

namespace App\Http\Controllers;

use App\Helpers\EntityValueFileHelper;
use App\Http\Requests\FileRequest;
use App\Http\Resources\EntityValueResource;
use App\Models\Entity;
use App\Models\EntityValue;
use App\Repositories\EntityValueRepository;
use App\Services\EntityValueService;
use App\Services\FieldTypeService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController
{
    public function list($dir) {
        return EntityValueFileHelper::fileList($dir);
    }

    public function index(Entity $entity, string $recordId, string $field): mixed {
        $entity_table = "table_" . $entity->hash;
        $service = new EntityValueService($entity_table);
        return array_values($service->getRecord($entity, $recordId))[0][$field];
    }

    public function show(FileRequest $request, Entity $entity, string $recordId, string $field): BinaryFileResponse {
        $file = $request->input('file');
        $path = Storage::disk('public')->path($file);
        return response()->download($path, basename(EntityValueFileHelper::getOriginalName($file)));
    }

    public function destroy(FileRequest $request, Entity $entity, string $recordId, string $field): EntityValue|bool {
        $oldFile = $request->input('file');

        $result = EntityValueFileHelper::removeFileFromStorage($oldFile);

        if($result) {
            return EntityValueFileHelper::fileRecordModification($entity, $recordId, $field, $oldFile, null);
        } else {
            return $result;
        }
    }

    public function update(FileRequest $request, Entity $entity, string $recordId, string $field): false|EntityValue {
        $oldFile = $request->input('oldFile');

        $file = EntityValueFileHelper::addFileToStorage($request[$field]);
        $result = EntityValueFileHelper::removeFileFromStorage($oldFile);

        if($file && $result) {
            return EntityValueFileHelper::fileRecordModification($entity, $recordId, $field, $oldFile, $file);
        } else {
            return false;
        }
    }

    public function store(FileRequest $request, Entity $entity, string $recordId, string $field): false|EntityValue  {
        $file = EntityValueFileHelper::addFileToStorage($request[$field]);

        if($file) {
            return EntityValueFileHelper::fileRecordModification($entity, $recordId, $field, null, $file);
        } else {
            return false;
        }
    }
}
