<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Str;
#[MapName(SnakeCaseMapper::class)]
class EntityFieldFixedValueData extends Data
{
    public function __construct(
        public ?string $id,
        public string $entity_field_id,
        public string $value
    )
    {
    }
}