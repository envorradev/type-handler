<?php

namespace Envorra\TypeHandler\Contracts;

use Envorra\TypeHandler\Exceptions\HandlerException;

/**
 * @Handler
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Handler
{
    /**
     * @param  mixed  $value
     * @throws HandlerException
     */
    public function __construct(mixed $value);

    /**
     * @return T
     */
    public function getType(): mixed;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param  mixed  $value
     * @return static
     * @throws HandlerException
     */
    public static function make(mixed $value): static;

    /**
     * @param  mixed  $value
     * @return T
     * @throws HandlerException
     */
    public static function type(mixed $value): mixed;
}
