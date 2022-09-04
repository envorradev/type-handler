<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Scalar;

/**
 * ScalarTypeFactory
 *
 * @package  Envorra\TypeHandler\Factories
 *
 * @template TScalar of Scalar
 *
 * @extends PrimitiveTypeFactory<TScalar>
 */
class ScalarTypeFactory extends PrimitiveTypeFactory
{
    /**
     * @inheritDoc
     */
    protected static function subType(): string
    {
        return Scalar::class;
    }

}
