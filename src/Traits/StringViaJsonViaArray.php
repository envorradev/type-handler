<?php

namespace Envorra\TypeHandler\Traits;

/**
 * StringViaJsonViaArray
 *
 * @package Envorra\TypeHandler\Traits
 */
trait StringViaJsonViaArray
{
    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
