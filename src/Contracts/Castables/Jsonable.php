<?php /** @noinspection SpellCheckingInspection */

namespace Envorra\TypeHandler\Contracts\Castables;

/**
 * Jsonable
 *
 * @package Envorra\TypeHandler\Contracts\Castables
 */
interface Jsonable
{
    /**
     * @return string
     */
    public function toJson(): string;
}
