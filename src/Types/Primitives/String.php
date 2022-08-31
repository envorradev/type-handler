<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Envorra\TypeHandler\Types\AbstractTypes\AbstractType;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * StringType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends AbstractType<string>
 */
final class String extends AbstractType implements StringContract
{
    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return true;
    }
}
