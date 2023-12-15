<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Str;
#[MapName(SnakeCaseMapper::class)]
class EntityData extends Data
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?string $hash,
        public bool $isSubEntity,
        public bool $isKanban,
        public ?string $shortOutput,
    )
    {
    }
}