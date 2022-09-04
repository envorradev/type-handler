<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Compound;

/**
 * CompoundTypeFactory
 *
 * @package  Envorra\TypeHandler\Factories
 *
 * @template TCompound of Compound
 *
 * @extends PrimitiveTypeFactory<TCompound>
 */
class CompoundTypeFactory extends PrimitiveTypeFactory
{
    /**
     * @inheritDoc
     */
    protected static function subType(): string
    {
        return Compound::class;
    }

}
