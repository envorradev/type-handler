<?php

namespace Envorra\TypeHandler\Contracts\Types;

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
     * @return StringContract
     */
    public function toString(): StringContract;
}
