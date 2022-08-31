<?php

namespace Envorra\TypeHandler\Contracts;

use Stringable;

/**
 * @Type
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Type extends Stringable
{
    /**
     * @param  T|null  $value
     */
    public function __construct(mixed $value = null);

    /**
     * @return T
     */
    public function getValue(): mixed;

    /**
     * @return mixed
     */
    public function getOriginal(): mixed;

    /**
     * @return bool
     */
    public function isPrimitive(): bool;

    /**
     * @return bool
     */
    public function isScalar(): bool;

    /**
     * @return bool
     */
    public function isCompound(): bool;

    /**
     * @return bool
     */
    public function isNonPrimitive(): bool;

    /**
     * @param  Type|string|null  $type
     * @return bool
     */
    public function is(Type|string|null $type = null): bool;

    /**
     * @param  array<Type|string|null>  $types
     * @return bool
     */
    public function isIn(array $types = []): bool;

    /**
     * @param  T  $value
     * @return static
     */
    public static function make(mixed $value): static;

    /**
     * @param  mixed  $value
     * @return static
     */
    public static function from(mixed $value): static;
}
