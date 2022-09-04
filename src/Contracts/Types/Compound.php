<?php

namespace Envorra\TypeHandler\Contracts\Types;

/**
 * Compound
 *
 * @package  Envorra\TypeHandler\Contracts
 *
 * @template TCompound
 *
 * @extends Primitive<TCompound>
 */
interface Compound extends Primitive
{
    /**
     * @param  string  $json
     * @return self
     */
    public static function fromJson(string $json): self;

    /**
     * @return string
     */
    public function toJson(): string;
}
