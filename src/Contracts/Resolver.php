<?php

namespace Envorra\TypeHandler\Contracts;

use Envorra\TypeHandler\Exceptions\ResolverException;

/**
 * Resolver
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Resolver
{
    /**
     * @param  mixed|null  $abstract
     */
    public function __construct(mixed $abstract = null);

    /**
     * @return T
     * @throws ResolverException
     */
    public function getConcrete(): mixed;

    /**
     * @return bool
     */
    public function hasResolved(): bool;

    /**
     * @param  mixed  $abstract
     * @return Resolver
     */
    public function setAbstract(mixed $abstract): Resolver;

    /**
     * @return mixed
     */
    public function getAbstract(): mixed;

    /**
     * @param  mixed  $abstract
     * @return T
     * @throws ResolverException
     */
    public static function resolve(mixed $abstract): mixed;

    /**
     * @param  mixed  $abstract
     * @return T|null
     */
    public static function tryResolve(mixed $abstract): mixed;

    /**
     * @param  mixed|null  $abstract
     * @return Resolver
     */
    public static function resolver(mixed $abstract = null): Resolver;
}
