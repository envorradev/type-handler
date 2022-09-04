<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Compound;

/**
 * CompoundType
 *
 * @package  Envorra\TypeHandler\Types
 *
 * @template TCompound
 *
 * @extends PrimitiveType<TCompound>
 * @implements Compound<TCompound>
 */
abstract class CompoundType extends PrimitiveType implements Compound
{
    /**
     * @inheritDoc
     */
    public static function fromJson(string $json): Compound
    {
        return static::make(json_decode($json, true));
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @inheritDoc
     */
    public function toJson(): string
    {
        return json_encode($this->getValue());
    }


}
