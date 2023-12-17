<?php

namespace App\Resolvers\FieldTypeResolvers;

use App\Data\EntityValueFieldGetData;

interface FieldResolverInterface
{
    public function set($value, $field = null);
    public function get(EntityValueFieldGetData $data);
}
