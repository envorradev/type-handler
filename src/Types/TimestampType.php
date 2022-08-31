<?php

namespace Envorra\TypeHandler\Types;

use Envorra\TypeHandler\Attributes\ExtendsType;
use Envorra\TypeHandler\Types\AbstractTypes\DataType;
use Envorra\TypeHandler\Types\Primitives\IntegerType;

/**
 * TimestampType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends DataType<integer>
 */
#[ExtendsType(IntegerType::class)]
class TimestampType extends DataType
{

}
