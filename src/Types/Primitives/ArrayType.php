<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Envorra\TypeHandler\Helpers\ArrayHelper;
use Envorra\TypeHandler\Types\AbstractTypes\CompoundType;

/**
 * ArrayType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends CompoundType<array>
 */
final class ArrayType extends CompoundType
{
    /**
     * @inheritDoc
     */
    protected function castIncomingValue(mixed $value): array
    {
        return ArrayHelper::from($value);
    }
}
