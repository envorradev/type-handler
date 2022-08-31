<?php

namespace Envorra\TypeHandler\Handlers;

use Envorra\TypeHandler\Contracts\PackageConstants;
use Envorra\TypeHandler\Contracts\Primitive;
use Envorra\TypeHandler\Exceptions\PrimitiveHandlerException;

/**
 * PrimitiveHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @extends AbstractHandler<Primitive>
 */
class PrimitiveHandler extends AbstractHandler
{
    /**
     * @inheritDoc
     */
    protected function getValueType(): Primitive
    {
        $dataType = gettype($this->getValue());

        /** @var Primitive $type */
        $type = static::NAMESPACE_PRIMITIVES.strtr(static::PATTERN_PRIMITIVE_CLASS, ['{$dataType}' => ucwords($dataType)]);

        if(class_exists($type) && in_array(Primitive::class, class_implements($type))) {
            return $type::from($this->getValue());
        }

        throw new PrimitiveHandlerException('Expected primitive class ' . $type . ' not found.');
    }
}
