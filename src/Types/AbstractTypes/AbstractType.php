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

    /**
     * @inheritDoc
     */
    public function __construct(protected mixed $value = null)
    {
        if($this->value instanceof Type) {
            $this->value = $this->value->getValue();
        }

        $this->original = $this->value;

        if(!$this->isIncomingValueCorrectType($this->value)) {
            $this->value = $this->castIncomingValue($this->value);
        }
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
        return static::reflection()->implementsInterface(Primitive::class);
    }

    /**
     * @inheritDoc
     */
    public function isScalar(): bool
    {
        return static::reflection()->implementsInterface(Scalar::class);
    }

    /**
     * @inheritDoc
     */
    public function isCompound(): bool
    {
        return static::reflection()->implementsInterface(Compound::class);
    }

    /**
     * @inheritDoc
     */
    public function isNonPrimitive(): bool
    {
        return static::reflection()->implementsInterface(NonPrimitive::class);
    }

    /**
     * @inheritDoc
     */
    public function is(Type|string|null $type = null): bool
    {
        if($type) {

            if($type instanceof Type) {
                $type = get_class($type);
            }

            return get_class($this) === $type;
        }
        return false;
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
    protected static function reflection(): ReflectionClass
    {
        return new ReflectionClass(static::class);
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    protected function isIncomingValueCorrectType(mixed $value): bool
    {
        return gettype($value) === static::type() && $this->additionalTypeCheck($value);
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    protected function additionalTypeCheck(mixed $value): bool
    {
        return true;
    }

    /**
     * @param  mixed  $value
     * @return T
     */
    abstract protected function castIncomingValue(mixed $value): mixed;

    /**
     * @inheritDoc
     */
    public static function make(mixed $value = null): static
    {
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public static function type(): string
    {
        return strtolower(str_replace('Type', '', static::reflection()->getShortName()));
    }


    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function dump(): void
    {
        dump($this);
    }
}
