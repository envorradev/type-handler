<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Maps\TypeMap;
use Envorra\TypeHandler\Contracts\Factory;
use Envorra\Maps\Factories\UuidMapFactory;
use Envorra\TypeHandler\Contracts\Types\Type;
use Envorra\ClassFinder\Builders\FinderBuilder;
use Envorra\ClassFinder\Filters\ClassDefinitionFilter;
use Envorra\ClassFinder\Contracts\Definitions\TypeDefinition;

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
     * @noinspection PhpUnusedParameterInspection
     */
    public static function create(string $typeSubClass = Type::class): TypeMap
    {
        $finder = (new FinderBuilder)->directory(__DIR__.'/../Types')
                                     ->filter(new ClassDefinitionFilter)
                                     ->recursive()
                                     ->build();

        $map = UuidMapFactory::createUsing(
            items: $finder->getSubClasses($typeSubClass),
            columns: ['type', 'basename', 'class'],
            callable: function (TypeDefinition $definition, $key, $column, $uuid) {
                /** @var class-string<Type> $class */
                $class = $definition->getFullyQualifiedName();

                return match ($column) {
                    'type' => $class::type(),
                    'basename' => $definition->getName(),
                    'class' => $class,
                    default => '',
                };
            }
        );

        return TypeMap::fromMap($map);
    }
}
