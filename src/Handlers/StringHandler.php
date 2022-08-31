<?php

namespace Envorra\TypeHandler\Handlers;

use Stringable;
use Envorra\TypeHandler\Contracts\StringTypeContract;
use Envorra\TypeHandler\OldTypes\Primitives\StringType;
use Envorra\TypeHandler\Exceptions\StringHandlerException;

/**
 * StringHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @extends AbstractHandler<StringTypeContract>
 */
class StringHandler extends AbstractHandler
{
    /**
     * @inheritDoc
     */
    protected function getValueType(): StringTypeContract
    {
        if(!is_string($this->getValue()) && !$this->getValue() instanceof Stringable) {
            throw new StringHandlerException('$value must be string or Stringable');
        }

        return StringType::from($this->getValue());
    }

}
