<?php /** @noinspection SpellCheckingInspection */

namespace Envorra\TypeHandler\Tests\Helpers;

use stdClass;
use Illuminate\Support\Collection;
use Envorra\TypeHandler\Tests\TestCase;
use Envorra\TypeHandler\Helpers\JsonHelper;
use Envorra\Castables\Jsonable;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Helpers\JsonHelper
 */
class JsonHelperTest extends TestCase
{

    /**
     * @test
     * @covers ::isJson
     */
    public function it_can_execute_isJson_method(): void
    {
        $this->assertTrue(JsonHelper::isJson('["one"]'));
        $this->assertTrue(JsonHelper::isJson('{}'));
        $this->assertTrue(JsonHelper::isJson('{"one":"two"}'));
        $this->assertFalse(JsonHelper::isJson([]));
        $this->assertFalse(JsonHelper::isJson('string'));
        $this->assertFalse(JsonHelper::isJson('{"invalid":"json",}'));
    }

    /**
     * @test
     * @covers ::isJsonable
     */
    public function it_can_execute_isJsonable_method(): void
    {
        $classWithInterface = new class implements Jsonable {
            public function toJson(): string
            {
                return '{}';
            }
        };

        $classWithMethodOnly = new class {
            public function toJson(): string
            {
                return '{}';
            }
        };

        $this->assertTrue(JsonHelper::isJsonable($classWithInterface));
        $this->assertTrue(JsonHelper::isJsonable($classWithMethodOnly));
        $this->assertTrue(JsonHelper::isJsonable(new Collection()));
        $this->assertFalse(JsonHelper::isJsonable(new stdClass()));
        $this->assertFalse(JsonHelper::isJsonable([]));
    }

    /**
     * @test
     * @covers ::toArray
     */
    public function it_can_execute_toArray_method(): void
    {
        $this->assertEquals(['one' => 'two'], JsonHelper::toArray('{"one":"two"}'));
        $this->assertEquals(['one', 'two'], JsonHelper::toArray('["one","two"]'));
    }

    /**
     * @test
     * @covers ::toJson
     */
    public function it_can_execute_toJson_already_json(): void
    {
        $this->assertEquals('["json"]', JsonHelper::toJson('["json"]'));
    }

    /**
     * @test
     * @covers ::toJson
     */
    public function it_can_execute_toJson_from_array(): void
    {
        $this->assertEquals('["regular","array"]', JsonHelper::toJson([
            'regular',
            'array',
        ]));

        $this->assertEquals('{"assoc":"array","key":"value"}', JsonHelper::toJson([
            'assoc' => 'array',
            'key' => 'value',
        ]));
    }

    /**
     * @test
     * @covers ::toJson
     */
    public function it_can_execute_toJson_from_jsonable(): void
    {
        $jsonable = new class implements Jsonable {
            public array $items = [
                'item 1' => 'value 1',
                'item 2' => 'value 2',
            ];

            public string $name = 'some name';

            public int $anIntValue = 10;

            public function toJson(): string
            {
                return json_encode($this->items);
            }
        };

        $this->assertNotEquals(JsonHelper::toJson($jsonable), json_encode($jsonable));
        $this->assertEquals('{"item 1":"value 1","item 2":"value 2"}', JsonHelper::toJson($jsonable));
    }

    /**
     * @test
     * @covers ::toJson
     */
    public function it_can_execute_toJson_from_object(): void
    {
        $this->assertEquals('{"object":"value"}', JsonHelper::toJson((object) ['object' => 'value']));

        $this->assertEquals('{"propOne":"string 1","propTwo":100}',
            JsonHelper::toJson(new class {
                public string $propOne = 'string 1';
                public int $propTwo = 100;
            })
        );
    }

    /**
     * @test
     * @covers ::toObject
     */
    public function it_can_execute_toObject_method(): void
    {
        $this->assertEquals((object) ['one' => 'two'], JsonHelper::toObject('{"one":"two"}'));
        $this->assertEquals((object) ['one', 'two'], JsonHelper::toObject('["one","two"]'));
    }

    /**
     * @test
     * @covers ::tryToArray
     */
    public function it_can_execute_tryToArray_method(): void
    {
        $this->assertEquals(['one'], JsonHelper::tryToArray('["one"]'));
        $this->assertNull(JsonHelper::tryToArray('{"not valid",'));
        $this->assertNull(JsonHelper::tryToArray([]));
    }

    /**
     * @test
     * @covers ::tryToObject
     */
    public function it_can_execute_tryToObject_method(): void
    {
        $this->assertEquals((object) ['one'], JsonHelper::tryToObject('["one"]'));
        $this->assertNull(JsonHelper::tryToObject('{"not valid",'));
        $this->assertNull(JsonHelper::tryToObject([]));
    }
}
