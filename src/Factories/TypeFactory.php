<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Factory;
use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\TypeHandler\Types\Primitives\StringType;

/**
 * TypeFactory
 *
 * @package Envorra\TypeHandler
 *
 * @template T of Type
 *
 * @implements Factory<T>
 */
class TypeFactory implements Factory
{

    /**
     * @param  string|class-string<T>|null  $type
     * @param  mixed|null   $value
     * @return T
     */
    public static function create(?string $type = null, mixed $value = null): mixed
    {
        $value ??= '';
        $type ??= gettype($value);
        $map = TypeMapFactory::create(static::subType());

        /** @var class-string<Type> $class */
        $class = static::defaultType();

        if(array_key_exists($type, $map)) {
            $class = $map[$type];
        } elseif(in_array($type, $map)) {
            $class = $map[array_search($type, $map)];
        }

        return $class::make($value);
    }


    /**
     * @param  string  $type
     * @return T
     */
    public static function createFromType(string $type): mixed
    {
        return static::create(type: $type);
    }


    /**
     * @param  mixed  $value
     * @return T
     */
    public static function createFromValue(mixed $value): mixed
    {
        return static::create(value: $value);
    }

    /**
     * @return class-string<T>
     */
    protected static function subType(): string
    {
        return Type::class;
    }

    /**
     * @return class-string<T>
     */
    protected static function defaultType(): string
    {
        return StringType::class;
    }
}
