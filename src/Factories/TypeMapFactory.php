<?php

namespace Envorra\TypeHandler\Factories;

use Illuminate\Support\Str;
use Envorra\TypeHandler\Maps\TypeMap;
use Envorra\TypeHandler\Contracts\Factory;
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
        $map = [
            'type' => [],
            'basename' => [],
            'class' => [],
        ];

        /** @var class-string<Type> $class */
        foreach (ScannerFactory::create()->getSubClasses($typeSubClass) as $class) {
            $uuid = Str::uuid()->toString();
            $map['type'][$uuid] = $class::type();
            $map['basename'][$uuid] = class_basename($class);
            $map['class'][$uuid] = $class;
        }

        return new TypeMap($map);
    }
}
