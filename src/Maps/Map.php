<?php

namespace Envorra\TypeHandler\Maps;

use Envorra\TypeHandler\Exceptions\MapException;
use Envorra\TypeHandler\Contracts\Map as MapContract;
use Envorra\TypeHandler\Traits\StringViaJsonViaArray;

/**
 * Map
 *
 * @package  Envorra\TypeHandler\Maps
 *
 * @template T
 *
 * @implements MapContract<T>
 */
class Map implements MapContract
{
    use StringViaJsonViaArray;

    /**
     * @param  array  $map
     */
    public function __construct(
        protected array $map = [],
    ) {
    }

    /**
     * @inheritDoc
     */
    public function find(mixed $item): mixed
    {
        try {
            return $this->findOrFail($item);
        } catch (MapException) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(mixed $item): mixed
    {
        if (in_array($item, $this->map)) {
            return $this->map[array_search($item, $this->map)];
        }

        if (array_key_exists($item, $this->map)) {
            return $this->map[$item];
        }

        throw new MapException('Item not found!');
    }

    /**
     * @inheritDoc
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->map;
    }
}
