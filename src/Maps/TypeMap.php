<?php

namespace Envorra\TypeHandler\Maps;

use Envorra\Maps\UuidMap;
use Envorra\Maps\Contracts\Map;
use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * TypeMap
 *
 * @package Envorra\TypeHandler\Maps
 *
 * @extends UuidMap<Type>
 */
class TypeMap extends UuidMap
{
    /**
     * @param  Map  $map
     * @return TypeMap
     */
    public static function fromMap(Map $map): TypeMap
    {
        return new TypeMap($map->getMap());
    }

    /**
     * @param  mixed  $item
     * @return string|null
     */
    public function getBasename(mixed $item): ?string
    {
        return $this->findItem($item, 'basename');
    }

    /**
     * @param  mixed  $item
     * @return string|null
     */
    public function getClass(mixed $item): ?string
    {
        return $this->findItem($item, 'class');
    }

    /**
     * @param  mixed  $item
     * @return string|null
     */
    public function getType(mixed $item): ?string
    {
        return $this->findItem($item, 'type');
    }

    /**
     * @param  mixed   $item
     * @param  string  $key
     * @return mixed
     */
    protected function findItem(mixed $item, string $key): mixed
    {
        if (is_string($item)) {
            return $this->findIgnoreCase($item, $key);
        }
        return $this->find($item, $key);
    }
}
