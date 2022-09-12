<?php

namespace Envorra\TypeHandler\Maps;


use Envorra\TypeHandler\Exceptions\MapException;

/**
 * PrimitiveMap
 *
 * @package Envorra\TypeHandler\Maps
 *
 * @extends StaticMap<string>
 */
class PrimitiveMap extends StaticMap
{
    /**
     * @inheritDoc
     */
    protected static function defineMap(): array
    {
        return [
            'integer' => [
                'int',
                'i',
            ],
            'boolean' => [
                'bool',
                'b',
            ],
            'string'  => [
                'str',
                's',
            ],
            'array'   => [
                'arr',
                'a',
            ],
            'object'  => [
                'obj',
                'o',
            ],
            'double'  => [
                'dbl',
                'd',
                'float',
                'fl',
                'f',
                'real',
                'r',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(mixed $item): mixed
    {
        if(array_key_exists($item, $this->map)) {
            return $item;
        }

        foreach(array_keys($this->map) as $primitive) {
            if(in_array($item, $this->map[$primitive])) {
                return $primitive;
            }
        }

        throw new MapException($item.' could not be converted to valid type.');
    }


}
