<?php

namespace Envorra\TypeHandler\Contracts;

use Envorra\TypeHandler\Exceptions\MapException;
use Envorra\TypeHandler\Contracts\Castables\Jsonable;
use Envorra\TypeHandler\Contracts\Castables\Arrayable;
use Envorra\TypeHandler\Contracts\Castables\Stringable;

/**
 * Map
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Map extends Arrayable, Jsonable, Stringable
{
    /**
     * @param  mixed  $item
     * @return string|T|null
     */
    public function find(mixed $item): mixed;

    /**
     * @param  mixed  $item
     * @return string|T|null
     * @throws MapException
     */
    public function findOrFail(mixed $item): mixed;

    /**
     * @return array
     */
    public function getMap(): array;
}
