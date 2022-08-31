<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Envorra\TypeHandler\Contracts\StringTypeContract;
use Envorra\TypeHandler\Types\AbstractTypes\AbstractType;

/**
 * StringType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends AbstractType<string>
 */
final class StringType extends AbstractType implements StringTypeContract
{
    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return true;
    }
}
