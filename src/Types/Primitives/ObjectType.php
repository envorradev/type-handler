<?php

namespace Envorra\TypeHandler\Types\Primitives;

use Stringable;
use Envorra\TypeHandler\Contracts\Types\Compound;
use Envorra\TypeHandler\Types\AbstractTypes\CompoundType;

/**
 * ObjectType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends CompoundType<object>
 */
final class ObjectType extends CompoundType
{
    /**
     * @inheritDoc
     */
    public static function fromJson(string $json): Compound
    {
        return ObjectType::make(json_decode($json, false));
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        if($this->getValue() instanceof Stringable) {
            return (string) $this->getValue();
        }
        return $this->toJson();
    }



}
