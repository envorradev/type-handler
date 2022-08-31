<?php

namespace Envorra\TypeHandler\Types;

use Carbon\Carbon;
use Envorra\TypeHandler\Types\AbstractTypes\DataType;
use Envorra\TypeHandler\Attributes\ExtendsObjectType;

/**
 * DateType
 *
 * @package Envorra\TypeHandler\Types
 *
 * @extends DataType<Carbon>
 */
#[ExtendsObjectType(Carbon::class)]
class DateType extends DataType
{

}
