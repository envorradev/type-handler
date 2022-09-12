<?php

namespace Envorra\TypeHandler\Maps;


use Envorra\TypeHandler\Exceptions\MapException;
use Envorra\TypeHandler\Contracts\StaticMap as StaticMapContract;

/**
 * StaticMap
 *
 * @package  Envorra\TypeHandler\Maps
 *
 * @template T
 *
 * @extends Map<T>
 * @implements StaticMapContract<T>
 */
abstract class StaticMap extends Map implements StaticMapContract
{
    public function __construct()
    {
        parent::__construct(static::defineMap());
    }

    /**
     * @param  mixed  $item
     * @return T|null
     */
    public static function get(mixed $item): mixed
    {
        return (new static)->find($item);
    }

    /**
     * @param  mixed  $item
     * @return mixed
     * @throws MapException
     */
    public static function getOrFail(mixed $item): mixed
    {
        return (new static)->findOrFail($item);
    }

    /**
     * @return array
     */
    abstract protected static function defineMap(): array;
}
