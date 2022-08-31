<?php

namespace Envorra\TypeHandler\Types\Primitives;


use Stringable;
use Envorra\TypeHandler\Contracts\PrimitiveString;

/**
 * @StringType
 *
 * @package Envorra\TypeHandler\Types
 */
final class StringType implements PrimitiveString
{
    /**
     * @inheritDoc
     */
    public function __construct(
        protected string $value = ''
    ) {}


    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value;
    }


    /**
     * @inheritDoc
     */
    public static function make(string $value): self
    {
        return new self($value);
    }

    /**
     * @inheritDoc
     */
    public static function from(string|Stringable|null $value): self
    {
        return new self((string) $value);
    }

}
