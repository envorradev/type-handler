<?php

namespace Envorra\TypeHandler\Contracts;

use Stringable;

/**
 * PrimitiveString
 *
 * @package Envorra\TypeHandler\Contracts
 */
interface PrimitiveString
{
    /**
     * @param  string  $value
     */
    public function __construct(string $value = '');

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param  string  $value
     * @return self
     */
    public static function make(string $value): self;

    /**
     * @param  string|Stringable|null  $value
     * @return self
     */
    public static function from(string|Stringable|null $value): self;
}
