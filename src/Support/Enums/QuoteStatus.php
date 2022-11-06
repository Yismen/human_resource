<?php

namespace  Dainsys\HumanResource\Support\Enums;

use Illuminate\Support\Arr;

final class QuoteStatus implements EnumContract
{
    public const DRAFT = 'draft';
    public const PENDING = 'pending';
    public const APROVED = 'aproved';
    public const INVOICED = 'human_resourced';
    public const CANCELLED = 'cancelled';

    public static function associated(): array
    {
        return [
            self::DRAFT => self::DRAFT,
            self::PENDING => self::PENDING,
            self::APROVED => self::APROVED,
            self::INVOICED => self::INVOICED,
            self::CANCELLED => self::CANCELLED,
        ];
    }

    public static function all(): array
    {
        return Arr::flatten(self::associated());
    }
}
