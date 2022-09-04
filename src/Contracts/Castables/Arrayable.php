<?php

namespace Envorra\TypeHandler\Contracts\Castables;

/**
 * Arrayable
 *
 * @package Envorra\TypeHandler\Contracts
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}
