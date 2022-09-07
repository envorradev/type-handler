<?php

namespace Envorra\TypeHandler\Tests\Factories;

use Envorra\TypeHandler\Contracts\Types\Scalar;
use Envorra\TypeHandler\Factories\TypeMapFactory;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Contracts\Types\Compound;
use Envorra\TypeHandler\Contracts\Types\Primitive;
use Envorra\TypeHandler\Contracts\Types\NonPrimitive;
use Envorra\TypeHandler\Contracts\Types\StringContract;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Factories\TypeMapFactory
 */
class TypeMapFactoryTest extends TestCase
{

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_with_no_parameters(): void
    {
        $this->assertArraysMatchAfterSort([
            "array" => "Envorra\TypeHandler\Types\Primitives\ArrayType",
            "boolean" => "Envorra\TypeHandler\Types\Primitives\BooleanType",
            "double" => "Envorra\TypeHandler\Types\Primitives\DoubleType",
            "integer" => "Envorra\TypeHandler\Types\Primitives\IntegerType",
            "object" => "Envorra\TypeHandler\Types\Primitives\ObjectType",
            "string" => "Envorra\TypeHandler\Types\Primitives\StringType",
            "carbon" => "Envorra\TypeHandler\Types\CarbonType",
            "collection" => "Envorra\TypeHandler\Types\CollectionType",
            "datetime" => "Envorra\TypeHandler\Types\DateTimeType",
            "date" => "Envorra\TypeHandler\Types\DateType",
            "timestamp" => "Envorra\TypeHandler\Types\TimestampType",
        ], TypeMapFactory::create());
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_subtype_primitive(): void
    {
        $this->assertArraysMatchAfterSort([
            "array" => "Envorra\TypeHandler\Types\Primitives\ArrayType",
            "boolean" => "Envorra\TypeHandler\Types\Primitives\BooleanType",
            "double" => "Envorra\TypeHandler\Types\Primitives\DoubleType",
            "integer" => "Envorra\TypeHandler\Types\Primitives\IntegerType",
            "object" => "Envorra\TypeHandler\Types\Primitives\ObjectType",
            "string" => "Envorra\TypeHandler\Types\Primitives\StringType",
        ], TypeMapFactory::create(Primitive::class));
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_subtype_non_primitive(): void
    {
        $this->assertArraysMatchAfterSort([
            "carbon" => "Envorra\TypeHandler\Types\CarbonType",
            "collection" => "Envorra\TypeHandler\Types\CollectionType",
            "datetime" => "Envorra\TypeHandler\Types\DateTimeType",
            "date" => "Envorra\TypeHandler\Types\DateType",
            "timestamp" => "Envorra\TypeHandler\Types\TimestampType",
        ], TypeMapFactory::create(NonPrimitive::class));
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_subtype_compound(): void
    {
        $this->assertArraysMatchAfterSort([
            "array" => "Envorra\TypeHandler\Types\Primitives\ArrayType",
            "object" => "Envorra\TypeHandler\Types\Primitives\ObjectType",
        ], TypeMapFactory::create(Compound::class));
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_subtype_scalar(): void
    {
        $this->assertArraysMatchAfterSort([
            "boolean" => "Envorra\TypeHandler\Types\Primitives\BooleanType",
            "double" => "Envorra\TypeHandler\Types\Primitives\DoubleType",
            "integer" => "Envorra\TypeHandler\Types\Primitives\IntegerType",
            "string" => "Envorra\TypeHandler\Types\Primitives\StringType",
        ], TypeMapFactory::create(Scalar::class));
    }

    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_subtype_string(): void
    {
        $this->assertArraysMatchAfterSort([
            "string" => "Envorra\TypeHandler\Types\Primitives\StringType",
        ], TypeMapFactory::create(StringContract::class));
    }

    protected function assertArraysMatchAfterSort(array $expected, array $actual): void
    {
        $this->assertTrue(array_multisort($expected, $actual));
        $this->assertEquals($expected, $actual);
    }
}
