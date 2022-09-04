<?php

namespace Envorra\TypeHandler\Contracts\Types;

use Stringable;

/**
 * @Type
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Type extends Stringable
{
    /**
     * @param  T|Type|null  $value
     */
    public function __construct(mixed $value = null);

    /**
     * @param  T|Type|null  $value
     * @return static
     */
    public static function make(mixed $value = null): static;

    /**
     * @return string
     */
    public static function type(): string;

    /**
     * @return mixed
     */
    public function getOriginal(): mixed;

    /**
     * @return T
     */
    public function getValue(): mixed;

    /**
     * @param  Type|string|null  $type
     * @return bool
     */
    public function is(Type|string|null $type = null): bool;

    /**
     * @return bool
     */
    public function isCompound(): bool;

    /**
     * @param  array<Type|string|null>  $types
     * @return bool
     */
    public function isIn(array $types = []): bool;

    /**
     * @return bool
     */
    public function isNonPrimitive(): bool;

    /**
     * @return bool
     */
    public function isPrimitive(): bool;

    /**
     * @return bool
     */
    public function isScalar(): bool;
}
