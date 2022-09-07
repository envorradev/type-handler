<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Factory;
use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Types\Primitives\ObjectType;
use Envorra\TypeHandler\Exceptions\TypeFactoryException;

/**
 * TypeFactory
 *
 * @package  Envorra\TypeHandler
 *
 * @template T of Type
 *
 * @implements Factory<T>
 */
class TypeFactory implements Factory
{
    protected array $map;

    /**
     * @param  string  $type
     * @param  mixed   $value
     * @param  class-string  $subType
     */
    public function __construct(protected string $type, protected mixed $value, protected string $subType)
    {
        $this->map = TypeMapFactory::create($this->subType);
    }

    /**
     * @param  string|class-string<T>|null  $type
     * @param  mixed|null                   $value
     * @return T
     * @throws TypeFactoryException
     */
    public static function create(?string $type = null, mixed $value = ''): mixed
    {
        try {
            return (new self($type ?? gettype($value), $value, static::typeContract()))->make();
        } catch (TypeFactoryException $exception) {
            if($type && $type !== gettype($value) && $exception->getMessage() === $type.' is not a valid type.') {
                return (new self(gettype($value), $value, static::typeContract()))->make();
            }

            throw $exception;
        }
    }

    /**
     * @param  string|class-string<T>  $type
     * @return T
     * @throws TypeFactoryException
     */
    public static function createFromType(string $type): mixed
    {
        return static::create(type: $type);
    }

    /**
     * @param  mixed  $value
     * @return T
     * @throws TypeFactoryException
     */
    public static function createFromValue(mixed $value): mixed
    {
        return static::create(value: $value);
    }

    /**
     * @return class-string<T>
     */
    protected static function defaultType(): string
    {
        return StringType::class;
    }

    /**
     * @return class-string<T>
     */
    protected static function typeContract(): string
    {
        return Type::class;
    }

    /**
     * @param  string|class-string<T>  $item
     * @return string
     */
    protected function getFromMap(string $item): string
    {
        return $this->map[$item] ?? $this->map[array_search($item, $this->map)];
    }

    /**
     * @return class-string<T>
     * @throws TypeFactoryException
     */
    protected function getType(): string
    {
        if ($class = $this->resolveObjectInMap()) {
            return $class;
        }

        if ($this->inMap($this->type)) {
            return $this->getFromMap($this->type);
        }

        throw new TypeFactoryException($this->type.' is not a valid type.');
    }

    /**
     * @param  string|class-string<T>  $item
     * @return bool
     */
    protected function inMap(string $item): bool
    {
        return array_key_exists($item, $this->map) || in_array($item, $this->map);
    }

    /**
     * @return T
     * @throws TypeFactoryException
     */
    protected function make(): mixed
    {
        /** @var class-string<Type> $type */
        $type = $this->getType();
        return $type::make($this->value);
    }

    /**
     * @return class-string<T>|null
     */
    protected function resolveObjectInMap(): ?string
    {
        if ($this->type === 'object' || is_object($this->value)) {
            $class = get_class((object) $this->value);
            $key = strtolower(class_basename($class));

            if ($this->inMap($class)) {
                return $this->getFromMap($class);
            }

            if ($this->inMap($key)) {
                return $this->getFromMap($key);
            }

            return ObjectType::class;
        }

        return null;
    }
}
