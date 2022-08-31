<?php

namespace Envorra\TypeHandler\Attributes;

use Attribute;
use Envorra\TypeHandler\Types\Primitives\ObjectType;

/**
 * ContainsObjectClass
 *
 * @package Envorra\TypeHandler\Attributes
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ExtendsObjectType extends ExtendsType
{
    /**
     * @param  string  $objectClass
     */
    public function __construct(
        public string $objectClass
    ) {
        parent::__construct(ObjectType::class);
    }
}
