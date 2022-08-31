<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Contracts\Types\NonPrimitive;

/**
 * NonPrimitiveType
 *
 * @package Envorra\TypeHandler\Types\AbstractTypes
 *
 * @template TNonPrimitive
 *
 * @extends AbstractType<TNonPrimitive>
 * @implements NonPrimitive<TNonPrimitive>
 */
abstract class NonPrimitiveType extends AbstractType implements NonPrimitive
{
    /**
     * @inheritDoc
     */
    public function toPrimitive(): Primitive
    {
        // TODO: Implement toPrimitive() method.
    }
}
