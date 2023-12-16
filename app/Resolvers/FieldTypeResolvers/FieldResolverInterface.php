<?php

namespace App\Resolvers\FieldTypeResolvers;

interface FieldResolverInterface
{
    public function set($value, $field = null);
    public function get($value, $field = null, $isFormatted = true, $current_instance = null);
}
