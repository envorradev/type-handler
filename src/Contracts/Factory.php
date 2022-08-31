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
    /**
     * Constructor
     */
    public function __construct();

    /**
     * @return T
     */
    public function create(): mixed;

    /**
     * @return self
     */
    public function newInstance(): self;

    /**
     * @param  mixed  $value
     * @return self
     */
    public function fromValue(mixed $value): self;

    /**
     * @param  Type  $type
     * @return self
     */
    public function fromType(Type $type): self;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param  mixed  $value
     * @return T
     */
    public static function createFromValue(mixed $value): mixed;
}
