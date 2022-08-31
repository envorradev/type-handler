<?php

namespace Envorra\TypeHandler\Contracts;

/**
 * @Type
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template TDataType
 *
 * @extends Primitive<TDataType>
 */
interface Type extends Primitive
{
    /**
     * @return Primitive
     */
    public function toPrimitive(): Primitive;
}
