<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Envorra\TypeHandler\Types\AbstractTypes\AbstractType;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * StringType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends AbstractType<StringType>
 */
final class StringType extends AbstractType implements StringContract
{
    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return true;
    }
}
