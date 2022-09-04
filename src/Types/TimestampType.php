<?php

namespace Envorra\TypeHandler\Types;

use Envorra\TypeHandler\Types\Primitives\IntegerType;
use Envorra\TypeHandler\Types\AbstractTypes\NonPrimitiveType;

/**
 * TimestampType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends NonPrimitiveType<integer>
 */
class TimestampType extends NonPrimitiveType
{
    /**
     * @inheritDoc
     */
    public static function primitiveType(): string
    {
        return IntegerType::class;
    }

    /**
     * @inheritDoc
     */
    protected function additionalTypeCheck(mixed $value): bool
    {
        return $value === strtotime(date('c', $value));
    }

    /**
     * @inheritDoc
     * @noinspection PhpMixedReturnTypeCanBeReducedInspection
     */
    protected function castIncomingValue(mixed $value): mixed
    {
        return strtotime($value);
    }
}
