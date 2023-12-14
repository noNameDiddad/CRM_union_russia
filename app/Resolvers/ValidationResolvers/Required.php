<?php

namespace App\Resolvers\ValidationResolvers;

class Required implements ValidationResolverInterface
{

    public function validate($value, $key, $field): bool
    {
        if ($value === null || $value === '') {
            return false;
        }
        return true;
    }

    public function message($key)
    {
        return "Field {$key} is required";
    }
}
