<?php

namespace App\Resolvers\FieldTypeResolvers;

interface FieldResolverInterface
{
    public function resolve();
    public function validate();
}
