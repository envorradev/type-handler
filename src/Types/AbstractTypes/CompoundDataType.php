<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

/**
 * CompoundDataType
 *
 * @package Envorra\TypeHandler\Types\AbstractTypes
 *
 * @template TCompoundType
 *
 * @extends PrimitiveDataType<TCompoundType>
 */
abstract class CompoundDataType extends PrimitiveDataType
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return json_encode($this->getValue());
    }

    /**
     * @inheritDoc
     */
    protected function castValue(): void
    {
        if(is_string($this->value)) {
            json_decode($this->value);

            if(json_last_error() === JSON_ERROR_NONE) {
                $this->value = json_decode($this->value, $this->getTypeString() === 'array');
                return;
            }
        }

        parent::castValue();
    }
}
