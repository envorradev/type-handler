<?php

namespace Envorra\TypeHandler\Attributes;

use Attribute;

/**
 * ExtendsType
 *
 * @package Envorra\TypeHandler\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ExtendsType
{
    /**
     * @param  string       $type
     */
    public function __construct(
        public string $type,
    ) {}
}
