<?php

namespace Envorra\TypeHandler\Tests\Helpers;

use stdClass;
use Illuminate\Support\Collection;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Helpers\ArrayHelper;
use Envorra\TypeHandler\Contracts\Castables\Arrayable;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Helpers\ArrayHelper
 */
class ArrayHelperTest extends TestCase
{
    /**
     * @test
     * @covers ::fromObject
     */
    public function it_can_execute_fromObject_method_with_arrayable(): void
    {
        $arrayable = new class implements Arrayable {
            public array $items = [
                'one' => 'val one',
                'two' => 'val two',
            ];

            public string $name = 'some name';

            public function toArray(): array
            {
                return $this->items;
            }
        };

        $this->assertEquals([
            'one' => 'val one',
            'two' => 'val two',
        ], ArrayHelper::fromObject($arrayable));
    }

    /**
     * @test
     * @covers ::fromObject
     */
    public function it_can_execute_fromObject_with_non_arrayable(): void
    {
        $object = new class {
            public string $one = 'val one';
            public string $two = 'val two';
        };

        $this->assertEquals([
            'one' => 'val one',
            'two' => 'val two',
        ], ArrayHelper::fromObject($object));
    }

    /**
     * @test
     * @covers ::fromObject
     */
    public function it_can_execute_fromObject_with_stdClass(): void
    {
        $object = new stdClass();
        $object->one = 'val one';
        $object->two = 'val two';

        $this->assertEquals([
            'one' => 'val one',
            'two' => 'val two',
        ], ArrayHelper::fromObject($object));
    }

    /**
     * @test
     * @covers ::from
     */
    public function it_can_execute_from_with_array(): void
    {
        $array = ['one' => 'val one'];

        $this->assertEquals($array, ArrayHelper::from($array));
    }

    /**
     * @test
     * @covers ::from
     */
    public function it_can_execute_from_with_json(): void
    {
        $json = '{"one":"val 1","two":"val 2"}';

        $this->assertEquals([
            'one' => 'val 1',
            'two' => 'val 2',
        ], ArrayHelper::from($json));
    }

    /**
     * @test
     * @covers ::from
     */
    public function it_can_execute_from_with_object(): void
    {
        $array = ['one' => 'val'];

        $this->assertEquals($array, ArrayHelper::from((object) $array));
    }

    /**
     * @test
     * @covers ::from
     */
    public function it_can_execute_from_with_primitives(): void
    {
        $this->assertEquals(['string'], ArrayHelper::from('string'));
        $this->assertEquals([15], ArrayHelper::from(15));
        $this->assertEquals([1.5], ArrayHelper::from(1.5));
    }

    /**
     * @test
     * @covers ::isArray
     */
    public function it_can_execute_isArray_method(): void
    {
        $this->assertTrue(ArrayHelper::isArray([]));
        $this->assertTrue(ArrayHelper::isArray([]));
        $this->assertFalse(ArrayHelper::isArray(new stdClass()));
        $this->assertFalse(ArrayHelper::isArray('string'));
        $this->assertFalse(ArrayHelper::isArray(10));
    }

    /**
     * @test
     * @covers ::isArrayable
     */
    public function it_can_execute_isArrayable_method(): void
    {
        $classWithInterface = new class implements Arrayable {
            public function toArray(): array
            {
                return [];
            }
        };

        $classWithMethodOnly = new class {
            public function toArray(): array
            {
                return [];
            }
        };

        $this->assertTrue(ArrayHelper::isArrayable($classWithInterface));
        $this->assertTrue(ArrayHelper::isArrayable($classWithMethodOnly));

        $this->assertTrue(ArrayHelper::isArrayable(new Collection()));
        $this->assertFalse(ArrayHelper::isArrayable(new stdClass()));
        $this->assertFalse(ArrayHelper::isArrayable([]));
    }

    /**
     * @test
     * @covers ::viaJson
     */
    public function it_can_execute_viaJson_method(): void
    {
        $this->assertEquals(['one'], ArrayHelper::viaJson(['one']));
        $this->assertEquals(['one'], ArrayHelper::viaJson('["one"]'));
    }
}
