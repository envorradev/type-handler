<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Primitive;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Contracts\StringTypeContract;

/**
 * PrimitiveType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @template TPrimitive
 *
 * @extends AbstractType<TPrimitive>
 * @implements Primitive<TPrimitive>
 */
abstract class PrimitiveType extends AbstractType implements Primitive
{
    /**
     * @inheritDoc
     */
    public function toString(): StringTypeContract
    {
        return StringType::from($this->getValue());
    }
}
