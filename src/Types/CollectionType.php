<?php

namespace Envorra\TypeHandler\Types;

use Illuminate\Support\Collection;
use Envorra\TypeHandler\Types\AbstractTypes\DataType;
use Envorra\TypeHandler\Attributes\ExtendsObjectType;

/**
 * @CollectionType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends DataType<Collection>
 */
#[ExtendsObjectType(Collection::class)]
class CollectionType extends DataType
{

}
