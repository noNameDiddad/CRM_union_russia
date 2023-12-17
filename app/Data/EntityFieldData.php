<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Str;
#[MapName(SnakeCaseMapper::class)]
class EntityFieldData extends Data
{
    public function __construct(
        public ?string $id,
        public string $entityId,
        public string $name,
        public string $type,
        public ?string $hash,
        public bool $inStat,
        public ?string $relateTo,
        public ?string $subType,
        public ?array $rules = [],
    )
    {
        if ($this->hash === null) {
            $this->hash = Str::slug($this->name);
        }
    }
}