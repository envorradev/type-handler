<?php

namespace Envorra\TypeHandler\Contracts;

use Envorra\TypeHandler\Contracts\Types\Type;

/**
 * Factory
 *
 * @package Envorra\TypeHandler\Contracts
 *
 * @template TFactory
 */
interface Factory
{
    /**
     * Constructor
     */
    public function __construct();

    /**
     * @return TFactory
     */
    public function create(): mixed;

    /**
     * @return self
     */
    public function newInstance(): self;

    /**
     * @param  mixed  $value
     * @return $this
     */
    public function fromValue(mixed $value): self;

    /**
     * @param  Type  $type
     * @return $this
     */
    public function fromType(Type $type): self;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param  mixed  $value
     * @return TFactory
     */
    public static function createFromValue(mixed $value): mixed;
}
