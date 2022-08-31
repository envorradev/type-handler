<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Compound;

/**
 * CompoundType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @template TCompound
 *
 * @extends PrimitiveType<TCompound>
 * @implements Compound<TCompound>
 */
abstract class CompoundType extends PrimitiveType implements Compound
{

}
