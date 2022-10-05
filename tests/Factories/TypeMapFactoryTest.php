<?php

namespace Envorra\TypeHandler\Tests\Factories;

use Envorra\TypeHandler\Maps\TypeMap;
use Envorra\TypeHandler\Factories\TypeMapFactory;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Contracts\Types\Primitive;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Factories\TypeMapFactory
 */
class TypeMapFactoryTest extends TestCase
{

    /**
     * @test
     * @covers ::create
     */
    public function it_can_create_with_no_parameters(): void
    {
        $map = TypeMapFactory::create();

        $this->assertInstanceOf(TypeMap::class, $map);

        $dotted = $map->toDottedArray();
        asort($dotted);

        $this->assertEquals([
            'carbon.CarbonType' => 'Envorra\TypeHandler\Types\CarbonType',
            'collection.CollectionType' => 'Envorra\TypeHandler\Types\CollectionType',
            'datetime.DateTimeType' => 'Envorra\TypeHandler\Types\DateTimeType',
            'date.DateType' => 'Envorra\TypeHandler\Types\DateType',
            'array.ArrayType' => 'Envorra\TypeHandler\Types\Primitives\ArrayType',
            'boolean.BooleanType' => 'Envorra\TypeHandler\Types\Primitives\BooleanType',
            'double.DoubleType' => 'Envorra\TypeHandler\Types\Primitives\DoubleType',
            'integer.IntegerType' => 'Envorra\TypeHandler\Types\Primitives\IntegerType',
            'object.ObjectType' => 'Envorra\TypeHandler\Types\Primitives\ObjectType',
            'string.StringType' => 'Envorra\TypeHandler\Types\Primitives\StringType',
            'timestamp.TimestampType' => 'Envorra\TypeHandler\Types\TimestampType',
        ], $dotted);
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_create_with_parameter(): void
    {
        $map = TypeMapFactory::create(Primitive::class);

        $this->assertInstanceOf(TypeMap::class, $map);

        $dotted = $map->toDottedArray();
        asort($dotted);

        $this->assertEquals([
            'array.ArrayType' => 'Envorra\TypeHandler\Types\Primitives\ArrayType',
            'boolean.BooleanType' => 'Envorra\TypeHandler\Types\Primitives\BooleanType',
            'double.DoubleType' => 'Envorra\TypeHandler\Types\Primitives\DoubleType',
            'integer.IntegerType' => 'Envorra\TypeHandler\Types\Primitives\IntegerType',
            'object.ObjectType' => 'Envorra\TypeHandler\Types\Primitives\ObjectType',
            'string.StringType' => 'Envorra\TypeHandler\Types\Primitives\StringType',
        ], $dotted);
    }
}
