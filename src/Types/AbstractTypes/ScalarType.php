<?php

namespace Envorra\TypeHandler\Types\AbstractTypes;

use Envorra\TypeHandler\Contracts\Types\Scalar;

/**
 * ScalarType
 *
 * @package  Envorra\TypeHandler\Types
 *
 * @template TScalar
 *
 * @extends PrimitiveType<TScalar>
 * @implements Scalar<TScalar>
 */
abstract class ScalarType extends PrimitiveType implements Scalar
{

}
