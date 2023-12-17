<?php

namespace App\Resolvers\ValidationResolvers;

use App\Services\EntityService;
use App\Services\EntityValueService;

class IssetRelation implements ValidationResolverInterface
{

    public function validate($value, $key, $field): bool
    {
        $service = new EntityValueService(EntityService::getByHash($field['relateTo']));

        if ($service->find($value) == null)  {
            return false;
        }
        return true;
    }

    public function message($key)
    {
        return "Not found relation for field {$key}";
    }
}
