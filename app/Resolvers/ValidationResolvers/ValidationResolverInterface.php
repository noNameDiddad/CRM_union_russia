<?php

namespace App\Resolvers\ValidationResolvers;

interface ValidationResolverInterface
{
    public function validate($value, $key, $field);
    public function message($key);
}
