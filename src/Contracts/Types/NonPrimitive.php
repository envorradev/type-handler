<?php

namespace Envorra\TypeHandler\Contracts\Types;

/**
 * NonPrimitive
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template TNonPrimitive
 *
 * @extends Type<TNonPrimitive>
 */
interface NonPrimitive extends Type
{
    /**
     * @return Primitive
     */
    public function toPrimitive(): Primitive;
}
