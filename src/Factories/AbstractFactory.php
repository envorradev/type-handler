<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Factory;
use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * AbstractFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @template TFactory
 *
 * @implements Factory<TFactory>
 */
abstract class AbstractFactory implements Factory
{
    /**
     * @var mixed
     */
    protected mixed $value;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->value = null;
    }

    /**
     * @inheritDoc
     */
    public function newInstance(): Factory
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function fromValue(mixed $value): Factory
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function fromType(Type $type): Factory
    {
        $this->fromValue($type->getValue());
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public static function createFromValue(mixed $value): mixed
    {
        return (new static)->fromValue($value)->create();
    }

}
