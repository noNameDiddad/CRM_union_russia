<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
#[MapName(SnakeCaseMapper::class)]
class ChapterData extends Data
{
    public function __construct(
        public ?string $id,
        public string $entityId,
        public string $name,
        public ?array $specialFields,
        public array $fields,
        public int $order,
        public ?bool $isSubEntity = false,
    )
    {
    }
}