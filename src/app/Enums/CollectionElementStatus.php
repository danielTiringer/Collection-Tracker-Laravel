<?php

namespace App\Enums;

enum CollectionElementStatus: int
{
    case PLANNED = 0;
    case OWNED = 1;

    public function isPlanned(): bool
    {
        return $this === self::PLANNED;
    }

    public function isOwned(): bool
    {
        return $this === self::OWNED;
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::PLANNED => 'Planned',
            self::OWNED => 'Owned',
        };
    }
}
