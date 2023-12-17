<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Str;
#[MapName(SnakeCaseMapper::class)]
class FieldFilterData extends Data
{
    public function __construct(
        public ?string $id,
        public string $entityId,
        public string $name,
        public array $fields
    )
    {
    }
}