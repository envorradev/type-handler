<?php

namespace Envorra\TypeHandler\Factories;

use Envorra\TypeHandler\Contracts\Factory;
use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * TypeMapFactory
 *
 * @package Envorra\TypeHandler\Factories
 *
 * @implements Factory<array>
 */
class TypeMapFactory implements Factory
{
    /**
     * @param  class-string<Type>  $typeSubClass
     * @return array<string, class-string>
     */
    public static function create(string $typeSubClass = Type::class): array
    {
        $map = [];

        /** @var class-string<Type> $type */
        foreach (ScannerFactory::create()->getSubClasses($typeSubClass) as $type) {
            $map[$type::type()] = $type;
        }

        return $map;
    }
}
