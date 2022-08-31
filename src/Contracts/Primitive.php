<?php

namespace Envorra\TypeHandler\Contracts;

/**
 * @Primitive
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template TPrimitive
 *
 * @extends Type<TPrimitive>
 */
interface Primitive extends Type
{
    /**
     * @return StringTypeContract
     */
    public function toString(): StringTypeContract;
}
