<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Scalar;

/**
 * ScalarFactory
 *
 * @package Envorra\TypeHandler\Factories
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
    protected function classSubType(): string
    {
        return Scalar::class;
    }

}
