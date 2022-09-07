<?php

namespace Envorra\TypeHandler\Tests\Factories;

use Envorra\TypeHandler\Types\DateType;
use Envorra\TypeHandler\Types\CarbonType;
use Envorra\TypeHandler\Helpers\JsonHelper;
use Envorra\TypeHandler\Types\DateTimeType;
use Envorra\TypeHandler\Types\TimestampType;
use Envorra\TypeHandler\Types\CollectionType;
use Envorra\TypeHandler\Factories\TypeFactory;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Types\Primitives\ArrayType;
use Envorra\TypeHandler\Types\Primitives\StringType;
use Envorra\TypeHandler\Types\Primitives\DoubleType;
use Envorra\TypeHandler\Types\Primitives\ObjectType;
use Envorra\TypeHandler\Types\Primitives\IntegerType;
use Envorra\TypeHandler\Types\Primitives\BooleanType;
use Envorra\TypeHandler\Exceptions\TypeFactoryException;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Factories\TypeFactory
 */
class TypeFactoryTest extends TestCase
{
    /**
     * @test
     * @covers ::createFromType
     * @throws TypeFactoryException
     */
    public function it_can_create_from_primitive_types(): void
    {
        $this->assertInstanceOf(StringType::class, TypeFactory::createFromType('string'));
        $this->assertInstanceOf(IntegerType::class, TypeFactory::createFromType('integer'));
        $this->assertInstanceOf(DoubleType::class, TypeFactory::createFromType('double'));
        $this->assertInstanceOf(BooleanType::class, TypeFactory::createFromType('boolean'));
        $this->assertInstanceOf(ArrayType::class, TypeFactory::createFromType('array'));
        $this->assertInstanceOf(ObjectType::class, TypeFactory::createFromType('object'));
    }

    /**
     * @test
     * @covers ::createFromType
     * @throws TypeFactoryException
     */
    public function it_can_create_from_non_primitive_types(): void
    {
        $this->assertInstanceOf(CollectionType::class, TypeFactory::createFromType('collection'));
        $this->assertInstanceOf(DateTimeType::class, TypeFactory::createFromType('datetime'));
        $this->assertInstanceOf(DateType::class, TypeFactory::createFromType('date'));
        $this->assertInstanceOf(CarbonType::class, TypeFactory::createFromType('carbon'));
        $this->assertInstanceOf(TimestampType::class, TypeFactory::createFromType('timestamp'));
    }

    /**
     * @test
     * @covers ::createFromType
     * @throws TypeFactoryException
     */
    public function it_can_create_string_from_non_existent_type(): void
    {
        $this->assertInstanceOf(StringType::class, TypeFactory::createFromType('invalid'));
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_scalar_values(): void
    {
        $stringType = TypeFactory::createFromValue('a string');
        $this->assertInstanceOf(StringType::class, $stringType);
        $this->assertSame('a string', $stringType->getValue());

        $intType = TypeFactory::createFromValue(10);
        $this->assertInstanceOf(IntegerType::class, $intType);
        $this->assertSame(10, $intType->getValue());

        $doubleType = TypeFactory::createFromValue(1.5);
        $this->assertInstanceOf(DoubleType::class, $doubleType);
        $this->assertSame(1.5, $doubleType->getValue());

        $boolType = TypeFactory::createFromValue(true);
        $this->assertInstanceOf(BooleanType::class, $boolType);
        $this->assertSame(true, $boolType->getValue());
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_array_value(): void
    {
        $arrayType = TypeFactory::createFromValue(['a']);
        $this->assertInstanceOf(ArrayType::class, $arrayType);
        $this->assertSame(['a'], $arrayType->getValue());
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_object_value_stdClass(): void
    {
        $object = new \stdClass();
        $object->one = 'two';

        $objectType = TypeFactory::createFromValue($object);
        $this->assertInstanceOf(ObjectType::class, $objectType);
        $this->assertSame($object, $objectType->getValue());
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_object_value_collection(): void
    {
        $collectionType = TypeFactory::createFromValue(collect(['one','two']));
        $this->assertInstanceOf(CollectionType::class, $collectionType);
        $this->assertEquals(collect(['one', 'two']), $collectionType->getValue());
    }

    /**
     * @test
     * @covers ::createFromValue
     * @throws TypeFactoryException
     */
    public function it_can_create_from_object_value_no_class_type(): void
    {
        $type = TypeFactory::createFromValue($this);
        $this->assertInstanceOf(ObjectType::class, $type);
        $this->assertEquals(JsonHelper::toObject(JsonHelper::toJson($this)), $type->getValue());
    }

    /**
     * @test
     * @covers ::create
     * @throws TypeFactoryException
     */
    public function it_can_create_with_no_parameters(): void
    {
        $this->assertInstanceOf(StringType::class, TypeFactory::create());
    }

    /**
     * @test
     * @covers ::create
     * @throws TypeFactoryException
     */
    public function it_can_create_array_from_json(): void
    {
        $json = '{"key":"value"}';
        $type = TypeFactory::create('array', $json);
        $this->assertInstanceOf(ArrayType::class, $type);
        $this->assertEquals(['key' => 'value'], $type->getValue());
        $this->assertEquals($json, $type->getOriginal());
    }

    /**
     * @test
     * @covers ::create
     * @throws TypeFactoryException
     */
    public function it_can_create_array_from_collection(): void
    {
        $collection = collect(['one','two','three']);
        $type = TypeFactory::create('array', $collection);
        $this->assertInstanceOf(ArrayType::class, $type);
        $this->assertEquals(['one','two','three'], $type->getValue());
        $this->assertEquals($collection, $type->getOriginal());
    }

    /**
     * @test
     * @covers ::create
     * @throws TypeFactoryException
     */
    public function it_can_create_using_class_string(): void
    {
        $this->assertInstanceOf(DateTimeType::class, TypeFactory::create(type: DateTimeType::class));
    }
}
