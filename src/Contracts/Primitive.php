<?php

namespace Envorra\TypeHandler\Contracts;

use Stringable;

/**
 * @Primitive
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template TPrimitive
 */
interface Primitive extends Stringable
{
    /**
     * @param  TPrimitive|null  $value
     */
    public function __construct(mixed $value = null, bool $castToType = false);

    /**
     * @return TPrimitive
     */
    public function getValue(): mixed;

    /**
     * @return mixed
     */
    public function getOriginal(): mixed;

    /**
     * @param  TPrimitive  $value
     * @return static
     */
    public static function make(mixed $value): static;

    /**
     * @param  mixed  $value
     * @return static
     */
    public static function from(mixed $value): static;

    /**
     * @return PrimitiveString
     */
    public function toString(): PrimitiveString;
}
