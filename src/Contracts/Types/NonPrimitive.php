<?php

namespace Envorra\TypeHandler\Contracts\Types;

/**
 * NonPrimitive
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template TNonPrimitive
 *
 * @extends Type<TNonPrimitive>
 */
interface NonPrimitive extends Type
{
    /**
     * @param  Primitive  $primitive
     * @return self
     */
    public static function fromPrimitive(Primitive $primitive): self;

    /**
     * @return class-string<Primitive>
     */
    public static function primitiveType(): string;

    /**
     * @return Primitive
     */
    public function toPrimitive(): Primitive;
}
