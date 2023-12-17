<?php

namespace App\Data;

use App\Models\Entity;
use App\Models\EntityValue;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
#[MapName(SnakeCaseMapper::class)]
class EntityValueFieldGetData extends Data
{
    public function __construct(
        public array $field,
        public string $value,
        public ?Entity $entity = null,
        public ?EntityValue $currentEntityValue = null,
        public ?bool $isFormatted = false,
    )
    {
    }
}