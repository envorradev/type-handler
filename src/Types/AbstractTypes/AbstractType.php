<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use ReflectionClass;
use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\TypeHandler\Contracts\Types\Scalar;
use Envorra\TypeHandler\Contracts\Types\Compound;
use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Contracts\Types\NonPrimitive;

/**
 * AbstractType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @template T
 *
 * @implements Type<T>
 */
abstract class AbstractType implements Type
{
    protected mixed $original;

    protected ReflectionClass $reflection;

    /**
     * @inheritDoc
     */
    public function __construct(protected mixed $value = null) {
        $this->original = $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getOriginal(): mixed
    {
        return $this->original;
    }

    /**
     * @inheritDoc
     */
    public function isPrimitive(): bool
    {
        return $this->reflection()->implementsInterface(Primitive::class);
    }

    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return $this->reflection()->implementsInterface(Scalar::class);
    }

    /**
     * @inheritDoc
     */
    public function isCompound(): bool
    {
        return $this->reflection()->implementsInterface(Compound::class);
    }

    /**
     * @inheritDoc
     */
    public function isNonPrimitive(): bool
    {
        return $this->reflection()->implementsInterface(NonPrimitive::class);
    }

    /**
     * @inheritDoc
     */
    public function is(Type|string|null $type = null): bool
    {
        return get_class($this) === get_class($type);
    }

    /**
     * @inheritDoc
     */
    public function isIn(array $types = []): bool
    {
        foreach($types as $type) {
            if($this->is($type)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return ReflectionClass
     */
    protected function reflection(): ReflectionClass
    {
        $this->reflection ??= new ReflectionClass($this);
        return $this->reflection;
    }

    /**
     * @inheritDoc
     */
    public static function make(mixed $value): static
    {
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public static function from(mixed $value): static
    {
        return static::make($value);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
