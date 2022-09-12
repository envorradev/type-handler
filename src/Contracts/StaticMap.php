<?php

namespace Envorra\TypeHandler\Contracts;

/**
 * StaticMap
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template T
 *
 * @extends Map<T>
 */
interface StaticMap extends Map
{
    public function __construct();
}
