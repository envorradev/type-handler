<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Factory;

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
    protected const ACTION_GET = 'notGettable';

    protected const ACTION_SET = 'notSettable';

    protected array $notSettable = [];

    protected array $notGettable = [];

    public function __construct()
    {
        $this->init();
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {

    }

    /**
     * @inheritDoc
     */
    public function newInstance(): static
    {
        return static::instance();
    }

    /**
     * @inheritDoc
     */
    public function set(string $property, mixed $value): static
    {
        if($this->can(self::ACTION_SET, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get(string $property): mixed
    {
        return $this->can(self::ACTION_GET, $property) ? $this->$property : null;
    }

    /**
     * @param  string  $action
     * @param  string  $property
     * @return bool
     */
    private function can(string $action, string $property): bool
    {
        return !in_array($property, array_merge($this->$action, ['notGettable', 'notSettable']));
    }

    /**
     * @inheritDoc
     */
    public function __get(string $property): mixed
    {
        return $this->get($property);
    }

    /**
     * @inheritDoc
     */
    public static function make(array $arguments = []): mixed
    {
        $instance = static::instance();

        foreach($arguments as $key => $value) {
            $instance->set($key, $value);
        }

        return $instance->create();
    }

    /**
     * @inheritDoc
     */
    public static function instance(): static
    {
        return new static;
    }

}
