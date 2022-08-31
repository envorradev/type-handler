<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Types\Primitives\String;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * PrimitiveType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @template TPrimitive
 *
 * @extends AbstractType<TPrimitive>
 * @implements \Envorra\TypeHandler\Contracts\Types\Primitive<TPrimitive>
 */
abstract class PrimitiveType extends AbstractType implements Primitive
{
    /**
     * @inheritDoc
     */
    public function toString(): StringContract
    {
        return String::from((string) $this->getValue());
    }
}
