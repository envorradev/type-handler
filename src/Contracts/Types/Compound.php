<?php

namespace Envorra\TypeHandler\Contracts\Types;

use Envorra\TypeHandler\Contracts\Castables\Jsonable;

/**
 * Compound
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template TCompound
 *
 * @extends Primitive<TCompound>
 */
interface Compound extends Primitive, Jsonable
{
    /**
     * @param  string  $json
     * @return self
     */
    public static function fromJson(string $json): self;
}
