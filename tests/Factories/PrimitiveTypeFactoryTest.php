<?php

namespace Envorra\TypeHandler\Tests\Factories;

use Carbon\Carbon;
use Envorra\TypeHandler\Types\DateType;
use Envorra\TypeHandler\Types\CollectionType;
use Envorra\TypeHandler\Types\Primitives\ArrayType;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Types\Primitives\DoubleType;
use Envorra\TypeHandler\Types\Primitives\ObjectType;
use Envorra\TypeHandler\Types\Primitives\IntegerType;
use Envorra\TypeHandler\Types\Primitives\BooleanType;
use Envorra\TypeHandler\Factories\PrimitiveTypeFactory;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Exceptions\TypeFactoryException;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Factories\PrimitiveTypeFactory
 */
class PrimitiveTypeFactoryTest extends TestCase
{

    /**
     * @test
     * @covers ::createFromType
     * @throws TypeFactoryException
     */
    public function it_can_create_from_primitive_types(): void
    {
        $this->assertInstanceOf(StringType::class, PrimitiveTypeFactory::createFromType('string'));
        $this->assertInstanceOf(IntegerType::class, PrimitiveTypeFactory::createFromType('integer'));
        $this->assertInstanceOf(DoubleType::class, PrimitiveTypeFactory::createFromType('double'));
        $this->assertInstanceOf(BooleanType::class, PrimitiveTypeFactory::createFromType('boolean'));
        $this->assertInstanceOf(ArrayType::class, PrimitiveTypeFactory::createFromType('array'));
        $this->assertInstanceOf(ObjectType::class, PrimitiveTypeFactory::createFromType('object'));
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_primitive_values(): void
    {
        $this->assertInstanceOf(StringType::class, PrimitiveTypeFactory::createFromValue('string'));
        $this->assertInstanceOf(IntegerType::class, PrimitiveTypeFactory::createFromValue(10));
        $this->assertInstanceOf(DoubleType::class, PrimitiveTypeFactory::createFromValue(1.5));
        $this->assertInstanceOf(BooleanType::class, PrimitiveTypeFactory::createFromValue(false));
        $this->assertInstanceOf(ArrayType::class, PrimitiveTypeFactory::createFromValue([]));
        $this->assertInstanceOf(ObjectType::class, PrimitiveTypeFactory::createFromValue(new \stdClass()));
    }

    /**
     * @test
     * @throws TypeFactoryException
     */
    public function it_can_create_objects_from_non_primitive_objects(): void
    {
        $this->assertInstanceOf(ObjectType::class, PrimitiveTypeFactory::createFromValue(collect()));
        $this->assertInstanceOf(ObjectType::class, PrimitiveTypeFactory::createFromValue(Carbon::now()));
    }

    /**
     * @test
     * @covers ::create
     * @throws TypeFactoryException
     */
    public function it_can_execute_create_method(): void
    {
        $int = PrimitiveTypeFactory::create('integer', 6);
        $this->assertInstanceOf(IntegerType::class, $int);
        $this->assertSame(6, $int->getValue());
    }
}
