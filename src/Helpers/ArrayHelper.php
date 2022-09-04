<?php

namespace Envorra\TypeHandler\Helpers;

use stdClass;
use Envorra\TypeHandler\Contracts\Castables\Arrayable;

/**
 * ArrayHelper
 *
 * @package Envorra\TypeHandler\Helpers
 */
class ArrayHelper
{
    /**
     * @param  mixed  $value
     * @return bool
     */
    public static function isArray(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    public static function isArrayable(mixed $value): bool
    {
        return method_exists($value, 'toArray');
    }

    /**
     * @param  object  $object
     * @return array
     */
    public static function fromObject(object $object): array
    {
        if(static::isArrayable($object)) {
            return $object->toArray();
        }

        if($object instanceof stdClass) {
            return (array) $object;
        }

        return static::viaJson($object);
    }

    /**
     * @param  mixed  $value
     * @return array
     */
    public static function from(mixed $value): array
    {
        if(static::isArray($value)) {
            return $value;
        }

        if(is_object($value)) {
            return static::fromObject($value);
        }

        return static::viaJson($value);
    }

    /**
     * @param  mixed  $value
     * @return array
     */
    public static function viaJson(mixed $value): array
    {
        return JsonHelper::toArray(JsonHelper::toJson($value));
    }
}
