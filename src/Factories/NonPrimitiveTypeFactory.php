<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\NonPrimitive;

/**
 * NonPrimitiveTypeFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @template TNonPrimitive of NonPrimitive
 *
 * @extends TypeFactory<TNonPrimitive>
 */
class NonPrimitiveTypeFactory extends TypeFactory
{
    /**
     * @inheritDoc
     */
    protected function classSubType(): string
    {
        return NonPrimitive::class;
    }
}
