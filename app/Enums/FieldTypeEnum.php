<?php

namespace App\Enums;

enum FieldTypeEnum: string
{
    case String = 'string';
    case Object = 'object';
    case Integer = 'integer';
    case File = 'file';
    case User = 'user';
    case Generate = 'generate';
    case Users = 'users';
    case Timestamps = 'timestamps';
    case Select = 'select';
    case MultiSelect = 'multi_select';
    case Boolean = 'boolean';
    case BelongsTo = 'belongs_to';
    case Child = 'child';
    case Address = 'address';
    case Stage = 'stage';
    case Relation = 'relation';
    case ManyRelation = 'many_relation';
    case Priority = 'priority';
    case PhoneNumber = 'phone_number';
    case Email = 'email';
}
