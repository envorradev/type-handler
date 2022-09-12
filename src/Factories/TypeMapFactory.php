<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Maps\TypeMap;
use Envorra\TypeHandler\Contracts\Factory;
use Envorra\Maps\Factories\UuidMapFactory;
use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * TypeMapFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @implements Factory<TypeMap>
 */
class TypeMapFactory implements Factory
{
    /**
     * @param  class-string<Type>  $typeSubClass
     */
    public static function create(string $typeSubClass = Type::class): TypeMap
    {
        $map = UuidMapFactory::createUsing(
            items: ScannerFactory::create()->getSubClasses($typeSubClass),
            columns: ['type', 'basename', 'class'],
            callable: function ($type, $key, $column, $uuid) {
                return match ($column) {
                    'type' => $type::type(),
                    'basename' => class_basename($type),
                    'class' => $type,
                    default => '',
                };
            }
        );

        return TypeMap::fromMap($map);
    }
}
