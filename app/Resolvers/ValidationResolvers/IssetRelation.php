<?php

namespace App\Resolvers\ValidationResolvers;

use App\Services\EntityValueService;

class IssetRelation implements ValidationResolverInterface
{

    public function validate($value, $key, $field): bool
    {
        $entity_table = "table_" . $field['relateTo'];
        $service = new EntityValueService($entity_table);
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
