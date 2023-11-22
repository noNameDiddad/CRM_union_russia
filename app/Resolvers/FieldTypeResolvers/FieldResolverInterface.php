<?php

namespace App\Resolvers\FieldTypeResolvers;

interface FieldResolverInterface
{
    public function set($value);
    public function get($value);
    public function validate();
}