<?php

namespace Envorra\TypeHandler\Handlers;

use Stringable;
use Envorra\TypeHandler\OldTypes\Primitives\StringType;
use Envorra\TypeHandler\Exceptions\StringHandlerException;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * StringHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @extends AbstractHandler<StringContract>
 */
class StringHandler extends AbstractHandler
{
    /**
     * @inheritDoc
     */
    protected function getValueType(): StringContract
    {
        if(!is_string($this->getValue()) && !$this->getValue() instanceof Stringable) {
            throw new StringHandlerException('$value must be string or Stringable');
        }

        return StringType::from($this->getValue());
    }

}
