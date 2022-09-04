<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Primitive;

/**
 * PrimitiveFactory
 *
 * @package  Envorra\TypeHandler\Factories
 *
 * @template TPrimitive of Primitive
 *
 * @extends TypeFactory<TPrimitive>
 */
class PrimitiveTypeFactory extends TypeFactory
{
    /**
     * @inheritDoc
     */
    protected static function subType(): string
    {
        return Primitive::class;
    }

}
