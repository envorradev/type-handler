<?php

namespace Envorra\TypeHandler\Contracts\Castables;

use Stringable as BaseStringable;

/**
 * Stringable
 *
 * @package Envorra\TypeHandler\Contracts\Castables
 */
interface Stringable extends BaseStringable
{
    /**
     * @return string
     */
    public function toString(): string;
}
