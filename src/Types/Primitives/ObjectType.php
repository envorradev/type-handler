<?php

namespace Envorra\TypeHandler\Types\Primitives;

use stdClass;
use Stringable;
use Envorra\TypeHandler\Helpers\JsonHelper;
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
        if ($this->getValue() instanceof Stringable) {
            return (string) $this->getValue();
        }
        return $this->toJson();
    }

    /**
     * @inheritDoc
     */
    protected function additionalTypeCheck(mixed $value): bool
    {
        return $value instanceof stdClass;
    }

    /**
     * @inheritDoc
     */
    protected function castIncomingValue(mixed $value): mixed
    {
        return JsonHelper::tryToObject($value)
            ?? JsonHelper::tryToObject(JsonHelper::toJson($value))
            ?? parent::castIncomingValue($value);
    }


}
