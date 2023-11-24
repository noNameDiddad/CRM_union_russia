<?php

namespace App\Enums;

enum FieldTypeEnum: string
{
    case String = 'string';
    case File = 'file';
    case Date = 'date';
    case Select = 'select';
    case MultiSelect = 'multi_select';
    case Boolean = 'boolean';
}
