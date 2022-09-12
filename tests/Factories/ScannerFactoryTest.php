<?php

namespace Envorra\TypeHandler\Tests\Factories;

use Envorra\TypeHandler\Tests\TestCase;
use Violet\ClassScanner\Contracts\Scanner;
use Envorra\TypeHandler\Factories\ScannerFactory;

/**
 * @coversDefaultClass \Envorra\TypeHandler\Factories\ScannerFactory
 */
class ScannerFactoryTest extends TestCase
{
    /**
     * @test
     * @covers ::create
     */
    public function it_can_execute_create_method(): void
    {
        $this->assertInstanceOf(Scanner::class, ScannerFactory::create());
    }

    /**
     * @test
     * @covers ::scannerClass
     */
    public function it_can_execute_scannerClass_method(): void
    {
        $class = ScannerFactory::scannerClass();
        $this->assertIsString($class);
        $this->assertInstanceOf(Scanner::class, new $class());
    }
}
