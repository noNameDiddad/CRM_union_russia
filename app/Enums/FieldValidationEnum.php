<?php

namespace App\Enums;

enum FieldValidationEnum: string
{
    case Required = 'required';
    case IssetRelation = 'issetRelation';
}
