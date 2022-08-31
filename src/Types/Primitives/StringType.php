<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\TypeHandler\Contracts\Types\StringContract;
use Envorra\TypeHandler\Types\AbstractTypes\PrimitiveType;

/**
 * StringType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends PrimitiveType<string>
 */
final class StringType extends PrimitiveType implements StringContract
{
    /**
     * @inheritDoc
     */
    public function __construct(mixed $value = null)
    {
        if($value instanceof Type) {
            $value = (string) $value;
        }

        parent::__construct($value);
    }

    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function toString(): StringContract
    {
        return $this;
    }
}
