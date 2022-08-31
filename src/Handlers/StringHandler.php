<?php

namespace Envorra\TypeHandler\Handlers;

use Stringable;
use Envorra\TypeHandler\Contracts\PrimitiveString;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Exceptions\StringHandlerException;

/**
 * StringHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @extends AbstractHandler<PrimitiveString>
 */
class StringHandler extends AbstractHandler
{
    /**
     * @inheritDoc
     */
    protected function getValueType(): PrimitiveString
    {
        if(!is_string($this->getValue()) && !$this->getValue() instanceof Stringable) {
            throw new StringHandlerException('$value must be string or Stringable');
        }

        return StringType::from($this->getValue());
    }

}
