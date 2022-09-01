<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Types\Primitives\ObjectType;
use Envorra\TypeHandler\Contracts\Types\NonPrimitive;

/**
 * NonPrimitiveType
 *
 * @package Envorra\TypeHandler\Types\AbstractTypes
 *
 * @template TNonPrimitive
 *
 * @extends AbstractType<TNonPrimitive>
 * @implements NonPrimitive<TNonPrimitive>
 */
abstract class NonPrimitiveType extends AbstractType implements NonPrimitive
{
    /**
     * @inheritDoc
     */
    public function toPrimitive(): Primitive
    {
        return static::primitiveType()::make($this);
    }

    /**
     * @inheritDoc
     */
    protected function castIncomingValue(mixed $value): mixed
    {
        $class = static::objectClass();
        return new $class($value);
    }

    /**
     * @inheritDoc
     */
    public static function fromPrimitive(Primitive $primitive): NonPrimitive
    {
        return static::make($primitive);
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    protected function isIncomingValueCorrectType(mixed $value): bool
    {
        return gettype($value) === static::primitiveType()::type() && $this->additionalTypeCheck($value);
    }

    /**
     * @inheritDoc
     */
    protected function additionalTypeCheck(mixed $value): bool
    {
        return get_class($value) === static::objectClass();
    }

    /**
     * @return string|null
     */
    public static function objectClass(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public static function primitiveType(): string
    {
        return ObjectType::class;
    }
}
