<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Type;
use Envorra\TypeHandler\Contracts\Primitive;
use Envorra\TypeHandler\Handlers\PrimitiveHandler;
use Envorra\TypeHandler\Contracts\PrimitiveString;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Exceptions\HandlerException;

/**
 * @DataType
 *
 * @package Envorra\TypeHandler\Types\AbstractTypes
 *
 * @template TDataType
 *
 * @implements Type<TDataType>
 */
abstract class DataType implements Type
{
    protected mixed $original;

    /**
     * @inheritDoc
     */
    public function __construct(
        protected mixed $value = null,
        bool $castToType = false
    ) {
        $this->original = $this->value;

        if($castToType) {
            $this->castValue();
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
     * @return void
     */
    protected function castValue(): void
    {

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
        return new static($value, true);
    }

    /**
     * @inheritDoc
     * @throws HandlerException
     */
    public function toPrimitive(): Primitive
    {
        /** @var class-string<Primitive>|null $primitive */
        $primitive = static::primitive();
        $type = $primitive ? $primitive::from($this->getValue()) : null;

        return $type ?? PrimitiveHandler::type($this->getValue());
    }

    /**
     * @return class-string<Primitive>|null
     */
    public static function primitive(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function toString(): PrimitiveString
    {
        return StringType::from($this);
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
