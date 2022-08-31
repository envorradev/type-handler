<?php

namespace Envorra\TypeHandler\Contracts;

/**
 * HandlerConstants
 *
 * @package Envorra\TypeHandler\Contracts
 */
interface PackageConstants
{
    const NAMESPACE_TYPES = 'Envorra\\TypeHandler\\Types\\';
    const NAMESPACE_PRIMITIVES = self::NAMESPACE_TYPES.'Primitives\\';

    const PATTERN_TYPE_CLASS = '{$dataType}Type';
    const PATTERN_PRIMITIVE_CLASS = self::PATTERN_TYPE_CLASS;
}
