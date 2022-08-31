<?php

namespace Envorra\TypeHandler\Types;

use Carbon\Carbon;
use Envorra\TypeHandler\Types\AbstractTypes\NonPrimitiveType;

/**
 * CarbonType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends NonPrimitiveType<Carbon>
 */
class CarbonType extends NonPrimitiveType
{
    /**
     * @inheritDoc
     */
    public static function objectClass(): ?string
    {
        return Carbon::class;
    }
}
