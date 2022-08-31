<?php

namespace Envorra\TypeHandler\Handlers;

use Envorra\TypeHandler\Contracts\Type;
use Envorra\TypeHandler\Contracts\Primitive;
use Envorra\TypeHandler\OldTypes\TimestampType;
use Envorra\TypeHandler\OldTypes\Primitives\ObjectType;
use Envorra\TypeHandler\OldTypes\Primitives\IntegerType;

/**
 * TypeHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @extends AbstractHandler<Type|Primitive>
 */
class TypeHandler extends AbstractHandler
{
    /**
     * @inheritDoc
     */
    protected function getValueType(): Type|Primitive
    {
        $primitive = PrimitiveHandler::type($this->getValue());
        $method = 'handle'.class_basename($primitive);

        if(method_exists($this, $method)) {
            return $this->$method() ?? $primitive;
        }

        return $primitive;
    }

    /**
     * @return Type|null
     */
    protected function handleObjectType(): ?Type
    {

    }

    /**
     * @return Type|null
     */
    protected function handleIntegerType(): ?Type
    {
        if($this->getValue() === strtotime(date('c', $this->getValue()))) {
            return TimestampType::from($this->getValue());
        }

        return null;
    }
}
