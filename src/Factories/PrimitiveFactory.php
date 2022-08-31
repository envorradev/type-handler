<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Types\Primitive;

/**
 * PrimitiveFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @extends AbstractFactory<Primitive>
 */
class PrimitiveFactory extends AbstractFactory
{
    /**
     * @inheritDoc
     */
    public function create(): mixed
    {
        /** @var class-string<Primitive> $class */
        $class = $this->getTypeClass(gettype($this->getValue()));
        return $class::make($this->getValue());
    }

    /**
     * @param  string  $type
     * @return class-string<Primitive>
     */
    protected function getTypeClass(string $type): string
    {
        return '\\Envorra\\TypeHandler\\Types\\Primitives\\'.ucwords($type).'Type';
    }
}
