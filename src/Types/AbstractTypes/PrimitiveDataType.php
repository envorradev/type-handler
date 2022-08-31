<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Primitive;
use Envorra\TypeHandler\Contracts\PrimitiveString;
use Envorra\TypeHandler\Types\Primitives\StringType;

/**
 * @PrimitiveDataType
 *
 * @package Envorra\TypeHandler\Types\AbstractTypes
 *
 * @template TPrimitiveDataType
 *
 * @implements Primitive<TPrimitiveDataType>
 */
abstract class PrimitiveDataType implements Primitive
{
    protected mixed $original;

    protected string $typeString;

    /**
     * @inheritDoc
     */
    public function __construct(protected mixed $value = null, bool $castToType = false)
    {
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
        settype($this->value, $this->getTypeString());
    }

    /**
     * @return string
     */
    protected function getTypeString(): string
    {
        return $this->typeString ?? $this->guessTypeString();
    }

    /**
     * @return string
     */
    protected function guessTypeString(): string
    {
        return strtolower(str_replace('Type', '', class_basename($this)));
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
     */
    public function toString(): PrimitiveString
    {
        return StringType::from($this);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
