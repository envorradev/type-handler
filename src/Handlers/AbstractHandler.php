<?php

namespace Envorra\TypeHandler\Handlers;

use Envorra\TypeHandler\Contracts\Handler;
use Envorra\TypeHandler\Contracts\PackageConstants;
use Envorra\TypeHandler\Exceptions\HandlerException;

/**
 * AbstractHandler
 *
 * @package Envorra\TypeHandler\Handlers
 *
 * @template T
 *
 * @implements Handler<T>
 */
abstract class AbstractHandler implements Handler, PackageConstants
{
    /**
     * @var T
     */
    protected mixed $type;

    /**
     * @inheritDoc
     */
    public function __construct(
        protected mixed $value
    ) {
        $this->type = $this->getValueType();
    }

    /**
     * @inheritDoc
     */
    public function getType(): mixed
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): mixed
    {
        return $this->value;
    }


    /**
     * @return T
     * @throws HandlerException
     */
    abstract protected function getValueType(): mixed;

    /**
     * @inheritDoc
     */
    public static function make(mixed $value): static
    {
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public static function type(mixed $value): mixed
    {
        return static::make($value)->getType();
    }


}
