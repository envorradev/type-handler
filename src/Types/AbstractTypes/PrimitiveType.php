<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * PrimitiveType
 *
 * @package  Envorra\TypeHandler\Types
 *
 * @template TPrimitive
 *
 * @extends AbstractType<TPrimitive>
 * @implements Primitive<TPrimitive>
 */
abstract class PrimitiveType extends AbstractType implements Primitive
{
    /**
     * @inheritDoc
     */
    public function toString(): StringContract
    {
        return StringType::make($this);
    }

    /**
     * @inheritDoc
     */
    protected function castIncomingValue(mixed $value): mixed
    {
        settype($value, static::type());
        return $value;
    }
}
