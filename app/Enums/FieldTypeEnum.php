<?php

namespace App\Enums;

enum FieldTypeEnum: string
{
    case String = 'string';
    case Integer = 'integer';
    case File = 'file';
    case User = 'user';
    case Timestamps = 'timestamps';
    case Select = 'select';
    case MultiSelect = 'multi_select';
    case Boolean = 'boolean';
    case Relation = 'relation';
}
