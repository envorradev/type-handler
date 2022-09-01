<?php

namespace Envorra\TypeHandler\Contracts;

use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * Factory
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template T
 */
interface Factory
{
    public function __construct();

    /**
     * @return void
     */
    public function init(): void;

    /**
     * @return static
     */
    public function newInstance(): static;

    /**
     * @param  string  $property
     * @param  mixed   $value
     * @return static
     */
    public function set(string $property, mixed $value): static;

    /**
     * @param  string  $property
     * @return mixed
     */
    public function get(string $property): mixed;

    /**
     * @return T
     */
    public function create(): mixed;

    /**
     * @param  string  $property
     * @return mixed
     */
    public function __get(string $property): mixed;

    /**
     * @param array<string, mixed> $arguments
     * @return T
     */
    public static function make(array $arguments = []): mixed;

    /**
     * @return static
     */
    public static function instance(): static;
}
